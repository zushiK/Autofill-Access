<?php

namespace App\Models\Front;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public $incrementing = false; // ← 追加

    protected $keyType = 'string'; // ← 追加

    protected $table = 'users';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id'];

    protected $casts = [

    ];
}