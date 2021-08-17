<?php

// データベースの接続情報
if ($_SERVER['HTTP_HOST'] === 'www.macropfc.com'){
    define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
    define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'sample');
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_CHARSET', 'utf8');
} else {
    define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
    define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');
    define('DB_HOST', 'mysql');
    define('DB_NAME', 'sample');
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_CHARSET', 'utf8');
}

//php処理変数定義
define('MAX_DATA',20);

//view共通設定
define('HEAD_SETTING',
    '<meta charset = "utf-8">
    <meta name=”viewport” content=”width=device-width,initial-scale=1.0″>
    <link rel="stylesheet" href="/view/css/common_view.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"　integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>'
);
define('JS_SETTING',
    '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>'
);
define('COMMON_SCRIPT',
    '<script>
    $(function(){
        $("table.itemDetail").hide();
        $(".itemlist li").hover(function(){
            $("table:not(:animated)", this).slideDown();
        }, function(){
            $("table.itemDetail",this).slideUp();
        });
    });
    </script>'
);


