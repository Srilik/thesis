<?php

namespace App\Models\Thesis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisCommittees extends Model
{
    use HasFactory;
    protected $table = 'thesis_committees';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected $fillable = [
        'thesis_id',
        'lecturer_id',
        'role',
        'title',
    ];

    /**
     * Define a relationship with the Thesis model.
     */
    public function thesises()
    {
        return $this->belongsTo(Thesises::class, 'thesis_id');
    }

}
