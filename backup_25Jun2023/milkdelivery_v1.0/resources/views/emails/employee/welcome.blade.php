@component('mail::message')
# Welcome to MilkDelivery
@php
$url = route('login');
@endphp

Dear {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }} your account has been created successfully.
<br> 
Please login to update your profile using given credentials <br>

Email -> {{ $user->email }}
Password ->{{ $user->org_password }}

@component('mail::button', ['url' => $url])
Go to Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
