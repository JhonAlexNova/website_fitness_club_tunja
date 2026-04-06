<?php

namespace App\Http\Controllers\API;

use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Mail\ProfileVerificationCodeMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas.'],
            ]);
        }

        $membresiaActiva = $user->membresiaActiva()->with('membresia')->first();

        return response()->json([
            'token'     => $user->createToken('auth_token')->plainTextToken,
            'user'      => $user,
            'membresia' => $membresiaActiva ? $membresiaActiva->membresia->nombre : null
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'nullable|string|max:255',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'celular' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'documento' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|string|max:255',
            'fecha_inscripcion' => 'nullable|date',
            'talla' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'perimetro_abdominal' => 'nullable|numeric',
            'porcentaje_grasa' => 'nullable|numeric',
            'porcentaje_musculo' => 'nullable|numeric',
            'tipo' => 'nullable|in:Instructor,Cliente,Administrador,SuperAdmin',
            'estado' => 'nullable|in:activo,inactivo',
            'objetivos' => 'nullable|array',
            'ppm_max' => 'nullable|numeric',
            'ppm_min' => 'nullable|numeric'
        ]);

        $observaciones = $this->buildObservaciones($data);
        $username = $this->resolveUsername($data);

        $user = User::create([
            'username' => $username,
            'primer_nombre' => $data['primer_nombre'],
            'segundo_nombre' => $data['segundo_nombre'] ?? null,
            'primer_apellido' => $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'] ?? null,
            'celular' => $data['celular'],
            'email' => $data['email'],
            'documento' => $data['documento'],
            'password' => Hash::make($data['password']),
            'foto_perfil' => $data['avatar'] ?? null,
            'fecha_inscripcion' => $data['fecha_inscripcion'] ?? null,
            'talla' => $data['talla'] ?? null,
            'peso' => isset($data['peso']) ? (string) $data['peso'] : null,
            'perimetro_abdominal' => $data['perimetro_abdominal'] ?? null,
            'porcentaje_grasa' => $data['porcentaje_grasa'] ?? null,
            'porcentaje_musculo' => $data['porcentaje_musculo'] ?? null,
            'estado' => $data['estado'] ?? 'activo',
            'tipo' => $data['tipo'] ?? 'Cliente',
            'observaciones' => $observaciones
        ]);

        $verification = $this->sendVerificationCode($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user,
            'verification' => $verification
        ]);
    }

    private function resolveUsername(array $data): string
    {
        $desired = $data['username'] ?? null;

        if (empty($desired)) {
            $parts = array_filter([
                $data['primer_nombre'] ?? null,
                $data['primer_apellido'] ?? null,
            ]);

            $desired = Str::slug(implode(' ', $parts), '');
        }

        $desired = $desired ?: 'cliente';
        $candidate = $desired;
        $suffix = 1;

        while (User::where('username', $candidate)->exists()) {
            $candidate = $desired . $suffix++;
        }

        return $candidate;
    }

    private function buildObservaciones(array $data): ?string
    {
        $payload = [];

        if (!empty($data['objetivos'])) {
            $payload['objetivos'] = $data['objetivos'];
        }

        if (isset($data['ppm_min']) || isset($data['ppm_max'])) {
            $ppm = array_filter([
                'min' => $data['ppm_min'] ?? null,
                'max' => $data['ppm_max'] ?? null,
            ], fn ($value) => $value !== null && $value !== '');

            if (!empty($ppm)) {
                $payload['ppm'] = $ppm;
            }
        }

        if (empty($payload)) {
            return null;
        }

        return json_encode($payload, JSON_UNESCAPED_UNICODE);
    }

    private function sendVerificationCode(User $user): array
    {
        $code = (string) random_int(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(15);

        EmailVerificationCode::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'code' => $code,
            'expires_at' => $expiresAt,
        ]);

        try {
            Mail::to($user->email)->send(
                new ProfileVerificationCodeMail($user, $code, $expiresAt->format('Y-m-d H:i'))
            );
            $sent = true;
        } catch (\Throwable $e) {
            \Log::error('No se pudo enviar el correo de verificación.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
            $sent = false;
        }

        return [
            'sent' => $sent,
            'expires_at' => $expiresAt->toDateTimeString(),
        ];
    }
}
