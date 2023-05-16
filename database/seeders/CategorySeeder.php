<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias=[
            'Informática'=>"#c0392b",
            'Matemáticas'=>" #17a589",
            'Química'=>"#d4ac0d",
            'Física'=>'#909497',
            'Deportes'=>'#800080',
        ];
        foreach($categorias as $n=>$v){
            Category::create([
                'nombre'=>$n,
                'color'=>$v
            ]);
        }

    }
}
