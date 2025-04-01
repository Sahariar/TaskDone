<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory;
    protected $guarded  =['id'];

    protected $casts = [
        'start_date' => 'datetime',
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];
    /**
     * Get the project that owns the task.
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }
 /**
     * Get the user that created the task.
     */
    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that is assigned to the task.
     */
    public function assignee(){
        return $this->belongsTo(User::class, 'assigned_to');
    }
/**
     * Get the comments for the task.
     */
    public function comments(){
        return $this->hasMany(TaskComments::class);
    }
    /**
     * Mark task as completed
     */
    public function complete(){

        $this->status = "completed";
        $this->completed_at = now();
        $this->save();

        return $this;
    }
    /**
     * Check if task is overdue
     */

    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && $this->status !== 'completed' && $this->due_date < now();
    }

}
