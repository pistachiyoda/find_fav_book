<?php
// 共通で使う関数を記述
function db_connect(){
    try {
        $pdo = new PDO('mysql:dbname=fav_book_app;charset=utf8;host=localhost','root','');
        return $pdo;
    } catch (PDOException $e) {
        exit('DB-Connection-Error:'.$e->getMessage());
    }      
}

session_start();
$isLoggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
?>