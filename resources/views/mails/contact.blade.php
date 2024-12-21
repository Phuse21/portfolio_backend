@component('mail::message')
    # New Contact Form Submission

    **Name:** {{ $data['firstName'] }} {{ $data['lastName'] }}
    **From:** {{ $data['email'] }}
    **Phone:** {{ $data['phone'] }}
    **Service:** {{ $data['service'] }}
    **Message:**
    {{ $data['message'] }}

    Thanks,
@endcomponent
