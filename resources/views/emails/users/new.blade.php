@component('mail::message')
{{-- Logo --}}
<p style="text-align:center; margin-bottom:20px;">
    <img src="cid:logo.png" alt="{{ config('app.name') }}" style="width:150px; height:auto;">
</p>

{{-- Salutation --}}
# Bonjour {{ $user->prenom }} {{ $user->nom }},

Un compte a été créé pour vous sur **{{ config('app.name') }}**.

{{-- Identifiants --}}
<div style="background-color:#f7f7f7; padding:15px; border-radius:8px; margin:15px 0;">
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Mot de passe :</strong> <code>{{ $password }}</code></p>
</div>

Merci de modifier votre mot de passe dès votre première connexion pour garantir la sécurité de votre compte.

{{-- Bouton connexion --}}
@component('mail::button', ['url' => url('/login'), 'color' => 'success'])
Se connecter
@endcomponent

Cordialement,<br>
L'équipe {{ config('app.name') }}

{{-- Footer --}}
@slot('subcopy')
Vous recevez cet e-mail car un compte a été créé pour vous sur notre plateforme. Si vous n'avez pas demandé ce compte, veuillez contacter le support.
@endslot
@endcomponent
