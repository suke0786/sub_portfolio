<?php
require_once './conf/const.php';
require_once './model/user_info.php';
require_once './model/itemlist.php';

//DB接続情報と変数定義
$dbh = get_db_connect();
$err_msg = [];
$reply_item_rows = array();
$reply_text = array();

//LINEのwebhook認証情報
$channelSecret = ''; // Channel secret string
$httpRequestBody = file_get_contents("php://input"); // Request body string
$hash = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
$signature = base64_encode($hash);

//LINEから送られてきたjsonから検索ワードを変数へ格納
$array = json_decode($httpRequestBody, true);
$search_word = $array['events'][0]['message']['text'];

//検索結果の配列から、上位三つを抽出
$LINE_item_rows = word_item_rows($dbh,$search_word);

for($i=0;$i<3;$i++) {
    array_push($reply_item_rows,
                array(
                    'name' => $LINE_item_rows[$i]['name'],
                    'cal' => $LINE_item_rows[$i]['cal'],
                    'protein' => $LINE_item_rows[$i]['protein'],
                    'fat' => $LINE_item_rows[$i]['fat'],
                    'carbo' => $LINE_item_rows[$i]['carbo']
                    )
                );
};

//JSON文字列をファイルへ書き込み
$fp = fopen('LINE.txt','a');
foreach($reply_item_rows as $reply_item) {
    fwrite($fp, $reply_item['name']."\n".
                $reply_item['cal'].
                $reply_item['protein']."\n".
                $reply_item['fat']."\n".
                $reply_item['carbo']."\n"."\n"
            );
}
fclose($fp);


foreach($reply_item_rows as $reply_item) {
        $reply_item = str_replace(array("\r\n", "\r", "\n"), '', $reply_item);
        array_push($reply_text,
                    '名前：'.$reply_item['name']."\n".
                    'カロリー：'.$reply_item['cal']." cal"."\n".
                    'タンパク質：'.$reply_item['protein']." g"."\n".
                    '脂質：'.$reply_item['fat']." g"."\n".
                    '糖質：'.$reply_item['carbo'])." g"."\n"."\n";
}
$reply_text = implode("\n\n",$reply_text);

$replyToken = $array['events'][0]['replyToken'];

//チャネルアクセストークン(MessagingAPI設定から確認)
define('TOKEN', '');
//返信用のメッセージ配列を設定
$messageData = [
    'type' => 'text',
    'text' => "$reply_text",
];
//返信用の配列設定
$response = [
    'replyToken' => $replyToken,
    'messages' => [
        $messageData,
    ],
];
$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8','Authorization: Bearer  ' . TOKEN ));
$result = curl_exec($ch);
curl_close($ch);