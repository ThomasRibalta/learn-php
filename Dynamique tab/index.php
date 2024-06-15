<?php
use App\URLManager;
use App\Order;
require "vendor/autoload.php";
$title = "Dynamique tab";

$pdo = new \PDO('sqlite:./data/products.db');
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$query = "SELECT * FROM products";
$queryCount = "SELECT COUNT(*) FROM products";
$nbProducts = 0;
$params = [];
$elements_sort = ['id', 'name', 'price', 'city', 'address'];

if (!empty($_GET['search']))
{
    $search = $_GET['search'];
    $query .= " WHERE city LIKE :city";
    $queryCount .= " WHERE city LIKE :city";
    $params['city'] = '%' . $search . '%';
}

if (!empty($_GET['order']) && in_array($_GET['by'], $elements_sort))
{
    $dir = $_GET['order'] ?? 'asc';
    if (!in_array($dir, ['asc', 'desc']))
        $dir = 'asc';
    $query .= " ORDER BY " . $_GET['by'] . " " . $dir;
}

$pageN = (int)($_GET['page'] ?? 0);
$offset = ($pageN - 1) * 20;
$query .= " LIMIT 20 OFFSET $offset";

$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll(\PDO::FETCH_ASSOC);

$statement = $pdo->prepare($queryCount);
$statement->execute($params);
$nbProducts = $statement->fetchColumn();
$nbProducts = ceil($nbProducts / 20);

require "header.php";
?>

<h1 class="text-center mt-5"><?= $title ?></h1>

<div class="col-auto">
    <form action="">
      <div class="form-group">
        <input type="text" class="form-control" id="search" name="search" placeholder=<?= htmlentities($_GET['search'] ?? "Search (Ex:Paris)")?>>
      </div>  
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <?php $order = Order::reverse_order(isset($_GET['order']) ? $_GET['order'] : 'asc')?>
                <?php foreach ($elements_sort as $element) : ?>
                    <th><a href="<?=URLManager::makeURL($_GET, ["order" => $order, "by" => $element])?>"><?= ucfirst($element) ?></a></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product) : ?>
              <tr>
                  <td><?= $product['id'] ?></td>
                  <td><?= $product['name'] ?></td>
                  <td><?= number_format($product['price'], 0, '.', ' ') . '$' ?></td>
                  <td><?= $product['city'] ?></td>
                  <td><?= $product['address'] ?></td>
              </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $nbProducts; $i++) : ?>
                <li class="page-item"><a class="page-link" href="<?= URLManager::makeURL($_GET, ["page" => $i])?>"><?= $i ?></a></li>
            <?php endfor; ?>
        </ul>
</div>

<?php require "footer.php"; ?>

