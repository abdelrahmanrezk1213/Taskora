<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'priority',
        'due_date',
        'user_id',
        'category_id',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'category_id' => 'integer',
            'created_by' => 'integer',
            'due_date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Mutators

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => trim($value)
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: function (?string $value) {
                $value = trim($value ?? '');

                return $value === '' ? null : $value;
            }
        );
    }

    protected function isOverdue(): Attribute
    {
        return Attribute::get(
            fn(): bool => $this->due_date !== null
                && $this->due_date->isBefore(Carbon::today())
                && $this->status !== 'completed'
        );
    }

    // Scopes
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    public function scopeHighPriority(Builder $query): Builder
    {
        return $query->where('priority', 'high');
    }

    public function scopeMediumPriority(Builder $query): Builder
    {
        return $query->where('priority', 'medium');
    }

    public function scopeLowPriority(Builder $query): Builder
    {
        return $query->where('priority', 'low');
    }

    public function scopeOverdue(Builder $query): Builder
    {
        return $query
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', Carbon::today())
            ->where('status', '!=', 'completed');
    }
}
