@component('mail::message')
# Quote Ready

Your quote is ready!

@component('mail::button', ['url' => $url, 'color' => 'success']
View Quote
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent