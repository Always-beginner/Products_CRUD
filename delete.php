<?php
require_once 'conn.php';

$id = $_GET['id'];

if (!$id) {
    header('Location : index.php');
} else {
    $state = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $state->bindValue(':id', $id);
    $state->execute();

    header('Location: index.php');
}
