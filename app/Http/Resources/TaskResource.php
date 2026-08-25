<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'title' => $this->title,

            'description' => $this->description,

            'status' => $this->status,

            'priority' => $this->priority,

            'due_date' => $this->due_date?->format('Y-m-d'),

            'is_overdue' => $this->is_overdue,

            'category' => $this->category
                ? [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                ]
                : null,

            'assigned_to' => $this->user
                ? [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ]
                : null,

            'created_by' => $this->createdBy
                ? [
                    'id' => $this->createdBy->id,
                    'name' => $this->createdBy->name,
                ]
                : null,

            'image' => $this->image
                ? asset('storage/' . $this->image)
                : null,

            'created_at' => $this->created_at?->toISOString(),

            'updated_at' => $this->updated_at?->toISOString(),

        ];
    }
}
