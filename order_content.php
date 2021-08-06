<?php
//建立訂單查詢
$maxRows_rs = 5; //分業設定數量
$pageNum_rs = 0; //起始頁0
if (isset($_GET['pageNum_order_rs'])) {
    $pageNum_rs = $_GET['pageNum_order_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;
$queryFirst = sprintf("SELECT *,uorder.create_date AS udate FROM uorder,addbook WHERE uorder.emailid='%d' AND uorder.addressid=addbook.addressid ORDER BY uorder.create_date DESC", $_SESSION['emailid']);
$query = sprintf("%s LIMIT %d,%d", $queryFirst, $startRow_rs, $maxRows_rs);
$order_rs = mysqli_query($link, $query);
$i = 1; //控制第一筆訂單開啟
?>
<h3>電商藥粧：訂單查詢</h3>
<?php if ($order_rs->num_rows != 0) { ?>
    <div class="accordion" id="accordion_order">
        <?php while ($data01 = mysqli_fetch_array($order_rs)) { ?>
            <div class="card">
                <div class="card-header" id="heading1<?php echo $i; ?>"><a data-toggle="collapse" href="#collapse1<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse1<?php echo $i; ?>s">
                        <div class="table-responsive-md">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td width="10%">訂單編號</td>
                                        <td width="20%">下單日期時間</td>
                                        <td width="15%">付款方式</td>
                                        <td width="15%">訂單狀態</td>
                                        <td width="10%">收件人</td>
                                        <td width="20%">地址</td>
                                        <td width="10%">備註</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data01['orderid']; ?></td>
                                        <td><?php echo $data01['udate']; ?></td>
                                        <td><?php echo epayCode($data01['howpay']); ?></td>
                                        <td><?php echo processCode($data01['status']); ?></td>
                                        <td><?php echo $data01['cname']; ?></td>
                                        <td><?php echo $data01['address']; ?></td>
                                        <td><?php echo $data01['renmark']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>
            <hr>
        <?php $i++;
        } ?>
    </div>
    <div class="row mt-2">
        <?php
        //處理訂單詳細商品資料列表
        $subQuery = sprintf("SELECT * FROM cart,product,product_img WHERE cart.orderid='%s' AND cart.p_id=product.p_id AND product.p_id=product_img.p_id AND product_img.sort='1' ORDER BY cart.create_date DESC", $data01['orderid']);
        $details_rs = mysqli_query($link, $subQuery);
        $ptotal = 0;
        ?>
        <div id="collapse1<?php echo $i; ?>" class="collapse<?php echo ($i == 1) ? 'show' : ''; ?>" aria-labelledby="heading1<?php echo $i; ?>" data-parent="#accordion_order">
            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <td width="10%">產品編號</td>
                                <td width="10%">圖片</td>
                                <td width="25%">名稱</td>
                                <td width="15%">價格</td>
                                <td width="10%">數量</td>
                                <td width="15%">小計</td>
                                <td width="15%">狀態</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data02 = mysqli_fetch_array($details_rs)) { ?>
                                <tr>
                                    <td><?php echo $data02['p_id']; ?></td>
                                    <td><img src="product_img/<?php echo $data02['img_file']; ?>" alt="<?php echo $data02['p_name']; ?>" class="img-fluid"></td>
                                    <td><?php echo $data02['p_name']; ?></td>
                                    <td>
                                        <h4 class="color_e600a0 pt-1"> $<?php echo $data02['p_price']; ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="color_e600a0 pt-1"><?php echo $data02['qty']; ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="color_e600a0 pt-1"> $<?php echo $data02['p_price'] * $data02['qty']; ?></h4>
                                    </td>
                                    <td><?php echo processCode($data02['status']); ?></td>
                                </tr>
                            <?php
                                $ptotal += $data02['p_price'] * $data02['qty'];
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">累計:<?php echo $ptotal; ?></td>
                            </tr>
                            <tr>
                                <td colspan="7">運費:100</td>
                            </tr>
                            <tr>
                                <td colspan="7" class="color_red">總計:<?php echo $ptotal + 100; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-info" role="alert">
        抱歉!目前還沒有任何訂單。
    </div>
<?php } ?>