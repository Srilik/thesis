<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGradeOld extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_master';
    protected $table = 'dbo.tblGradeNewStudent';
    // no primary key
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'Supperid',
        'Type',
        'TotalGrade',
        'Score',
        'HighSchool',
        'Username',
        'HighSchoolProvince',
    ];
}
