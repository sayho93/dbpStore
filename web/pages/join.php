<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 10. 15.
 * Time: PM 5:08
 */
?>

<? include_once "../inc/header.php"; ?>

<script>
    $(document).ready(function(){
        var check = -1;

        $(".jCheckEmail").click(function(){
            var email = $("[name=email]").val();
            if(email === '' || email == null){
                alert("이메일 입력 후 시도해 주시기 바랍니다.");
                return;
            }
            var ajax = new AjaxSender("<?=URL_PATH_SHARED?>/shared/public/route.php?F=UserSVC.checkEmail", true, "json", new sehoMap().put("email", email));
            ajax.send(function(data){
                if(data.code === 1) check = 1;
                alert(data.message);
            })
        });

        $(".jSubmit").click(function(){
            if(check !== 1){
                alert("이메일 중복 확인 후 시도해주시기 바랍니다.");
                return;
            }
            var ajax = new AjaxSubmit("<?=URL_PATH_SHARED?>/shared/public/route.php?F=UserSVC.userJoin", "post", true, "json", "#form");
            ajax.send(function(data){
                if(data.code === 1){
                    alert(data.message);
                    location.href = "/web";
                }else{
                    alert("error");
                }
            });
        });
    });
</script>

<body>

<header id="home">
    <div class="bg-img" style="background-image: url('<?=URL_PATH_WEB?>/img/background1.jpg');">
        <div class="overlay"></div>
    </div>
    <? include_once "../inc/navigator.php"; ?>

    <form id="form">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <div class="home-content">
                            <h2 class="white-text">회원가입</h2>
                        </div>
                    </div>
                </div>

                <div class="input-group input-group-lg">

                    <span class="input-group-addon" id="sizing-addon1">이메일</span>
                    <input type="text" class="form-control" name="email"/>
                    <span class="input-group-btn">
                        <button class="btn btn-danger jCheckEmail" type="button">중복확인</button>
                    </span>
                </div>

                <div class="input-group input-group-lg" style="margin-top: 10px">
                    <span class="input-group-addon" id="sizing-addon1">비밀번호</span>
                    <input type="password" class="form-control" name="password"/>
                </div>

                <div class="input-group input-group-lg" style="margin-top: 10px">
                    <span class="input-group-addon" id="sizing-addon1">이름</span>
                    <input type="text" class="form-control" name="name"/>
                </div>

                <div class="input-group input-group-lg" style="margin-top: 10px">
                    <span class="input-group-addon" id="sizing-addon1">휴대전화번호</span>
                    <input type="text" class="form-control" name="phone"/>
                </div>

                <div class="input-group input-group-lg" style="margin-top: 10px">
                    <span class="input-group-addon" id="sizing-addon1">닉네임</span>
                    <input type="text" class="form-control" name="nick"/>
                </div>

                <input type="button" class="btn btn-primary btn-lg pull-right jSubmit" style="margin-top: 10px;" value="회원가입" />
            </div>
        </div>
    </form>

</header>


<!--<div id="about" class="section md-padding">-->
<!---->
<!--</div>-->



<? include_once "../inc/footer.php"; ?>
