<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    /**
    * @var \App\User
    */
    protected $defaultUser;

    use CreatesApplication;
    use RefreshDatabase;

    public function defaultUser()
    {
      if($this->defaultUser){
        return $this->defaultUser;
      }
      return $this->defaultUser = factory(User::class)->create();
    }
}
