@component('mail::message')
    # Olá {{ $client->name }}

    Seu cadastro foi recebido com sucesso.

    **Dados básicos**
    - E-mail: {{ $client->email }}
    - Telefone: {{ $client->phone ?? '—' }}

    Obrigado,<br>
    {{ config('app.name') }}
@endcomponent
