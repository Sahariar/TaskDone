<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotifications extends Model
{
    /** @use HasFactory<\Database\Factories\CustomNotificationsFactory> */
    use HasFactory;
    protected $guarded  =['id'];
}
