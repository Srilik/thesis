<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentOldView extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_master';
    protected $table = 'dbo.vStudentAll';
    protected $primaryKey = 'Supperid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'Supperid',
        'FamilyName',
        'MiddlName',
        'FirstName',
        'Sex',
        'Nationality',
        'BirthDate',
        'BirthMonth',
        'BirthYear',
        'City',
        'CurrentAddres',
        'Father name',
        'fcurrentjob',
        'Mother name',
        'mcurrentjob',
        'Khmername',
        'Knationality',
        'KCity',
        'KCurrentAddr',
        'KFather name',
        'KFcurrentjob',
        'KMother name',
        'KMcurrentjob',
        'TransferRemark',
        'Phone Number',
        'AcademicYear',
        'Coment',
        'ksex',
        'Batch',
        'Phone',
    ];

    /**
     * @return HasMany
     */
    public function studentGroups() : HasMany
    {
        return $this->hasMany(StudentGroupOldView::class, 'SupperID', 'Supperid')->distinct()->orderBy('AcademicYear', 'desc');
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(StudentPaymentOldView::class, 'SupperID', 'Supperid')->distinct()->orderBy('AcademicYear', 'desc');
    }

    /**
     * @return HasOne
     */
    public function grade(): HasOne
    {
        return $this->hasOne(StudentGradeOld::class, 'Supperid', 'Supperid');
    }
}
