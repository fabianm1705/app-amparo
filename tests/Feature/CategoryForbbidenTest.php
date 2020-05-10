<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryForbbiden extends TestCase
{
  function test_categories_index_forbbiden()
  {
    $response = $this->actingAs($this->defaultUser())
                       ->get(route('categories.index'))
                       ->assertStatus(403);
  }
}
