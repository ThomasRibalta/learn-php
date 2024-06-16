<?php
use App\App;
require '../vendor/autoload.php';

App::getAuth()->requireRole('admin');
?>
Réservé à l'admin