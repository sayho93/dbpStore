<?include_once "inc/header.php";?>
<?
    $categoryInfo = $obj->categoryInfo();

    $appList = $obj->appList();
?>

<script>
    $(document).ready(function(){

    });
</script>

    <div id="content-wrapper">

        <div class="container-fluid">

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a><?=$categoryInfo["data"]["desc"]?></a>
                </li>
            </ol>

            <div class="row">

                <?foreach($appList["data"] as $item){?>
                    <div class="col-xl-2 col-sm-3 mb-3">
                        <div class="card text-dark bg-white o-hidden h-100">
                            <div class="card-body text-center p-0">
                                <img src="<?=URL_PATH_WEB?>/img/PickleCode_logo.png" width="90%" height="50%"/>
                                <h5><?=$item["appTitle"]?></h5>
                                <p><?=$item["desc"]?></p>
                            </div>
                            <a class="card-footer text-dark clearfix small z-1" href="#">
                                <span class="float-left">View Details</span>
                                <span class="float-right"><i class="fas fa-angle-right"></i></span>
                            </a>
                        </div>
                    </div>
                <?}?>

            </div>
        </div>

<?include_once "inc/footer.php"?>
