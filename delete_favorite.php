<?php
require_once "funcs.php";

session_start();
$bookId = $_POST["bookId"];
$userId = $_SESSION["userId"];

$pdo = db_connect();

// そのユーザーがその本をお気に入りしているかどうかを判定。
// お気に入りがすでにあればなにもしない
$sql = "DELETE FROM fav_book WHERE user_id=:userId and book_id=:bookId";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
$stmt->bindValue(':bookId', $bookId, PDO::PARAM_STR);
$status = $stmt->execute();

header("Location: favorite.php");