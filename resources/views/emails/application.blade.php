@component('mail::message')
# Registration Application

The following application was received on {{ now()->format('jS M Y') }} at {{ now()->format('H:i') }}

@component('mail::table')
|              |                            |
| ------------ | -------------------------- |
| Organisation | **{{ $applic->client }}**  |
| Name         | **{{ $applic->name }}**    |
| Email        | **{{ $applic->email }}**   |
| Phone        | **{{ $applic->phone }}**   |
@endcomponent

<br>{{ config('app.name') }} website
@endcomponent
