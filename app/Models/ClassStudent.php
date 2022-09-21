<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_email',
        'classroom_id',
        'school_teacher_id',
        'school_classroom',
        'reason'
    ];
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
