<script src="<?=$CONST_URL_WEB?>/js/sb-admin.min.js"></script>
<script>
    $(document).ready(function(){
        $("#loginModal").on('shown.bs.modal', function(){
            $("#loginForm [name=email]").trigger('focus')
        });

        $("#joinModal").on('shown.bs.modal', function(){
            $("#joinForm [name=email]").trigger('focus')
        });

        $("#loginForm [name=email], #loginForm [name=password]").enterHandle($(".jLogin"));

        var check = -1;

        $(".jCheckEmail").click(function(){
            var email = $("[name=email]").val();
            if(email == "" || email == null){
                alert("이메일 입력 후 시도해 주시기 바랍니다.");
                return;
            }
            var ajax = new AjaxSender("<?=$CONST_URL_SHARED?>/shared/public/route.php?F=UserSVC.checkEmail", false, "json",
                new sehoMap().put("email", email));
            ajax.send(function(data){
                if(data.code === 1){
                    alert("사용 가능한 이메일입니다.")
                    $(".jCheckEmail").removeClass("btn-danger");
                    $(".jCheckEmail").addClass("btn-success");
                    check = 1;
                } else {
                    alert("이미 사용중인 이메일입니다.");
                    check = -1;
                }
            });
        });

        $(".jJoin").click(function(){
            if(check !== 1){
                alert("이메일 중복 확인 후 시도해 주시기 바랍니다.");
                return;
            }

            var ajax = new AjaxSubmit("<?=$CONST_URL_SHARED?>/shared/public/route.php?F=UserSVC.userJoin", "post", true, "json", "#joinForm");
            ajax.send(function(data){
                if(data.code === 1){
                    alert("가입되었습니다.");
                    location.reload();
                } else {
                    alert("가입 실패");
                }
            });
        });

        $(".jLogin").click(function(){
            var ajax = new AjaxSubmit("<?=$CONST_URL_SHARED?>/shared/public/route.php?F=UserSVC.userLogin", "post", true, "json", "#loginForm");
            ajax.send(function(data){
                if(data.code === 1){
                    location.reload();
                }else{
                    alert("일치하는 계정이 존재하지 않습니다.");
                }
            });
        });

        $(".jLogout").click(function(){
            var ajax = new AjaxSender("<?=$CONST_URL_SHARED?>/shared/public/route.php?F=UserSVC.userLogout", false, "json", new sehoMap());
            ajax.send(function(data){
                if(data.code === 1){
                    alert("로그아웃 되었습니다");
                    location.reload();
                }
            });
        })
    });
</script>


<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © Picklecode 2018</span>
        </div>
    </div>
</footer>

</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!--LOGIN MODAL-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">로그인</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">email</span>
                        </div>
                        <input type="text" class="form-control" name="email"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">password</span>
                        </div>
                        <input type="password" class="form-control" name="password"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary jLogin">로그인</button>
            </div>
        </div>
    </div>
</div>

<!--JOIN MODAL-->
<div class="modal fade" id="joinModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">회원가입</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="joinForm">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">email</span>
                        </div>
                        <input type="text" class="form-control" name="email"/>
                        <div class="input-group-append">
                            <span class="btn btn-danger jCheckEmail">중복확인</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">비밀번호</span>
                        </div>
                        <input type="password" class="form-control" name="password"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">이름</span>
                        </div>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">전화번호</span>
                        </div>
                        <input type="text" class="form-control" name="phone"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">주소</span>
                        </div>
                        <input type="text" class="form-control" name="addr"/>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">주소 상세</span>
                        </div>
                        <input type="text" class="form-control" name="addrDetail"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary jJoin">가입</button>
            </div>
        </div>
    </div>
</div>

<!--LOGOUT MODAL-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>

