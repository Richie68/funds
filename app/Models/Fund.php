<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Str;

class Fund extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class, 'manager_uuid', 'uuid')
            ->select(['id', 'uuid', 'name']);
    }

    public function aliases(): BelongsToMany
    {
        return $this->belongsToMany(Alias::class);
    }
}
