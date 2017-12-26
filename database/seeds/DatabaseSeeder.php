<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CitySeeder::class);
        // $this->call(RoadSeeder::class);  // 生成City数据之后手动运行RoadSeeder
    }
}
