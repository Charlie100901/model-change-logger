# Model Change Logger
**Librería Laravel para registrar cambios (update y delete) en modelos.**  
Registra en una tabla los campos modificados, su valor anterior, nuevo valor, el usuario responsable y la fecha del cambio.

---

## 📦 Instalación

Agrega el paquete a tu proyecto vía Composer:
```bash
composer require carlosdev/model-change-logger
```

Asegúrate de tener PHP 8.0+ y Laravel 10.

## 🔧 Configuración

Publicar y correr las migraciones:
```bash
php artisan migrate
```

Usar el trait en el modelo que desees auditar:
```php
use CarlosDev\ModelChangeLogger\Traits\TracksChanges;

class OfertaEmpresa extends Model
{
    use TracksChanges;
}
```

(Opcional) Auditar solo campos específicos:
Si deseas registrar únicamente ciertos campos, define la propiedad $auditFields en tu modelo:
```php
protected array $auditFields = ['estado_oferta_empresa_id', 'titulo'];
```

## 🧠 ¿Qué registra?

- Cambios en campos individuales al hacer update().
- Eliminaciones (delete y forceDelete), guardando el evento pero sin campos específicos.
- Usuario responsable (Auth::id()).
- Modelo y ID afectados.
- Fecha y hora del cambio.

## 📄 Estructura de la tabla model_changes

| Campo | Descripción |
|-------|-------------|
| model_type | Clase del modelo afectado (App\Models\X) |
| model_id | ID del modelo modificado |
| field | Campo que cambió |
| old_value | Valor anterior del campo |
| new_value | Nuevo valor del campo |
| user_id | ID del usuario que realizó el cambio |
| event | Tipo de evento (updated, deleted, etc.) |
| changed_at | Fecha y hora del cambio |


## ✅ Compatibilidad

- PHP: >= 8.0
- Laravel: ^10.0 || ^11.0

## 📬 Contribuciones

¡Sugerencias, mejoras y pull requests son bienvenidos! 🚀

Este paquete está pensado para proyectos donde se requiere trazabilidad de cambios sin depender de paquetes complejos de auditoría.

## 📄 Licencia

MIT © CarlosDev