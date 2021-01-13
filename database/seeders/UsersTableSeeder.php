<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ADMINISTRADOR SISTEMA',
            'email' => 'admin@prescott.edu.pe',
            'password' => Hash::make('admin'),
            'role_id' => '1',
        ]);
        User::create([
            'name' => 'ADMINISTRADOR GENERAL',
            'email' => 'admingeneral@prescott.edu.pe',
            'password' => Hash::make('admingeneral'),
            'role_id' => '2',
        ]);

        User::create([
            'name' => 'ARLETTE RONDÓN',
            'email' => 'arondon@prescott.edu.pe',
            'password' => Hash::make('arondon'),
            'role_id' => '4',
        ]);

        User::create([
            'name' => 'ANA IRENE TALAVERA',
            'email' => 'italavera@prescott.edu.pe',
            'password' => Hash::make('italavera'),
            'role_id' => '4',
        ]);

        User::create([
            'name' => 'PATRICIA MEDINA',
            'email' => 'kmedina@prescott.edu.pe',
            'password' => Hash::make('kmedina'),
            'role_id' => '4',
        ]);

        User::create([
            'name' => 'FLORITA SARMIENTO',
            'email' => 'fsarmiento@prescott.edu.pe',
            'password' => Hash::make('fsarmiento'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'ANDREA ZEGARRA',
            'email' => 'azegarra@prescott.edu.pe ',
            'password' => Hash::make('azegarra'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'SUSANA BUSTAMANTE',
            'email' => 'sbustamante@prescott.edu.pe',
            'password' => Hash::make('sbustamante'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'PAOLA ORTIZ',
            'email' => 'portizdezevallos@prescott.edu.pe',
            'password' => Hash::make('portizdezevallos'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'CARMEN GARCIA',
            'email' => 'cgarciacalderon@prescott.edu.pe',
            'password' => Hash::make('cgarciacalderon'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'VANIA LOPEZ',
            'email' => 'vlopez@prescott.edu.pe',
            'password' => Hash::make('vlopez'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'ANA PAOLA MOSCOSO',
            'email' => 'ana.moscosog@prescott.edu.pe',
            'password' => Hash::make('ana.moscosog'),
            'role_id' => '3',

        ]);

        User::create([
            'name' => 'PAOLA CARDENAS',
            'email' => 'pcardenas@prescott.edu.pe',
            'password' => Hash::make('pcardenas'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'FERNANDO AZALGARA',
            'email' => 'fazalgara@prescott.edu.pe',
            'password' => Hash::make('fazalgara'),
            'role_id' => '4',

        ]);

        User::create([
            'name' => 'JAVIER BUTRÓN',
            'email' => 'jbutron@prescott.edu.pe',
            'password' => Hash::make('jbutron'),
            'role_id' => '4',

        ]);


    }
}
