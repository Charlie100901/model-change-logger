<?php

namespace CarlosDev\ModelChangeLogger\Traits;

use CarlosDev\ModelChangeLogger\Models\ModelChange;
use Illuminate\Support\Facades\Auth;

trait TracksChanges
{
    public static function bootTracksChanges()
    {
        static::updating(function ($model) {
            $original = $model->getOriginal();
            $changes = $model->getDirty();

            $auditFields = property_exists($model, 'auditFields') ? $model->auditFields : null;

            foreach ($changes as $field => $newValue) {
                if (is_array($auditFields) && !in_array($field, $auditFields)) {
                    continue;
                }

                $oldValue = $original[$field] ?? null;

                if ((string) $oldValue !== (string) $newValue) {
                    ModelChange::create([
                        'model_type' => get_class($model),
                        'model_id'   => $model->getKey(),
                        'field'      => $field,
                        'old_value'  => $oldValue,
                        'new_value'  => $newValue,
                        'user_id'    => Auth::id(),
                        'event'      => 'updated',
                        'changed_at' => now(),
                    ]);
                }
            }
        });

        static::deleted(function ($model) {
            $event = method_exists($model, 'isForceDeleting') && $model->isForceDeleting()
                ? 'force_deleted'
                : 'deleted';

            ModelChange::create([
                'model_type' => get_class($model),
                'model_id'   => $model->getKey(),
                'field'      => null,
                'old_value'  => null,
                'new_value'  => null,
                'user_id'    => Auth::id(),
                'event'      => $event,
                'changed_at' => now(),
            ]);
        });
    }
}
