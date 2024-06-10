<?php

function connect_user(string $pseudo, string $password) : string
{
    $file = fopen('compte.csv', 'r');
    while ($data = fgetcsv($file))
    {
        if ($data[0] === $pseudo && password_verify($password, $data[2]))
        {
            fclose($file);
            return "Connexion réussie";
        }
    }
    fclose($file);
    $status = "Pseudo ou mot de passe incorrect";
    header('Location: connexion.php?status='.$status);
    exit;
}

function in_csv(string $name, string $email) : bool
{
    $file = fopen('compte.csv', 'r');
    $users = [];
    while ($data = fgetcsv($file))
    {
        if ($data[0] === $name || $data[1] === $email)
        {
            fclose($file);
            return true;
        }
    }
    return false;
}

function add_user(string $pseudo, string $email, string $password) : string
{
    $status = "";
    if (empty($pseudo))
    {
        $status = "Vous avez oublié de renseigner votre pseudo";
        header('Location: index.php?status='.$status);
    }
    else if (empty($email))
    {
        $status = "Vous avez oublié de renseigner votre email";
        header('Location: index.php?status='.$status);
    }
    else if (strlen($password) < 8)
    {
        $status = "Mot de passe trop court";
        header('Location: index.php?status='.$status);
    }
    else if (in_csv($pseudo, $email))
    {
        $status = "Utilisateur déjà existant";
        header('Location: index.php?status='.$status);
    }
    $file = fopen('compte.csv', 'a+');
    fputcsv($file, [$pseudo, $email, password_hash($password, PASSWORD_DEFAULT)]);
    fclose($file);
    return "Utilisateur ajouté avec succès";
}
?>