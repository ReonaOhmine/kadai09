<?php
//1. POSTデータ取得
$id         = $_POST["id"];
$name       = $_POST["name"];
$email      = $_POST["email"];
$birthday   = $_POST["birthday"];
$job        = $_POST["job"];
$experience = $_POST["experience"];
$indate     = $_POST["indate"];

//2. DB接続します
//*** function化する！  *****************
include("0_funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "UPDATE kadai08_an_table SET name=:name,email=:email,birthday=:birthday,job=:job,experience=:experience,indate=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',          $id,         PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name',        $name,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email',       $email,      PDO::PARAM_STR);  
$stmt->bindValue(':birthday',    $birthday,   PDO::PARAM_STR);  
$stmt->bindValue(':job',         $job,        PDO::PARAM_STR);  
$stmt->bindValue(':experience',  $experience, PDO::PARAM_STR);  
$status = $stmt->execute(); //実行


//４．データ登録処理後
if ($status == false) {
     sql_error($stmt);
} else {
    redirect("5_select.php");
}
?>
