<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['nis', 'name','kelas','phone','photo'];

    public function attedances() {
        return $this->hasMany('Attendance'::class);
    }
}
