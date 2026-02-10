<input type="hidden" name="id" value="{{ $ejercicioRutina->id }}">
{{-- <div class="form-group">
    <label for="">Video</label>
    <input type="file" name="video" class="form-control file mb-3">
</div> --}}
<div class="form-group">
    <label>Volumen</label>
    <input type="text" name="volumen" value="{{ $ejercicioRutina->volumen }}" class="form-control">
</div>
<div class="form-group">
    <label>Intensidad</label>
    <input type="text" name="intensidad" value="{{ $ejercicioRutina->intensidad }}" class="form-control">
</div>
<div class="form-group">
    <label>Frecuencia</label>
    <input type="text" name="frecuencia" value="{{ $ejercicioRutina->frecuencia }}" class="form-control">
</div>
