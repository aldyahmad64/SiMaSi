<?php

namespace Database\Seeders;

use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WilayahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedProvinces();
        $this->seedRegencies();
        $this->seedDistricts();
        $this->seedVillages();
    }

    private function seedProvinces()
    {
        $csv = Reader::createFromPath(storage_path('app/public/regions/provinces.csv'), 'r');
        foreach ($csv as $row) {
            DB::table('provinces')->insert([
                'id' => $row[0],
                'name' => $row[1]
            ]);
        }
    }

    private function seedRegencies()
    {
        $csv = Reader::createFromPath(storage_path('app/public/regions/regencies.csv'), 'r');
        foreach ($csv as $row) {
            DB::table('regencies')->insert([
                'id' => $row[0],
                'name' => $row[2],
                'province_id' => $row[1]
            ]);
        }
    }

    private function seedDistricts()
    {
        $csv = Reader::createFromPath(storage_path('app/public/regions/districts.csv'), 'r');
        foreach ($csv as $row) {
            DB::table('districts')->insert([
                'id' => $row[0],
                'name' => $row[2],
                'regency_id' => $row[1]
            ]);
        }
    }

    private function seedVillages()
    {
        $csv = Reader::createFromPath(storage_path('app/public/regions/villages.csv'), 'r');
        foreach ($csv as $row) {
            DB::table('villages')->insert([
                'id' => $row[0],
                'name' => $row[2],
                'district_id' => $row[1]
            ]);
        }
    }
}
