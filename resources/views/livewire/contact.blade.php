<div>
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

    <form action="#" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20" wire:submit.prevent="submit">
        <x-honeypot livewire-model="extraFields" />
        @if( $isSend )
        <div class="my-2 bg-green-300 px-4 py-8 text-center rounded-md">
            <p>{{ __('Your email has been sent to us correctly. We will try to answer you as soon as possible.') }}</p>
        </div>
        @endif
        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
            @if( in_array('name', $fields) )
            <div>
                <label for="name" class="block text-sm font-semibold leading-6 text-white">{{ __('Name') }}</label>
                <div class="mt-2.5">
                    <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('name') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model.debounce.1000ms="name">
                    @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            @if( in_array('email', $fields) )
            <div>
                <label for="email" class="block text-sm font-semibold leading-6 text-white">{{ __('Email Address') }}</label>
                <div class="mt-2.5">
                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('email') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model.debounce.1000ms="email">
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            @if( in_array('topic', $fields) )
            <div class="sm:col-span-2">
                <label for="subject" class="block text-sm font-semibold leading-6 text-white">{{ __('Topic') }}</label>
                <div class="mt-2.5">
                    <input type="text" name="subject" id="subject" autocomplete="off" class="block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('subject') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model.debounce.1000ms="subject">
                    @error('subject')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            @if( in_array('phone_number', $fields) )
            <div class="sm:col-span-2">
                <label for="phoneNumber" class="block text-sm font-semibold leading-6 text-white">{{ __('Phone Number') }}</label>
                <div class="mt-2.5">
                    <input type="tel" name="phoneNumber" id="phoneNumber" autocomplete="phone" class="block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('phoneNumber') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model.debounce.1000ms="phoneNumber">
                    @error('phoneNumber')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            @if( in_array('message', $fields) )
            <div class="sm:col-span-2">
                <label for="message" class="block text-sm font-semibold leading-6 text-white">{{ __('Message') }}</label>
                <div class="mt-2.5">
                    <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 bg-white/5 py-2 px-3.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('message') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model.debounce.1000ms="message"></textarea>
                    @error('message')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            @if( in_array('files', $fields) )
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold leading-6 text-white" for="files">{{ __('Upload Files') }}</label>
                <div class="mt-2.5">
                    <input class="block w-full rounded-md border-0 bg-white/5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('files.*') border-red-500 ring-red-500 text-red-900 placeholder-red-300 @enderror" wire:model="files" id="files" type="file" multiple >
                    @error('files.*')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            <div class="sm:col-span-2">
                <livewire:rgpd-consent :consent-name="$consentName" :title='__("I agree to receive an answer by email")' :explanation=' __("Your name, your email address and your telephone number will not be recorded in our databases, nor communicated to third parties, and will only be used, if necessary, to respond to exchanges of emails requested by sending this form.")' :consent-data="['name', 'email', 'phone']" :form-id="$formId" />

                @error('isConsented')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <button type="submit" class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" wire:loading.attr="disabled">{{ __('Send') }}</button>
        </div>
    </form>
</div>
