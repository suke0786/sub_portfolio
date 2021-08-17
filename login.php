<?php
require_once './conf/const.php';
require_once './model/user_info.php';

session_start();

$dbh = get_db_connect();
$err_msg = [];

//ログイン処理
if (isset($_POST['login'])) {
    $user_name = conv($_POST['user_name']);
    $password = conv_password();
    $result = collation_login($dbh,$user_name,$password);
    
    if ($user_name !== '' || $password !== '' && count($result) > 1) {
        setcookie('user_name', $user_name, time() + 60 * 60 * 24 * 365);
        $userid = $result['user_id'];
        if (isset($userid)){
            $_SESSION['user_id'] = $userid;
                header('Location: /itemlist.php');
        }
    } else {
        $err_msg[] = 'ユーザー名またはパスワードが誤りです';
    }
}

require_once './view/login_view.php'
?>