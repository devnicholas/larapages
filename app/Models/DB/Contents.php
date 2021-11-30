<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $fillable = [
        'title', 'slug', 'type', 'fields', 'content_type_id'
    ];

    public function contentType()
    {
        return $this->belongsTo(ContentTypes::class, 'content_type_id');
    }
}
