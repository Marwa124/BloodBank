@component('mail::message')
# Resetting login password

<h5>Your pin code is: <span>{{ $pincode }}</span></h5>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
