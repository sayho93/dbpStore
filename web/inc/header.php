<?
    include_once $_SERVER["DOCUMENT_ROOT"].  "/shared/bases/Configs.php";
    $conf = new Configs();
    include_once $_SERVER["DOCUMENT_ROOT"]. $conf->PF_URL_PATH_SHARED . "/shared/public/innerRoute.php";
    $introPress = new innerRoute();
?>

<?
    $obj = new UserSVC($_REQUEST);
    $list = $obj->categoryList();

    $CONST_URL_WEB = $conf->PF_URL_PATH_WEB;
    $CONST_URL_SHARED = $conf->PF_URL_PATH_SHARED;

    $CONST_PROJECT_NAME = "AppStore";
    $CONST_TITLE_POSTFIX = " :: 깨끗하고 빠른 의견수렴 서비스";

    $user = $obj->currentUserInfo();

?>
<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <link href="<?=$CONST_URL_WEB?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$CONST_URL_WEB?>/css/sb-admin.css" rel="stylesheet">
    <link href="<?=$CONST_URL_WEB?>/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="<?=$CONST_URL_WEB?>/js/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="<?=$CONST_URL_WEB?>/js/bootstrap.min.js"></script>



    <script type="text/javascript" src="<?=$CONST_URL_SHARED?>/shared/modules/ajaxCall/ajaxClass.js"></script>
    <script type="text/javascript" src="<?=$CONST_URL_SHARED?>/shared/modules/sehoMap/sehoMap.js"></script>
    <script type="text/javascript" src="<?=$CONST_URL_SHARED?>/shared/modules/utils/PValidation.js"></script>
    <script type="text/javascript" src="<?=$CONST_URL_SHARED?>/shared/modules/valueSetter/sayhoValueSetter.js"></script>



</head>

<script>
    $(document).ready(function(){
        initProcess();


        function initProcess(){
            var ajax = new AjaxSender("<?=$CONST_URL_SHARED?>/shared/public/route.php?F=UserSVC.categoryList", false, "json", new sehoMap());
            ajax.send(function(data){
                if(data.code !== 1){
                    alert("데이터 로드중 오류가 발생하였습니다.");
                }
            });
        }
    });
</script>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="<?=$CONST_URL_WEB?>">AppStore</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-5">
        <div class="input-group">
            <input type="text" class="form-control" name="searchTxt" placeholder="검색">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Navbar -->
    <div class="ml-auto">
        <ul class="navbar-nav float-right mr-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                    <?=$user != "" ? $user->name . "(" . $user->email . ") 님" : ""?>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <?if($user  == ""){?>
                        <a class="dropdown-item" data-toggle="modal" data-target="#loginModal">로그인</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#joinModal">회원가입</a>
                    <?}else{?>
                        <a class="dropdown-item jLogout">로그아웃</a>
                    <?}?>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div id="wrapper">
    <ul class="sidebar navbar-nav">
        <?foreach($list["data"] as $item){?>
            <li class="nav-item active">
                <a class="nav-link" href="<?=$CONST_URL_WEB?>/index.php?categoryId=<?=$item["id"]?>">
                    <i class="fas fa-fw <?=$item["fa-icon"]?>"></i>
                    <span>&nbsp;<?=$item["desc"]?>&nbsp;</span>
                </a>
            </li>
        <?}?>
    </ul>

    <div id="content-wrapper">