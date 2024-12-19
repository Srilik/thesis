<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPaymentOldView extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_master';
    protected $table = 'dbo.v_Student_Status_Payment';
    protected $primaryKey = 'SupperID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'SupperID',
        'No',
        'AcademicYear',
        'TDYS',
        'Semester1',
        'Semester2',
        'Payment',
        'Due Date',
        'Fee',
        'Sequence',
    ];

    protected $casts = [
        'Due Date' => 'datetime',
    ];
}
