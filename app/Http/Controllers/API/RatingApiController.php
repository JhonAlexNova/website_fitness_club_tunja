<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\GymClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingApiController extends Controller
{
    /**
     * Obtener todas las calificaciones para una clase específica.
     *
     * @param  int  $classId
     * @return \Illuminate\Http\Response
     */
    public function getClassRatings($classId)
    {
        $gymClass = GymClass::findOrFail($classId);
        
        $ratings = Rating::forClass($classId)
            ->with('user:id,name,profile_image')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $averageRating = $ratings->avg('rating');
        
        return response()->json([
            'ratings' => $ratings,
            'average_rating' => round($averageRating, 1),
            'total_ratings' => $ratings->count()
        ]);
    }

    
    /**
     * Obtener la calificación del usuario actual para una clase específica.
     *
     * @param  int  $classId
     * @return \Illuminate\Http\Response
     */
    public function getUserRating(Request $request, $classId)
    {
        $userId = request()->user()->id;
        
        $rating = Rating::forClass($classId)
            ->byUser($userId)
            ->first();
            
        return response()->json($rating);
    }
    
    /**
     * Crear o actualizar una calificación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $classId
     * @return \Illuminate\Http\Response
     */
    public function rateClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        // Verificar que la clase existe
       // $gymClass = GymClass::findOrFail($classId);
        
        // Verificar que el usuario está inscrito y ha asistido a la clase
        $userId = request()->user()->id;
        $classId = $request->classId;
       /*  $hasAttended = $this->userHasAttendedClass($userId, $classId);
        
        if (!$hasAttended) {
            return response()->json([
                'message' => 'Solo puedes calificar clases a las que hayas asistido'
            ], 403);
        } */
        
        // Crear o actualizar la calificación
        $rating = Rating::updateOrCreate(
            ['user_id' => $userId, 'class_id' => $classId],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );
        
        return response()->json([
            'message' => 'Calificación guardada correctamente',
            'rating' => $rating
        ]);
    }
    
    /**
     * Eliminar una calificación.
     *
     * @param  int  $classId
     * @return \Illuminate\Http\Response
     */
    public function deleteRating($classId)
    {
        $userId = Auth::id();
        
        $rating = Rating::forClass($classId)
            ->byUser($userId)
            ->firstOrFail();
            
        $rating->delete();
        
        return response()->json([
            'message' => 'Calificación eliminada correctamente'
        ]);
    }
    
    /**
     * Verificar si el usuario ha asistido a la clase.
     * 
     * @param int $userId
     * @param int $classId
     * @return bool
     */
    private function userHasAttendedClass($userId, $classId)
    {
        // Aquí iría la lógica para verificar si el usuario ha asistido a la clase
        // Por ejemplo, consultando una tabla de asistencias
        
        // Para este ejemplo, asumimos que existe una tabla 'class_attendances'
        return \DB::table('class_attendances')
            ->where('user_id', $userId)
            ->where('class_id', $classId)
            ->where('attended', true)
            ->exists();
    }
}