<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class UserModel extends User
{
    use HasFactory;

    protected $table = 'm_user';
    public $timestamps = false;
    protected $primaryKey = 'user_id';

    protected $fillable = ['username', 'nama', 'password', 'level_id','user_id'];

    public function level() {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
