<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    const STATUS_NEW = 0;
    const STATUS_CONFIRMED = 1;
    const STATIS_COMPLETED = 2;

    protected $fillable = [
        'file',
        'mapping',
    ];

    protected $casts = [
        'mapping' => 'array',
    ];

    protected $attributes = [
        'status' => self::STATUS_NEW,
    ];

    public function confirm()
    {
        $this->status = self::STATUS_CONFIRMED;
    }
}
