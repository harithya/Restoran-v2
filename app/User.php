<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'role_id'
    ];

    /**
     * disable insert waktu di table
     *
     * @var boolean
     */
    public $timestamps = false;

    public static function getAll()
    {
        return DB::table('users')
            ->select('users.*', 'role.role')
            ->leftJoin('role', 'role.id', '=', 'users.role_id')->get();
    }
}
