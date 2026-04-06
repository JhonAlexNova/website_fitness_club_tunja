@component('mail::message')
# Verifica tu perfil

Hola {{ $user->primer_nombre ?? $user->name ?? 'usuario' }},

Para completar el registro en tu cuenta, usa este código de verificación:

@component('mail::panel')
{{ $code }}
@endcomponent

Este código vence el {{ $expiresAt }}.

Si no creaste esta cuenta, puedes ignorar este mensaje.

Gracias,  
Equipo Fitness Club
@endcomponent
