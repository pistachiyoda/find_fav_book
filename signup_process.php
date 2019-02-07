<?php
// 新規登録時の処理

require_once "funcs.php";

// 新規登録処理
$signUpUserName = $_POST["signUpUserName"];
$authority = "general";
$signUpPass = password_hash($_POST["signUpPass"], PASSWORD_DEFAULT);

$pdo = db_connect();

//// 同じユーザー名がないか確認
$checkSql = "SELECT * FROM user_info WHERE name=:userName";
$stmt = $pdo->prepare($checkSql);
$stmt->bindValue(':userName', $signUpUserName, PDO::PARAM_STR);
$status = $stmt->execute();
if (!$status) {
    // 学び：header("Location: login_signup.php")とするとhtmlが描画される前にリダイレクトされてしまうので、
    // スクリプトで描画する。
    echo '
    <script type="text/javascript">
        alert("そのユーザー名はすでに使用されています。他のユーザー名で登録してください。");
        location.href = "login_signup.php";
    </script>
    ';
    return;
}

$insertSql = "INSERT INTO user_info (
        name, authority, password_digest
    )
    VALUES
    (
        :signUpUserName,
        :authority,
        :signUpPass
    )";
$stmt = $pdo->prepare($insertSql);
$stmt->bindValue(":signUpUserName", $signUpUserName, PDO::PARAM_STR);
$stmt->bindValue(":authority", $authority, PDO::PARAM_STR);
$stmt->bindValue(":signUpPass", $signUpPass, PDO::PARAM_STR);
$status = $stmt->execute();

// サインアップに続けてログイン処理
$selectSql = "SELECT * FROM user_info WHERE user_name=:userName";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userName', $signUpUserName, PDO::PARAM_STR);
$status = $stmt->execute();
$user = $stmt->fetch();
$id = $user["id"];

session_start();
$_SESSION['loggedIn'] = true;
$_SESSION['user'] = $id;
$_SESSION['admin'] = false;

header("Location: index.php");