<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $villes = [
            'Agadir',
            'Aïn Harrouda',
            'Aït Melloul',
            'Al Hoceima',
            'Asilah',
            'Azemmour',
            'Azrou',
            'Beni Mellal',
            'Berkane',
            'Berrechid',
            'Boujdour',
            'Boulemane',
            'Casablanca',
            'Chefchaouen',
            'Chichaoua',
            'Dakhla',
            'Demnate',
            'El Hajeb',
            'El Jadida',
            'El Kelaâ des Sraghna',
            'Errachidia',
            'Essaouira',
            'Fès',
            'Fnideq',
            'Fquih Ben Salah',
            'Guelmim',
            'Guercif',
            'Ifrane',
            'Imzouren',
            'Jerada',
            'Kasba Tadla',
            'Kénitra',
            'Khémisset',
            'Khénifra',
            'Khouribga',
            'Ksar El Kebir',
            'Laâyoune',
            'Larache',
            'Marrakech',
            'Martil',
            'Meknès',
            'Midelt',
            'Mohammédia',
            'Nador',
            'Ouarzazate',
            'Ouezzane',
            'Oujda',
            'Rabat',
            'Safi',
            'Salé',
            'Sefrou',
            'Settat',
            'Sidi Bennour',
            'Sidi Ifni',
            'Sidi Kacem',
            'Sidi Slimane',
            'Skhirat',
            'Souk El Arbaa',
            'Tamesna',
            'Tan-Tan',
            'Tanger',
            'Taounate',
            'Taourirt',
            'Tarfaya',
            'Taroudant',
            'Taza',
            'Témara',
            'Tétouan',
            'Tinghir',
            'Tiznit',
            'Youssoufia',
            'Zagora',
        ];

        foreach ($villes as $ville) {
            DB::table('villes')->insert([
                'name' => $ville,
            ]);
        }
    }
}
