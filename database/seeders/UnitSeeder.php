<?php

namespace Database\Seeders;

use App\Models\Unit;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    use WithoutModelEvents;

    private array $units = [
        [
            'id' => 1,
            'name' => 'Porto Alegre',
            'latitude' => -30.048750057541955,
            'longitude' => -51.228587422990806,
            'manager_id' => 5,
            'division_id' => 1
        ],
        [
            'id' => 2,
            'name' => 'Florianópolis',
            'latitude' => -27.55393525017396,
            'longitude' => -48.49841515885026,
            'manager_id' => 6,
            'division_id' => 1
        ],
        [
            'id' => 3,
            'name' => 'Curitiba',
            'latitude' => -25.473704465731746,
            'longitude' => -49.24787198992874,
            'manager_id' => 7,
            'division_id' => 1
        ],
        [
            'id' => 4,
            'name' => 'São Paulo',
            'latitude' => -23.544259437612844,
            'longitude' => -46.64370714029131,
            'manager_id' => 8,
            'division_id' => 2
        ],
        [
            'id' => 5,
            'name' => 'Rio de Janeiro',
            'latitude' => -22.923447510604802,
            'longitude' => -43.23208495438858,
            'manager_id' => 9,
            'division_id' => 2
        ],
        [
            'id' => 6,
            'name' => 'Belo Horizonte',
            'latitude' => -19.917854829716372,
            'longitude' => -43.94089385954766,
            'manager_id' => 10,
            'division_id' => 2
        ],
        [
            'id' => 7,
            'name' => 'Vitória',
            'latitude' => -20.340992420772206,
            'longitude' => -40.38332271475097,
            'manager_id' => 11,
            'division_id' => 2
        ],
        [
            'id' => 8,
            'name' => 'Campo Grande',
            'latitude' => -20.462652006300377,
            'longitude' => -54.615658937666645,
            'manager_id' => 12,
            'division_id' => 3
        ],
        [
            'id' => 9,
            'name' => 'Goiânia',
            'latitude' => -16.673126240814387,
            'longitude' => -49.25248826354209,
            'manager_id' => 13,
            'division_id' => 3
        ],
        [
            'id' => 10,
            'name' => 'Cuiabá',
            'latitude' => -15.601754458320842,
            'longitude' => -56.09832706558089,
            'manager_id' => 14,
            'division_id' => 3
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->units as $unit) {
            Unit::updateOrCreate($unit);
        }
    }
}
