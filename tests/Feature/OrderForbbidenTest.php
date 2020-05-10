<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderForbbiden extends TestCase
{
  function test_orders_index_forbbiden()
  {
      $response = $this->actingAs($this->defaultUser())
                       ->get(route('orders.index'))
                       ->assertStatus(403);
  }
}
