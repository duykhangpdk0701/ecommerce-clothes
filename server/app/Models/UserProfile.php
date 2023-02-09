<?php

namespace App\Models;

use App\Traits\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserProfile extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Location;

    const COLLECTION_CCCD_FRONT = "image_cccd_front";
    const COLLECTION_CCCD_BACK = 'iamge_cccd_back';
    const CCCD_RESIZE_NAME = 'cccd_resize';
    const CONVERSION_SIZE = [
        'width' => '650',
        'height' => '415',
    ];

    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id', 'phone', 'first_name', 'last_name', 'identify_number', 'bank_number', 'bank_name', 'staff_code'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::COLLECTION_CCCD_FRONT, self::COLLECTION_CCCD_BACK)->singleFile();
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(self::CCCD_RESIZE_NAME)
            ->crop('crop-center', self::CONVERSION_SIZE['width'], self::CONVERSION_SIZE['height'])
            ->performOnCollections(self::COLLECTION_CCCD_FRONT, self::COLLECTION_CCCD_BACK)
            ->nonQueued();
    }
}
