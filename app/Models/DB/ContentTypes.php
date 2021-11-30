<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class ContentTypes extends Model
{
    protected $fillable = ['title', 'slug', 'template', 'fields', 'single'];

    public function contents()
    {
        return $this->hasMany(Contents::class, 'content_type_id');
    }
}
