<?php

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialty::create([
          "descripcion" => "Análisis Bioquímicos", "monto_s" => 0,
          "monto_a" => 0, "vigente" => true, "vigenteOrden" => false
        ]);
        Specialty::create([
          "descripcion" => "Clínica Médica", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Cardiología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => false
        ]);
        Specialty::create([
          "descripcion" => "Cirugía", "monto_s" => 250,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Dermatología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Flebología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Gastroenterología", "monto_s" => 250,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Ginecología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Kinesiología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => false
        ]);
        Specialty::create([
          "descripcion" => "Nutrición", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Alergista", "monto_s" => 250,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Anátomo Patología", "monto_s" => 0,
          "monto_a" => 0, "vigente" => true, "vigenteOrden" => false
        ]);
        Specialty::create([
          "descripcion" => "Oftalmología", "monto_s" => 300,
          "monto_a" => 350, "vigente" => true, "vigenteOrden" => false
        ]);
        Specialty::create([
          "descripcion" => "Pediatría", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Podología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Psicología", "monto_s" => 300,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Radiografías y Ecografías", "monto_s" => 0,
          "monto_a" => 0, "vigente" => true, "vigenteOrden" => false
        ]);
        Specialty::create([
          "descripcion" => "Traumatología", "monto_s" => 200,
          "monto_a" => 250, "vigente" => true, "vigenteOrden" => true
        ]);
        Specialty::create([
          "descripcion" => "Odontología", "monto_s" => 0,
          "monto_a" => 0, "vigente" => true, "vigenteOrden" => false
        ]);
      }
}
