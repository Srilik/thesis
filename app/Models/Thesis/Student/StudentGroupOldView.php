<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroupOldView extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_master';
    protected $table = 'dbo.v_Student_Status';
    protected $primaryKey = 'SupperID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'SupperID',
        'TDYSG',
        'AcademicYear',
        'Department',
        'Suspend',
    ];
}
