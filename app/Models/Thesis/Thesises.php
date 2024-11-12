<?php

namespace App\Models\Thesis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesises extends Model
{
    use HasFactory;
    protected $table = 'thesises';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';

    protected $fillable = [
        'group_id',
        'academic_year',
        'major',
        'year',
        'batch',
        'topic',
        'topic_kh',
        'objective',
        'objective_kh',
        'description',
        'organization',
        'organization_type',
        'organization_address',
        'organization_phone',
        'organization_email',
        'lecturer_id',
    ];
    public function thesisCommittees()
    {
        return $this->hasMany(ThesisCommittees::class, 'thesis_id');
    }
    public function thesisStudents()
    {
        return $this->hasMany(ThesisStudents::class, 'thesis_id');
    }
}
