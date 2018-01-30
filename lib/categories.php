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
   'page' => 'apps-page'
),
  array('id' => 1 ,
   'name' => $dictionary['word_product_sourcing'],
   'page' => 'product-sourcing'
),
  array('id' => 2 ,
  'name' => $dictionary['word_marketing'],
  'page' => ''
),
  array('id' => 3 ,
  'name' => $dictionary['word_sales'],
  'page' => ''
),
  array('id' => 4 ,
  'name' => $dictionary['word_social_media'],
  'page' => ''
),
  array('id' => 5 ,
  'name' => $dictionary['word_shipping'],
  'page' => ''
),
  array('id' => 6 ,
  'name' => $dictionary['word_inventory'],
  'page' => ''
),
  array('id' => 7 ,
  'name' => $dictionary['word_customer_service'],
  'page' => ''
),
  array('id' => 8 ,
  'name' => $dictionary['word_tools'],
  'page' => ''
),
  array('id' => 9 ,
  'name' => $dictionary['word_reporting'],
  'page' => ''
),
  array('id' => 10 ,
  'name' => $dictionary['word_sales_channels'],
  'page' => ''
),
);

$categories_themes = array(
  // Categories Themes
  array('id' => 11 ,
   'name' => $dictionary['word_all_categories'],
   'page' => 'theme-page'
),
  array('id' => 12 ,
  'name' => $dictionary['word_art_photography'],
  'page' => ''
),
  array('id' => 13 ,
  'name' => $dictionary ['word_clothing_fashion'],
  'page' => ''
),
  array('id' => 14 ,
  'name' => $dictionary ['word_jewelry_accessories'],
  'page' => ''
),
  array('id' => 15 ,
  'name' => $dictionary ['word_electronics'],
  'page' => ''
),
  array('id' => 16 ,
  'name' => $dictionary ['word_food_drinks'],
  'page' => ''
),
  array('id' => 17 ,
  'name' => $dictionary ['word_home_garden'],
  'page' => ''
),
  array('id' => 18 ,
  'name' => $dictionary ['word_furniture'],
  'page' => ''
),
  array('id' => 19 ,
  'name' => $dictionary ['word_health_beauty'],
  'page' => ''
),
  array('id' => 20 ,
  'name' => $dictionary ['word_sports_recreation'],
  'page' => ''
),
  array('id' => 21 ,
  'name' => $dictionary ['word_toys_games'],
  'page' => ''
),
array('id' => 22,
  'name' => $dictionary['word_games'],
  'page' => ''
),
array('id' => 23,
  'name' => $dictionary['word_sexshop'],
  'page' => ''
),
array('id' => 24,
  'name' => $dictionary['word_petshop'],
  'page' => ''
),
array('id' => 25,
  'name' => $dictionary['word_service'],
  'page' => ''
),

array('id' => 26,
  'name' => $dictionary['word_fitness'],
  'page' => ''
),

// last from the list
  array('id' => 27 ,
  'name' => $dictionary ['word_other'],
  'page' => ''
),

);
//
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
