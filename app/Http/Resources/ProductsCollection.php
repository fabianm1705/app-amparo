<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'data' => $this->collection->transform(function($element){
            return [
              'modelo' => $element->modelo,
              'descripcion' => $element->descripcion,
              'cantidadCuotas' => $element->cantidadCuotas,
              'montoCuota' => '$'.$element->montoCuota,
              'montoTotal' => '$'.($element->montoCuota*$element->cantidadCuotas),
              'image_url' => $element->image_url,
              'categoria' => $element->category->nombre,
            ];
          })
        ];
    }
}
