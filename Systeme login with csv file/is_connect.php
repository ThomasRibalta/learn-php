<?php
$title = "Connected";
require "header.php";
require "account_manager.php";
?>
<?php if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])): ?>
  <div class="alert alert-success"><?=add_user($_POST['pseudo'], $_POST['email'], $_POST['password']);?></div>
<?php elseif (isset($_POST['connect-pseudo']) && isset($_POST['connect-password'])): ?>
  <div class="alert alert-success"><?=connect_user($_POST['connect-pseudo'], $_POST['connect-password']);?></div>
<?php else:
    header('Location: connexion.php');
    exit;
  endif
?>