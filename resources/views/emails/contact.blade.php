<x-mail::message>
    # Contact Form Submission

    <p>Name: {{ $details['name'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    <p>Message: {{ $details['message'] }}</p>

    {{ config('app.name') }}
</x-mail::message>
