<!DOCTYPE html>
<html>
<head>
        <!-- 共通設定の読込 -->
        <?php print(HEAD_SETTING) ?>
        <title>マイページ</title>
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
                    <p><a class="nav-link text-secondary" href="./fav.php">お気に入り</a></p>
                </div>
                
                <div class="nav-item" style="min-width: 150px;">
                    <a class="nav-link disabled text-secondary" href = 'mypage.php'><p>マイページ</p></a>
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
                        <div>
                            <ul class="d-flex flex-row bd-highlight">
                                <li class="bd-highlight text-center w-25">
                                    アカウント名: <?php print $user_info_rows[0]['user_name']; ?>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    誕生日: <input type="date" name="birthday" value="<?php print $user_info_rows[0]['birthday']; ?>">
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    年齢: <?php print $user_age ;?>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    身長: <input type="number" name="height" value="<?php print $user_info_rows[0]['height'];?>">
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    体重: <input type="number" name="weight" value="<?php print $user_info_rows[0]['weight'];?>">
                                </li>
                            </ul>
                            <ul class="d-flex flex-row bd-highlight">
                                <li class="bd-highlight text-center w-25">
                                    アクティブレベル: 
                                    <select name='level'>
                                        <?php for($i=1;$i<4;$i++){ ?>
                                            <option value="<?php print $i ;?>" <?php if ($i === $user_info_rows[0]['level']) { print 'selected'; }?>>
                                                <?php print $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <p class='tooltip'>
                                        ・レベル1: <br>
                                        デスクワークなどで、運動量は少ない<br>
                                        ・レベル2: <br>
                                        立ち仕事や外回りなどで、比較的一日動き回る<br>
                                        ・レベル3: <br>
                                        立ち仕事や外回りに加え、トレーニングを行う<br>
                                    </p>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                    一日の基礎代謝: <?php print $base_calorie_date; ?>
                                </li>
                                <li class="bd-highlight text-center w-25">
                                一日の消費カロリー: <?php print $calorie_date ;?>
                                </li>
                                <li class="bd-highlight" style="width: 15%;">
                                    <input type="submit" name="form" class="btn btn-primary" value="情報を更新する">
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
            <h2>目的別の摂取カロリー目安</h2>
                <ul class='purpose'>
                    <li>
                        増量したい人: <?php print $calorie_date * 1.2 ;?>kcal
                        <ul class='macro'>
                            推奨される一日あたりの各マクロ栄養素量
                            <li>
                                タンパク質: <?php print $user_info_rows[0]['weight'] * 2 ;?>
                            </li>
                            <li>
                                脂質: <?php print (int)($calorie_date * 1.2 * 0.25 / 9) ;?>
                            </li>
                            <li>
                                炭水化物: <?php print (int)((($calorie_date * 1.2) - ($user_info_rows[0]['weight'] * 2 * 4) - (int)($calorie_date * 1.2 * 0.25)) / 4) ;?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        維持したい人: <?php print $calorie_date ;?>kcal
                        <ul class='macro'>
                            推奨される一日あたりの各マクロ栄養素量
                            <li>
                                タンパク質: <?php print $user_info_rows[0]['weight'] * 2 ;?>
                            </li>
                            <li>
                                脂質: <?php print (int)($calorie_date * 0.25 / 9) ;?>
                            </li>
                            <li>
                                炭水化物: <?php print (int)(($calorie_date - (($user_info_rows[0]['weight'] * 2 * 4) + ($calorie_date * 0.25))) / 4) ;?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        減量したい人: <?php print $calorie_date * 0.8 ;?>kcal
                        <ul class='macro'>
                            推奨される一日あたりの各マクロ栄養素量
                            <li>
                                タンパク質: <?php print $user_info_rows[0]['weight'] * 2 ;?>
                            </li>
                            <li>
                                脂質: <?php print (int)($calorie_date * 0.8 * 0.25 / 9) ;?>
                            </li>
                            <li>
                                炭水化物: <?php print (int)((($calorie_date * 0.8) - ($user_info_rows[0]['weight'] * 2 * 4) - (int)($calorie_date * 0.8 * 0.25)) / 4) ;?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </form>
        </main>
        <script>
            $(function(){
                $('.tooltip').hide();
                $('.level').hover(
                    function(){
                    $(this).children('.tooltip').fadeIn('fast');
                },function(){
                    $(this).children('.tooltip').fadeOut('fast');
                });
            });
        
        //$(function(){
        //    $('.macro').hide();
        //    $('.purpose li').hover(function(){
        //        $(".macro:not(:animated)", this).slideDown();
        //    }, function(){
        //        $(".macro",this).slideUp();
        //    });
        //});
            
        </script>
    <!-- bootstrap設定の読込 -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php print (JS_SETTING) ;?>
  </body>
</html>