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
$categories = array(
  array('id' => 0 , name => 'All Categories' ),
  array('id' => 1 , name => 'Product Sourcing' ),
  array('id' => 2 , name => 'Marketing'),
  array('id' => 3 , name => 'Sales'),
  array('id' => 4 , name => 'Social Media'),
  array('id' => 5 , name => 'Shipping'),
  array('id' => 6 , name => 'Inventory'),
  array('id' => 7 , name => 'Customer Service'),
  array('id' => 8 , name => 'Accounting'),
  array('id' => 9 , name => 'Tools'),
  array('id' => 10 , name => 'Reporting'),
  array('id' => 11 , name => 'Sales Channels'),
  // Categories Themes
  array('id' => 12 , name => 'Art & Photography'),
  array('id' => 13 , name => 'Clothing & Fashion'),
  array('id' => 14 , name => 'Jewelry & Accessories'),
  array('id' => 15 , name => 'Electronics'),
  array('id' => 16 , name => 'Food & Drinks'),
  array('id' => 17 , name => 'Home & Garden'),
  array('id' => 18 , name => 'Furniture'),
  array('id' => 19 , name => 'Health & Beauty'),
  array('id' => 20 , name => 'Sports & Recreation'),
  array('id' => 21 , name => 'Toys & Games'),
  array('id' => 22 , name => 'Other'),
);
function get_categories()
{
  $categories = $GLOBALS['categories'];
  return $categories;
}
