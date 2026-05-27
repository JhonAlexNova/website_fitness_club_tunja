# TODO - Implementación: modelo 3d en CRUD Ejercicios + DataTables responsive

## Paso 1: Preparar migración
- [x] (Entorno) Corregir/asegurar migraciones existentes para que el framework no falle (musculos modelo_3d).
- [ ] Crear migración nueva para `ejercicios.modelo_3d` (nullable).

## Paso 2: Modelo Ejercicio
- [ ] Actualizar `app/Models/Ejercicio.php`:
  - agregar `modelo_3d` a `$fillable` y `$casts`
  - agregar regla nullable al `$rules`

## Paso 3: Formularios (create/edit)
- [ ] Actualizar `resources/views/ejercicios/fields.blade.php`:
  - agregar input file `file_modelo_3d` opcional
  - mostrar link del archivo actual si existe

## Paso 4: Controller (store/update)
- [ ] Actualizar `app/Http/Controllers/EjercicioController.php`:
  - guardar archivo como `modelo_3d` en `disk('public')`
  - en update: borrar archivo anterior si se sube uno nuevo
  - `unset($input['file_modelo_3d'])`

## Paso 5: Tabla/Listado
- [ ] Actualizar `resources/views/ejercicios/table.blade.php`:
  - agregar columna “Modelo 3D” con link “Ver” si existe

## Paso 6: DataTables responsive
- [ ] Revisar cómo inicializa DataTables el dashboard.
- [ ] Asegurar que las tablas del dashboard tengan `responsive: true`.
- [ ] Hacer que `ejercicios` use DataTables responsive (clase/ID correcto).

## Paso 7: Verificación
- [ ] Probar migración y navegación CRUD.
- [ ] Probar responsive en 2-3 tablas del dashboard (incl. Ejercicios).

