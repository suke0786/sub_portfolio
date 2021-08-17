<!DOCTYPE html>
<html>
    <head>
        <!-- 共通設定の読込 -->
        <?php print(HEAD_SETTING) ?>
        <title>商品一覧</title>
    </head>
    
    <body>
        <header class='text-secondary' style="background-color:#FFA07A;">
            <div  class="d-flex flex-row p-2 bd-highlight　mb-4">
                <div class="p-2 flex-grow-1 bd-highlight">
                    <h1>Title</h1>
                </div>
                
                <?php if ($err_msg !== '') { foreach ($err_msg as $msg) { echo "<p>  $msg  <p> "; } } ?> 

                <div class="nav">
                <div class="nav-item" style="min-width: 150px;">
                    <p><a class="nav-link disabled text-secondary" href="./itemlist.php">リスト</a></p>
                </div>
                
                <div class="nav-item" style="min-width: 150px;">
                    <p><a class="nav-link text-secondary" href="./fav.php">お気に入り</a></p>
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
                
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-secondary text-white p-2">

                    <form method="POST">
                        <div class="p-3">
                            <input type="search" name="keyword" value=""/> 
                            <input type="submit" name="word_search" class="btn btn-primary">
                        </div>
                    </form>
                        
                    <form method="POST">
                        <div>
                            <ul class="d-flex flex-row bd-highlight">
                                <li class="bd-highlight text-center w-25">
                                    <p>カロリー: <input type="number" name="min_cal" class="search_cal w-25"/>kcal ～ <input type="number" name="max_cal"  class="search_cal w-25"/>kcal</p>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    <p>タンパク質: <input type="number" name="min_pro" class="search_cal w-25"/>g ～ <input type="number" name="max_pro" class="search_cal w-25"/>g</p>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    <p>脂質: <input type="number" name="min_fat"  class="search_cal w-25"/>g ～ <input type="number" name="max_fat" class="search_cal w-25"/>g</p>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    <p>炭水化物: <input type="number" name="min_carbo" class="search_cal w-25"/>g ～ <input type="number" name="max_carbo" class="search_cal w-25"/>g</p>
                                </li>
                                <li class="bd-highlight" style="width: 15%;">
                                    <input type="submit" name="search" class="btn btn-primary" value="絞り込み検索">
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <nav class="navbar navbar-dark bg-secondary px-3">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>

        <main>
                <div class="d-flex flex-wrap justify-content-around mb-3">
                <?php foreach ($item_page_rows as $page_rows) { ?>
                        <div class="p-2 bd-highlight">
                            <ul class="itemlist shadow p-2">

                                <li class="item_part p-2;" style="width: 300px;">
                                    <div class='item_features'>
                                        <p>
                                            <?php if($page_rows['protein'] >= 15){ ?>
                                                <span class="text-danger"> HP </span> 
                                            <?php } ?>
                                            <?php if($page_rows['fat'] <= 5){ ?>
                                                <span class="text-warning"> LF </span>
                                            <?php } ?>
                                            <?php if($page_rows['carbo'] <= 10){ ?>
                                                <span class="text-info"> LC </span>
                                            <?php } ?>
                                        </p>
                                    </div>

                                    <div class="itemTitle" style="background-color: #fff8dc;">
                                        <h6 style="line-height: 1.5em;"><?php print $page_rows['name'];?></h6>
                                    </div>
                                
                                    <table class="itemDetail">
                                        <tr>
                                            <th scope="row" class="text-nowrap">カロリー</th>
                                            <td><?php print $page_rows['cal'] ;?>kcal</td>
                                        </tr>
                                        
                                        <tr>
                                            <th scope="row" class="text-nowrap">タンパク質</th>
                                            <td><?php print $page_rows['protein'] ;?> g</td>
                                        </tr>
                                            
                                        <tr>
                                            <th scope='row' class="text-nowrap">脂質</th>
                                            <td><?php print $page_rows['fat'] ;?> g</td>
                                        </tr>
                                            
                                        <tr>
                                            <th scope='row' class="text-nowrap">炭水化物</th>
                                            <td><?php print $page_rows['carbo'] ;?> g</td>
                                        </tr>
                                            
                                        <tr>
                                            <th>コメント</th>
                                            <td><?php print $page_rows['comment'] ;?></td>
                                        </tr>
                                    </table>
                                    <div class="item_form">
                                        <form method="post">
                                            <input type="hidden" name="item_id" value="<?php print $page_rows['id'];?>">
                                            <input type="submit" name="add_fav" value="お気に入り" class="btn btn-outline-danger">
                                        </form>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    <?php } ?>
        </main>

        <!-- ページ移動 -->

        <div class="paging text-center block mb-3;" style="margin-bottom: 2em;">
            <?php  if ($page > 1){ ?>
                <a class = 'p-2' href="itemlist.php?page=<?php echo ($page-1); ?>">前のページへ</a>
            <?php } ;?>

            <?php  if ($page > 2){ ?>
                <a class = 'p-1' href="itemlist.php?page=<?php echo ($page-2); ?>">
                <?php print $page-2 ;?>
                </a> 
            <?php } ;?>

            <?php  if ($page > 1){ ?>
                <a class = 'p-1' href="itemlist.php?page=<?php echo ($page-1); ?>">
                <?php print $page-1 ;?>
                </a> 
            <?php } ;?>

                <?php print $page ;?>

            <?php  if ($page < $max_page - 2){ ?>
                <a class = 'p-1' href="itemlist.php?page=<?php echo ($page+1); ?>">
                <?php print $page+1 ;?>
                </a>
            <?php } ;?> 

            <?php  if ($page < $max_page - 1){ ?>
                <a class = 'p-1' href="itemlist.php?page=<?php echo ($page+2); ?>">
                <?php print $page+2 ;?>
                </a> 
            <?php } ;?> 

            <?php  if ($page < $max_page): ?>
                <a class = 'p-2' href="itemlist.php?page=<?php echo ($page+1); ?>">次のページへ</a>
            <?php endif; ?>
        </div>


    <!-- 共通JS設定の読込 -->
    <?php //print (COMMON_SCRIPT) ?>
    
    <!-- bootstrap設定の読込 -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php print (JS_SETTING) ;?>
  </body>
</html>