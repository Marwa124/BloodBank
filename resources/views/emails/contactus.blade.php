@component('mail::message')
# Redirected BloodBank

Thanks, <strong>{{ $contact['name'] }}</strong> for contact with us.<br>
<p>We'll revise your form so soon.</p>

@component('mail::button', ['url' => 'http://ipda3.com', 'color' => 'success'])
Our website
@endcomponent

{{ config('app.name') }}
@endcomponent
