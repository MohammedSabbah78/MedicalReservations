@component('mail::message')
# Welcome {{$admin->name}}
Thanks for your cooperation and support,
@component('mail::panel')
To access CMS your password is {{$password}} <br>
click on below button to login
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin/cities'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent