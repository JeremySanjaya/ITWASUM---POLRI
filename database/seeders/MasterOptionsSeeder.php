<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterOptionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_options')->insert([
            [
                'id' => 6,
                'kategori' => 'struktural',
                'nama_opsi' => 'Irwil I',
                'created_at' => Carbon::parse('2026-03-17 08:27:04'),
                'updated_at' => Carbon::parse('2026-03-17 08:27:04'),
            ],
            [
                'id' => 7,
                'kategori' => 'struktural',
                'nama_opsi' => 'Iriwil II',
                'created_at' => Carbon::parse('2026-03-17 08:27:44'),
                'updated_at' => Carbon::parse('2026-03-17 08:27:44'),
            ],
            [
                'id' => 8,
                'kategori' => 'struktural',
                'nama_opsi' => 'Irwil III',
                'created_at' => Carbon::parse('2026-03-17 08:27:51'),
                'updated_at' => Carbon::parse('2026-03-17 08:27:51'),
            ],
        ]);
    }
}
