<?php

namespace App\Models\ExamAffair;

use App\Models\Schedule\Lecturer as ScheduleLecturer;

/**
 * App\Models\ExamAffair\Lecturer
 *
 * @property mixed $ddress_Province
 * @property mixed $Address_District
 * @property mixed $Address_Commune
 * @property mixed $Address_Village
 * @property mixed $Address_Street_House
 * @property mixed $department_name
 * @property-write mixed $updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmployeeAttendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\DepartmentMain|null $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EducationMain> $educations
 * @property-read int|null $educations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExperienceMain> $experiences
 * @property-read int|null $experiences_count
 * @property-read mixed $date_of_hire
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamAffair\LecturerSubject> $lectuereSubjects
 * @property-read int|null $lectuere_subjects_count
 * @property-read \App\Models\Staff|null $staff
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamAffair\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonWorkMain> $works
 * @property-read int|null $works_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer countUniqueSubject($academicYear, $semester)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonMain educationLevel()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonMain getInfo()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonMain staffReport($type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer withoutTrashed()
 * @mixin \Eloquent
 */
class Lecturer extends ScheduleLecturer
{
    public function subjects(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        // get table name from config
        $pivotTable = config('database.connections.sqlsrv_exam_affair.database') . '.dbo.lecturer_subject'; // NU_SCHEDULE.dbo.lecturer_subject'
        return $this->belongsToMany(Subject::class, $pivotTable, 'lecturer_id', 'subject_id', 'ShortName', 'subject_id')
            // ->withPivot('schedule_main_id', 'is_health_department')
            ->withTimestamps('created_at', 'updated_at')
            ->as('lecturer_subject')
            ->using(LecturerSubject::class);
    }

    public  function lectuereSubjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LecturerSubject::class, 'lecturer_id', 'ShortName');
    }






    public function scopeCountUniqueSubject($query, $academicYear, $semester)
    {
        // ref.

        // SELECT COUNT
        // 	( DISTINCT [lecturer_subject].[subject_id] )
        // FROM
        // 	[NU_EXAM_AFFAIR].[dbo].[lecturer_subject]
        // WHERE
        // 	[NU_DB].[dbo].[PERSONS].[ShortName] = [NU_EXAM_AFFAIR].[dbo].[lecturer_subject].[lecturer_id]
        // 	AND EXISTS (
        // 	SELECT
        // 		*
        // 	FROM
        // 		[NU_EXAM_AFFAIR].[dbo].[semesters]
        // 	WHERE
        // 		[NU_EXAM_AFFAIR].[dbo].[lecturer_subject].[semester_id] = [NU_EXAM_AFFAIR].[dbo].[semesters].[id]
        // 		AND [academic_year] = '2019-2020'
        // 		AND [semester] = 2
        // 	)

        return $query->selectRaw('COUNT(DISTINCT [lecturer_subject].[subject_id])')
            ->from('NU_EXAM_AFFAIR.dbo.lecturer_subject')
            ->whereColumn('NU_DB.dbo.PERSONS.ShortName', 'NU_EXAM_AFFAIR.dbo.lecturer_subject.lecturer_id')
            ->whereExists(function ($query) use ($academicYear, $semester) {
                $query->select('semesters.id')
                    ->from('NU_EXAM_AFFAIR.dbo.semesters')
                    ->whereColumn('NU_EXAM_AFFAIR.dbo.lecturer_subject.semester_id', 'NU_EXAM_AFFAIR.dbo.semesters.id')
                    ->where('academic_year', $academicYear)
                    ->where('semester', $semester);
            });
    }
}
