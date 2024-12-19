<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupThesis extends Model
{
    use HasFactory;


    protected $table = 'group_theses';


    protected $primaryKey = 'group_id';
    protected $fillable = [
        // 'group_id',
        'group_name',
    ];

    // $group = Group::with('theses')->find(1);

    public function theses()
    {
        return $this->hasMany(Thesis::class, 'group_id', 'group_id');
    }
}
