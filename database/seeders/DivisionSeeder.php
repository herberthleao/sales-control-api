<?php

namespace Database\Seeders;

use App\Models\Division;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    use WithoutModelEvents;

    private array $divisions = [
        ['id' => 1, 'name' => 'Sul', 'director_id' => 2],
        ['id' => 2, 'name' => 'Sudeste', 'director_id' => 3],
        ['id' => 3, 'name' => 'Centro-oeste', 'director_id' => 4]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->divisions as $division) {
            Division::updateOrCreate($division);
        }
    }
}
