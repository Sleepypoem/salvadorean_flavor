use salvadorean_flavor;

/* ************************************************************ Ingredients insertions ************************************************************ */

INSERT INTO
    `ingredients` (
        `ingredient_id`,
        `name`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Tomate',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

INSERT INTO
    `ingredients` (
        `ingredient_id`,
        `name`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Ajo',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

INSERT INTO
    `ingredients` (
        `ingredient_id`,
        `name`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Cebolla',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

INSERT INTO
    `ingredients` (
        `ingredient_id`,
        `name`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Pan de hogaza',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

INSERT INTO
    `ingredients` (
        `ingredient_id`,
        `name`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Aceite de oliva',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

INSERT INTO
    `ingredients` (
        `ingredient_id`,
        `name`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Sal',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

/* ************************************************************************************************************************************************ */

/* ************************************************************** Recipes insertions ************************************************************** */

INSERT INTO
    `recipes` (
        `recipe_id`,
        `name`,
        `steps`,
        `category`,
        `image`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'Salmorejo cordobez',
        'En un bol coloco el pan y lo cubro con el puré de tomate dejando que se impregne durante unos diez minutos.Pasado ese tiempo,
incorporo el diente de ajo y trituro bien con la batidora o con la Thermomix y obtengo una crema espesa de pan y tomate.La proporción de pan que yo uso es estupenda para esta textura,
pero podéis variarla en función del agua que tengan los tomates que utilicéis y de lo consistente que sea la miga.A continuación incorporo el aceite de oliva virgen extra,
procurad que sea un buen aceite de oliva virgen extra que conseguirá la emulsión perfecta y un resultado cremoso y espeso.Tras echar el aceite volvemos a turbinar todo en el robot de cocina o a base de batidora y paciencia hasta que nuestro salmorejo sea uniforme,
con un bonito color anaranjado y suficientemente compacto como para aguantar sobre su superficie los tradicionales tropezones de guarnición con los que se decora cada ración.',
        '1',
        'default.png',
        CURRENT_DATE(),
        CURRENT_DATE()
    );

/* ************************************************************************************************************************************************ */