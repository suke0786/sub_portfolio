<?php
require_once './conf/const.php';
require_once "./model/user_info.php";
session_start();

//変数定義
$dbh = get_db_connect();
$birthday = '';
$user_age = '';
$level = '';
$mail = '';
$err_msg = array(); // エラーメッセージ

//ユーザーチェック
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header ("Location ./login.php");
}

//ユーザー情報更新
if (isset($_POST['form'])) {
    $birthday = $_POST['birthday'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $level = $_POST['level'];
    
    if ($height<120 || $height>250) {
        $err_msg[] = '身長を正しく入力してください';
    }
    if ($weight<30 || $weight>300) {
        $err_msg[] = '体重を正しく入力してください';
    }
    if ($level<1 || $level>3) {
        $err_msg[] = '運動レベルを正しく入力してください';
    }
    if ($birthday === '') {
        $err_msg[] = "誕生日を正しく入力してください";
    }
    
    if (count($err_msg) === 0) {
        update_user_info($dbh,$height,$weight,$level,$birthday,$user_id);
    }
}

$user_info_rows = get_user_info($dbh,$user_id);

//ユーザー情報の計算
$user_age = user_age($dbh,$birthday,$user_info_rows,$user_age);
$level = level_conv($user_info_rows,$level);
$base_calorie_date = ((10 * $user_info_rows[0]['weight']) + (6.25 * $user_info_rows[0]['height']) - (5 * $user_age + 5));
$calorie_date = $base_calorie_date * $level;

require_once "./view/mypage_view.php";

?>
