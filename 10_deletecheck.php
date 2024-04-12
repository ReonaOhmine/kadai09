<?php
//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
include("0_funcs.php");
$pdo = db_conn();
?>

<!DOCTYPE html>
<html lang="ja" class="html-delete">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除チェック</title>
    <link rel="stylesheet" href="./css_folder/select.css">
</head>
<body>
    <form action="9_delete.php" method="get" class="delete-form">
        <input type="hidden" name="id" value="<?= $id ?>">
        <p>本当に削除しますか？</p>
        <input type="submit" value="はい" class="delete-yes-button">
    </form>
    <form action="5_select.php" class="delete-no-form">
        <input type="submit" value="いいえ" class="delete-no-button">
    </form>
</body>
</html>


