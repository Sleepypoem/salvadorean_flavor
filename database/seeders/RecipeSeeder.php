<?php

namespace Database\Seeders;

use App\Models\Ingredients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Support\Carbon;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipe = Recipe::create([
            "name" => "Salmorejo Cordobez",
            "steps" => "En un bol coloco el pan y lo cubro con el puré de tomate dejando que se impregne durante unos diez minutos.Pasado ese tiempo,
incorporo el diente de ajo y trituro bien con la batidora o con la Thermomix y obtengo una crema espesa de pan y tomate.La proporción de pan que yo uso es estupenda para esta textura,
pero podéis variarla en función del agua que tengan los tomates que utilicéis y de lo consistente que sea la miga.A continuación incorporo el aceite de oliva virgen extra,
procurad que sea un buen aceite de oliva virgen extra que conseguirá la emulsión perfecta y un resultado cremoso y espeso.Tras echar el aceite volvemos a turbinar todo en el robot de cocina o a base de batidora y paciencia hasta que nuestro salmorejo sea uniforme,
con un bonito color anaranjado y suficientemente compacto como para aguantar sobre su superficie los tradicionales tropezones de guarnición con los que se decora cada ración.",
            "category" => "1",
            "image" => "default.png",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Ingredients::create([
            "ingredient_id" => "1",
            "name" => "Ajo",
            "image" => "default.png",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Ingredients::create([
            "ingredient_id" => "2",
            "name" => "Pan de hogaza",
            "image" => "default.png",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Ingredients::create([
            "ingredient_id" => "3",
            "name" => "Tomate",
            "image" => "default.png",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Ingredients::create([
            "ingredient_id" => "4",
            "name" => "Aceite",
            "image" => "default.png",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        $recipe->ingredients()->sync([1, 2, 3, 4]);
    }
}