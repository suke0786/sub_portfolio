<!DOCTYPE html>
<html>
<head>
        <!-- 共通設定の読込 -->
        <?php print(HEAD_SETTING) ?>
        <title>お気に入り</title>
    </head>
    <body>
        <header>
        <header class='text-secondary' style="background-color:#FFA07A;">
            <div  class="d-flex flex-row p-2 bd-highlight　mb-4">
                <div class="p-2 flex-grow-1 bd-highlight">
                    <h1>Title</h1>
                </div>
                
                <?php if ($err_msg !== '') { foreach ($err_msg as $msg) { echo "<p>  $msg  <p> "; } } ?> 

                <div class="nav">
                <div class="nav-item" style="min-width: 150px;">
                    <p><a class="nav-link text-secondary" href="./itemlist.php">リスト</a></p>
                </div>
                
                <div class="nav-item" style="min-width: 150px;">
                    <p><a class="nav-link disabled text-secondary" href="./fav.php">お気に入り</a></p>
                </div>
                
                <div class="nav-item" style="min-width: 150px;">
                    <a class="nav-link text-secondary" href = 'mypage.php'><p>マイページ</p></a>
                </div>

                <div class="nav-item" style="min-width: 150px;">
                    <form action='login.php' method="POST">
                        <input class="btn btn-outline-secondary" type="submit" name="logout" value="ログアウト"/>
                    </form>
                </div>
                </div>
            </div>
        </header>
                
        <nav>
            <h6>お気に入りリスト</h6>
            <ul class='sum_cal'>
                <li>
                    カロリー: <?php print $sum_calorie ;?>
                </li>
                <li>
                    タンパク質: <?php print $sum_protein ;?>
                </li>
                <li>
                    脂質: <?php print $sum_fat ;?>
                </li>
                <li>
                    炭水化物: <?php print $sum_carbohydrate ;?>
                </li>
            </ul>
            </form>
        </nav>
        <main>
        </div>
                <div class="d-flex flex-wrap justify-content-around mb-3">
                    <?php foreach ($user_fav_rows as $fav_rows) {?>
                        <div class="p-2 bd-highlight">
                            <ul class="itemlist shadow p-2">
                            <li class="item_part p-2;" style="width: 300px;">
                                    <div class='item_features'>
                                        <p>
                                            <?php if($fav_rows['protein'] >= 15){ ?>
                                                <span class="text-danger"> HP </span> 
                                            <?php } ?>
                                            <?php if($fav_rows['fat'] <= 5){ ?>
                                                <span class="text-warning"> LF </span>
                                            <?php } ?>
                                            <?php if($fav_rows['carbo'] <= 10){ ?>
                                                <span class="text-info"> LC </span>
                                            <?php } ?>
                                        </p>
                                    </div>

                                    <!-- 商品の名前 -->
                                    <div class="itemTitle" style="background-color: #fff8dc;">
                                        <h6 style="line-height: 1.5em;"><?php print $fav_rows['name'];?></h6>
                                    </div>
                                
                                    <table class="itemDetail">
                                        <tr>
                                            <th scope="row" class="text-nowrap">カロリー</th>
                                            <td><?php print $fav_rows['cal'] ;?>kcal</td>
                                        </tr>
                                        
                                        <tr>
                                            <th scope="row" class="text-nowrap">タンパク質</th>
                                            <td><?php print $fav_rows['protein'] ;?> g</td>
                                        </tr>
                                            
                                        <tr>
                                            <th scope='row' class="text-nowrap">脂質</th>
                                            <td><?php print $fav_rows['fat'] ;?> g</td>
                                        </tr>
                                            
                                        <tr>
                                            <th scope='row' class="text-nowrap">炭水化物</th>
                                            <td><?php print $fav_rows['carbo'] ;?> g</td>
                                        </tr>
                                            
                                        <tr>
                                            <th>コメント</th>
                                            <td><?php print $fav_rows['comment'] ;?></td>
                                        </tr>
                                    </table>
                                    <div class="item_form">
                                        <form method="post">
                                            <input type="hidden" name="item_id" value="<?php print $fav_rows['item_id'];?>">
                                            <input type="submit" name="delete" class="btn btn-outline-danger m-2" value="削除">
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
        </main>
    <!-- 共通JS設定の読込 -->
    <?php //print (COMMON_SCRIPT) ?>
    
    <!-- bootstrap設定の読込 -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php print (JS_SETTING) ;?>
  </body>
</html>