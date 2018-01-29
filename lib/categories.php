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
*/
$categories_app = array(
  array('id' => 1 , name => 'product sourcing' ),
  array('id' => 2 , name => 'marketing'),
  array('id' => 3 , name => 'sales'),
  array('id' => 4 , name => 'social media'),
  array('id' => 5 , name => 'shipping'),
  array('id' => 6 , name => 'inventory'),
  array('id' => 7 , name => 'customer service'),
  array('id' => 8 , name => 'accounting'),
  array('id' => 9 , name => 'tools'),
  array('id' => 10 , name => 'reporting'),
  array('id' => 11 , name => 'sales channels')
);
function get_categories()
{
  $categories = $GLOBALS['categories_app'];
  return $categories;
}
