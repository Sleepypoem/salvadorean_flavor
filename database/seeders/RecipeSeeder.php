<?php

namespace Database\Seeders;

use App\Models\Ingredients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Image;
use App\Models\Tags;
use App\Models\Categories;
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

        Tags::create([
            "name" => "Vegan"
        ]);

        Tags::create([
            "name" => "Easy"
        ]);

        Categories::create([
            "name" => "Ligeras"
        ]);

        $recipe = Recipe::create([
            "name" => "Salmorejo Cordobez",
            "steps" => "En un bol coloco el pan y lo cubro con el puré de tomate dejando que se impregne durante unos diez minutos.Pasado ese tiempo,
incorporo el diente de ajo y trituro bien con la batidora o con la Thermomix y obtengo una crema espesa de pan y tomate.La proporción de pan que yo uso es estupenda para esta textura,
pero podéis variarla en función del agua que tengan los tomates que utilicéis y de lo consistente que sea la miga.A continuación incorporo el aceite de oliva virgen extra,
procurad que sea un buen aceite de oliva virgen extra que conseguirá la emulsión perfecta y un resultado cremoso y espeso.Tras echar el aceite volvemos a turbinar todo en el robot de cocina o a base de batidora y paciencia hasta que nuestro salmorejo sea uniforme,
con un bonito color anaranjado y suficientemente compacto como para aguantar sobre su superficie los tradicionales tropezones de guarnición con los que se decora cada ración.",
            "category_id" => "1",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        $recipe->tags()->sync([1, 2]);

        Image::create([
            "title" => "Salmorejo Cordobès_image",
            "image" => "default_recipe.jpg",
            "imageable_type" => "App\Models\Recipe",
            "imageable_id" => "1"
        ]);

        Ingredients::create([
            "ingredient_id" => "1",
            "name" => "Ajo",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Image::create([
            "title" => "Ajo_image",
            "image" => "ajo.jpg",
            "imageable_type" => "App\Models\Ingredients",
            "imageable_id" => "1"
        ]);

        Ingredients::create([
            "ingredient_id" => "2",
            "name" => "Pan de hogaza",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Image::create([
            "title" => "Pan de hogaza_image",
            "image" => "pan.jpg",
            "imageable_type" => "App\Models\Ingredients",
            "imageable_id" => "2"
        ]);

        Ingredients::create([
            "ingredient_id" => "3",
            "name" => "Tomate",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Image::create([
            "title" => "Tomate_image",
            "image" => "tomate.jpg",
            "imageable_type" => "App\Models\Ingredients",
            "imageable_id" => "3"
        ]);

        Ingredients::create([
            "ingredient_id" => "4",
            "name" => "Aceite de oliva",
            "updated_at" => "2022-09-13",
            "created_at" => "2022-09-13",
        ]);

        Image::create([
            "title" => "Aceite de oliva_image",
            "image" => "aceite_oliva.jpg",
            "imageable_type" => "App\Models\Ingredients",
            "imageable_id" => "4"
        ]);

        $recipe->ingredients()->sync([1, 2, 3, 4]);
    }
}