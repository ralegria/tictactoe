<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "partials/_head.php";?>
        <title>Tictactoe - Baypayer</title>
    </head>
    <body class="black" style="overflow-x:hidden;background:url('https://source.unsplash.com/random/1920x1080?blur') 50%;background-size: cover;">
        <?php require_once "partials/_menu.php";?>
        <main class="valign-wrapper">
            <div class="row" style="margin:0;width:100%;">
                <div class="center-align" style="width:100%;margin:0 auto;">
                    <div class="left-align ticket-container" style="background: url(<?php echo $this->_helpers->linkTo("img/dark-lines-circles.png", "Assets")?>) #FFF !important;background-size:cover !important;">
                        <div class="loader valign-wrapper center-align" style="background-color:rgb(249,249,249);border-radius:10px;">
                            <div style="display:inline-block;width:70%;margin-left:auto;margin-right:auto;">
                                <div style="display:inline-flex;width:100%;height:100px;">
                                    <img src="<?php echo $this->_helpers->linkTo("img/loading.svg", "Assets")?>" class="loader-image animated bounceIn" style="opacity:0;width:100%;object-fit:contain;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row s12 m6 center-align" style="padding:15px 0 0;">
                            <span style="font-size:1.5rem;font-family:Mont;">Tictactoe</span>
                        </div>
                        <div class="main-menu" style="display:none;padding:16px 0;">
                            <div class="s12 m12" style="margin:10px 0 0;padding:0;">
                                <a class="btn k-btn v2 white-text red waves-effect waves-dark" onclick="pager('game','main-menu');">
                                    Let's go!
                                </a>
                            </div>
                            <div class="s12 m12" style="margin:10px 0 0;padding:0;">
                                <a class="btn k-btn v2 white-text purple waves-effect waves-dark" onclick="pager('settings','main-menu');">
                                    Settings
                                </a>
                            </div>
                        </div>
                        <div class="row game" style="display:none;">
                            <div class="white turn-tab left go">
                                <i class="material-icons right">close</i>
                                <span class="left"></span>
                            </div>
                            <div class="white turn-tab right">
                                <i class="material-icons left">panorama_fish_eye</i>
                                <span class="right"></span>
                            </div>
                            
                            <div id="tictactoe" class="col s12 m12">
                                <!-- Game panel to be shown here -->
                            </div>
                            <div class="col s12 m12" style="margin-top:20px;">
                                <a class="quit btn btn-flat purple big-purple-button waves-effect waves-dark white-text" onclick="pager('main-menu','game');">Quit game</a>
                            </div>
                        </div>
                        <div class="row result" style="display:none;">
                            <div class="stats center-align col s12 m12">
                                <div><i class="material-icons animated flip"></i></div>
                                <div class="animated tada infinite">Wins</div>
                            </div>

                            <div class="col s12 m12" style="margin-top:20px;">
                                <a class="btn btn-flat red big-purple-button waves-effect waves-dark white-text" onclick="pager('game','result');">Rematch</a>
                            </div>
                            <div class="col s12 m12" style="margin-top:10px;">
                                <a class="btn btn-flat purple big-purple-button waves-effect waves-dark white-text" onclick="pager('main-menu','result');">Main menu</a>
                            </div>
                        </div>
                        <div class="settings" style="display:none;padding:0 20px;">
                            <div class="col s12 m12" style="margin-bottom:0px;padding-left: 0;">
                                <label for="size">Table size</label>
                                <input type="text" id="size" class="email-singup" placeholder="3" autofocus />
                            </div>
                            <div class="row s12 m12" style="padding:0;">
                                <a class="send btn btn-flat purple big-purple-button waves-effect waves-dark white-text" onclick="saveSize();">Save</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--  Scripts-->
        <?php require_once "partials/_outputJs.php";?>
        <script>
            var squares = [],
                SIZE = 3,
                EMPTY = "&nbsp;",
                score,
                moves,
                side,
                turn = "X";

            function startNewGame() {
                turn = "X";
                score = {
                    "X": 0,
                    "O": 0
                };
                moves = 0;
                squares.forEach(function (square) {
                    square.html(EMPTY);
                });
                $('.turn-tab').find('span').html('');
                $('.stats div:first-child i').html('').removeClass('light-blue-text red-text');
                side = turn === "X" ? "left" : "right";
                $('.turn-tab').removeClass('go animated pulse infinite');
                $('.turn-tab.'+side).addClass('go');
                $('.quit').removeClass('disabled');
            }

            function win(clicked) {
                var memberOf = clicked[0].className.split(/\s+/);

                for (var i = 0; i < memberOf.length; i++) {
                    var testClass = '.' + memberOf[i];

                    var piece = turn === "X" ? "close" : "panorama_fish_eye";
                    /* console.log('Containing '+turn+': '+ $('#tictactoe').find(testClass + ':contains(' + piece + ')').length); */
                    
                    if ($('#tictactoe').find(testClass + ':contains(' + piece + ')').length == SIZE) {
                        $('#tictactoe').find(testClass + ':contains(' + piece + ')').find('i').addClass('animated bounceIn infinite');
                        return true;
                    }
                }

                return false;
            }

            function set() {
                if ($(this).html() !== EMPTY) return;

                var piece = turn === "X" ? "close" : "panorama_fish_eye";
                var color = turn === "X" ? "light-blue-text" : "red-text";
                
                var chip = $('<i class="material-icons '+color+'">'+ piece +'</i>');
                chip.addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('animated bounceIn');
                });
                $(this).html(chip);
                
                side = turn === "X" ? "left" : "right";
                moves += 1;
                score[turn] += $(this)[0].indicator;

                if (win($(this))) {
                    $('.turn-tab.'+side).addClass('animated pulse infinite');
                    $('.stats div:first-child i').html(piece).addClass(''+color+'');
                    $('#tictactoe').attr('style','pointer-events:none;');
                    $('.quit').addClass('disabled');
                    setTimeout(function(){
                        pager('result','game');
                    }, 3000);
                } else if (moves === SIZE * SIZE) {
                    $('.stats div:nth-child(2)').html('It\'s a draw').addClass(''+color+'');
                    $('#tictactoe').attr('style','pointer-events:none;filter:grayscale();');
                    $('.quit').addClass('disabled');
                    setTimeout(function(){
                        pager('result','game');
                    }, 3000);
                } else {
                    $('.turn-tab').addClass('go');
                    $('.turn-tab.'+side).removeClass('go').find('span').html(score[turn]).addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        $(this).removeClass('animated bounceIn');
                    });
                    turn = turn === "X" ? "O" : "X";
                }
            }

            function play() {
                var board = $("<table class='cell-wrapper' border=1 cellspacing=0>"),
                    indicator = 1;
                for (var i = 0; i < SIZE; i++) {
                    var row = $("<tr style='height:"+100/SIZE+"%;'>");
                    board.append(row);
                    for (var j = 0; j < SIZE; j++) {
                        var cell = $("<td class='' style='width:"+100/SIZE+"%;height:100%;'></td>");
                        cell.addClass('col' + j);
                        cell.addClass('row' + i);
                        
                        if (i == j) cell.addClass('dia0');
                        if (j == SIZE - i - 1) cell.addClass('dia1');
                        
                        cell[0].indicator = indicator;
                        cell.click(set);
                        row.append(cell);
                        squares.push(cell);
                        indicator += indicator;
                    }
                }
                
                $(document.getElementById("tictactoe") || document.body).html(board).removeAttr('style');
                startNewGame();
            }

            function saveSize(){
                $('.send').html('<img src="http://platform.kitecweb.com/assets/img/loading-dark.svg " style="height:inherit;">');
                SIZE = $('#size').val() != "" ? $('#size').val() : SIZE;
                play();
                setTimeout(function(){ 
                    logMessages('send','bounceIn','#3dcc91','<i class="material-icons left">check</i>Saved', 'Save');
                    setTimeout(function(){ 
                        pager('main-menu','settings');
                    }, 500);
                }, 500);
            }
        </script>
        <script>
            $(window).ready(function() {
                setTimeout(function(){ $(".loader").fadeOut("slow"); }, 500);
                $('.main-menu').show("slow","swing");
            });
            function logMessages(elem, anim, color, message, after){
                $('.'+elem).addClass('animated '+anim).html(message).attr('style','background-color:'+color+' !important;');
                setTimeout(function(){
                    $('.'+elem).removeClass('animated '+anim).html(after).removeAttr('style');
                }, 3000);
            }
            function pager(elem1,elem2){
                $("."+elem1).slideDown("slow","swing");
                $("."+elem2).slideUp("slow","swing");
                if(elem1 == "game"){
                    play();
                }
            }
        </script>
    </body>

</html>