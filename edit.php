<?php
require_once 'conn.php';

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

    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $img = $_FILES['image'];
    $price = $_POST['price'];


    if (!$title) {
        $error[] = 'Product title is required ';
    }
    if (!$desc) {
        $error[] = 'Product Description is required ';
    }
    if (!$price) {
        $error[] = 'Product Price is required ';
    }

    if (!is_dir('images')) {
        mkdir('images');
    }

    function randStr($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {

            $index = rand(0, strlen($characters) - 1);

            $str .= $characters[$index];
        }
        return $str;
    }

    if ($img && $img['tmp_name']) {
        $imgPath = 'images/' . randStr(8) . '/' . $img['name'];
        mkdir(dirname($imgPath));
        move_uploaded_file($img['tmp_name'], $imgPath);
    } else {
        $imgPath =  $products['image'];
        // echo $products['image'];
    }
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


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Editing Product: <?php echo $title ?></title>
</head>

<body style="padding: 50px;">
    <a class="btn btn-secondary" href="index.php">Back Product</a>
    <h1>Edit Product: <b><?php echo $title ?></b></h1>



    <?php if ($flage === 1) : ?>
        <div class='mt-3 alert alert-success alert-dismissible fade show' role='alert'>
            <strong> You're Product is Edited Successfully </strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    <?php endif ?>



    <?php if (!empty($error)) : ?>
        <?php foreach ($error as $er) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $er ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php endforeach;
    endif; ?>

    <!-- form start here -->

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="title" value="<?php echo $title ?>" placeholder="Title" class="mt-3 form-control">
        </div>
        <div class="form-group">
            <input type="text" value="<?php echo $desc ?>" class="form-control mt-3" name="desc" placeholder="Description"></input>
        </div>
        <?php if ($products['image']) : ?>
            <img src="<?php echo $products['image'] ?>" style="width: 60px;" alt="<?php echo $products['title'] ?>">
        <?php endif; ?>
        <div class="mt-3 form-group">
            <label>Product Image</label>
            <input type="file" class=" form-control" value="<?php echo $products['title'] ?>" name="image"></input>
        </div>
        <div class="form-group">
            <input type="number" class="form-control mt-3" step=".01" placeholder="Price" value="<?php echo $price ?>" name="price"></input>
        </div>
        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>

    <!-- form end here -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>