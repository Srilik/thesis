<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentGroupView extends Pivot
{
    protected $table = 'NU_EXAMINATION.dbo.student_group_pivot_view';

    protected $fillable = [
        'student_id',
        'gno',
        'note',
        'admission',
    ];
}
