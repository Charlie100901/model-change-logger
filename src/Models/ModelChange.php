<?php
namespace CarlosDev\ModelChangeLogger\Models;

use Illuminate\Database\Eloquent\Model;

class ModelChange extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'model_type',
        'model_id',
        'field',
        'old_value',
        'new_value',
        'user_id',
        'event',
        'changed_at'
    ];
}
