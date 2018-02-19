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
   'page' => 'category-product-sourcing'
),
  array('id' => 2 ,
  'name' => $dictionary['word_marketing'],
  'page' => 'category-marketing'
),
  array('id' => 3 ,
  'name' => $dictionary['word_sales'],
  'page' => 'category-sales'
),
  array('id' => 4 ,
  'name' => $dictionary['word_social_media'],
  'page' => 'category-social-media'
),
/* not implemented
  array('id' => 5 ,
  'name' => $dictionary['word_shipping'],
  'page' => 'category-shipping'
),
  array('id' => 6 ,
  'name' => $dictionary['word_inventory'],
  'page' => 'category-invetory'
),
  array('id' => 7 ,
  'name' => $dictionary['word_customer_service'],
  'page' => 'category-customer-service'
),
  array('id' => 8 ,
  'name' => $dictionary['word_tools'],
  'page' => 'category-tools'
),
  array('id' => 9 ,
  'name' => $dictionary['word_reporting'],
  'page' => 'category-reporting'
),
  array('id' => 10 ,
  'name' => $dictionary['word_sales_channels'],
  'page' => 'category-sales-channels'
),
*/
);

$categories_themes = array(
  // Categories Themes
  array('id' => 0 ,
   'name' => $dictionary['word_all_categories'],
   'page' => 'theme-page'
),
  array('id' => 1 ,
  'name' => $dictionary['word_art_photography'],
  'page' => 'category-art-photography'
),
/* not implemented
  array('id' => 2 ,
  'name' => $dictionary ['word_clothing_fashion'],
  'page' => 'category-clotthinf-fashion'
),
  array('id' => 3 ,
  'name' => $dictionary ['word_jewelry_accessories'],
  'page' => 'category-jewelry-acessories'
),
  array('id' => 4 ,
  'name' => $dictionary ['word_electronics'],
  'page' => 'category-electronics'
),
  array('id' => 5 ,
  'name' => $dictionary ['word_food_drinks'],
  'page' => 'category-food-drinks'
),
  array('id' => 6 ,
  'name' => $dictionary ['word_home_garden'],
  'page' => 'category-home-garden'
),
  array('id' => 7 ,
  'name' => $dictionary ['word_furniture'],
  'page' => 'category-furniture'
),
  array('id' => 8 ,
  'name' => $dictionary ['word_health_beauty'],
  'page' => 'category-health-beauty'
),
  array('id' => 9 ,
  'name' => $dictionary ['word_sports_recreation'],
  'page' => 'category-sports-recreation'
),
  array('id' => 10 ,
  'name' => $dictionary ['word_toys_games'],
  'page' => 'category-toys-games'
),
array('id' => 11,
  'name' => $dictionary['word_games'],
  'page' => 'category-games'
),
array('id' => 12,
  'name' => $dictionary['word_sexshop'],
  'page' => 'category-sexshop'
),
array('id' => 13,
  'name' => $dictionary['word_petshop'],
  'page' => 'category-petshop'
),
array('id' => 14,
  'name' => $dictionary['word_service'],
  'page' => 'category-service'
),

array('id' => 15,
  'name' => $dictionary['word_fitness'],
  'page' => 'category-fitness'
),

// last from the list
  array('id' => 16 ,
  'name' => $dictionary ['word_other'],
  'page' => 'category-outher'
),
*/
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
