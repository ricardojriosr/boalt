<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications'; // table used in the database

    protected $fillable = [
        'notification', 'read', 'user_id',
    ]; // Fields that are able to update
}
