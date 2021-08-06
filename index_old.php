<?php require_once("Connections/conn_db.php"); ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once('php_lib.php'); ?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電商藥粧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/website_s01.css">
</head>

<body>
    <section id="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <img src="./images/logo.jpg" class="img-fluid rounded-circle" alt="電商藥粧">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                //列出導覽列第一層
                $SQLstring = "SELECT * FROM pyclass WHERE level = 1 order by sort";
                $pyclass01 = mysqli_query($link, $SQLstring);
            ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle">產品資訊</a>
                        <ul class="dropdown-menu">
                        <?php while ($pyclass01_Rows = mysqli_fetch_array($pyclass01)) { ?>
                            <li class="dropdown-item dropdown-submenu">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa <?php echo $pyclass01_Rows['fonticon']; ?> fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?></a>
                                <?php
                                // 列出導覽列第二層
                                $SQLstring = "SELECT * FROM pyclass WHERE level = 2 and uplink =" . $pyclass01_Rows['classid'] . " order by sort";
                                $pyclass02 = mysqli_query($link, $SQLstring);
                                ?>
                                <ul class="dropdown-menu">
                                <?php while ($pyclass02_Rows = mysqli_fetch_array($pyclass02)) { ?>
                                    <li class="dropdown-item"><em class="fa <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><a href="#"><?php echo $pyclass02_Rows['cname']; ?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">會員註冊</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">會員登入</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">會員中心</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">最新活動</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">查訂單</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">折價券</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">購物車</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            企業專區
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">認識企業文化</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">全台門市資訊</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">供應商報價服務</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">加盟專區</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">投資人專區</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar">
                        <form action="" name="id" method="get">
                            <div class="input-group">
                                <!-- search -->
                                <input type="text" name="search_name" class="form-control" placeholder="Search...">
                                <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search fa-lg"></i></button></span>
                            </div>
                        </form>
                    </div>
                    <?php
                    //列出產品類別第一層
                    $SQLstring = "SELECT * FROM pyclass WHERE level = 1 order by sort";
                    $pyclass01 = mysqli_query($link, $SQLstring);
                    $i = 1; //控制編號順序
                    ?>
                    <div class="accordion" id="accordionExample">
                        <?php while ($pyclass01_Rows = mysqli_fetch_array($pyclass01)) { ?>
                            <div class="card">
                                <div class="card-header" id="headingOne<?php echo $i; ?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>" style="font-size: x-large;">
                                            <i class="fa <?php echo $pyclass01_Rows['fonticon']; ?> fa-lg fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?>
                                        </button>
                                    </h2>
                                </div>
                                <?php
                                // 列出產品第二層
                                $SQLstring = "SELECT * FROM pyclass WHERE level = 2 and uplink =" . $pyclass01_Rows['classid'] . " order by sort";
                                $pyclass02 = mysqli_query($link, $SQLstring);
                                ?>
                                <div id="collapseOne<?php echo $i; ?>" class="collapse<?php echo ($i == 1) ? 'show' : ''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <?php while ($pyclass02_Rows = mysqli_fetch_array($pyclass02)) { ?>
                                                    <td><em class="fa <?php echo $pyclass02_Rows['fonticon']; ?>"></em><a href="#"><?php echo $pyclass02_Rows['cname']; ?></a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php $i++;
                        } ?>
                    </div>
                    <?php
                    //建立熱銷商品查詢
                    $SQLstring = "SELECT * FROM hot, product, product_img WHERE hot.p_id = product_img.p_id AND hot.p_id = product.p_id AND product_img.sort = 1 ORDER BY h_sort";
                    $hot = mysqli_query($link, $SQLstring);
                    ?>
                    <div class="card text-center mt-3" style="border: none;">
                        <div class="card-body">
                            <h3 class="card-title">站長推薦，熱銷商品</h3>
                        </div>
                        <?php while ($data = mysqli_fetch_array($hot)) { ?>
                            <img src="./product_img/<?php echo $data['img_file']; ?>" alt="HOT<?php echo $data['h_sort']; ?>" title="<?php echo $data['p_name']; ?>" class="card-img-top">
                        <?php } ?>
                    </div>
                </div>
                <!-- banner -->
                <div class="col-md-10">
                    <?php
                    //建立輪播查詢
                    $SQLstring = "SELECT * FROM carousel WHERE caro_online = 1 ORDER BY caro_sort";
                    $carousel = mysqli_query($link, $SQLstring);
                    $i = 0; //控制active啟動
                    ?>
                    <div class="row">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                for ($i = 0; $i < $carousel->num_rows; $i++) {
                                ?>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $i; ?>" class="<?php echo activeShow($i, 0); ?>"></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                $i = 0;
                                while ($data = mysqli_fetch_array($carousel)) {
                                ?>
                                    <div class="carousel-item <?php echo activeShow($i, 0); ?>">
                                        <img src="./product_img/<?php echo $data['caro_pic']; ?>" class="d-block w-100" alt="<?php echo $data['caro_title']; ?>">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h3><?php echo $data['caro_title']; ?></h3>
                                            <p><?php echo $data['caro_content']; ?></p>
                                        </div>
                                    </div>
                                <?php $i++;
                                } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <?php
                    //建立商品分頁功能
                    $maxRows_rs = 12; //分頁設定數量
                    $pageNum_rs = 0; //起始頁=0
                    if (isset($_GET['pageNum_rs'])) {
                        $pageNum_rs = $_GET['pageNum_rs'];
                    }
                    $startRow_rs = $pageNum_rs * $maxRows_rs;

                    //列出產品資料查詢
                    $queryFirst = sprintf("SELECT * FROM product, product_img WHERE p_open = 1 AND product_img.sort = 1 AND product.p_id = product_img.p_id ORDER BY product.p_id DESC");
                    $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
                    $pList01 = mysqli_query($link, $query);
                    $i = 1; //控制每列row產生
                    ?>
                    <?php while ($pList01_rows = mysqli_fetch_array($pList01)) { ?>
                        <?php if ($i % 4 == 1) { ?>
                            <div class="row text-center">
                            <?php } ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="./product_img/<?php echo $pList01_rows['img_file'] ?>" alt="<?php echo $pList01_rows['p_name'] ?>" title="<?php echo $pList01_rows['p_name'] ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $pList01_rows['p_name'] ?></h5>
                                        <p class="card-text"><?php echo mb_substr($pList01_rows['p_intro'], 0, 30, "utf-8"); ?></p>
                                        <p><?php echo $pList01_rows['p_price'] ?></p>
                                        <a href="#" class="btn btn-primary">更多資訊</a> <a href="#" class="btn btn-success">放購物車</a>
                                    </div>
                                </div>
                            </div>
                            <?php if ($i % 4 == 0 || $i == $pList01->num_rows) { ?>
                            </div>
                        <?php } ?>
                    <?php $i++;
                    } ?>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <?php
                            //取得目前頁數
                            if (isset($_GET['totalRows_rs'])) {
                                $totalRows_rs = $_GET['totalRows_rs'];
                            } else {
                                $all_rs = mysqli_query($link, $queryFirst);
                                $totalRows_rs = mysqli_num_rows($all_rs);
                            }
                            $totalPages_rs = ceil($totalRows_rs / $maxRows_rs) - 1;
                            ?>
                            <?php
                            //呼叫分頁功能
                            $prev_rs = "&laquo;";
                            $next_rs = "&raquo;";
                            $separator = "|";
                            $max_links = 20;
                            $pages_rs = buildNavigation($pageNum_rs, $totalPages_rs, $prev_rs, $next_rs, "rs", $separator, $max_links, true, 3);
                            ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="scontent">
        <div class="container-fluid">
            <div id="aboutme" class="row text-center">
                <div class="col-md-2 col-lg-2 col-xs-12">
                    <img src="./images/Qrcode02.png" alt="QRCODE" class="img-fluid mx-auto">
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12">
                    <i class="far fa-thumbs-up fa-5x"></i>
                    <h3>關於我們</h3>
                    關於我們<br>
                    企業官網<br>
                    招商專區<br>
                    人才招募<br>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12">
                    <i class="fa fa-truck fa-5x"></i>
                    <h3>特色服務</h3>
                    大宗採購方案<br>
                    直配內地<br>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12">
                    <i class="fa fa-users fa-5x"></i>
                    <h3>客戶服務</h3>
                    訂單/配送進度查詢<br>
                    取消訂單/退貨<br>
                    更改配送地址<br>
                    追蹤清單<br>
                    12H速達服務<br>
                    折價券說明<br>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12">
                    <i class="far fa-money-bill-alt fa-5x"></i>
                    <h3>好康大放送</h3>
                    新會員禮包<br>
                    活動得獎名單<br>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12">
                    <i class="fa fa-question fa-5x"></i>
                    <h3>FAQ 常見問題</h3>
                    系統使用問題<br>
                    產品問題資詢<br>
                    大宗採購問題<br>
                    聯絡我們<br>
                </div>
            </div>
        </div>
    </section>
    <section id="footer">
        <div class="container-fluid">
            <div id="last-data" class="row text-center">
                <div class="col-md-12">
                    <h6>中彰投分署科技股份有限公司 40767台中市西屯區工業區一路100號 電話：04-23592181 免付費電話：0800-777888</h6>
                    <h6>企業通過ISO/IEC27001認證，食品業者登錄字號：A-127360000-00000-0</h6>
                    <h6>版權所有 copyright © 2017 WDA.com Inc. All Rights Reserved.</h6>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="gotop.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.dropdown-submenu>a').on("click", function(e) {
                var submenu = $(this);
                $('.dropdown-submenu .dropdown-menu').removeClass('show');
                submenu.next('.dropdown-menu').addClass('show');
                e.stopPropagation();
            });

            $('.dropdown').on("hidden.bs.dropdown", function() {
                $('.dropdown-menubar.show').removeClass('show');
            });
        });
    </script>
    <?php
    function activeShow($num, $chkPoint)
    {
        return (($num == $chkPoint) ? "active" : "");
    }
    ?>
</body>

</html>