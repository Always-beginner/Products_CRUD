<?php
require_once '../../database.php';
require_once '../../functions.php';
$id = $_GET['id'];

if (!$id) {
    header('Location: index.php');
}


$state = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$state->bindValue(':id', $id);
$state->execute();
$products = $state->fetch(PDO::FETCH_ASSOC);

$title = $products['title'];
$desc = $products['disc'];
$img = $products['image'];
$price = $products['price'];
$flage = 0;
// echo "<pre>";
// print_r($products);
// echo "</pre>";

// print_r($_SERVER);
$error = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../../validate_product.php';

    if (empty($error)) {
        $statement = $pdo->prepare('UPDATE  products SET
                                                        title = :title,
                                                        disc = :disc,
                                                        image = :image,
                                                        price = :price
                                                        WHERE id = :id');

        $statement->bindValue(':id', $id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':disc', $desc);
        $statement->bindValue(':image', $imgPath);
        $statement->bindValue(':price', $price);
        $statement->execute();
        header('location', 'index.php');
        if (!empty($statement)) {
            $flage = 1;
            header('Location: index.php');
        }
    }
} else {
}



?>

<?php include_once '../../views/partials/header.php'; ?>


<body style="padding: 50px;">
    <a class="btn btn-secondary" href="index.php">Back Product</a>
    <h1>Edit Product: <b><?php echo $title ?></b></h1>

    <?php include_once '../../views/product/form.php'; ?>

    <?php include_once '../../views/partials/footer.php'; ?>