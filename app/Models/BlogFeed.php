<?php

namespace App\Models;

use App\Jobs\ProcessFeed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogFeed extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const UNPROCESSED = 'unprocessed';
    public const PROCESSED = 'processed';
    public const PROCESSING = 'processing';
    public const HOLD = 'on hold';
    public const ERROR = 'error';

    protected static function booted()
    {
        static::created(function () {
            ProcessFeed::dispatch();
        });
    }

    public function scopeisUnprocessed($query)
    {
        return $query->where('status', self::UNPROCESSED);
    }

    public function scopeisProcessed($query)
    {
        return $query->where('status', self::PROCESSED);
    }
    public function scopeerror($query)
    {
        return $query->where('status', self::ERROR);
    }
    public function scopeonHold($query)
    {
        return $query->where('status', self::HOLD);
    }

    public function processing()
    {
        return $this->update([
            'status' => self::PROCESSING
        ]);
    }
    public function processed()
    {
        return $this->update([
            'status' => self::PROCESSED
        ]);
    }
    public function failed()
    {
        return $this->update([
            'status' => self::ERROR
        ]);
    }
    public function unprocessed()
    {
        return $this->update([
            'status' => self::UNPROCESSED
        ]);
    }
}
