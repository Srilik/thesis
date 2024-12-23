<?php

namespace App\Models\Thesis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisStudent extends Model
{
    use HasFactory;
    protected $table = 'thesis_students';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected $fillable = [
        'thesis_id',
        'student_id',
        'phone',
        'email',
        'remark',
    ];
    /**
     * Define a relationship with the Thesis model.
     */
    public function thesises()
    {
        return $this->belongsTo(Thesises::class, 'id');
    }
}
