<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 31/10/2018
 * Time: 5:19 PM
 */
?>
<?include_once "../inc/header.php";?>
<?
$appData = $userSVC->appInfo();

$data = $appData["data"];
$commentList = $appData["extra"];
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="<?=$CONST_URL_WEB?>/js/rater.js"></script>
    <style>
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
        .starrating > input {display: none;}

        .starrating > label:before{
            content: "\f005"; /* Star */
            margin: 2px;
            font-size: 1em;
            font-family: FontAwesome;
            display: inline-block;
        }

        .starrating > label{
            color: #FFFFFF; /* Start color when not clicked */
        }
        .starrating > input:checked ~ label{ color: #ffca08 ; } /* Set yellow color when star checked */
        .starrating > input:hover ~ label{ color: #ffca08 ;  } /* Set yellow color when star hover */
    </style>

    <script>
        $(document).ready(function(){
//            $(".rating").rate();
//            var options = {
//                max_value: 5,
//                step_size: 0.1,
//                selected_symbol_type: 'hearts',
//                convert_to_utf8: true,
//                readonly: true
//            };
//            $(".rating").rate(options);
            var options = {
                max_value: 5,
                step_size: 0.5,
                selected_symbol_type: 'utf8_star',
                readonly: true
            }

            $(".rating").rate(options);
        });
    </script>

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a><?=$categoryInfo["data"]["desc"]?></a>
            </li>
        </ol>

        <div class="row">
            <div class="col-xl-2 col-sm-3 mb-3">
                <div class="card text-dark bg-white o-hidden h-100 border-0">
                    <div class="card-body text-center p-0">
                        <img src="<?=$CONST_URL_WEB?>/img/PickleCode_logo.png" width="100%" height="100%"/>
                    </div>
                </div>
            </div>

            <div class="col">
                <h1><small><?=$data["appTitle"]?></small></h1>
                <div>
                    <div>
                        <a href="#" class="mr-3"><u><?=$data["desc"]?></u></a> <?=$data["category"]?>
                        <div class="float-right">
                            <div class="rating" data-rate-value=3.5></div>
<!--                            <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">-->
<!--                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>-->
<!--                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>-->
<!--                                <input type="radio" id="star3" name="rating" value="3" checked/><label for="star3" title="3 star"></label>-->
<!--                                <input type="radio" id="star2" name="rating" value="2" checked/><label for="star2" title="2 star"></label>-->
<!--                                <input type="radio" id="star1" name="rating" value="1" checked/><label for="star1" title="1 star"></label>-->
<!--                            </div>-->
                            <div>
                                <?=$data["average"]?>&nbsp;&nbsp;
                                <?=$data["cnt"]?>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <!--
                        <div class="progress w-25 float-right mr-2">
                            <div class="progress-bar" role="progressbar" style="width: <?=($data["average"] / 5) * 100?>%"></div>
                        </div>
                        -->

                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <!--            commentList area-->
        </div>
    </div>
<?include_once $_SERVER["DOCUMENT_ROOT"] . $CONST_URL_WEB . "/inc/footer.php";
