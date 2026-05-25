@php
    $timezoneOptions = __('public.form.timezone_options');
    $alarmOptions = __('public.form.alarm_options');
@endphp

<div class="bg-surface">
    <section class="border-b border-line">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 py-14 sm:px-6 lg:grid-cols-[minmax(0,0.9fr)_minmax(420px,1fr)] lg:px-8 lg:py-20">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase text-accent">{{ __('public.home.eyebrow') }}</p>
                <h1 class="mt-5 text-5xl font-semibold leading-none tracking-normal text-ink sm:text-6xl">
                    {{ __('public.home.title') }}
                </h1>
                <p class="mt-6 max-w-xl text-xl leading-8 text-muted">
                    {{ __('public.home.description') }}
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-app.button href="#calendar-form">
                        {{ __('public.home.primary_cta') }}
                    </x-app.button>
                    <x-app.button href="{{ route('docs') }}" variant="outline">
                        {{ __('public.home.secondary_cta') }}
                    </x-app.button>
                </div>
            </div>

            <form id="calendar-form" method="GET" action="{{ route('ics.create') }}" class="scroll-mt-24 border border-line bg-paper p-5 sm:p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-ink">{{ __('public.form.title') }}</h2>
                    <p class="mt-2 text-sm leading-6 text-muted">{{ __('public.form.description') }}</p>
                </div>

                @if ($errors->any())
                    <x-app.notice class="mb-6 border-red-600 bg-red-50 text-red-950">
                        {{ __('public.form.error_summary') }}
                    </x-app.notice>
                @endif

                <div class="grid gap-5">
                    <x-form.input
                        name="title"
                        :label="__('public.form.fields.title')"
                        :required="true"
                        autocomplete="off"
                    />

                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-form.input
                            name="start"
                            type="datetime-local"
                            :label="__('public.form.fields.start')"
                            :required="true"
                        />
                        <x-form.input
                            name="end"
                            type="datetime-local"
                            :label="__('public.form.fields.end')"
                            :required="true"
                        />
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-form.select
                            name="timezone"
                            :label="__('public.form.fields.timezone')"
                            :options="$timezoneOptions"
                            value="Europe/Oslo"
                            :required="true"
                        />
                        <x-form.select
                            name="alarm_minutes"
                            :label="__('public.form.fields.alarm')"
                            :options="$alarmOptions"
                            value=""
                        />
                    </div>

                    <x-form.input
                        name="location"
                        :label="__('public.form.fields.location')"
                        autocomplete="off"
                    />

                    <x-form.textarea
                        name="description"
                        :label="__('public.form.fields.description')"
                        rows="3"
                    />

                    <x-form.input
                        name="url"
                        type="url"
                        :label="__('public.form.fields.url')"
                        :placeholder="__('public.form.placeholders.url')"
                    />

                    <x-form.checkbox
                        name="all_day"
                        :label="__('public.form.fields.all_day')"
                        :description="__('public.form.fields.all_day_description')"
                    />

                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <x-app.button type="submit">
                            {{ __('public.form.submit') }}
                        </x-app.button>
                        <x-app.link href="{{ route('docs') }}#link">
                            {{ __('public.form.link_help') }}
                        </x-app.link>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <x-app.section :title="__('public.home.steps_title')" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <ol class="grid gap-6 md:grid-cols-3">
            @foreach (__('public.home.steps') as $step)
                <li class="border-t border-line pt-5">
                    <p class="text-sm font-semibold text-accent">{{ $step['label'] }}</p>
                    <h3 class="mt-3 text-xl font-semibold text-ink">{{ $step['title'] }}</h3>
                    <p class="mt-3 text-base leading-7 text-muted">{{ $step['body'] }}</p>
                </li>
            @endforeach
        </ol>
    </x-app.section>

    <x-app.section
        :title="__('public.home.docs_title')"
        :intro="__('public.home.docs_body')"
        class="mx-auto max-w-7xl border-t border-line px-4 py-16 sm:px-6 lg:px-8"
    >
        <div class="flex flex-wrap gap-3">
            <x-app.button href="{{ route('docs') }}">
                {{ __('public.home.docs_primary') }}
            </x-app.button>
            <x-app.button href="{{ route('docs') }}#examples" variant="outline">
                {{ __('public.home.docs_secondary') }}
            </x-app.button>
        </div>
    </x-app.section>

    <x-app.section
        :title="__('public.home.about_title')"
        :intro="__('public.home.about_body')"
        class="mx-auto max-w-7xl border-t border-line px-4 py-16 sm:px-6 lg:px-8"
    >
        <x-app.notice>
            {{ __('public.home.about_notice') }}
        </x-app.notice>
    </x-app.section>
</div>
