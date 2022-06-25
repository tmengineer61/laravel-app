<?php

namespace App\Validators;

class HotPepperValidator 
{
    
    /**
     * バリデートルール
     * 
     * @return array バリデートルール
     */
    public function getSearchShopValidateRules()
    {
        return [
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'genre' => ['nullable', 'regex:/^G0/'],
            'page' => ['nullable', 'numeric'],
        ];
    }
}