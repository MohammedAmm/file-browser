<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'online_id',
        'name',
        'title',
        'download_url',
        'size',
        'mime_type',
    ];


    /**
     *
     *
     * Mutators
     *
     */

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = ($value/1024);
    }
}
