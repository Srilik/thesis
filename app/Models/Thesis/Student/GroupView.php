<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class GroupView extends Model
{
    protected $table = 'NU_EXAMINATION.dbo.student_group_view';
    protected $primaryKey = 'gno';
    public $incrementing = false;
    public $timestamps = false;
    public $keyType = 'string';

    protected $fillable = [
        'gno',
        'year',
        'TDYSG',
        'DYS',
        'group',
        'shift',
        'department',
        'major_name',
        'department_id',
        'college',
        'academic_year',
        'semester',
    ];

    protected $hidden = ['pivot'];
}
