<x-mail::message>
# Bienvenue sur GEDAC +, {{ $user->prenom }} !

Bonjour {{ $user->prenom }} {{ $user->nom }},

Votre compte a été créé avec succès sur **GEDAC +**, notre application de gestion de stock. Vous pouvez désormais accéder à votre compte et utiliser nos services.

Voici vos informations de connexion :

- **Nom d'utilisateur** : {{ $user->email }}
- **Rôle** : {{ $user->role->libelle }}
- **Mot de passe** : {{ $password }}

Vous pouvez vous connecter en utilisant l'email que vous avez fourni et le mot de passe que vous avez défini.

Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.

Merci,  
L'équipe IT & Système COREX-International

</x-mail::message>
