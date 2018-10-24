<?include_once $_SERVER["DOCUMENT_ROOT"]. "/shared/bases/Const.php";?>

<?

    $list = UserSVC::categoryList();
    echo json_encode($list);

    $CONST_PROJECT_NAME = "풀링폴링";
    $CONST_TITLE_POSTFIX = " :: 깨끗하고 빠른 의견수렴 서비스";

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

    <link href="<?=URL_PATH_WEB?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=URL_PATH_WEB?>/css/sb-admin.css" rel="stylesheet">
    <link href="<?=URL_PATH_WEB?>/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="<?=URL_PATH_WEB?>/js/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="<?=URL_PATH_WEB?>/js/bootstrap.min.js"></script>

    <script src="<?=URL_PATH_WEB?>/js/sb-admin.min.js"></script>

    <script type="text/javascript" src="<?=URL_PATH_SHARED?>/shared/modules/ajaxCall/ajaxClass.js"></script>
    <script type="text/javascript" src="<?=URL_PATH_SHARED?>/shared/modules/sehoMap/sehoMap.js"></script>
    <script type="text/javascript" src="<?=URL_PATH_SHARED?>/shared/modules/utils/PValidation.js"></script>
    <script type="text/javascript" src="<?=URL_PATH_SHARED?>/shared/modules/valueSetter/sayhoValueSetter.js"></script>
</head>

<script>
    $(document).ready(function(){
        initProcess();


        function initProcess(){
            var ajax = new AjaxSender("<?=URL_PATH_SHARED?>/shared/public/route.php?F=UserSVC.categoryList", false, "json", new sehoMap());
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

    <a class="navbar-brand mr-1" href="<?=URL_PATH_WEB?>">AppStore</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-5">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="검색">
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
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Login</a>
                    <a class="dropdown-item" href="#">Join</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div id="wrapper">
    <ul class="sidebar navbar-nav">




        <li class="nav-item active">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=1">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>게임</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=2">
                <i class="fas fa-fw fa-child"></i>
                <span>키즈</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=3">
                <i class="fas fa-fw fa-heartbeat"></i>
                <span>건강/운동</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=4">
                <i class="fas fa-fw fa-book-open"></i>
                <span>교육</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=5">
                <i class="fas fa-fw fa-money-bill"></i>
                <span>금융</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=6">
                <i class="fas fa-fw fa-sun"></i>
                <span>날씨</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=7">
                <i class="fas fa-fw fa-cogs"></i>
                <span>생산성</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH_WEB?>/index.php?categoryId=8">
                <i class="fas fa-fw fa-comments"></i>
                <span>소셜</span></a>
        </li>
    </ul>