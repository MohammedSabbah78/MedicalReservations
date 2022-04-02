@component('mail::message')
# Welcome {{$admin->name}}

The body of your message.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin/cities'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent