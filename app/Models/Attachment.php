<?php

namespace App\Models;

use App\Enums\AttachmentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => AttachmentType::class,
        ];
    }

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Generate attachment url.
     */
    public function getUrlAttribute(): ?string
    {
        if (in_array($this->type, [AttachmentType::ImageUrl, AttachmentType::VideoUrl])) {
            return $this->content;
        }

        return asset('storage/'.$this->content);
    }
}
