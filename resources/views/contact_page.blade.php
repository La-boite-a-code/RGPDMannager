<x-rgpdmanager-r-g-p-d-manager-layout>
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('Contact Us')  }}</h2>

        @livewire('rgpd-contact', ['consentName' => 'consent-contact', 'fields' => config('rgpdmanager.contact_fields'), 'form-rules' => config('rgpdmanager.contact_rules')])
    </div>

</x-rgpdmanager-r-g-p-d-manager-layout>