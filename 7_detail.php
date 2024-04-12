<?php
$id = $_GET["id"];

include("0_funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM kadai08_an_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if ($status == false) {
    sql_error($stmt);
}

//全データ取得
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
?>

<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報修正</title>
    <link rel="stylesheet" href="./css_folder/style.css">
</head>

<header>
    <?php
    include('html_folder/indexhead.html');
    ?>

</header>

<body>
    <section class="entry2">
        <div>
            <div class="entry_title">
                <div class="membership">
                    <p>データ修正</p>
                </div>
            </div>

            <form class="form" action="8_update.php" method="post" name="form">
                <label class="label_contents" for="name">
                    <div class="label_title">
                        <p>お名前</p>
                        <p id="red">*</p>
                    </div>
                    <input type="text" id="name" name="name" value="<?= $v["name"] ?>" placeholder="名字　名前" required size="30" />
                </label>
                <label for="email">
                    <div class="label_title">
                        <p>メールアドレス</p>
                        <p id="red">*</p>
                    </div>
                    <input type="email" id="email" size="30" name="email" value="<?= $v["email"] ?>" placeholder="example@gmail.com" required />
                </label>
                <label for="birthday">
                    <div class="label_title">
                        <p>生年月日</p>
                        <p id="red">*</p>
                    </div>
                    <input type="date" id="birthday" name="birthday" value="<?= $v["birthday"] ?>" required />
                </label>
                <label for="job">
                    <div class="label_title">
                        <p>職種</p>
                        <p id="red">*</p>
                    </div>

                    <select name="job" id="job-select">
                        <option value="">--該当職種をお選びください--</option>
                        <option value="エンジニア" <?= ($v["job"] === "エンジニア") ? "selected" : "" ?>>エンジニア</option>
                        <option value="デザイナー" <?= ($v["job"] === "デザイナー") ? "selected" : "" ?>>デザイナー</option>
                        <option value="マーケター" <?= ($v["job"] === "マーケター") ? "selected" : "" ?>>マーケター</option>
                        <option value="その他" <?= ($v["job"] === "その他") ? "selected" : "" ?>>その他</option>
                    </select>
                </label>



                <div class="label_title">
                    <p>実務経験は2年以上ありますか？</p>
                    <p id="red">*</p>
                </div>
                <div>
                    <input type="radio" id="experience" name="experience" value="はい" <?= ($v["experience"] === "はい") ? "checked" : "" ?> />
                    <label for="はい">はい</label>
                </div>
                <div>
                    <input type="radio" id="no-experience" name="experience" value="いいえ" <?= ($v["experience"] === "いいえ") ? "checked" : "" ?> />
                    <label for="いいえ">いいえ</label>
                </div>


                <input type="hidden" name="id" value="<?= $v["id"] ?>">
                <button>修正</button>
            </form>
        </div>
    </section>
</body>


<footer>
    <?php
    include('html_folder/indexfoot.html');

    ?>
</footer>

</html>