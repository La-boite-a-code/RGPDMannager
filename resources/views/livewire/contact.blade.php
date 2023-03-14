<div>
    @if( in_array('files', $fields) )
    <style>
        input[type=file]::-webkit-file-upload-button,
        input[type=file]::file-selector-button {
            color: white;
            background-color: #4a5568;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            margin-inline-start: 0rem;
            margin-inline-end: 1rem;
            border: 1px solid transparent;
            box-shadow: none;
        }
    </style>
    @endif

    <form action="#" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20" wire:submit.prevent="submit">

        @if( $isSend )
        <div class="my-2 bg-green-300 px-4 py-8 text-center rounded-md">
            <p>{{ __('Your email has been sent to us correctly. We will try to answer you as soon as possible.') }}</p>
        </div>
        @endif

        @if( $isError )
        <div class="my-2 bg-red-300 px-4 py-8 text-center rounded-md">
            <p>{{ $errorMessage }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
        @if( in_array('name', $fields) )
        <div class="sm:col-span-2" wire:key="name_div">
            <x-honeypot livewire-model="extraFields" />
            <label for="name" class="block text-sm font-semibold leading-6 text-white">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" autocomplete="name" class="mt-2.5 block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('name') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="name" wire:key="name_input">
            @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        @endif

        @if( in_array('email', $fields) )
        <div class="sm:col-span-2" wire:key="email_div">
            <label for="email" class="block text-sm font-semibold leading-6 text-white">{{ __('Email Address') }}</label>
            <input type="email" name="email" id="email" autocomplete="email" class=" mt-2.5 block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('email') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="email" wire:key="email_input">
            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        @endif

        @if( in_array('topic', $fields) )
            <div class="sm:col-span-2" wire:key="topic_div">
                <label for="subject" class="block text-sm font-semibold leading-6 text-white">{{ __('Topic') }}</label>
                <input type="text" name="subject" id="subject" autocomplete="off" class=" mt-2.5 block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('subject') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="subject" wire:key="topic_input">
                @error('subject')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        @if( in_array('phone_number', $fields) )
            <div class="sm:col-span-2" wire:key="phone_number_div">
                <label for="phoneNumber" class="block text-sm font-semibold leading-6 text-white">{{ __('Phone Number') }}</label>
                <input type="tel" name="phoneNumber" id="phoneNumber" autocomplete="phone" class=" mt-2.5 block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('phoneNumber') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="phoneNumber" wire:key="phone_number_input">
                @error('phoneNumber')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        @if( in_array('message', $fields) )
        <div class="sm:col-span-2" wire:key="message_div">
            <label for="message" class="block text-sm font-semibold leading-6 text-white">{{ __('Message') }}</label>
            <textarea name="message" id="message" rows="4" class="mt-2.5 block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('message') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="message" wire:key="message_input"></textarea>
            @error('message')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        @endif

        @if( in_array('files', $fields) )
        <div class="sm:col-span-2" wire:key="files_div">
            <label class="block text-sm font-semibold leading-6 text-white" for="files">{{ __('Upload Files') }}</label>
            <input class="mt-2.5 block w-full rounded-md border-0 bg-white/5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('files.*') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="files" id="files" type="file" multiple wire:key="files_input">
            @error('files.*')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        @endif

        <div class="sm:col-span-2">
            <livewire:rgpd-consent :consent-name="$consentName" :title='__("I agree to receive an answer by email")' :explanation=' __("Your name, your email address and your telephone number will not be recorded in our databases, nor communicated to third parties, and will only be used, if necessary, to respond to exchanges of emails requested by sending this form.")' :consent-data="['name', 'email', 'phone']" :form-id="$formId" />

            @error('isConsented')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-2">
        <div class="mt-8 flex justify-end">
            <button
                type="submit"
                class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 g-recaptcha"
                wire:loading.attr="disabled"
                data-sitekey="{{ config('services.receptcha.key') }}"
                data-callback='handle'
                data-action='submit'
            >
                <div wire:loading wire:target="submit">
                    <i class="fa-solid fa-spinner fa-spin-pulse fa-spin-reverse mr-3"></i>
                </div>
                {{ __('Send') }}
            </button>
        </div>
        </div>
        </div>
    </form>
    @if( config('rgpdmanager.enable_recaptcha') )
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>
        <script>
            function handle(e) {
                grecaptcha.ready(function () {
                    grecaptcha.execute('{{ config('services.recaptcha.key') }}', {action: 'submit'})
                        .then(function (token) {
                        @this.set('captcha', token);
                        });
                })
            }
        </script>
    @endif
</div>
