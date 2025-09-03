@component('mail::message')

# Name
{{ $contact->name }}<br>

# Email
{{ $contact->email }}<br>

# Phone
{{ $contact->phone }}<br>

# Subject
{{ $contact->subject ?? 'Need a Quotation!' }}<br>

# Message
{{ $contact->message ?? 'No messages!' }}

@endcomponent