<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StudentAnnouncement
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property int $active
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property mixed|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAnnouncement withoutTrashed()
 * @mixin \Eloquent
 */
class StudentAnnouncement extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'published_at',
        'active',
        'user_id',
        'image'
    ];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable','imageable_type','imageable_id');
    }
}
