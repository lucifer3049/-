<?php require_once("Connections/conn_db.php"); ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once('php_lib.php'); ?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<!-- head -->
<?php require_once('headfile.php'); ?>
</head>

<body>
    <section id="header">
        <!-- 導覽列 -->
        <?php require_once('navbar.php'); ?>
    </section>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- 商品分類 -->
                    <?php require_once('sidebar.php'); ?>
                    <!-- 熱銷商品 -->
                    <?php require_once('hot.php'); ?>
                    
                </div>
                <!-- banner -->
                <div class="col-md-10">
                    <!-- 輪播廣告 -->
                    <?php require_once('carousel.php'); ?>
                    <hr>
                    <!-- 藥妝商品 -->
                    <?php require_once('product_list.php'); ?>
                </div>
            </div>
        </div>
    </section>
    <section id="scontent">
        <!-- 服務說明 -->
        <?php require_once('scontent.php'); ?>
    </section>
    <section id="footer">
        <!-- 頁尾-聯絡資訊 -->
        <?php require_once('footer.php'); ?>        
    </section>
        <!-- javascript file -->
        <?php require_once('jsfile.php'); ?>   
    
</body>

</html>