@php
    $navItems = __('public.docs.nav');
@endphp

@props([
    'docsLinkExample',
    'docsApiCalendarExample',
    'docsApiJsonExample',
    'docsExamples',
])

<div class="bg-surface">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[240px_minmax(0,1fr)] lg:px-8">
        <aside class="hidden lg:block">
            <div class="sticky top-24">
                <p class="mb-3 text-xs font-semibold uppercase text-muted">{{ __('public.docs.navigation_label') }}</p>
                <x-public.docs-nav :items="$navItems" />
            </div>
        </aside>

        <article class="max-w-3xl">
            <div class="border-b border-line pb-10">
                <p class="text-sm font-semibold uppercase text-accent">{{ __('public.docs.eyebrow') }}</p>
                <h1 class="mt-5 text-4xl font-semibold tracking-normal text-ink sm:text-5xl">
                    {{ __('public.docs.title') }}
                </h1>
                <p class="mt-5 text-lg leading-8 text-muted">{{ __('public.docs.description') }}</p>

                <details class="mt-8 border border-line p-4 lg:hidden">
                    <summary class="cursor-pointer text-sm font-semibold text-ink">{{ __('public.docs.contents') }}</summary>
                    <x-public.docs-nav :items="$navItems" class="mt-4" />
                </details>
            </div>

            <div class="space-y-16 py-12">
                <x-app.section
                    id="getting-started"
                    :title="__('public.docs.sections.getting_started.title')"
                    :intro="__('public.docs.sections.getting_started.body')"
                >
                    <x-app.notice>{{ __('public.docs.sections.getting_started.notice') }}</x-app.notice>
                </x-app.section>

                <x-app.section
                    id="fields"
                    :title="__('public.docs.sections.fields.title')"
                    :intro="__('public.docs.sections.fields.body')"
                >
                    <div class="overflow-x-auto border border-line">
                        <table class="min-w-full divide-y divide-line text-left text-sm">
                            <thead class="bg-paper text-ink">
                                <tr>
                                    <th class="px-4 py-3 font-semibold">{{ __('public.docs.table.field') }}</th>
                                    <th class="px-4 py-3 font-semibold">{{ __('public.docs.table.required') }}</th>
                                    <th class="px-4 py-3 font-semibold">{{ __('public.docs.table.notes') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-line text-muted">
                                @foreach (__('public.docs.fields') as $field)
                                    <tr>
                                        <td class="px-4 py-3 font-mono text-code-muted">{{ $field['name'] }}</td>
                                        <td class="px-4 py-3">{{ $field['required'] }}</td>
                                        <td class="px-4 py-3">{{ $field['notes'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-app.section>

                <x-app.section
                    id="link"
                    :title="__('public.docs.sections.link.title')"
                    :intro="__('public.docs.sections.link.body')"
                >
                    <x-app.code-block :code="$docsLinkExample" />
                </x-app.section>

                <x-app.section
                    id="api"
                    :title="__('public.docs.sections.api.title')"
                    :intro="__('public.docs.sections.api.body')"
                >
                    <div class="grid gap-6">
                        <x-app.notice>{{ __('public.docs.sections.api.notice') }}</x-app.notice>

                        <div class="grid gap-3">
                            <h3 class="text-lg font-semibold text-ink">{{ __('public.docs.sections.api.calendar_response_title') }}</h3>
                            <x-app.code-block :code="$docsApiCalendarExample" />
                        </div>

                        <div class="grid gap-3">
                            <h3 class="text-lg font-semibold text-ink">{{ __('public.docs.sections.api.json_response_title') }}</h3>
                            <x-app.code-block :code="$docsApiJsonExample" />
                        </div>
                    </div>
                </x-app.section>

                <x-app.section
                    id="mcp"
                    :title="__('public.docs.sections.mcp.title')"
                    :intro="__('public.docs.sections.mcp.body')"
                >
                    <div class="grid gap-6">
                        <div class="overflow-x-auto border border-line">
                            <table class="min-w-full divide-y divide-line text-left text-sm">
                                <tbody class="divide-y divide-line text-muted">
                                    @foreach (__('public.docs.mcp_details') as $detail)
                                        <tr>
                                            <th class="w-40 px-4 py-3 font-semibold text-ink">{{ $detail['label'] }}</th>
                                            <td class="px-4 py-3 font-mono text-code-muted">{{ $detail['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="grid gap-3">
                            <h3 class="text-lg font-semibold text-ink">{{ __('public.docs.sections.mcp.example_title') }}</h3>
                            <x-app.code-block :code="__('public.docs.sections.mcp.example')" />
                        </div>

                        <x-app.notice>{{ __('public.docs.sections.mcp.notice') }}</x-app.notice>
                    </div>
                </x-app.section>

                <x-app.section
                    id="examples"
                    :title="__('public.docs.sections.examples.title')"
                    :intro="__('public.docs.sections.examples.body')"
                >
                    <div class="grid gap-6">
                        @foreach ($docsExamples as $example)
                            <div class="grid gap-3">
                                <h3 class="text-lg font-semibold text-ink">{{ $example['title'] }}</h3>
                                <x-app.code-block :code="$example['code']" />
                            </div>
                        @endforeach
                    </div>
                </x-app.section>

                <x-app.section
                    id="privacy"
                    :title="__('public.docs.sections.privacy.title')"
                    :intro="__('public.docs.sections.privacy.body')"
                >
                    <ul class="grid gap-3 text-base leading-7 text-muted">
                        @foreach (__('public.docs.privacy_points') as $point)
                            <li class="border-l border-line pl-4">{{ $point }}</li>
                        @endforeach
                    </ul>
                </x-app.section>
            </div>
        </article>
    </div>
</div>
