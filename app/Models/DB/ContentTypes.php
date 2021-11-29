<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class ContentTypes extends Model
{
    protected $fillable = ['title', 'slug', 'template', 'fields', 'single'];
}
