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
    $sql = 'UPDATE tweets SET good = FALSE WHERE id = :id';
    
} else {
    $sql = 'UPDATE tweets SET good = TRUE WHERE id = :id';
}

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: index.php');
exit;
