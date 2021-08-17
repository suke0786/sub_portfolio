<?php
require_once './conf/const.php';
require_once './model/itemlist.php';
require_once './model/user_info.php';
session_start();

//変数定義
$dbh = get_db_connect();
$err_msg = [];
$user_name = '';
$sum_price = 0;
$user_fav_rows = array();
$sum_calorie = 0;
$sum_calorie = 0;
$sum_protein = 0;
$sum_fat = 0;
$sum_carbohydrate = 0;

//ユーザーチェック
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_rows = get_username($dbh,$user_id);
    $user_name = $user_rows['user_name'];
}else {
    header('Location: /login.php');
}

//ログアウトボタンの処理
if (isset($_POST['logout'])) {
    session_destroy();
}

//お気に入り内の商品削除
if (isset($_POST['delete'])) {
    $item_id = (int)$_POST['item_id'];
    $user_id = $_SESSION['user_id'];
    delete_fav_item($dbh,$item_id,$user_id);
}

$user_fav_rows = user_fav_rows($dbh,$user_id);

//お気に入り内の商品のカロリー計算処理
foreach ($user_fav_rows as $rows ){
    //お気に入り内の商品のカロリーを変数へ
    $calorie = $rows['cal'];
    $protein = $rows['prot'];
    $fat = $rows['fat'];
    $carbohydrate = $rows['carbo'];
    
    //お気に入り内の商品のカロリーの計算
    $sum_calorie = $amount * $calorie + $sum_calorie;
    $sum_protein = $amount * $protein + $sum_protein;
    $sum_fat = $amount * $fat + $sum_fat;
    $sum_carbohydrate = $amount * $carbohydrate + $sum_carbohydrate;
}

require_once './view/fav_view.php'

?>