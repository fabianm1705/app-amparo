<?php

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Models\Doctor::Class)->times(50)->create();
    }
}
