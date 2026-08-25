<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => [
                'name' => $name = trim($value),
                'slug' => Str::slug($name),
            ],
        );
    }
}
