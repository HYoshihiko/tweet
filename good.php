<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];
$good = $_GET['good'];

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


$sql = 'UPDATE tweets SET good = :good WHERE id = :id';

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':good', $good, PDO::PARAM_INT);
$stmt->execute();


header('Location: index.php');
exit;

?>
