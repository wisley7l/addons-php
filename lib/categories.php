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
$categories = array(
  array('id' => 0 , name => $dictionary['word_all_categories']),
  array('id' => 1 , name => $dictionary['word_product_sourcing'] . '-' . $dictionary['word_app']),
  array('id' => 2 , name => $dictionary['word_marketing']) . '-' . $dictionary['word_app'],
  array('id' => 3 , name => $dictionary['word_sales'] . '-' . $dictionary['word_app']),
  array('id' => 4 , name => $dictionary['word_social_media'] . '-' . $dictionary['word_app']),
  array('id' => 5 , name => $dictionary['word_shipping'] . '-' . $dictionary['word_app']),
  array('id' => 6 , name => $dictionary['word_inventory'] . '-' . $dictionary['word_app']),
  array('id' => 7 , name => $dictionary['word_customer_service'] . '-' . $dictionary['word_app']),
  array('id' => 8 , name => $dictionary['word_accounting'] . '-' . $dictionary['word_app']),
  array('id' => 9 , name => $dictionary['word_tools'] . '-' . $dictionary['word_app']),
  array('id' => 10 , name => $dictionary['word_reporting'] . '-' . $dictionary['word_app']),
  array('id' => 11 , name => $dictionary['word_sales_channels'] . '-' . $dictionary['word_app']),
  // Categories Themes
  array('id' => 12 , name => $dictionary['word_art_photography']),
  array('id' => 13 , name => $dictionary ['word_clothing_fashion']),
  array('id' => 14 , name => $dictionary ['word_jewelry_accessories']),
  array('id' => 15 , name => $dictionary ['word_electronics']),
  array('id' => 16 , name => $dictionary ['word_food_drinks']),
  array('id' => 17 , name => $dictionary ['word_home_garden']),
  array('id' => 18 , name => $dictionary ['word_furniture']),
  array('id' => 19 , name => $dictionary ['word_health_beauty']),
  array('id' => 20 , name => $dictionary ['word_sports_recreation']),
  array('id' => 21 , name => $dictionary ['word_toys_games']),
  array('id' => 22 , name => $dictionary ['word_other']),
);
function get_categories()
{
  $categories = $GLOBALS['categories'];
  return $categories;
}
