<?php

use App\Models\Road;
use Illuminate\Database\Seeder;

class RoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roads = factory(Road::class)->times(10)->make();
    }
}
