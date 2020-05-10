<?php

use Illuminate\Database\Seeder;
use App\Subscription;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Subscription::create([
        "description" => "Amparo Sepelio", "grupal" => 1, "sepelio_estandar" => 1,
        "sepelio_plus" => 0, "salud" => 0, "odontologia" => 0, "orden_medica" => 0
      ]);
      Subscription::create([
        "description" => "Amparo Sepelio Estándar", "grupal" => 1, "sepelio_estandar" => 1,
        "sepelio_plus" => 0, "salud" => 0, "odontologia" => 0, "orden_medica" => 0
      ]);
      Subscription::create([
        "description" => "Amparo Sepelio Plus", "grupal" => 1, "sepelio_estandar" => 0,
        "sepelio_plus" => 1, "salud" => 0, "odontologia" => 0, "orden_medica" => 0
      ]);
      Subscription::create([
        "description" => "Amparo Mayores", "grupal" => 1, "sepelio_estandar" => 1,
        "sepelio_plus" => 0, "salud" => 0, "odontologia" => 0, "orden_medica" => 0
      ]);
      Subscription::create([
        "description" => "Amparo Salud Plus", "grupal" => 1, "sepelio_estandar" => 0,
        "sepelio_plus" => 0, "salud" => 1, "odontologia" => 0, "orden_medica" => 1
      ]);
      Subscription::create([
        "description" => "Amparo Salud", "grupal" => 0, "sepelio_estandar" => 0,
        "sepelio_plus" => 0, "salud" => 1, "odontologia" => 0, "orden_medica" => 1
      ]);
      Subscription::create([
        "description" => "Amparo Joven - Odontología", "grupal" => 0, "sepelio_estandar" => 1,
        "sepelio_plus" => 0, "salud" => 1, "odontologia" => 1, "orden_medica" => 1
      ]);
      Subscription::create([
        "description" => "Amparo Joven Plus - Odontología", "grupal" => 0, "sepelio_estandar" => 0,
        "sepelio_plus" => 1, "salud" => 1, "odontologia" => 1, "orden_medica" => 1
      ]);
      Subscription::create([
        "description" => "Amparo Odontológico", "grupal" => 0, "sepelio_estandar" => 0,
        "sepelio_plus" => 0, "salud" => 0, "odontologia" => 1, "orden_medica" => 0
      ]);
      Subscription::create([
        "description" => "Descuento Adhesión Débito", "grupal" => 0, "sepelio_estandar" => 0,
        "sepelio_plus" => 0, "salud" => 0, "odontologia" => 0, "orden_medica" => 0
      ]);
    }
}
