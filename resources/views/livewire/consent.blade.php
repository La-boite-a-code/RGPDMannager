<div>
    <style>
        .toggle-checkbox:checked {
            @apply: right-0 border-green-400 !important;
            right: 0;
            border-color: #68D391;
        }
        .toggle-checkbox:checked + .toggle-label {
            @apply: bg-green-400 !important;
            background-color: #68D391;
        }
    </style>
    <div class="mb-3block w-full rounded-md border-0 bg-white/5 py-2 px-3.5">
        <div class="flex items-center justify-start">
            <div class="flex justify-center items-center h-full">

                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" name="consent_{{ $consentName }}" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 text-white appearance-none cursor-pointer" id="{{ $consentName }}" wire:model="consented" value="{{ old('consented', 1) }}" />
                    <label for="consent_{{ $consentName }}" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>

{{--                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" id="{{ $consentName }}" wire:model="consented" value="{{ old('consented', 1) }}" name="consented" role="switch">--}}
            </div>
            <div class="ml-3 text-sm">
                <label class="font-medium text-gray-100" for="{{ $consentName }}">{{ __($title) }}</label>
                <p class="text-left text-gray-500">{{ __($explanation) }}</p>
                @if( $alreadyConsented )
                        <a href="{{ route('rgpd-manager.details', ['token' => $token, 'slug' => \Illuminate\Support\Str::replace('_', '-', $consentName)]) }}" class="block pt-2 text-white" title="{{ __('See consent details') }}">{{ __('See consent details') }}</a>
                @endif
            </div>
        </div>

        <input type="hidden" name="consent_name" value="{{ $consentName }}">
        <input type="hidden" name="consent_data" value="{{ $dataParsed }}">
        <input type="hidden" name="consent_token" id="{{ $consentName }}_consent_token" value="{{ $token }}">
        <input type="hidden" name="consent_form_id" id="{{ $consentName }}_consent_form_id" value="{{ $formId }}">
        <input type="hidden" name="consent_form_url" id="{{ $consentName }}_consent_form_url" value="{{ $url }}">
        <input type="hidden" name="consent_explanation" id="{{ $consentName }}_consent_explanation" value="{{ $explanation }}">
    </div>
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof localStorage !== 'undefined') {
                let token = '{{ Str::random(50) }}';
                const SITE_SLUG = '{{ Str::slug(config('app.name')) }}';

                if( !localStorage.getItem(SITE_SLUG + '_consent_token') ) {
                    localStorage.setItem(SITE_SLUG + '_consent_token', token);
                } else {
                    token = localStorage.getItem(SITE_SLUG + '_consent_token');
                }

                window.Livewire.dispatch('setTokenFromLocalStorage', token);
            }
        });
    </script>
    @endpush
</div>