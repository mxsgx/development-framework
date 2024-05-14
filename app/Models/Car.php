<?php

namespace App\Models;

use App\Enums\CarStatus;
use App\Enums\CarTransmissionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'name',
        'plate_number',
        'vehicle_year',
        'color',
        'status',
        'base_price',
        'with_driver',
        'driver_price',
        'transmission_type',
        'total_seat',
        'total_baggage',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:0',
            'driver_price' => 'decimal:0',
            'status' => CarStatus::class,
            'with_driver' => 'boolean',
            'transmission_type' => CarTransmissionType::class,
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function imagePreviews(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function scopeAvailable(): Car
    {
        return $this->where('status', '=', CarStatus::Available);
    }

    public function markAsAvailable(): bool
    {
        return $this->forceFill([
            'status' => CarStatus::Available,
        ])->save();
    }

    public function markAsUnavailable(): bool
    {
        return $this->forceFill([
            'status' => CarStatus::Unavailable,
        ])->save();
    }

    public function isAvailable(): bool
    {
        return $this->status === CarStatus::Available;
    }

    public function isUnavailable(): bool
    {
        return $this->status === CarStatus::Unavailable;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->imagePreviews && $this->imagePreviews->first()) {
            return $this->imagePreviews->first()->url;
        }

        return 'https://placehold.co/160x120';
    }
}
