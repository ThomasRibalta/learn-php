<?php
use App\App;
require '../vendor/autoload.php';

$auth = App::getAuth();
$user = $auth->getUser();
if ($user) {
    header('Location: /index.php/');
    exit();
}
$error = false;
if (!empty($_POST)) {
    $user = $auth->login($_POST['username'], $_POST['password']);
    if ($user) {
        header('Location: /index.php/');
        exit();
    }else {
        $error = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="p-4">
    <?php if ($error): ?>
        <div class="alert alert-danger">Identifiant ou mot de passe incorrects</div>
    <?php endif ?>
    <h1>Connexion</h1>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="username">Pseudo</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
</body>
</html>