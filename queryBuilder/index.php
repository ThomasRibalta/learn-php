<?php
require 'vendor/autoload.php';
use App\QueryBuilder;

$builder = new QueryBuilder("test");
$builder->add_table('usersee');
$builder->select(['name', 'email']);
$builder->add_table('users');
$builder->select(['name', 'emaile']);

var_dump($builder->request);