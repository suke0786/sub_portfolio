<?php

//DB処理-----------------------------------------------------------

function up_new_item($dbh,$item_name,$price,$new_img_filename,$status,$amount,$calorie,$protein,$fat,$carbo,$comment) {
  try {
    $sql = 'INSERT INTO macro_data(item_name,price,img,status,stock,calorie,protein,fat,carbohydrate,comment) VALUES(?,?,?,?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$item_name,$price,$new_img_filename,$status,$amount,$calorie,$protein,$fat,$carbo,$comment]);
  }catch (PDOException $e){
    echo $e -> getMessage();
    exit;
  }
}

function get_item_rows($dbh) {
    try{
        $sql = 'SELECT * FROM macro_data';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $get_item_rows = $stmt->fetchAll();
        return $get_item_rows;
    }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function get_fav_rows($dbh,$user_id) {
    try{
        $sql = 'SELECT * FROM ec_fav WHERE user_id = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$user_id]);
        $get_fav_rows = $stmt->fetchAll();
        return $get_fav_rows;
    }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function add_fav_item($dbh,$user_id) {
  try{
    $sql = 'INSERT INTO ec_fav(user_id,item_id,create_datetime) VALUES (?,?,?)';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_id,$_POST['item_id'],date("Y/m/d H:i:s")]);
  } catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function delete_fav($dbh,$user_id) {
  try{
    $sql = 'DELETE FROM ec_fav WHERE user_id = ?;';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$user_id]);
  } catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function delete_fav_item($dbh,$item_id,$user_id) {
  try{
    $sql = 'DELETE FROM ec_fav WHERE item_id = ? AND user_id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$item_id,$user_id]);
  } catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function delete_item($dbh,$item_id) {
  try{
    $sql = 'DELETE FROM macro_data WHERE item_id = ?;';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$item_id]);
  } catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function stock_cut($dbh,$item_id,$amount,$stock) {
  try {
    $sql = 'UPDATE macro_data SET stock = ? WHERE item_id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$stock - $amount, PDO::PARAM_STR);
    $stmt->bindValue(2,$item_id, PDO::PARAM_STR);
    $stmt->execute();
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}


function add_item($dbh,$amount,$item_id) {
  try {
    $sql = "UPDATE ec_fav SET amount = ? WHERE item_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $amount, PDO::PARAM_STR);
    $stmt-> bindValue(2, $item_id, PDO::PARAM_STR);
    $stmt->execute();
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function user_fav_rows($dbh,$user_id) {
  try{
    $sql = "SELECT * FROM ec_fav INNER JOIN macro_data ON ec_fav.item_id = macro_data.id WHERE user_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt-> bindValue(1, $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $user_fav_rows = $stmt->fetchAll();
    return $user_fav_rows;
  } catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function mod_status($dbh,$status,$item_id) {
    try {
    $sql = "UPDATE macro_data SET status = ? WHERE item_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $status, PDO::PARAM_STR);
    $stmt-> bindValue(2, $item_id, PDO::PARAM_STR);
    $stmt->execute();
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function mod_stock($dbh,$stock,$item_id) {
    try {
    $sql = "UPDATE macro_data SET stock = ? WHERE item_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $stock, PDO::PARAM_STR);
    $stmt-> bindValue(2, $item_id, PDO::PARAM_STR);
    $stmt->execute();
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function search_item_rows($dbh,$min_cal,$max_cal,$min_pro,$max_pro,$min_fat,$max_fat,$min_carbo,$max_carbo) {
  try {
    $sql = "SELECT * FROM macro_data WHERE cal BETWEEN ? AND ? AND protein BETWEEN ? AND ? AND fat BETWEEN ? AND ? AND carbo BETWEEN ? AND ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $min_cal, PDO::PARAM_STR);
    $stmt->bindValue(2, $max_cal, PDO::PARAM_STR);
    $stmt->bindValue(3, $min_pro, PDO::PARAM_STR);
    $stmt->bindValue(4, $max_pro, PDO::PARAM_STR);
    $stmt->bindValue(5, $min_fat, PDO::PARAM_STR);
    $stmt->bindValue(6, $max_fat, PDO::PARAM_STR);
    $stmt->bindValue(7, $min_carbo, PDO::PARAM_STR);
    $stmt->bindValue(8, $max_carbo, PDO::PARAM_STR);
    $stmt->execute();
    $search_item_rows = $stmt->fetchAll();
    return $search_item_rows;
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

function word_item_rows($dbh,$keyword) {
  try {
    $sql = "SELECT * FROM macro_data WHERE name LIKE ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['%'.$keyword.'%']);
    $stmt->execute();
    $search_item_rows = $stmt->fetchAll();
    return $search_item_rows;
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

//pageごとのitem取得
function get_page_item_rows($dbh,$page) {
  try {
    $sql = "SELECT * FROM macro_data LIMIT ?,?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$page * (MAX_DATA),MAX_DATA]);
    $item_page_rows = $stmt->fetchAll(); 
    return $item_page_rows;
  }catch (PDOException $e) {
    echo $e -> getMessage();
    exit;
  }
}

//商品のお気に入りへの追加
function add_fav($dbh,$user_id){
  
    $item_id = intval($_POST['item_id']);
    $fav_rows = get_fav_rows($dbh,$user_id);
    $fav_id_correct = "";
    
    //item_idが同じ場合とそうじゃない場合
    for ($i=0;$i<count($fav_rows);$i++) {
        if ($item_id === $fav_rows[$i]['item_id']) {
         $fav_id_correct = $fav_rows[$i]['item_id'];
        } 
    }
    if ($fav_id_correct !== '') {
      print "既に存在します";
    } else {
      add_fav_item($dbh, $_SESSION['user_id']);
    }
  }

//商品の絞り込み検索
function refined_search($dbh){
  if ($_POST['min_cal'] === "") {
    $min_cal = 0;
  } else {
    $min_cal = (int)$_POST['min_cal'];
  }

  if ($_POST['max_cal'] === "") {
    $max_cal = 10000;
  } else {
    $max_cal = (int)$_POST['max_cal'];
  }

  if ($_POST['min_pro'] === "") {
    $min_pro = 0;
  } else {
    $min_pro = (int)$_POST['min_pro'];
  }

  if ($_POST['max_pro'] === "") {
    $max_pro = 10000;
  } else {
    $max_pro = (int)$_POST['max_pro'];
  }

  if ($_POST['min_fat'] === "") {
    $min_fat = 0;
  } else {
    $min_fat = (int)$_POST['min_fat'];
  }

  if ($_POST['max_fat'] === "") {
    $max_fat = 10000;
  } else {
    $max_fat = (int)$_POST['max_fat'];
  }
  
  if ($_POST['min_carbo'] === "") {
    $min_carbo = 0;
  } else {
    $min_carbo = (int)$_POST['min_carbo'];
  }
  
  if ($_POST['max_carbo'] === "") {
    $max_carbo = 10000;
  } else {
    $max_carbo = (int)$_POST['max_carbo'];
  }

  $item_rows = search_item_rows($dbh,$min_cal,$max_cal,$min_pro,$max_pro,$min_fat,$max_fat,$min_carbo,$max_carbo);
  return $item_rows;
}



//非DB処理---------------------------------------------------------------

//現在のページの取得
function get_current_page(){
  if (!isset($_GET['page'])) {
    $page = 1;
    return $page;
  } else {
    $page = $_GET['page'];
    return $page;
  }
}

//itemの総ページ数の取得
function sum_item_page($dbh){
  return ceil(count_item($dbh) / (MAX_DATA));
}

//item数を数える
function count_item($dbh) {
  $sum_item = get_item_rows($dbh);
  return count($sum_item);
}

//写真アップロードチェック
function up_pic() {
    $img_dir    = './img/';    // アップロードした画像ファイルの保存ディレクトリ
    $data       = array();    
    $new_img_filename = '';   // アップロードした新しい画像ファイル名
    if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
        // 画像の拡張子を取得
        $extension = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
        // 指定の拡張子であるかどうかチェック
        if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
          // 保存する新しいファイル名の生成（ユニークな値を設定する）
          $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
          // 同名ファイルが存在するかどうかチェック
          if (is_file($img_dir . $new_img_filename) !== TRUE) {
            // アップロードされたファイルを指定ディレクトリに移動して保存
            if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
                $err_msg[] = 'ファイルアップロードに失敗しました';
            }
          } else {
            $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
          }
        } else {
          $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEGのみ利用可能です。';
        }
      } else {
        $err_msg[] = 'ファイルを選択してください';
      }
    return $new_img_filename;
}

?>