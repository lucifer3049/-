<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="gotop.js"></script>
<script type="text/javascript">
    //navbar的三層選單
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

    //產品頁切換主圖功能
    $(function(){
        //定義在滑鼠滑過圖片即將圖片檔名填入主圖src中
        $(".card .row.mt-2 .col-md-4 a").mouseover(function(){
            var imgsrc = $(this).children("img").attr("src");
            $("#showGoods").attr({"src":imgsrc});
        });
        // 將子圖片放到lightBox展示
        $(".card .row.mt-2 .col-md-4 a").lightBox({maxHeight:$(window).height()*0.9, maxWidth:$(window).width()*0.9});
    });


</script>
<script type="text/javascript" src="jslib.js"></script>