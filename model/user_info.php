<?php

//DB処理---------------------------------------------------------

function get_db_connect(){
  // MySQL用のDSN文字列
  $dsn = 'mysql:dbname='. DB_NAME .';host='. DB_HOST .';charset='.DB_CHARSET;
 
  try {
    // データベースに接続
    $dbh = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    exit('接続できませんでした。理由：'.$e->getMessage() );
  }
  return $dbh;
}

function get_db($dbh){
    try {
    $sql = 'select * from ec_user';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();
    return $rows;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

function get_user_info($dbh,$user_id) {
  try {
  $sql = 'SELECT * FROM ec_user WHERE user_id = ?';
  $stmt = $dbh->prepare($sql);
  $stmt->execute([$user_id]);
  $user_info = $stmt->fetchAll();
  return $user_info;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

function register($dbh,$user_name,$password) {
    try {
      $sql = 'INSERT INTO ec_user(user_name,password,create_datetime) VALUES(?,?,?)';
      
      $stmt = $dbh->prepare($sql);
      
      $stmt->execute([$user_name,$password,date("Y/m/d H:i:s")]);
    }  catch (PDOException $e) {
      throw $e;
    }
}

function collation_login($dbh,$user_name,$password){
  try {
    $sql = 'SELECT * from ec_user where user_name=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_name,$password]);
    $result = $stmt->fetch();
    return $result;
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function get_username($dbh,$user_id) {
  try {
    $sql = 'SELECT * FROM ec_user WHERE user_id=?';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_id]);
    $user_rows = $stmt->fetch();
    return $user_rows;
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function update_user_info($dbh,$height,$weight,$level,$birthday,$user_id){
    try {
      $sql = 'UPDATE ec_user SET height = ?, weight = ?, level = ?, birthday = ? WHERE user_id = ?';
      $stmt = $dbh -> prepare($sql);
      $stmt->bindValue(1, $height, PDO::PARAM_STR);
      $stmt->bindValue(2, $weight, PDO::PARAM_STR);
      $stmt->bindValue(3, $level, PDO::PARAM_STR);
      $stmt->bindValue(4, $birthday, PDO::PARAM_STR);
      $stmt->bindValue(5, $user_id, PDO::PARAM_STR);
      $stmt -> execute();
    } catch (PDOException $e) {
      echo $e -> getMessage();
    }
}

//非DB処理---------------------------------------------------------

//誕生日から年齢を求める処理
function user_age($dbh,$birthday,$user_info_rows,$user_age) {
  if ($user_info_rows[0]['birthday'] !== null) {
  $now = date("Ymd");
  $birthday = str_replace("-", "", $user_info_rows[0]['birthday']);//ハイフンを除去しています。
  $user_age = (int)(($now-$birthday)/10000);
  return $user_age;
  }
}

//空白を取り除く処理
function mbTrim($pString){
    return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u', '', $pString);
}

//運動レベルの定義
function level_conv ($user_info_rows) {
  if ($user_info_rows[0]['level'] === 1 ) {
    $level = 1.2;
  }
  if ($user_info_rows[0]['level'] === 2 ) {
    $level = 1.55;
  }
  if ($user_info_rows[0]['level'] === 3 ) {
    $level = 1.75;
  }
  return (float)$level;
}

//userチェック
function is_check_user(){
  if (isset($_SESSION['user_id']) !== TRUE) {
    session_destroy();
    header('Location: ./login.php');
  } else {
    return TRUE;
  }
}

//クロスサイトスクリプティング対策
function conv($user_name) {
    if (isset($user_name) === TRUE) {
      $user_name = htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8');
    }
    return $user_name;
}

//クロスサイトスクリプティング対策
function conv_password() {
    if (isset($_POST['password']) === TRUE) {
      $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    }
    return $password;
}

?>