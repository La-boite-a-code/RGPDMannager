<x-rgpdmanager-r-g-p-d-manager-layout>
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ trans('rgpdmanager::rgpd.forms.' . $key . '.title') }}</h2>
        <p class="mt-2 text-lg leading-8 text-gray-100">{{ trans('rgpdmanager::rgpd.forms.' . $key . '.description') }}</p>

        @livewire('rgpd-contact', ['consentName' => 'consent-' . $key])
    </div>

</x-rgpdmanager-r-g-p-d-manager-layout>