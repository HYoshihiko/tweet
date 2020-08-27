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

if ($tweet['good']) {
    $sql_true = 'UPDATE tweets SET good = FALSE WHERE id = :id';
    $stmt_true = $dbh->prepare($sql_true);
    $stmt_true->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_true->execute();
} else {
    $sql_false = 'UPDATE tweets SET good = TRUE WHERE id = :id';
    $stmt_false = $dbh->prepare($sql_false);
    $stmt_false->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_false->execute();
}

header('Location: index.php');
exit;
