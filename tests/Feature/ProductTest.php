<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class ProductTest extends TestCase
{
  function test_products_index_forbbiden()
  {
    $response = $this->actingAs($this->defaultUser())
                       ->get(route('products.index'))
                       ->assertStatus(403);
  }

  function test_user_create_product()
  {
    //Having - Lo que tenemos
    $modelo = 'Este es un Modelo';
    $cantidadCuotas = 6;
    $vigente = true;
    $categories = factory(Category::class)->create();
    $this->actingAs($this->defaultUser());

    //When - Lo que sucede
    $this->get(route('products.create',['categories' => $categories]))
        ->type($modelo,'modelo')
        ->type($cantidadCuotas,'cantidadCuotas')
        ->type($vigente,'vigente')
        ->type(1,'category_id')
        ->press('Guardar');

    //then - Entonces
    $this->seeInDatabase('products',[
        'modelo' => $modelo,
        'cantidadCuotas' => $cantidadCuotas,
        'vigente' => $vigente
    ]);

    //Redirigido a
    $this->assertSee('Producto Registrado');
  }

}
