<?php
require_once '../../database.php';
require_once '../../functions.php';
// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';

$flage = 0;
$error = [];
$title = '';
$desc = '';
$price = '';
$products = [
    'image' => ''
];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../../validate_product.php';

    if (empty($error)) {


        $statement = $pdo->prepare('INSERT INTO products (title,disc,image,price,create_date) VALUES (:title,:disc,:image,:price,:create_date)');
        $statement->bindValue(':title', $title);
        $statement->bindValue(':disc', $desc);
        $statement->bindValue(':image', $imgPath);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':create_date', date('Y-m-d H:i:s'));
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
    <h1>Add new Product</h1>
    <a class="btn btn-secondary" href="index.php">Back Product</a>


    <?php include_once '../../views/product/form.php'; ?>

    <?php include_once '../../views/partials/footer.php'; ?>