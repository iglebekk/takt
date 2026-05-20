<?php

namespace App\Services;

use App\Data\CalendarEventData;
use Carbon\CarbonImmutable;
use DateTimeZone;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Throwable;

class CalendarEventNormalizer
{
    /**
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'start' => ['required', 'string', 'max:64'],
            'end' => ['required', 'string', 'max:64'],
            'description' => ['nullable', 'string', 'max:5000'],
            'location' => ['nullable', 'string', 'max:1000'],
            'url' => ['nullable', 'url', 'starts_with:https://', 'max:2048'],
            'timezone' => ['nullable', 'string', 'timezone:all'],
            'alarm_minutes' => ['nullable', 'integer', Rule::in([0, 5, 10, 15, 30, 60, 1440])],
            'all_day' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @param  array<string, mixed>  $input
     *
     * @throws ValidationException
     */
    public function validate(array $input): CalendarEventData
    {
        $validator = ValidatorFacade::make($input, self::rules());

        $validator->after(fn (Validator $validator): mixed => $this->addAfterValidationErrors($validator, $input));

        return $this->normalize($validator->validate());
    }

    /**
     * @param  array<string, mixed>  $validated
     */
    public function normalize(array $validated): CalendarEventData
    {
        $allDay = filter_var($validated['all_day'] ?? false, FILTER_VALIDATE_BOOL);
        $timezone = $this->nullableString($validated, 'timezone');

        return new CalendarEventData(
            title: trim((string) $validated['title']),
            start: $this->parseDateTime((string) $validated['start'], $timezone, $allDay),
            end: $this->parseDateTime((string) $validated['end'], $timezone, $allDay),
            description: $this->nullableString($validated, 'description'),
            location: $this->nullableString($validated, 'location'),
            url: $this->nullableString($validated, 'url'),
            timezone: $timezone,
            alarmMinutes: Arr::has($validated, 'alarm_minutes') && $validated['alarm_minutes'] !== null
                ? (int) $validated['alarm_minutes']
                : null,
            allDay: $allDay,
        );
    }

    /**
     * @param  array<string, mixed>  $input
     */
    public function addAfterValidationErrors(Validator $validator, array $input, ?int $requestUriLength = null): void
    {
        if ($validator->errors()->isNotEmpty()) {
            return;
        }

        if ($requestUriLength !== null && $requestUriLength > 4096) {
            $validator->errors()->add('request_uri', 'The request URL may not be greater than 4096 characters.');
        }

        $timezone = $this->nullableString($input, 'timezone');

        if ($this->requiresTimezone((string) $input['start']) || $this->requiresTimezone((string) $input['end'])) {
            if ($timezone === null) {
                $validator->errors()->add('timezone', 'The timezone field is required when start or end does not include a timezone offset.');

                return;
            }
        }

        $allDay = filter_var($input['all_day'] ?? false, FILTER_VALIDATE_BOOL);

        try {
            $start = $this->parseDateTime((string) $input['start'], $timezone, $allDay);
            $end = $this->parseDateTime((string) $input['end'], $timezone, $allDay);
        } catch (Throwable) {
            $validator->errors()->add('start', 'The start and end fields must be valid date values.');

            return;
        }

        if ($allDay) {
            if ($end->startOfDay()->lessThan($start->startOfDay())) {
                $validator->errors()->add('end', 'The end date must be the same as or after the start date.');
            }

            return;
        }

        if ($end->lessThanOrEqualTo($start)) {
            $validator->errors()->add('end', 'The end date must be after the start date.');
        }
    }

    public function requiresTimezone(string $value): bool
    {
        return preg_match('/(?:Z|[+-]\d{2}:?\d{2})$/i', trim($value)) !== 1;
    }

    protected function parseDateTime(string $value, ?string $timezone, bool $allDay): CarbonImmutable
    {
        $date = CarbonImmutable::parse(
            $value,
            $this->requiresTimezone($value) ? new DateTimeZone((string) $timezone) : null,
        );

        if ($allDay) {
            return $date->startOfDay();
        }

        return $date->utc();
    }

    /**
     * @param  array<string, mixed>  $input
     */
    protected function nullableString(array $input, string $key): ?string
    {
        $value = $input[$key] ?? null;

        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
