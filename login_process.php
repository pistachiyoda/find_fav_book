<?php
// ログイン時の処理

require_once "funcs.php";

$userName = $_POST["userName"];
$pass = $_POST["pass"];

$pdo = db_connect();

$selectSql = "SELECT * FROM user_info WHERE name=:userName";
$stmt = $pdo->prepare($selectSql);
$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
$status = $stmt->execute();
$user = $stmt->fetch();
$userId = $user["id"];
$authority = $user["authority"];
$password_digest = $user["password_digest"];

// 学び：【ガード説】処理の対象外とする条件を関数やループの先頭に集め、早めにreturnやcontinu/breakで抜ける
if ( !password_verify($pass, $password_digest) ) {
    echo '
    <script type="text/javascript">
        alert("ユーザー名かパスワードが間違っています。");
        location.href = "login_signup.php";
    </script>
    ';
    return;
}

// 学び：session_start()は、session存在しない場合はセッションを開始して、存在しない場合は復元する。
// セッション固定攻撃対策のためsession_regenerate_id(true)を記述;
session_start();
session_regenerate_id(true);
$_SESSION['loggedIn'] = true;
$_SESSION['userId'] = $userId;
// 学び： こういう書き方もできる
$_SESSION['admin'] = $authority == "admin";

header("Location: index.php");
