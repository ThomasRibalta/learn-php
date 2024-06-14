<?php
$title = "Blog pdo";
$pdo = new PDO('sqlite:data.db');
try
{
    if (isset($_POST['title'], $_POST['content']) && !empty($_POST['title']) && !empty($_POST['content']))
    {
        $titleAdd = $_POST['title'];
        $content = $_POST['content'];
        $date = new DateTime();
        $query = $pdo->prepare("INSERT INTO posts (title, content, created_at) VALUES (:title, :content, :moment)");
        $query->execute([
            'title' => $titleAdd,
            'content' => $content,
            'moment' => $date->getTimestamp()
        ]);
    }
    $query = $pdo->query("SELECT * FROM posts");
    if ($query === false)
    {
        die("Erreur SQL");
    }
    $donnees = $query->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
    $error = $e->getMessage();
}

require_once "header.php";
?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h1>Blog With SQLite</h1>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Entrez votre pseudo...">
            <label for="content">Votre Message</label>
            <input type="text" name="content" id="content" class="form-control" placeholder="Entrez votre message...">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Poster votre article</button>
        </div>
    </form>
</div>


<?php if (!isset($error)) : ?>
    <div class="container mt-5">
        <h2>Listes des Messages</h2>
        <?php foreach ($donnees as $donnee) : ?>
            <div class="card mt-3">
                <div class="card-body">
                    <h1 class="text-center"><?= $donnee['title']?></h1>
                    <p class="mt-4"><?=$donnee['content']?></p>
                    <div class="text-right mt-4">
                        <small><?= (new DateTime('@'. $donnee['created_at']))->format('d/m/Y à H:i') ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
