<?php

use Illuminate\Database\Seeder;
use App\Concept;

class ConceptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Concept::Class)->times(3000)->create();
    }
}
