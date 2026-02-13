<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteProfile extends Model
{
    protected $fillable = [
        'description',
        'image',

        'iframe_1',
        'iframe_2',

        'advantage_1_desc',
        'advantage_2_desc',
        'advantage_3_desc',

        'advantage_1_title',
        'advantage_1_icon',
        'advantage_2_title',
        'advantage_2_icon',
        'advantage_3_title',
        'advantage_3_icon',

       
    'latitude',
    'longitude',

    ];
}
