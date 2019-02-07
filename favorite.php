<?php
require_once "funcs.php";

if (!$_SESSION['loggedIn']) {
    echo ' 
    <script type="text/javascript">
        alert("ログインしてください。");
        location.href = "login_signup.php";
    </script>
    ';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Favorite</title>
</head>
<body>
    <div class="allWrapper">
        <div class="sideWrapper">
            <?php include('sidebar.php') ?>
        </div>
        <header class="headerWrapper">
            <h1>Book Marker</h1>
            <div class="favWrapper">
                <h2>Favorite Book List</h2>
            </div>
        </header>
        <div class="favBookWrapper">
<?php
$userId = $_SESSION['userId'];
$sql = "SELECT book_id FROM fav_book WHERE user_id=:userId";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
$status = $stmt->execute();
$favoriteData = $stmt->fetchAll();

foreach($favoriteData as $favorite) {
    $bookId = $favorite["book_id"];
    $requestUrl = "https://www.googleapis.com/books/v1/volumes/{$bookId}?key=AIzaSyCYByZrKmrrwMC28TpSF7wEUFktSvm0unE";
    $booksData = file_get_contents($requestUrl);
    $encodedBooksData = json_decode($booksData);
    $bookImg = $encodedBooksData->volumeInfo->imageLinks->thumbnail;
    $bookTitle = $encodedBooksData->volumeInfo->title;
    $bookPreview = $encodedBooksData->volumeInfo->previewLink;
    $bookId = $encodedBooksData->id;
    $bookHtml = <<< EOM
<div>
    <div class="book">
        <div class="DelBtn">
            <form method="post" action="delete_favorite.php">
                <input type="hidden" name="bookId" value="{$bookId}">
                <button type="submit"><i class="fas fa-times-circle DelBtnDetail fa-2x"></i></button>
            </form>
        </div>

        <a href="{$bookPreview}" class="bookImgTitle">
            <img src="{$bookImg}">
            <h1 class="bookTitle">{$bookTitle}</h1>
        </a>
    </div>
</div>
EOM;
    echo $bookHtml;
}


?>
        </div>
    </div>
</body>
</html>