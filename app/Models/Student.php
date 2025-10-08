<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nis', 'name', 'kelas', 'phone', 'photo'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}