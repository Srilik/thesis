<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected $fillable = [
        'student_id',
        'date',
        'status',
    ];

    /**
     * Define a relationship with the User_Attendance model.
     */
    public function user_attendance()
    {
        return $this->belongsTo(User_Attendance::class, 'student_id');
    }

}

