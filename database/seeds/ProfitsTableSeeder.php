<?php

use Illuminate\Database\Seeder;
use App\Models\Profit;

class ProfitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Profit::create([
        'description' => 'Cuotas de la casa',
        'percentage' => 28
      ]);
      Profit::create([
        'description' => 'Crédito en 1 pago',
        'percentage' => 18
      ]);
    }
}
