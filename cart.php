<?php require_once("Connections/conn_db.php"); ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once('php_lib.php'); ?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <!-- head -->
    <?php require_once('headfile.php'); ?>
    <style type="text/css">
        table input:invalid {
            border: solid red 3px;
        }
    </style>
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
                    <!-- 購物車內容模組 -->
                    <?php require_once('cart_content.php'); ?>
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
    <script type="text/javascript">
        $("#cartForm1 input").change(function() {
            var qty = $(this).val();
            const cartid = $(this).attr("cartid");
            if (qty <= 0 || qty >= 50) {
                alert("更改數量需大於0以上，以及小於50以下。");
                return false;
            }
            //將變更的數量寫入後台資料庫
            $.ajax({
                url: 'change_qty.php',
                type: 'post',
                dataType: 'json',
                data: {
                    cartid: cartid,
                    qty: qty,
                },
                success: function(data) {
                    if (data.c == true) {
                        // alert(data.m);
                        window.location.reload();
                    } else {
                        alert(data.m);
                    }
                },
                error: function(data) {
                    alert("系統目前無法連接到後台資料庫");
                }
            });
        });
    </script>
</body>

</html>