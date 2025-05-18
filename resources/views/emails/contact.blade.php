@component('mail::message')
# New Contact Message

**From:** {{ $name }} ({{ $email }})

**Subject:** {{ $subject }}

**Message:**
{{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent 