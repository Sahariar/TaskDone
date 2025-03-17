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
    public function members(){
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
            ->withTimestamps();
    }
}
