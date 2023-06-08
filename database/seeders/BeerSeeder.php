<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $beers = [
            [
                'brand' => 'Heineken',
                'description' => 'Heineken es una cerveza pilsner holandesa conocida por su sabor refrescante y su aroma distintivo. Tiene una graduación alcohólica del 5%. Es una cerveza dorada con un amargor suave y notas de malta.',
                'vol' => 5.0,
            ],
            [
                'brand' => 'Guinness',
                'description' => 'Guinness es una cerveza stout irlandesa famosa por su color oscuro y su sabor a malta tostada. Tiene una graduación alcohólica del 4.2%. Es una cerveza cremosa con notas de café y chocolate.',
                'vol' => 4.2,
            ],
            [
                'brand' => 'Stella Artois',
                'description' => 'Stella Artois es una cerveza lager belga conocida por su pureza y sabor suave. Tiene una graduación alcohólica del 5.0%. Es una cerveza dorada y cristalina con un equilibrio entre dulzor y amargor.',
                'vol' => 5.0,
            ],
            [
                'brand' => 'Corona Extra',
                'description' => 'Corona Extra es una cerveza pale lager mexicana, famosa por su imagen playera y su sabor refrescante. Tiene una graduación alcohólica del 4.5%. Es una cerveza ligera y suave con notas cítricas.',
                'vol' => 4.5,
            ],
            [
                'brand' => 'Paulaner Hefeweizen',
                'description' => 'Paulaner Hefeweizen es una cerveza de trigo alemana conocida por su aspecto turbio y su sabor a banana y clavo de olor. Tiene una graduación alcohólica del 5.5%. Es una cerveza fresca y afrutada.',
                'vol' => 5.5,
            ],
            [
                'brand' => 'Hoegaarden',
                'description' => 'Hoegaarden es una cerveza de trigo belga que se caracteriza por su sabor especiado y refrescante. Tiene una graduación alcohólica del 4.9%. Es una cerveza turbia con notas cítricas y de cilantro.',
                'vol' => 4.9,
            ],
            [
                'brand' => 'Chimay Grande Réserve',
                'description' => 'Chimay Grande Réserve es una cerveza trapense belga de estilo quadrupel. Tiene una graduación alcohólica del 9.0%. Es una cerveza oscura con sabores complejos de frutas secas, caramelo y especias.',
                'vol' => 9.0,
            ],
            [
                'brand' => 'Weihenstephaner Hefe Weissbier',
                'description' => 'Weihenstephaner Hefe Weissbier es una cerveza de trigo alemana de renombre mundial. Tiene una graduación alcohólica del 5.4%. Es una cerveza dorada y turbia con sabores de plátano y clavo de olor.',
                'vol' => 5.4,
            ],
            [
                'brand' => 'Budweiser',
                'description' => 'Budweiser es una cerveza lager estadounidense reconocida por su suavidad y ligereza. Tiene una graduación alcohólica del 5.0%. Es una cerveza dorada con un sabor equilibrado y notas sutiles de malta.',
                'vol' => 5.0,
            ],
            [
                'brand' => 'Franziskaner Weissbier',
                'description' => 'Franziskaner Weissbier es una cerveza de trigo alemana con una larga tradición. Tiene una graduación alcohólica del 5.0%. Es una cerveza de color dorado con sabores frutales y notas de especias.',
                'vol' => 5.0,
            ],
        ];

        foreach ($beers as $beer) {
            DB::table('beers')->insert($beer);
        }


    }
}
