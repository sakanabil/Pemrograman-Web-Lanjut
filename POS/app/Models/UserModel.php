<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LevelModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
    protected $table = 'm_user'; //Mendefinikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; // Mendefinikan primary key tabel ini
    // @var array
    protected $fillable = ['username', 'password', 'nama', 'level_id', 'created_at', 'updated_at'];
    protected $hidden = ['password']; // jangan ditampilkan saat select
    protected $casts = ['password' => 'hashed']; // casting password agar otomatis di hash

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

        // Mendapatkan nama role
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    // Cek apakah user memiliki role tertentu
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    // Mendapatkan kode role
    public function getRole()
    {
        return $this->level->level_kode;
    }
}