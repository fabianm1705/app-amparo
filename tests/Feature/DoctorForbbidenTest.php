<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorForbbiden extends TestCase
{
  function test_doctors_index_forbbiden()
  {
    $response = $this->actingAs($this->defaultUser())
                       ->get(route('doctors.index'))
                       ->assertStatus(403);
  }
}
