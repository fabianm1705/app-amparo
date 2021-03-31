<?php

namespace Database\Seeders;

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
      $concepts = Concept::factory()->count(3000)->make();
    }
}
