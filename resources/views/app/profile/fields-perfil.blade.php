

@if(Route::is('changePassword'))
<!-- Contraseña Actual -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Contraseña Actual</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="password" name="current_password" placeholder="Ingrese su contraseña actual" 
            class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full dark:text-color18 dark:placeholder:text-color18">
    </div>
    @error('current_password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Nueva Contraseña -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Nueva Contraseña</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="password" name="new_password" placeholder="Ingrese su nueva contraseña" 
            class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full dark:text-color18 dark:placeholder:text-color18">
    </div>
    @error('new_password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Confirmar Nueva Contraseña -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Confirmar Nueva Contraseña</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="password" name="new_password_confirmation" placeholder="Confirme su nueva contraseña" 
            class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full dark:text-color18 dark:placeholder:text-color18">
    </div>
    @error('new_password_confirmation')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

@else
<!-- Foto de Perfil -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Foto de Perfil</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="file" name="file_foto_perfil" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
    </div>
</div>

<!-- Primer Nombre -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Primer Nombre</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="text" name="primer_nombre" placeholder="Ingrese Primer Nombre" value="{{ Auth::user()->primer_nombre }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
    </div>
</div>

<!-- Segundo Nombre -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Segundo Nombre</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="text" name="segundo_nombre" placeholder="Ingrese Segundo Nombre" value="{{ Auth::user()->segundo_nombre }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
    </div>
</div>

<!-- Primer Apellido -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Primer Apellido</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="text" name="primer_apellido" placeholder="Ingrese Primer Apellido" value="{{ Auth::user()->primer_apellido }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
    </div>
</div>

<!-- Segundo Apellido -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Segundo Apellido</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="text" name="segundo_apellido" placeholder="Ingrese Segundo Apellido" value="{{ Auth::user()->segundo_apellido }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
    </div>
</div>

<!-- Celular -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Celular</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="tel" name="celular" placeholder="Ingrese Número de Celular" value="{{ Auth::user()->celular }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
        <i class="ph ph-phone text-xl text-bgColor18 !leading-none"></i>
    </div>
</div>

<!-- Email -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Correo</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="email" name="email" disabled placeholder="Ingrese Email" value="{{ Auth::user()->email }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
        <i class="ph ph-envelope-simple text-xl text-bgColor18 !leading-none"></i>
    </div>
</div>

<!-- Documento -->
<div class="input-field">
    <p class="text-sm font-semibold pb-2">Documento</p>
    <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
        <input type="text" name="documento" disabled placeholder="Ingrese Documento" value="{{ Auth::user()->documento }}" class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
    </div>
</div>
@endif