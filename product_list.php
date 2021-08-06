<?php
//建立商品分頁功能
$maxRows_rs = 12; //分頁設定數量
$pageNum_rs = 0; //起始頁=0
if (isset($_GET['pageNum_rs'])) {
    $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;
if(isset($_GET['search_name'])){
    $queryFirst = sprintf("SELECT * FROM product, product_img, pyclass WHERE p_open = 1 AND product_img.sort = 1 AND product.p_id = product_img.p_id AND product.classid = pyclass.classid AND (product.p_name LIKE '%s' OR product.p_price LIKE '%s' OR product.p_intro LIKE '%s') ORDER BY product.p_id DESC", '%'.$_GET['search_name'].'%', '%'.$_GET['search_name'].'%', '%'.$_GET['search_name'].'%');
}elseif(isset($_GET['level']) && $_GET['level']==1) {
    //使用第一層類別查詢
    $queryFirst = sprintf("SELECT * FROM product, product_img, pyclass WHERE p_open = 1 AND product_img.sort = 1 AND product.p_id = product_img.p_id AND product.classid = pyclass.classid AND pyclass.uplink='%d' ORDER BY product.p_id DESC", $_GET['classid']);
}elseif(isset($_GET['classid'])) {
    //列出產品類別查詢
    $queryFirst = sprintf("SELECT * FROM product, product_img WHERE p_open = 1 AND product_img.sort = 1 AND product.p_id = product_img.p_id AND product.classid = '%d' ORDER BY product.p_id DESC", $_GET['classid']);
} else {
    //列出所有產品資料查詢
    $queryFirst = sprintf("SELECT * FROM product, product_img WHERE p_open = 1 AND product_img.sort = 1 AND product.p_id = product_img.p_id ORDER BY product.p_id DESC");
}
$query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
$pList01 = mysqli_query($link, $query);
$i = 1; //控制每列row產生
?>

<?php if ($pList01->num_rows != 0) { ?>
    <?php while ($pList01_rows = mysqli_fetch_array($pList01)) { ?>
        <?php if ($i % 4 == 1) { ?>
            <div class="row text-center">
            <?php } ?>
            <div class="col-md-3">
                <div class="card">
                    <a href="goods.php?p_id=<?php echo $pList01_rows['p_id']; ?>">
                        <img src="./product_img/<?php echo $pList01_rows['img_file'] ?>" alt="<?php echo $pList01_rows['p_name'] ?>" title="<?php echo $pList01_rows['p_name'] ?>" class="card-img-top">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pList01_rows['p_name'] ?></h5>
                        <p class="card-text"><?php echo mb_substr($pList01_rows['p_intro'], 0, 30, "utf-8"); ?></p>
                        <p><?php echo 'NT$'.$pList01_rows['p_price'] ?></p>
                        <a href="goods.php?p_id=<?php echo $pList01_rows['p_id']; ?>" class="btn btn-primary">更多資訊</a> 
    <!-- <a href="#" class="btn btn-success">放購物車</a> -->
    <button type="button" id="button01[]" name="button01[]" class="btn btn-success" onclick="addcart(<?php echo $pList01_rows['p_id']; ?>)">放購物車</button>
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
<?php } else { ?>
    <div class="alert alert-danger" role="alert">
        抱歉，目前沒有相關產品。
    </div>
<?php } ?>