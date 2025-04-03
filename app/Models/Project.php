<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
        /**
     * Get the members (users) associated with the project.
     */
    protected $guarded  =['id'];
    protected $casts = [
        'start_date' => 'datetime',
        'due_date' => 'datetime',
    ];
    public function members(){
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
            ->withTimestamps();
    }
    /**
     * Get the user that owns the project.
     */
    public function user(){
        return $this->belongsTo(User::class , 'manager_id');
    }
    /**
     * Get the tasks for the project.
     */
    public function tasks(){
        return $this->hasMany(Tasks::class);
    }
     /**
     * Get tasks count by status
     */
    public function getTasksStatisticsAttribute(){
        return[
            'total' => $this->tasks->count(),
            'todo' => $this->tasks->where('status', 'todo')->count(),
            'in_progress' => $this->tasks->where('status', 'in_progress')->count(),
            'review' => $this->tasks->where('status', 'review')->count(),
            'completed' => $this->tasks->where('status', 'completed')->count(),
        ];

    }
    /**
     * Calculate project progress
     */
    public function getProgressStatisticsAttribute(){
        $totalTasks = $this->tasks->count();
        if($totalTasks == 0){
            return 0;
        }
        $completedTasks = $this->tasks->where('status' , 'completed')->count();
        return (($completedTasks / $totalTasks) * 100);
    }

}
