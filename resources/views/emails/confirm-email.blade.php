@component('mail::message')
# One Last Step

We just need you to confirm your email addressto prove that you're a human. You get it, right? Cool.

The body of your message.

@component('mail::button', ['url' => url('/register/confirm?token=' .$user->confirmation_token)])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
