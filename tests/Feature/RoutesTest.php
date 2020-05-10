<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class RoutesTest extends TestCase
{
     function test_route_welcome()
     {
         $response = $this->get('/');
         $response->assertStatus(200);
     }

     function test_route_about()
     {
         $response = $this->get('/about');
         $response->assertStatus(200);
     }

     function test_route_home()
     {
       $response = $this->actingAs($this->defaultUser())->get(route('home'));
       $response->assertStatus(200);
     }

     function test_redirect_guest_to_login()
     {
         $response = $this->get(route('home'))
                          ->assertStatus(302)
                          ->assertRedirect('login');
     }

     function test_roles_index_forbbiden()
     {
         $response = $this->actingAs($this->defaultUser())
                          ->get(route('roles.index'))
                          ->assertStatus(403);
     }

     function test_users_index_forbbiden()
     {
         $response = $this->actingAs($this->defaultUser())
                          ->get(route('users.index'))
                          ->assertStatus(403);
     }
}
