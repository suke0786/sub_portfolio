<?php
require_once './conf/const.php';
require_once './model/user_info.php';

//変数の初期化
$user_name = '';
$password = '';
$err_msg = [];
$success_msg = '';
$db_user_name = [];

//DBへ接続
$dbh = get_db_connect();
$usr_rows = get_db($dbh);


//DBのユーザー名の取得
for ($i=0; $i<count($usr_rows); $i++) {
    array_push($db_user_name, $usr_rows[$i]['user_name']);
}

//ユーザー登録処理
if(isset($_POST['submit'])){
    //入力されたユーザー名、パスワードを変換する
    $user_name = conv($_POST['user_name']);
    $password = conv_password();
    //エラー確認スタート------------------------------------------
    //ユーザー名が既にDBにないかチェック
    foreach($db_user_name as $name) {
        if ($name === $user_name) {
            $err_msg[] = 'そのユーザー名は使用されています';
        }
    }
    if ($user_name === '') {
        $err_msg[] = 'ユーザー名を入力してください';
    }
    if ($password === '') {
        $err_msg[] = 'パスワードを入力してください';
    }
    if (mb_strlen($user_name) < 6) {
        $err_msg[] = 'ユーザー名は6文字以上で入力してください';
    }
    if (mb_strlen($password) < 6) {
        $err_msg[] = 'パスワードは6文字以上で入力してください';
    }
    if (preg_match("/^[a-zA-Z0-9]+$/", $user_name) !== 1) {
        $err_msg[] = 'ユーザー名は半角英数字で入力してください';
    }
    if (preg_match("/^[a-zA-Z0-9]+$/", $password) !== 1) {
        $err_msg[] = 'パスワードは半角英数字で入力してください';
    }
    //エラー確認終了-----------------------------------------------
    if (count($err_msg) === 0) {
        register($dbh,$user_name,$password);
        $success_msg = 'ユーザー登録が完了しました';
        header('Location: /login.php');
    }
}
require_once './view/register_view.php';
?>