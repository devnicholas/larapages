<?php

namespace App\Helpers;

use App\Models\DB\Product;

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
    public static function getAttributeFromProduct(Product $product, $id)
    {
        foreach ($product->attributes as $attr) {
            if($attr->id === $id){
                return $attr->pivot->value;
            }
        }
        return '';
    }
    public static function translateStatus($status)
    {
        $allStatus = [
            'new' => 'Novo',
            'completed' => 'Completo',
            'canceled' => 'Cancelado'
        ];
        return $allStatus[$status];
    }
    public static function translateShippingValue($value)
    {
        $allValues = [
            'checkpoint' => 'Local de retirada',
            'region' => 'Bairro',
            'street' => 'Endereço',
            'number' => 'Número',
            'complement' => 'Complemento',
            'reference_point' => 'Ponto de referência'
        ];
        return $allValues[$value];
    }
}