<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    protected $fillable = ['nama_brand','category','description','url_content','cover_image','banner_image','content_image'];
}
