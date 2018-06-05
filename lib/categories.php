<?php
/*
Matheus [3:33 PM]
https://apps.shopify.com

All- Todos
Product sourcing - Dropshipping/Revenda de produtos
Marketing - Marketing
Sales - Otimização de vendas
Social Media - Mídias sociais
Shipping - Soluções de Envio
Inventory - Inventário
Customer Service - Serviço ao cliente
Tools -  Ferramentas e personalizações
Reporting - Relatórios e Análises
Sales Channels - Canais de venda

https://themes.shopify.com

Art & Photography - Arte e fotografia
Clothes & Fashion - Modas e acessórios
Joalherias e Acessórios
Eletrônicos
Alimentos e bebidas
Casa e jardim
Móveis e mobília
Saúde, beleza e perfumaria
Esportes e lazer
Infantil e Brinquedos
Games
Serviços
Sexshop
Petshop
Fitness
Outros
*/
$dictionary = get_dictionary();
$categories_apps = array(
  array('id' => 0 ,
   'name' => $dictionary['word_all_categories'],
   'page' => 'apps-page?type=apps'
),
  array('id' => 1 ,
   'name' => $dictionary['word_product_sourcing'],
   'page' => 'apps-page?type=apps&category=1'
),
  array('id' => 2 ,
  'name' => $dictionary['word_marketing'],
  'page' => 'apps-page?type=apps&category=2'
),
  array('id' => 3 ,
  'name' => $dictionary['word_sales'],
  'page' => 'apps-page?type=apps&category=3'
),
  array('id' => 4 ,
  'name' => $dictionary['word_social_media'],
  'page' => 'apps-page?type=apps&category=4'
),
//* not implemented
  array('id' => 5 ,
  'name' => $dictionary['word_shipping'],
  'page' => 'apps-page?type=apps&category=5'
),
  array('id' => 6 ,
  'name' => $dictionary['word_inventory'],
  'page' => 'apps-page?type=apps&category=6'
),
  array('id' => 7 ,
  'name' => $dictionary['word_customer_service'],
  'page' => 'apps-page?type=apps&category=7'
),
  array('id' => 8 ,
  'name' => $dictionary['word_tools'],
  'page' => 'apps-page?type=apps&category=8'
),
  array('id' => 9 ,
  'name' => $dictionary['word_reporting'],
  'page' => 'apps-page?type=apps&category=9'
),
  array('id' => 10 ,
  'name' => $dictionary['word_sales_channels'],
  'page' => 'apps-page?type=apps&category=10'
),
//*/
);

$categories_themes = array(
  // Categories Themes
  array('id' => 0 ,
   'name' => $dictionary['word_all_categories'],
   'page' => 'apps-page?type=themes'
),
  array('id' => 1 ,
  'name' => $dictionary['word_art_photography'],
  'page' => 'apps-page?type=themes&category=1'
),
//* not implemented
  array('id' => 2 ,
  'name' => $dictionary ['word_clothing_fashion'],
  'page' => 'apps-page?type=themes&category=2'
),
  array('id' => 3 ,
  'name' => $dictionary ['word_jewelry_accessories'],
  'page' => 'apps-page?type=themes&category=3'
),
  array('id' => 4 ,
  'name' => $dictionary ['word_electronics'],
  'page' => 'apps-page?type=themes&category=4'
),
  array('id' => 5 ,
  'name' => $dictionary ['word_food_drinks'],
  'page' => 'apps-page?type=themes&category=5'
),
  array('id' => 6 ,
  'name' => $dictionary ['word_home_garden'],
  'page' => 'apps-page?type=themes&category=6'
),
  array('id' => 7 ,
  'name' => $dictionary ['word_furniture'],
  'page' => 'apps-page?type=themes&category=7'
),
  array('id' => 8 ,
  'name' => $dictionary ['word_health_beauty'],
  'page' => 'apps-page?type=themes&category=8'
),
  array('id' => 9 ,
  'name' => $dictionary ['word_sports_recreation'],
  'page' => 'apps-page?type=themes&category=9'
),
  array('id' => 10 ,
  'name' => $dictionary ['word_toys_games'],
  'page' => 'apps-page?type=themes&category=10'
),
array('id' => 11,
  'name' => $dictionary['word_games'],
  'page' => 'apps-page?type=themes&category=11'
),
array('id' => 12,
  'name' => $dictionary['word_sexshop'],
  'page' => 'apps-page?type=themes&category=12'
),
array('id' => 13,
  'name' => $dictionary['word_petshop'],
  'page' => 'apps-page?type=themes&category=13'
),
array('id' => 14,
  'name' => $dictionary['word_service'],
  'page' => 'apps-page?type=themes&category=14'
),

array('id' => 15,
  'name' => $dictionary['word_fitness'],
  'page' => 'apps-page?type=themes&category=15'
),

// last from the list
  array('id' => 16 ,
  'name' => $dictionary ['word_other'],
  'page' => 'apps-page?type=themes&category=16'
),
//*/
);


$apps_themes = array(
    array('id' => 'ALL' ,
     'name' => 'TYPE',
     'page' => ''
  ),
    array('id' => 'apps' ,
     'name' => 'Type' .  $dictionary['word_app'],
     'page' => ''
  ),
  array('id' => 'themes' ,
   'name' => 'Type' . $dictionary['word_theme'],
   'page' => ''
  )
);

// FUNCTIONS

function get_categories_app()
{
  $categories = $GLOBALS['categories_apps'];
  return $categories;
}
//
function get_categories_theme()
{
  $categories = $GLOBALS['categories_themes'];
  return $categories;
}


function get_type()
{
  $categories = $GLOBALS['apps_themes'];
  return $categories;
}
