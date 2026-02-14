@component('mail::message')
# Nouveau message de contact

Vous avez reçu un nouveau message depuis le formulaire de contact de **PC Shop**.

**Nom :** {{ $msg->name }}  
**Email :** {{ $msg->email }}  
@if($msg->subject)
**Sujet :** {{ $msg->subject }}  
@endif

---

**Message :**

{{ $msg->message }}

---

@component('mail::subcopy')
Cet email a été généré automatiquement par votre site PC Shop.
@endcomponent
@endcomponent