<html>
<body>
@component('mail::message')
# REGISTRATION INFOS FOR LOGIN TO LARAQULITY


Hi {{$mailData['name']}},

Welcome to LaraQuality

<b>Username:</b> {{$mailData['email']}}<br>
<b>Password:</b> {{$mailData['password']}}

@component('mail::button', ['url' => 'http://localhost:8000/login', 'color' => 'success'])
    LOGIN
@endcomponent

THANKS,<br>
{{ config('app.name') }}
@endcomponent
</body>
</html>
