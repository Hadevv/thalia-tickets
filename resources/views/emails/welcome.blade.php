<x-mail::message>
# Introduction

Bienvenue sur {{ config('app.name') }}! Nous sommes ravis de vous compter parmi nos utilisateurs.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
