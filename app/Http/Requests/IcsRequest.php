<?php

namespace App\Http\Requests;

use App\Services\CalendarEventNormalizer;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class IcsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return CalendarEventNormalizer::rules();
    }

    /**
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                app(CalendarEventNormalizer::class)->addAfterValidationErrors(
                    $validator,
                    $this->all(),
                    $this->isMethod('GET') ? strlen($this->getRequestUri()) : null,
                );
            },
        ];
    }

    protected function failedValidation(ValidatorContract $validator): void
    {
        if (! $this->expectsJson()) {
            throw new HttpResponseException(
                redirect()
                    ->to(route('home').'#calendar-form')
                    ->withErrors($validator)
                    ->withInput()
            );
        }

        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
