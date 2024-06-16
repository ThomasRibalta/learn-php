<?php

require '../vendor/autoload.php';
use App\App;

$users = App::getPdo()->query('SELECT * FROM users')->fetchAll();
$auth = App::getAuth();
$user = $auth->getUser();
$is_connected = false;
if ($user) 
    $is_connected = true;

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="p-4">
    <h1>Accèder aux pages</h1>
    <?php if ($is_connected): ?>
        <p>Vous êtes connecté en tant qu'<?=$user->role?> <a href="/logout.php">se déconnecter</a></p>
    <?php endif ?>
    <ul>
        <li><a href="/admin.php">Page réservée à l'administrateur</a></li>
        <li><a href="/user.php">Page réservée à l'utilisateur</a></li>
    </ul>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>