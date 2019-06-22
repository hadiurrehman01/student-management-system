<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class test_user extends Model
{
    use Notifiable;

	protected $table = 'test_user';
    protected $fillable = [
        'name', 'email', 'password',
    ];

}
