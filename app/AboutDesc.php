<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutDesc extends Model
{
    protected $table = 'aboutdesc';
    protected $fillable = ['about_text'];
}
