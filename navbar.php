<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="index.php">
        <img src="./images/logo.jpg" class="img-fluid rounded-circle" alt="電商藥粧">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    //讀取後台購物車cart內產品數量
    $SQLstring = "SELECT * FROM cart WHERE orderid IS NULL AND ip ='".$_SERVER['REMOTE_ADDR']."';";
    $cart_rs = mysqli_query($link, $SQLstring);

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
                            // 列出產品第二層
                            $SQLstring = "SELECT * FROM pyclass WHERE level = 2 and uplink =" . $pyclass01_Rows['classid'] . " order by sort";
                            $pyclass02 = mysqli_query($link, $SQLstring);
                            ?>
                            <ul class="dropdown-menu">
                                <?php while ($pyclass02_Rows = mysqli_fetch_array($pyclass02)) { ?>
                                    <li class="dropdown-item"><em class="fa <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><a href="drugstore.php?classid=<?php echo $pyclass02_Rows['classid']; ?>"><?php echo $pyclass02_Rows['cname']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">會員註冊</a>
            </li>
<?php if(isset($_SESSION['login'])){ ?>
<li class="nav-item">
    <a class="nav-link" href="#" onclick="btn_confirmLink('請確定是否要登出','logout.php');" >會員登出</a>
</li>
<?php } else { ?>
<li class="nav-item">
    <a class="nav-link" href="login.php">會員登入</a>
</li>
<?php } ?>    
            <li class="nav-item">
                <a class="nav-link" href="#">會員中心</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">最新活動</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orderlist.php">查訂單</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">折價券</a>
            </li>
            <li class="nav-item">
<a class="nav-link" href="cart.php">購物車<span class="badge badge-info"><?php echo ($cart_rs)?$cart_rs->num_rows:''; ?></span></a>
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