<?php

namespace App\Models\Thesis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesises extends Model
{
    use HasFactory;
    protected $table = 'thesises';
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
}
