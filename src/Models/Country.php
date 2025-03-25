<?php

namespace Eclipse\World\Models;

use Eclipse\World\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'world_countries';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'a3_id',
        'num_code',
        'name',
        'flag',
    ];

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
