<!DOCTYPE html>
<html>
    <head>
        <meta charset = 'utf-8'>
        <meta name=”viewport” content=”width=device-width,initial-scale=1.0″>
        <link rel="stylesheet" href="./css/itemlist_view.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"　integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <title>ユーザー登録</title>
    </head>
    <body>
        <h1>ユーザー登録ページ</h1>
        <?php if ($err_msg !== '') { foreach ($err_msg as $msg) { echo "<p>  $msg  <p> "; } } ?> 
        <?php if(isset($_POST['submit'])){ ?>
            <?php if (count($err_msg) === 0 ) { ?>
                <p> <?php print $success_msg ?><p>
                <footer><a href="itemlist.php">トップページへ</a></footer>
            <?php } ?>
        <?php } ?>
        <form method = "post" enctype="multipart/form-data">
            <p>ユーザー名<input type="text" name="user_name"/></p>
            <p>パスワード<input type="password" name="password"/></p>
            <input type="submit" name="submit" value="登録"/>
        </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>