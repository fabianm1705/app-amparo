<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecialtyForbbiden extends TestCase
{
  function test_specialties_index_forbbiden()
  {
    $response = $this->actingAs($this->defaultUser())
                       ->get(route('specialties.index'))
                       ->assertStatus(403);
  }
}
