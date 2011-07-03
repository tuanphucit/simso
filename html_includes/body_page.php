
  <body>
        <div id="header">
            <div id="banner"><!-- Phần này đang để background -->

            </div><!-- End #banner -->
            <div id="menu">
                <ul>
                    <li><a href="<?=$_URL_BASE?>/index.php">Trang chủ</a></li>
                    <li><a href="<?=$_URL_BASE?>/index.php/8/Vinaphone">Vinaphone</a></li>
                    <li><a href="<?=$_URL_BASE?>/index.php/9/Mobifone">Mobiphone</a></li>
                    <li><a href="<?=$_URL_BASE?>/index.php/7/Viettel">Viettel</a></li>
                    <li><a href="<?=$_URL_BASE?>/index.php/index.php/41/Vietnamobile">Vietnamobile</a></li>
                    <li><a href="<?=$_URL_BASE?>/index.php/3/tin-tuc">Tin Tức</a></li>
                    <li><a href="<?=$_URL_BASE?>/index.php/2/huong-dan-mua-sim">Hướng dẫn mua sim</a></li>
					<li><a href = "<?=$_URL_BASE?>/index.php/5/thanh-toan"> Hướng dẫn thanh toán</a></li>
                </ul>
            </div><!-- End #menu -->
            
			
			<div id="top1"><!-- phần này chứa ô tìm kiếm và slideshow ảnh -->
                <div id="top1-left">
                    <form name="searchFrom" onSubmit="return doSubmitsearchForm()" action="<?=$_URL_BASE?>/index.php/timkiem" method="post">
                        <div>
			<input type="text" id="searchKeyword" name="searchKeyword" value="<?=$define["var_nhaptukhoa"]?>" onblur="if(this.value=='')this.value='<?=$define["var_nhaptukhoa"]?>';" onfocus="if(this.value=='<?=$define["var_nhaptukhoa"]?>')this.value='';">


                    <!--        <input class="search-input" type="text" name="search" /> -->
                           <input class="search-button" type="submit" name="submit" value="Tìm kiếm" />
                        </div>
                        <div>
                            <input type="radio" name="a" />
                            <label>10 số</label>
                            <input type="radio" name="b" />
                            <label>11 số</label>
                            <input type="radio" name="c" />
                            <label>Tất cả các loại</label>
							
                        </div>
                    </form>
                    <p>* Để tìm sim bắt đầu bằng 0935, quý khách nhập vào <a href="#">0935*</a></p>
                    <p>* Để tìm sim có đuôi là 88 và có đầu số 098, nhập vào <a href="#">098*88</a></p>
                </div><!-- End #top1-left -->
                <div id="top1-right">
                    <img name="slideshow1" alt="slideshow" src="<?=$_IMG_DIR?>/slideshow1.gif" />
                    <img name="slideshow2" alt="slideshow" src="<?=$_IMG_DIR?>/slideshow2.gif" />
                    <img name="slideshow3" alt="slideshow" src="<?=$_IMG_DIR?>/slideshow3.jpg" />
                    <img name="slideshow4" alt="slideshow" src="<?=$_IMG_DIR?>/slideshow4.gif" />
                    <img name="slideshow5" alt="slideshow" src="<?=$_IMG_DIR?>/slideshow5.jpg" />
                    <div class="number-list">
                        <a name="slideshow1">1</a>
                        <a name="slideshow2">2</a>
                        <a name="slideshow3">3</a>
                        <a name="slideshow4">4</a>
                        <a name="slideshow5">5</a>
                    </div>
                </div><!-- End #top1-right -->
            </div><!-- End #top1 -->
           


		   <div id="top2"><!-- phần này show ra các loại sim và đặt sim theo yêu cầu -->
                <div class="top2-box top2-box1">
                    <p>Tìm nhanh theo loại</p>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>

                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>

                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                    <a href="#">Sim năm sinh</a>
                </div>
                <div class="top2-box top2-box2">
                    <p>Tìm nhanh theo giá tiền</p>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                    <a href="#">10 triệu -> 50 triệu</a>
                </div>
                <div class="top2-box top2-box3">
                    <p>Tìm nhanh theo đầu số</p>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>

                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                </div>
                <div class="top2-box top2-box4">
                    <a class="top2-box4-title" href="#">Đặt sim theo yêu cầu</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>

                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                    <a href="#">Số đẹp 0123</a>
                </div>
            </div><!-- End #top2 -->
        </div><!-- End #header -->
        <div id="middle">
            <? if(is_file("$contentFile")) require_once("$contentFile");?>
            </div><!-- End #middle-content -->
            <div id="middle-right">
                <div id="middle-right1" class="right sim-list"><!-- đây là phần sim đẹp đặc biệt -->
                    <a class="first">Sim đẹp đặc biệt</a>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <p><a href="#">0987 654 321</a><span>3,000,000,000</span></p>
                    <a class="last" href="#">Xem thêm &raquo;</a>
                </div><!-- End #middle-right1 -->
                <div id="middle-right2" class="right sim-list"><!-- phần các đơn hàng mới *chỉ có phần này là fix chiều cao để chứa phần thông tin chạy lên -->
                   
                    
                         <?php include "$_HTML_DIR/danhsachkhachhang.php";?>
                    
                </div><!-- End #middle-right2 -->
                <div id="middle-right3"><!-- phần tin tức -->
                    <?php include "$_HTML_DIR/tinmoi.php";?>
                </div><!-- End #middle-right3 -->
            </div><!-- End #middle-right -->
            <div class="clear"></div>
        </div><!-- End #middle -->
        <div id="footer">
            <div id="footer-nav">
                <p class="footer-nav-title">Sim số đẹp &ndash; giá sinh viên</p>
                <div class="sim-list">
                    <a class="first">Sim đẹp đặc biệt</a>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                     <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <a class="last" href="#">Xem thêm &raquo;</a>
                </div>
                <div class="sim-list">
                    <a class="first">Sim đẹp đặc biệt</a>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                     <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <a class="last" href="#">Xem thêm &raquo;</a>
                </div>
                <div class="sim-list">
                    <a class="first">Sim đẹp đặc biệt</a>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                     <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <a class="last" href="#">Xem thêm &raquo;</a>
                </div>
                <div class="sim-list">
                    <a class="first">Sim đẹp đặc biệt</a>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                     <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <p><a href="#">0987 654 321</a><span>160,000</span></p>
                    <a class="last" href="#">Xem thêm &raquo;</a>
                </div>
                <div class="adv"><!-- Phần này chứa các flash quảng cáo -->
                    <embed height="120" width="210" type="application/x-shockwave-flash" 
                           src="images/adv.swf" 
                           pluginspage="http://www.macromedia.com/go/getflashplayer" 
                           wmode="transparent" play="true" quality="high" />
                    <embed height="120" width="210" type="application/x-shockwave-flash" 
                           src="images/adv.swf" 
                           pluginspage="http://www.macromedia.com/go/getflashplayer" 
                           wmode="transparent" play="true" quality="high" />
                    <embed height="120" width="210" type="application/x-shockwave-flash" 
                           src="images/adv.swf" 
                           pluginspage="http://www.macromedia.com/go/getflashplayer" 
                           wmode="transparent" play="true" quality="high" />
                </div>
            </div><!-- End #footer-nav -->
            <div id="footer-info"><!-- Phần cuối cùng của trang chứa tên trang web, bản quyền, thông tin địa chỉ ... -->
                <div>
                    <a class="no1" href="#">Trang chủ</a>
                    <a class="no2">www.simsodep.com - Đẹp từ A đến Z</a>
                    <a class="no3" href="#">Lên đầu trang &uArr;</a>
                </div>
                <p>Sim số đẹp từ A đến Z</p>
                <p>Phát triển bới eTeam.vn</p>
                <p>Địa chỉ : abc Hà Nội. Điện thoại : 0123456789</p>
            </div><!-- End #footer-info -->
        </div><!-- End #footer -->
    </body>
