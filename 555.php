<?php
                    //建立訂單查詢
                    $maxRows_rs = 5; //分頁設定數量
                    $pageNum_rs = 0; //起啟頁=0
                    if (isset($_GET['pageNum_order_rs'])) {
                        $pageNum_rs = $_GET['pageNum_order_rs'];
                    }
                    $startRow_rs = $pageNum_rs * $maxRows_rs;
                    $quertFirst = sprintf("SELECT *,uorder.create_date AS udate FROM uorder,addbook WHERE uorder.emailid='%d' AND uorder.addressid=addbook.addressid ORDER BY uorder.create_date DESC", $_SESSION['emailid']);
                    $query = sprintf("%s LIMIT %d,%d", $queryFirst, $startRow_rs, $maxRows_rs);
                    $order_rs = mysqli_query($link, $query);
                    $i = 1; //控制第一筆訂單開啟
?>
<?php if ($order_rs->num_rows != 0) {?>
 <?php $i++; 
                    } ?>
