<?php
phpinfo();
die();
date_default_timezone_set('Europe/Paris');
$title = "Livre d'or";
require 'header.php';
require_once 'class/Message.php';
require_once 'class/GoldBook.php';

$goldBook = new GoldBook('data/messages.txt');

if (isset($_POST['pseudo'], $_POST['message']))
{
    $message = new Message($_POST['pseudo'], $_POST['message']);
    if ($message->isValid())
    {
        $goldBook = new GoldBook('data/messages.txt');
        $goldBook->addMessage($message);
    }
    else
    {
        $errors = $message->getErrors();
    }
}
?>

<?php if (isset($errors)) : ?>
  <div class="alert alert-danger">
    <p>Le formulaire contient des erreurs :</p>
    <ul>
      <?php foreach ($errors as $error) : ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php elseif (!isset($errors) && isset($_POST['pseudo']) && isset($_POST['message'])) : ?>
  <div class="alert alert-success">
    <p>Votre message a bien été envoyé.</p>
  </div>
<?php endif; ?>

<div class="container mt-5">
    <h1>Livre d'or</h1>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudonyme</label>
            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Entrez votre pseudo...">
            <label for="message">Votre Message</label>
            <input type="text" name="message" id="message" class="form-control" placeholder="Entrez votre message...">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Envoyer message</button>
        </div>
    </form>
</div>

<div class="container mt-5">
    <h2>Listes des Messages</h2>
    <?php foreach ($goldBook->getMessages() as $message) : ?>
        <div class="card mt-3">
            <div class="card-body">
                <?= $message->to_html() ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>