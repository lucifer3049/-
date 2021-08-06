<li class="nav-item align-self-center dropdown">
    <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle">產品資訊</a>
    <ul class="dropdown-menu">
        <?php while ($pyclass01_Rows = mysqli_fetch_array($pyclass01)) { ?>
            <li class="dropdown-item dropdown-submenu">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"> <i class="fa <?php echo $pyclass01_Rows['fonticon']; ?>  fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?></a>
                <?php
                //列出產品第二列
                $SQLstring = "SELECT * FROM pyclass where level=2 and  uplink= $pyclass01_Rows[classid] order by sort";
                $pyclass02 = mysqli_query($link, $SQLstring);
                ?>
                <ul class="dropdown-menu">
                    <?php while ($pyclass02_Rows = mysqli_fetch_array($pyclass02)) { ?>
                        <li class="dropdown-item"><em class="fa <?php echo $pyclass02_Rows['fonticon']; ?>"></em><a href="#">
                                <?php echo $pyclass02_Rows['cname']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</li>