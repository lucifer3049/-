<?php require_once('Connections/conn_db.php'); ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once('php_lib.php'); ?>
<?php
// 結帳強制轉向登入
if (!isset($_SESSION['login'])) {
    $sPath = "login.php?sPath=checkout";
    header(sprintf("Location: %s", $sPath));
}
?>
<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 引入標頭網頁 -->
    <?php require_once('headfile.php'); ?>
</head>

<body>
    <section id="header">
        <!-- 引入導覽列 -->
        <?php require_once('navbar.php'); ?>
        <style type="text/css">
            .table td,
            .table th {
                padding: .75rem;
                vertical-align: top;
                border-bottom: none;
                border-top: 1px solid #dee2e6;
            }
        </style>
    </section>

    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- 產品類別 -->
                    <?php require_once('sidebar.php'); ?>
                    <!-- 熱銷商品 -->
                    <?php require_once('hot.php'); ?>
                </div>
                <div class="col-md-10">
                    <!-- 結帳主頁 -->
                    <?php require_once('chkout_content.php'); ?>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="scontent">
        <!-- 服務說明 -->
        <?php require_once('scontent.php'); ?>
    </section>
    <section id="footer">
        <!-- 聯絡資訊 -->
        <?php require_once('footer.php'); ?>
    </section>
    <!-- javascript檔 -->
    <?php require_once('jsfile.php'); ?>
    <script src="text/javascript">
        $(function() {
            //取得縣市碼後查詢鄉鎮市名稱放入#myTown
            $('#myCity').change(function() {
                var CNo = $('#myCity').val();
                $.ajax({
                    url: 'Town_ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        CNo: CNo
                    },
                    success: function(data) {
                        if (data.c == true) {
                            $('#myTown').html(data.m);
                        } else {
                            alert("Database reponse error:" + data.m);
                        }
                    },
                    error: function(data) {
                        alert("ajax request error");
                    }
                });
            });
            //選鄉鎮市後，查詢郵遞區號放入#myZip,#add_label
            $('#myTown').change(function() {
                var AutoNo = $('#myTown').val();
                $.ajax({
                    url: 'Zip_ajax01.php',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        AutoNo: AutoNo
                    },
                    success: function(data) {
                        if (data.c == true) {
                            $('#myzip').val(data.Post);
                            $('#add_label').html('郵遞區號:' + data.Post + data.Cityname + data.Name);
                        } else {
                            alert("Database reponse error:" + data.m);
                        }
                    },
                    error: function(data) {
                        alert("ajax request error");
                    }
                });
            });
        });
        //收件人程序js
        $('#recipient').click(function() {
            var validate = 0,
                msg = "";
            var cname = $("#cname").val();
            var mobile = $("#mobile").val();
            var myzip = $('#myzip').val();
            var address = $('#address').val();
            if (cname == "") {
                msg = msg + "收件人不得為空白！;\n";
                validate = 1;
            }
            if (mobile == "") {
                msg = msg + "電話不得為空白!;\n";
                validate = 1;
            }
            if (myZip == "") {
                msg = msg + "郵遞區號不得為空白!;\n";
                validate = 1;
            }
            if (address == "") {
                msg = msg + "地址不得為空白!;\n";
                validate = 1;
            }
            if (validate) {
                alert(msg);
                return false;
            }
            //新增收件人寫入資料庫
            $.ajax({
                url: 'addbook.php',
                type: 'post',
                dataType: 'json',
                data: {
                    cname: cname,
                    mobile: mobile,
                    myZip: myZip,
                    address: address,
                },
                success: function(data) {
                    if (data.c == true) {
                        window.location.reload();
                    } else {
                        alert("Database reponse error:" + data.m);
                    }
                },
                error: function(data) {
                    alert("ajax request error");
                }
            });
        });
        //更換收件人處理程序
        $('input[name=gridRadios]').change(function() {
            var addressid = $(this).val();
            $.ajax({
                url: 'changeaddr.php',
                type: 'post',
                dataType: 'json',
                data: {
                    addressid: addressid,
                },
                success: function(data) {
                    if (data.c == true) {
                        alert(data.m);
                        window.location.reload();
                    } else {
                        alert("Database reponse error : " + data.m);
                    }
                },
                error: function(data) {
                    alert("ajax request error");
                }
            });
        });
        //系統進行結帳處理
        $('#btn04').click(function() {
            let msg = "系統將進行結帳處理，請確認產品金額與收件人是否正確!";
            if (!confirm(msg)) return false;
            $("#loading").show();
            var addressid = $('input[name=gridRadios]:checked').val();
            debugger;
            $.ajax({
                url: 'addorder.php',
                type: 'post',
                dataType: 'json',
                data: {
                    addressid: addressid,
                },
                success: function(data) {
                    if (data.c == true) {
                        alert(data.m);
                        window.location.href = "index.php";
                    } else {
                        alert("Database reponse error:" + data.m);
                    }
                },
                error: function(data) {
                    alert("ajax request error");
                }
            });
        });
    </script>
    <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%"></i>
    </div>
</body>

</html>