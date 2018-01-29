<?php
/*
all categories app = todas as categorias de aplicativos
product sourcing = produto sourcing
marketing = marketing
sales = vendas
social media = mídia social
shipping = Remessa
inventory = inventário
customer service = serviço ao cliente
accounting = contabilidade
tools = Ferramentas
reporting = relatórios
sales channels = Canal de Vendas

Art & Photography = Arte e fotografia
Clothing & Fashion = Roupas e Moda
Jewelry & Accessories = Jóias e acessórios
Electronics = Eletrônicos
Food & Drinks = Bebidas Alimentos
Home & Garden = Casa e Jardim
Furniture = Mobília
Health & Beauty = Saúde & Beleza
Sports & Recreation = Esportes e recreação
Toys & Games = Brinquedos e Jogos
Other = Outros
*/
$dictionary = get_dictionary();
$categories_apps = array(
  array('id' => 0 ,
   'name' => $dictionary['word_all_categories'],
   'page' => 'apps-page'
),
  array('id' => 1 ,
   'name' => $dictionary['word_product_sourcing'],
   'page' => ''
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
  'name' => $dictionary['word_accounting'],
  'page' => ''
),
  array('id' => 9 ,
  'name' => $dictionary['word_tools'],
  'page' => ''
),
  array('id' => 10 ,
  'name' => $dictionary['word_reporting'],
  'page' => ''
),
  array('id' => 11 ,
  'name' => $dictionary['word_sales_channels'],
  'page' => ''
),
);

$categories_themes = array(
  // Categories Themes
  array('id' => 12 ,
   'name' => $dictionary['word_all_categories'],
   'page' => 'themes-page'
),
  array('id' => 13 ,
  'name' => $dictionary['word_art_photography'],
  'page' => ''
),
  array('id' => 14 ,
  'name' => $dictionary ['word_clothing_fashion'],
  'page' => ''
),
  array('id' => 15 ,
  'name' => $dictionary ['word_jewelry_accessories'],
  'page' => ''
),
  array('id' => 16 ,
  'name' => $dictionary ['word_electronics'],
  'page' => ''
),
  array('id' => 17 ,
  'name' => $dictionary ['word_food_drinks'],
  'page' => ''
),
  array('id' => 18 ,
  'name' => $dictionary ['word_home_garden'],
  'page' => ''
),
  array('id' => 19 ,
  'name' => $dictionary ['word_furniture'],
  'page' => ''
),
  array('id' => 20 ,
  'name' => $dictionary ['word_health_beauty'],
  'page' => ''
),
  array('id' => 21 ,
  'name' => $dictionary ['word_sports_recreation'],
  'page' => ''
),
  array('id' => 22 ,
  'name' => $dictionary ['word_toys_games'],
  'page' => ''
),
  array('id' => 23 ,
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
