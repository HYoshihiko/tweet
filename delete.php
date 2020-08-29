<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();
$sql = 'SELECT * FROM tweets WHERE id = :id';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$tweet = $stmt->fetch();

if (!$tweet) {
    header('Location: index.php');
    exit;
}

$sql_delete = 'DELETE FROM tweets WHERE id = :id';
$stmt_delete = $dbh->prepare($sql_delete);
$stmt_delete->bindParam(':id', $id, PDO::PARAM_INT);
$stmt_delete->execute();

header('Location: index.php');
exit;
