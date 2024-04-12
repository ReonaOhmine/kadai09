<?php
//1. POSTデータ取得
$name       = $_POST['name'];
$email      = $_POST['email'];
$birthday   = $_POST['birthday'];
$job        = $_POST['job'];
$experience = $_POST['experience'];

$str = $name . $email . $birthday . $job . $experience;

$file  = fopen("data.csv", "a");
fwrite($file, $str . "\n");
fclose($file);
?>


<?php
// 2. DB接続します
include("0_funcs.php");
$pdo = db_conn();


// ３．データ登録SQL作成
$sql = "INSERT INTO kadai08_an_table(id, name, email, birthday, job, experience, indate)VALUES(NULL, :name, :email, :birthday, :job, :experience, NOW());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',        $name,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email',       $email,      PDO::PARAM_STR);  
$stmt->bindValue(':birthday',    $birthday,   PDO::PARAM_STR);  
$stmt->bindValue(':job',         $job,        PDO::PARAM_STR);  
$stmt->bindValue(':experience',  $experience, PDO::PARAM_STR);  
$status = $stmt->execute();


// 自動返信メール(お客様へ)
mb_language("Japanese");
mb_internal_encoding("UTF-8");

$header = null;
$auto_reply_subject = null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');

// ヘッダー情報を設定
$header = "MIME-Version: 1.0\n";
$header .= "From: G'sテスト大嶺 <reonaomine@freddy.sakura.ne.jp>\n";
$header .= "Reply-To:G'sテスト大嶺 <reonaomine@freddy.sakura.ne.jp>\n"; 

// 件名を設定
$auto_reply_subject = '【Gsテスト】ご登録ありがとうございます。';

// 本文を設定
$auto_reply_text = "*注意*Gs課題のテストメールです" . "\n";
$auto_reply_text .= "$name" . "様" . "\n\n";
$auto_reply_text .= "登録完了しました。" . "\n";
$auto_reply_text .= "担当者から連絡します。" . "\n\n";
$auto_reply_text .= "hogehoge。";

// メール送信
mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);


// *****************************
// 自動返信メール(自分へ）
mb_language("Japanese");
mb_internal_encoding("UTF-8");

$header = null;
$auto_reply_subject = null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');

// ヘッダー情報を設定
$header = "MIME-Version: 1.0\n";
$header .= "From: G'sテスト大嶺 <reonaomine@freddy.sakura.ne.jp>\n";
$header .= "Reply-To:G'sテスト大嶺 <reonaomine@freddy.sakura.ne.jp>\n"; 

// 件名を設定
$auto_reply_subject = '【Gsテスト】'.$name.'様から登録がありました。';

// 本文を設定
$auto_reply_text  = "*注意*Gs課題のテストメールです" . "\n";
$auto_reply_text .= "ご担当者様" . "\n\n";
$auto_reply_text .= "$name'様から登録がありました。" . "\n";
$auto_reply_text .= "対応をお願いいたします。" . "\n\n";
$auto_reply_text .= "hogehoge。";

// メール送信
mb_send_mail('r.ohmine@freddy.co.jp', $auto_reply_subject, $auto_reply_text, $header);

//４．データ登録処理後
if ($status == false) {
     sql_error($stmt);
} else {
    redirect("4_finish.php");
}

?>

