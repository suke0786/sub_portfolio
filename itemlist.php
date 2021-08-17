<?php
require_once './conf/const.php';
require_once './model/itemlist.php';
require_once './model/user_info.php';

session_start();

//変数定義
$dbh = get_db_connect();
$err_msg = [];
$user_name = '';
$select_item_id = '';
$keyword = 0;
$min_cal = 0;
$max_cal = 0;
$min_pro = 0;
$max_pro = 0;
$min_fat = 0;
$max_fat = 0;
$min_carbo = 0;
$max_carbo = 0;

$item_rows = get_item_rows($dbh);

$max_page = sum_item_page($dbh);

$page = get_current_page();

$start = $max * ($page - 1); //スタートするページを取得

$item_page_rows = get_page_item_rows($dbh,$page);

//ユーザーチェック
if (is_check_user() === TRUE){
    $user_rows = get_username($dbh,$_SESSION['user_id']);
    $user_name = $user_rows['user_name'];
}

//ログアウトボタンの処理
if (isset($_POST['logout'])) {
    session_destroy();
}

//商品のお気に入りへの追加
if (isset($_POST['add_fav'])) {
    add_fav($dbh,$_SESSION['user_id']);
}

//商品の絞り込み検索
if (isset($_POST['search'])) {
    $item_page_rows = refined_search($dbh);
}

//商品のキーワード検索
if (isset($_POST['word_search'])) {
    $keyword = $_POST['keyword'];
    $item_page_rows = word_item_rows($dbh,$keyword);
}


require_once './view/itemlist_view.php';

