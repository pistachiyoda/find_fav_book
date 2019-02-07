<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Book Marker</title>
</head>
<body>
    <h1>Welcome to Book Marker</h1>
    <h2>登録済みの方</h2>
    <form action="login_process.php" method="post">
        <label>ユーザー名<input type="text" name="userName"></label>
        <label>パスワード<input type="text" name="pass"></label>
        <button type="submit">ログイン</button>
    </form>
    <h2>新規登録</h2>
    <form action="signup_process.php" method="post">
        <label>ユーザー名<input type="text" name="signUpUserName"></label>
        <label>パスワード<input type="text" name="signUpPass"></label>
        <button type="submit">サインアップ</button>
    </form>
</body>
</html>