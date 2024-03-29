<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelUpsert\Eloquent\HasUpsertQueries;

class Article extends Model
{
    use HasFactory;
    use HasUpsertQueries;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array|bool
     */
    protected $guarded = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date'         => 'datetime',
        'embed_meta'   => 'array',
        'embed_linked' => 'array',
    ];
}
