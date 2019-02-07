<?php
require_once "funcs.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Book Marker</title>
</head>
<body>
    <div class="allWrapper">
        <div class="sideWrapper">
            <?php include('sidebar.php') ?>
        </div>
        <header class="headerWrapper">
            <h1>Book Marker</h1>
            <div class="searchFormWrapper">
                <h2>Let's Search Book!</h2>
                <form class="searchFrom" method="post" action="index.php">
                    <input type="text" name="searchWord">
                    <button type="submit">しらべる</button>
                </form>
            </div>
        </header>
        <div class="searchedBookWrapper">
<?php
if ( isset($_POST["searchWord"])) {
    $searchWord = $_POST["searchWord"];
    $requestUrl = "https://www.googleapis.com/books/v1/volumes?q={$searchWord}&key=AIzaSyCYByZrKmrrwMC28TpSF7wEUFktSvm0unE";
    $booksData = file_get_contents($requestUrl);
    $encodedBooksData = json_decode($booksData);
} else {
    echo "気になる本を探しましょう！";
    return;
}

foreach($encodedBooksData->items as $item) {
    $bookImg = $item->volumeInfo->imageLinks->thumbnail;
    $bookTitle = $item->volumeInfo->title;
    $bookPreview = $item->volumeInfo->previewLink;
    $bookId = $item->id;
    $bookHtml = <<< EOM
<div>
    <div class="searchedBooks">
        <div class="favBtn">
            <form method="post" action="add_favorite.php">
                <input type="hidden" name="bookId" value="{$bookId}">
                <button type="submit"><i class="fab fa-gratipay favBtnDetail fa-2x"></i></button>
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