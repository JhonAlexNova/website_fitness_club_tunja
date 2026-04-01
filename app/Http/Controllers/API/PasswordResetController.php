<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    // PASO 1: Enviar código al correo
    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('password_reset_codes')->updateOrInsert(
            ['email' => $request->email],
            [
                'code'       => $code,
                'expires_at' => Carbon::now()->addMinutes(15),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Enviar email simple (sin Mailable extra)
        Mail::raw(
            "Tu código de recuperación es: {$code}\nVálido por 15 minutos.",
            fn($msg) => $msg
                ->to($request->email)
                ->subject('Código de recuperación - Fitness Club')
        );

        return response()->json(['message' => 'Código enviado correctamente']);
    }

    // PASO 2: Verificar código
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|string|size:6',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Código incorrecto'], 422);
        }

        if (Carbon::now()->isAfter($record->expires_at)) {
            return response()->json(['message' => 'El código ha expirado'], 422);
        }

        return response()->json(['message' => 'Código válido']);
    }

   // PASO 3: Cambiar contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'code'     => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$record || Carbon::now()->isAfter($record->expires_at)) {
            return response()->json(['message' => 'Código inválido o expirado'], 422);
        }

        // Buscar el usuario explícitamente
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }
}