<?php
// connection database
require_once 'conn.php';


$search = $_GET['search'] ?? '';
if ($search) {
    $state = $pdo->prepare('SELECT * FROM products WHERE title LIKE :search ORDER BY create_date DESC');
    $state->bindValue(':search', "%$search%");
} else {
    // select data from database
    $state = $pdo->prepare('SELECT * FROM products  ORDER BY create_date DESC');
}
$state->execute();


$products = $state->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($products);
// echo "</pre>";

// print_r($_SERVER);



?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Product CRUD</title>
</head>

<body>
    <h1>Product CRUD</h1>

    <a href="addProduct.php" class="btn btn-success"> Add Product</a>
    <form action="" method="get">
        <div class=" mt-4 input-group mb-3">
            <input type="text" class="form-control" placeholder="Search Products" name="search" aria-label="Recipient's username" value="<?php echo $search ?>" aria-describedby="button-addon2">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col"> Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($products as $key => $value) : ?>
                <tr>
                    <th scope="row"><?php echo $key + 1  ?></th>
                    <td><?php echo $value['title'] ?></td>
                    <td><?php echo $value['disc'] ?></td>
                    <td> <img src="<?php echo $value['image'] ?>" style="width: 60px;" alt=" <?php echo $value['title'] ?>"></img></td>
                    <td><?php echo '$' . $value['price'] ?></td>
                    <td><?php echo $value['create_date'] ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $value['id'] ?>" type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="delete.php?id=<?php echo $value['id'] ?>" type="button" class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>






    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>