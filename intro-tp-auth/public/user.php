<?php
use App\App;
require '../vendor/autoload.php';

App::getAuth()->requireRole('user', 'admin');
?>
Réservé à l'utilisateur