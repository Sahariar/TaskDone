<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategories extends Model
{
    /** @use HasFactory<\Database\Factories\TaskCategoriesFactory> */
    use HasFactory;
    protected $guarded  =['id'];
}
