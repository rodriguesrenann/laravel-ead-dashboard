<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    public static function booted() // toda vez antes de inserir um novo dado na table que usarmos a trait
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (String) Str::uuid();
        });
    }
}
