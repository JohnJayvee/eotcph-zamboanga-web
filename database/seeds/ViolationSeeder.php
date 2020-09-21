<?php

use App\Laravel\Models\Violations;
use Illuminate\Database\Seeder;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Violations::truncate();
        Violations::create(['description' => '1d-Abandoned Vehicle']);
        Violations::create(['description' => '1f-No required MV Parts/Acc.']);
        Violations::create(['description' => '1 a&b - Art III Illegal Parking']);
        Violations::create(['description' => '1 a Art. III - Double Parking']);
        Violations::create(['description' => '2 a - Obstruction on street/side-walks']);
        Violations::create(['description' => '6 c Art. IV - Cargo Trucks on curfew hours']);
        Violations::create(['description' => '1 a Art. IV - Disregarding Traffic signals/gestures']);
        Violations::create(['description' => '1 c Art. VII - Overtaking at road intersections']);
        Violations::create(['description' => '1e - Unlincensed driver']);
        Violations::create(['description' => '2c - Unregistered MV/Colorum']);
        Violations::create(['description' => 'Art. III Sec 3 - Illegal Side parking Area']);
        Violations::create(['description' => '2 a Art. IV - Entering one-way street']);
        Violations::create(['description' => '3 b Art. IV - Loding/Unloading on thru Sts.']);
        Violations::create(['description' => '8 a Art. IV - Entering prohibited zones by MTC, PUJ & PUB']);
        Violations::create(['description' => 'Art. IV Sec. 3 - Failure to pass pedestrian lanes']);
        Violations::create(['description' => '5 a Art. VII - Driving Under the influce']);
        Violations::create(['description' => '2 a Art. VII - Out of lane']);
        Violations::create(['description' => 'Other violations under C.O No. 185']);
    }
}
