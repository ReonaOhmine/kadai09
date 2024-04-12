<?php
//1.  DB接続します
include("0_funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$searchWord = $_POST['input1'];
$sql        = "SELECT * FROM kadai08_an_table WHERE name LIKE :searchWord OR email LIKE :searchWord OR birthday LIKE :searchWord OR job LIKE :searchWord OR experience LIKE :searchWord OR indate LIKE :searchWord";
$stmt       = $pdo->prepare($sql);
$stmt->bindValue(':searchWord', '%'.$searchWord.'%', PDO::PARAM_STR);
$status     = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
}
//全データ取得
$values     =  $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                    <a class="navbar-brand" href="2_index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->


    <!-- 検索フォーム -->
<form action="6_result.php" method="POST">
   <!-- 任意の<input>要素＝入力欄などを用意する -->
   <input type="text" name="input1">
   <!-- 送信ボタンを用意する -->
   <input type="submit" name="submit" value="検索">
</form>
<a href="5_select.php">検索結果解除</a>



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
                        <td><a href="10_deletecheck.php">🗑</a></td>
                    </tr>
                <?php } ?>
            </table>


        </div>
    </div>
    <!-- Main[End] -->


    <script>
        //JSON受け取り
    </script>
</body>

</html>