<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    const ALLOWED_IMG_EXT = ['png', 'jpg'];
    const ALLOWED_AUD_EXT = ['mp3'];
    const ALLOWED_VID_EXT = ['mp4'];
    const IMG_F = 'image';
    const AUD_F = 'audio';
    const VID_F = 'video';

    protected $table = 'media_files';

    protected $fillable = [
        'ownable_type', 'ownable_id', 'media_type', 'path'
    ];

    public function ownable()
    {
        return $this->morphTo();
    }
}
