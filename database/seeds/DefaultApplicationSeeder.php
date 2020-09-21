<?php

use App\Laravel\Models\OtherApplication;
use Illuminate\Database\Seeder;

class DefaultApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OtherApplication::truncate();
        OtherApplication::create(['name' => 'Traffic Violations','processing_fee' => '0.00','processing_days' => '0']);
        OtherApplication::create(['name' => 'Community Tax Certificate','processing_fee' => '0.00','processing_days' => '0']);
    }
}
