<!DOCTYPE html>
<html>
    <head>
        <meta charset = 'utf-8'>
        <meta name=”viewport” content=”width=device-width,initial-scale=1.0″>
        <link rel="stylesheet" href="./css/itemlist_view.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"　integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <title>ログイン画面</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <?php if ($err_msg !== '') { foreach ($err_msg as $msg) { echo "<p>  $msg  <p> "; } } ?> 
        <form action = "../login.php" method = "POST">
            <p>ユーザー名<input type="text" name="user_name" value=""/></p>
            <p>パスワード<input type="password" name="password" value=""/></p>
            <p><input type="submit" name="login" value="ログイン"/></p>
        </form>
        <a href="/codeshop/register.php">新規登録</a>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>