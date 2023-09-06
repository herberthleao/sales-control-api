<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    private array $users = [
        [
            'id' => 1,
            'name' => 'Edson A. do Nascimento',
            'email' => 'pele@magazineaziul.com.br',
            'role' => 'GENERAL_DIRECTOR'
        ],
        [
            'id' => 2,
            'name' => 'Vagner Mancini',
            'email' => 'vagner.mancini@magazineaziul.com.br',
            'role' => 'DIRECTOR'
        ],
        [
            'id' => 3,
            'name' => 'Abel Ferreira',
            'email' => 'abel.ferreira@magazineaziul.com.br',
            'role' => 'DIRECTOR'
        ],
        [
            'id' => 4,
            'name' => 'Rogerio Ceni',
            'email' => 'rogerio.ceni@magazineaziul.com.br',
            'role' => 'DIRECTOR'
        ],
        [
            'id' => 5,
            'name' => 'Ronaldinho Gaucho',
            'email' => 'ronaldinho.gaucho@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 6,
            'name' => 'Roberto Firmino',
            'email' => 'roberto.firmino@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 7,
            'name' => 'Alex de Souza',
            'email' => 'alex.de.souza@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 8,
            'name' => 'Françoaldo Souza',
            'email' => 'françoaldo.souza@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 9,
            'name' => 'Romário Faria',
            'email' => 'romário.faria@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 10,
            'name' => 'Ricardo Goulart',
            'email' => 'ricardo.goulart@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 11,
            'name' => 'Dejan Petkovic',
            'email' => 'dejan.petkovic@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 12,
            'name' => 'Deyverson Acosta',
            'email' => 'deyverson.acosta@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 13,
            'name' => 'Harlei Silva',
            'email' => 'harlei.silva@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 14,
            'name' => 'Walter Henrique',
            'email' => 'walter.henrique@magazineaziul.com.br',
            'role' => 'MANAGER'
        ],
        [
            'id' => 15,
            'name' => 'Afonso Afancar',
            'email' => 'afonso.afancar@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 6
        ],
        [
            'id' => 16,
            'name' => 'Alceu Andreoli',
            'email' => 'alceu.andreoli@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 6
        ],
        [
            'id' => 17,
            'name' => 'Amalia Zago',
            'email' => 'amalia.zago@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 6
        ],
        [
            'id' => 18,
            'name' => 'Carlos Eduardo',
            'email' => 'carlos.eduardo@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 6
        ],
        [
            'id' => 19,
            'name' => 'Luiz Felipe',
            'email' => 'luiz.felipe@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 6
        ],
        [
            'id' => 20,
            'name' => 'Breno',
            'email' => 'breno@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 8
        ],
        [
            'id' => 21,
            'name' => 'Emanuel',
            'email' => 'emanuel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 8
        ],
        [
            'id' => 22,
            'name' => 'Ryan',
            'email' => 'ryan@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 8
        ],
        [
            'id' => 23,
            'name' => 'Vitor Hugo',
            'email' => 'vitor.hugo@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 8
        ],
        [
            'id' => 24,
            'name' => 'Yuri',
            'email' => 'yuri@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 8
        ],
        [
            'id' => 25,
            'name' => 'Benjamin',
            'email' => 'benjamin@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 10
        ],
        [
            'id' => 26,
            'name' => 'Erick',
            'email' => 'erick@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 10
        ],
        [
            'id' => 27,
            'name' => 'Enzo Gabriel',
            'email' => 'enzo.gabriel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 10
        ],
        [
            'id' => 28,
            'name' => 'Fernando',
            'email' => 'fernando@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 10
        ],
        [
            'id' => 29,
            'name' => 'Joaquim',
            'email' => 'joaquim@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 10
        ],
        [
            'id' => 30,
            'name' => 'André',
            'email' => 'andré@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 3
        ],
        [
            'id' => 31,
            'name' => 'Raul',
            'email' => 'raul@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 3
        ],
        [
            'id' => 32,
            'name' => 'Marcelo',
            'email' => 'marcelo@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 3
        ],
        [
            'id' => 33,
            'name' => 'Julio César',
            'email' => 'julio.césar@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 3
        ],
        [
            'id' => 34,
            'name' => 'Cauê',
            'email' => 'cauê@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 3
        ],
        [
            'id' => 35,
            'name' => 'Benício',
            'email' => 'benício@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 2
        ],
        [
            'id' => 36,
            'name' => 'Vitor Gabriel',
            'email' => 'vitor.gabriel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 2
        ],
        [
            'id' => 37,
            'name' => 'Augusto',
            'email' => 'augusto@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 2
        ],
        [
            'id' => 38,
            'name' => 'Pedro Lucas',
            'email' => 'pedro.lucas@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 2
        ],
        [
            'id' => 39,
            'name' => 'Luiz Gustavo',
            'email' => 'luiz.gustavo@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 2
        ],
        [
            'id' => 40,
            'name' => 'Giovanni',
            'email' => 'giovanni@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 9
        ],
        [
            'id' => 41,
            'name' => 'Renato',
            'email' => 'renato@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 9
        ],
        [
            'id' => 42,
            'name' => 'Diego',
            'email' => 'diego@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 9
        ],
        [
            'id' => 43,
            'name' => 'João Paulo',
            'email' => 'joão.paulo@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 9
        ],
        [
            'id' => 44,
            'name' => 'Renan',
            'email' => 'renan@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 9
        ],
        [
            'id' => 45,
            'name' => 'Luiz Fernando',
            'email' => 'luiz.fernando@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 1
        ],
        [
            'id' => 46,
            'name' => 'Anthony',
            'email' => 'anthony@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 1
        ],
        [
            'id' => 47,
            'name' => 'Lucas Gabriel',
            'email' => 'lucas.gabriel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 1
        ],
        [
            'id' => 48,
            'name' => 'Thales',
            'email' => 'thales@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 1
        ],
        [
            'id' => 49,
            'name' => 'Luiz Miguel',
            'email' => 'luiz.miguel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 1
        ],
        [
            'id' => 50,
            'name' => 'Henry',
            'email' => 'henry@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 5
        ],
        [
            'id' => 51,
            'name' => 'Marcos Vinicius',
            'email' => 'marcos.vinicius@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 5
        ],
        [
            'id' => 52,
            'name' => 'Kevin',
            'email' => 'kevin@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 5
        ],
        [
            'id' => 53,
            'name' => 'Levi',
            'email' => 'levi@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 5
        ],
        [
            'id' => 54,
            'name' => 'Enrico',
            'email' => 'enrico@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 5
        ],
        [
            'id' => 55,
            'name' => 'João Lucas',
            'email' => 'joão.lucas@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 4
        ],
        [
            'id' => 56,
            'name' => 'Hugo',
            'email' => 'hugo@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 4
        ],
        [
            'id' => 57,
            'name' => 'Luiz Guilherme',
            'email' => 'luiz.guilherme@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 4
        ],
        [
            'id' => 58,
            'name' => 'Matheus Henrique',
            'email' => 'matheus.henrique@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 4
        ],
        [
            'id' => 59,
            'name' => 'Miguel',
            'email' => 'miguel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 4
        ],
        [
            'id' => 60,
            'name' => 'Miguel',
            'email' => 'davi@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 7
        ],
        [
            'id' => 61,
            'name' => 'Gabriel',
            'email' => 'gabriel@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 7
        ],
        [
            'id' => 62,
            'name' => 'Arthur',
            'email' => 'arthur@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 7
        ],
        [
            'id' => 63,
            'name' => 'Lucas',
            'email' => 'lucas@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 7
        ],
        [
            'id' => 64,
            'name' => 'Matheus',
            'email' => 'matheus@magazineaziul.com.br',
            'role' => 'SELLER',
            'unit_id' => 7
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultPassword = Hash::make('123mudar');

        Schema::disableForeignKeyConstraints();
        foreach ($this->users as $user) {
            User::updateOrCreate($user + ['password' => $defaultPassword]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
