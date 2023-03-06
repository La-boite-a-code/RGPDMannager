<x-mail::message>
# {{ trans('rgpdmanager::mails.' . $type) }}

@if( strlen($subject) > 0 )
### {{ trans('rgpdmanager::rgpd.topic') }}: {{ $subject }}
@endif

{{ $name }}({{ $email }}) {{ trans('rgpdmanager::rgpd.message_sended') }}

<x-mail::panel>
{{ $message }}
</x-mail::panel>

@if( strlen($phoneNumber) > 0 )
{{ trans('rgpdmanager::rgpd.phone_sended') }} : {{ $phoneNumber }}
@endif

{{ trans('rgpdmanager::rgpd.thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>