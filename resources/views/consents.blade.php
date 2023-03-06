<x-rgpdmanager-r-g-p-d-manager-layout>
    <div class="mx-auto max-w-5xl">
        <h2 class="text-3xl font-bold tracking-tight text-white text-center sm:text-4xl">{{ __('Your Consents') }}</h2>
        <p class="mt-2 text-lg leading-8 text-gray-100 text-center">{{ __("From this page you can manage all the permissions you have granted to the site by activating / deactivating your consents.") }}</p>

        <div class="my-4">
            <h4 class="text-white">{{ trans('rgpdmanager::rgpd.forms.contact.title') }}</h4>
            <livewire:rgpd-consent consent-name="consent-contact" :title="__('I agree to receive an answer by email')" :explanation=" __('Your name, your email address and your telephone number will not be recorded in our databases, nor communicated to third parties, and will only be used, if necessary, to respond to exchanges of emails requested by sending this form.')" :consent-data="['name', 'email', 'phone']" />
        </div>

        <div class="my-4">
            <h4 class="text-white">{{ trans('rgpdmanager::rgpd.forms.pdo.title') }}</h4>
            <livewire:rgpd-consent consent-name="consent-pdo" :title="__('I agree to receive an answer by email')" :explanation=" __('Your name, your email address and your telephone number will not be recorded in our databases, nor communicated to third parties, and will only be used, if necessary, to respond to exchanges of emails requested by sending this form.')" :consent-data="['name', 'email', 'phone']" />
        </div>

        <div class="my-4">
            <h4 class="text-white">{{ trans('rgpdmanager::rgpd.forms.forgot.title') }}</h4>
            <livewire:rgpd-consent consent-name="consent-forgot" :title="__('I agree to receive an answer by email')" :explanation=" __('Your name, your email address and your telephone number will not be recorded in our databases, nor communicated to third parties, and will only be used, if necessary, to respond to exchanges of emails requested by sending this form.')" :consent-data="['name', 'email', 'phone']" />
        </div>

        <div class="my-4">
            <h4 class="text-white">{{ trans('rgpdmanager::rgpd.forms.data.title') }}</h4>
            <livewire:rgpd-consent consent-name="consent-data" :title="__('I agree to receive an answer by email')" :explanation=" __('Your name, your email address and your telephone number will not be recorded in our databases, nor communicated to third parties, and will only be used, if necessary, to respond to exchanges of emails requested by sending this form.')" :consent-data="['name', 'email', 'phone']" />
        </div>
    </div>
</x-rgpdmanager-r-g-p-d-manager-layout>