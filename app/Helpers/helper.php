<?php

namespace App\Helpers;

class Helper
{
    public static function numberFormat(string $value)
    {
        return number_format($value, 2, ',', '.');
    }
    public static function uploadFile($file, $destinationPath = 'uploads/')
    {
        $prefix = strtotime('now') . '-';
        $name = $prefix.$file->getClientOriginalName();

        $upload = $file->storeAs($destinationPath, $name);

        if (!$upload) return false;

        return $name;
    }
    public static function getFieldValue($slug, $fields)
    {
        $field = json_decode($fields, true);
        return !empty($field[$slug]) ? $field[$slug] : '';
    }
}