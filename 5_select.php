<?php
// 1.  DB接続します
include("0_funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM kadai08_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理画面</title>
    <link rel="stylesheet" href="./css_folder/select.css">
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="2_index.php" >データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->


    <!-- 検索フォーム -->
    <form action="6_result.php" method="POST" class="search-form">
    <!-- 任意の<input>要素＝入力欄などを用意する -->
    <input type="text" name="input1" class="search-input">
    <!-- 送信ボタンを用意する -->
    <input type="submit" name="submit" value="検索" class="search-button">
</form>


    <!-- Main[Start] -->
    <div>

        <div class="container jumbotron">
            <table>
                <tr>
                    <th>会員番号</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>生年月日</th>
                    <th>年齢（計算）</th>
                    <th>職種</th>
                    <th>2年以上の経験者</th>
                    <th>登録日</th>
                    <th>修正</th>
                    <th>削除</th>

                </tr>
                <?php foreach ($values as $v) { ?>
                    <tr>
                        <td><?= h($v["id"]) ?></td>
                        <td><?= h($v["name"]) ?></td>
                        <td><?= h($v["email"]) ?></td>
                        <td><?= h($v["birthday"]) ?></td>
                        <td><?= $age2 = calculateAge(h($v['birthday'])); ?></td>
                        <td><?= h($v["job"]) ?></td>
                        <td><?= h($v["experience"]) ?></td>
                        <td><?= h($v["indate"]) ?></td>
                        <td><a href="7_detail.php?id=<?= h($v["id"]) ?>">🖊</a></td>
                        <td><a href="10_deletecheck.php?id=<?=h($v["id"])?>">🗑</a></td>
                    </tr>
                <?php } ?>
            </table>


        </div>
    </div>
    <!-- Main[End] -->
</body>

</html>