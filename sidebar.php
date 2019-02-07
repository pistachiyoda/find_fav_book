<?php
require_once "funcs.php";
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $pdo = db_connect();
    $sql = "SELECT name FROM user_info WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
    $status = $stmt->execute();
    $user = $stmt->fetch();
    $userName = $user["name"];
}

if ($isLoggedIn) {
    $loggedIn = <<< EOM
<div class="sideContentWrapper">    
    <span>ユーザー名：{$userName}</span>
    <form method="post" action="logout.php">
        <a href="index.php" class="menu">本を探す</a>
        <a href="favorite.php" class="menu">お気に入り</a>
        <button type="submit" class="logout">ログアウト</button>
    </form>
</div>
EOM;
    echo $loggedIn;
} else {
    $loggedOut = <<< EOM
<div class="sideContentWrapper">  
<p>ログインしてください</p>
<form method="post" action="login_signup.php">
    <button type="submit" class="login">ログイン</button>
</form>
</div>
EOM;
    echo $loggedOut;
}
?>