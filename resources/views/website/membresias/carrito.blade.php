@extends('website.layouts.app')
@section('title','Carrito de membresía | Fitness Club Tunja')
@section('content')
<main class="container" style="padding:80px 15px 120px;max-width:760px;color:#fff;min-height:70vh">
<a href="{{ route('website.membresias.index') }}" style="color:#00e5ff">← Cambiar membresía</a>
<h1 style="margin:25px 0 8px">Revisa tu membresía</h1><p style="color:#aaa">Confirma el plan y completa tus datos para continuar al pago seguro.</p>
<section id="membership-summary" style="margin:28px 0;padding:24px;background:#151527;border:1px solid rgba(255,255,255,.1);border-radius:16px"></section>
<form id="membership-payment" method="POST" action="{{ route('website.pagos.iniciar') }}" style="padding:24px;background:#151527;border-radius:16px">
@csrf<input type="hidden" name="tipo" value="membresia"><input type="hidden" name="membresia_id" id="membership-id">
<h2 style="font-size:1.2rem">Datos del comprador</h2>
<label>Nombre completo<input required name="nombre" value="{{ auth()->user()->name ?? '' }}" style="display:block;width:100%;padding:12px;margin:7px 0 14px"></label>
<label>Correo electrónico<input required type="email" name="email" value="{{ auth()->user()->email ?? '' }}" style="display:block;width:100%;padding:12px;margin:7px 0 14px"></label>
<label>Teléfono<input required name="telefono" value="{{ auth()->user()->celular ?? '' }}" style="display:block;width:100%;padding:12px;margin:7px 0 14px"></label>
@guest<label>Contraseña<input required type="password" name="password" minlength="8" style="display:block;width:100%;padding:12px;margin:7px 0 14px"></label><label>Repite la contraseña<input required type="password" name="password_confirmation" minlength="8" style="display:block;width:100%;padding:12px;margin:7px 0 14px"></label>@endguest
<button type="submit" style="width:100%;border:0;border-radius:25px;padding:14px;background:linear-gradient(90deg,#8a2be2,#00dff5);color:#fff;font-weight:800">CONTINUAR A WOMPI</button>
</form>
</main>
@endsection
@push('page_scripts')
<script>(function(){const key='fitness_club_membership_cart',cart=JSON.parse(localStorage.getItem(key)||'null'),summary=document.getElementById('membership-summary'),form=document.getElementById('membership-payment');if(!cart){summary.innerHTML='<p>Tu carrito está vacío.</p><a href="{{ route('website.membresias.index') }}">Elegir una membresía</a>';form.hidden=true;return}document.getElementById('membership-id').value=cart.id;summary.innerHTML='<strong style="font-size:1.3rem">'+cart.name+'</strong><p style="color:#00e5ff;font-size:1.7rem;font-weight:800;margin:10px 0">$'+Number(cart.price).toLocaleString('es-CO')+'</p><span style="color:#aaa">'+cart.duration+'</span>'})()</script>
@endpush
