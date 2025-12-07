@component('mail::message')
{{-- Header --}}
# 📢 New Career Application Received

Hello Team,

A new career application has been submitted. Please find the details below.

{{-- Applicant Details Panel --}}
@component('mail::panel')
**👤 Name:** {{ $application->name }}  <br>
**✉️ Email:** {{ $application->email }}  <br>
**📞 Phone:** {{ $application->phone }}  <br>
**💼 Job Title:** {{ $application->job_title }}  <br>

@if($application->resume)
**📄 Resume:** [Open Resume]({{ asset('storage/' . $application->resume) }})
@endif
@endcomponent

{{-- Additional Instructions --}}
@if($application->resume)
You can download the applicant's resume attached with this email for offline reference.
@endif

{{-- Call-to-Action Button --}}
{{-- @component('mail::button', ['url' => config('app.url'), 'color' => 'success'])
View Dashboard
@endcomponent --}}

{{-- Footer --}}
Thank you,  <br>
**Iconic Engineering Ltd**
<small style="color:#888;">This is an automated notification. Please do not reply to this email.</small>
@endcomponent
