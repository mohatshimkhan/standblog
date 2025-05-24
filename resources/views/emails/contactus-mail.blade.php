@component('mail::message')
# Introduction

The body of your message.

<h3>{{ $details['name'] }}</h3>
<h3>{{ $details['email'] }}</h3>
<h3>{{ $details['mobile'] }}</h3>
<h3>{{ $details['desc'] }}</h3>


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
