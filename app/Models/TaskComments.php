<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComments extends Model
{
    /** @use HasFactory<\Database\Factories\TaskCommentsFactory> */
    use HasFactory;
    protected $guarded  =['id'];


        /**
     * Get the task that owns the comment.
     */
    public function task()
    {
        return $this->belongsTo(Tasks::class);
    }

    /**
     * Get the user that created the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
