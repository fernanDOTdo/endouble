<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnabledScope;

class Source extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'priority', 'enabled'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The "booting" method of the Source.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // As a Global Scope, lets get just the enabled Sources
        static::addGlobalScope(new EnabledScope());
    }
}
