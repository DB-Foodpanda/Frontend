<!DOCTYPE html>
<html lang="zxx">

<head>
    <a href=""></a>
    <meta charset="UTF-8">
    <meta name="description" content="Home Template">
    <meta name="keywords" content="Home, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Foodpanda</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
<?php
    
    session_start();
    require('../shopping/connect.php');
    if(empty($_SESSION["cus_username"] && $_SESSION["cus_password"])){
        header("location:../index.php");
    }
    $mesql = " SELECT * FROM `food` JOIN food_type
    ON food.food_type = food_type.type_id
    ";
    $meQuery = mysqli_query($meConnect,$mesql);
    $meResult = mysqli_fetch_array($meQuery);
    $mesql1 = "SELECT * FROM `shop`";
    $meQuery1 = mysqli_query($meConnect,$mesql1);
    // $meResult1 = mysqli_fetch_array($meQuery1);
?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo_fpd.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header__top__right__auth">
                        <a href="../edit.php">
                            <?php
                                $cus_username = $_SESSION["cus_username"];
                                echo $cus_username;
                            ?> </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="../shopping/shop.php"><i class="fa fa-home"></i></a></li>
                            <li><a href="../shopping/monitor_order.php?order_status=1"><i class="fa fa-check-circle"></i></a></li>
                            <li><a href="../shopping/cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <a href="../website/logout.php" style="color: #000000">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero" >
        <div class="container" >

            <div class="row">
                <div class="col-lg-6 ">
                    <br>
                
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel ">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/dessert.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=5?> ">Desserts</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/chicken.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=4?> ">Chicken</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/thai.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=1?> ">Thai</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/coffee.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=2?> ">Coffee & Tea</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/sushi.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=8?> ">Japanese</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/bakery.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=3?> ">Bakery</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/fastfood.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=7?> ">Fastfood</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/korean.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=9?> ">Korean</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/steak.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=6?> ">Steak</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/drink.jpg">
                            <h5><a href="../shopping/index.php?type=<?=$meResult['type_id']=10?> ">Drink</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    
    <section class="featured spad">
        <div class="container">
            
            <div class="row featured__filter">
            <?php while($meResult1 = mysqli_fetch_array($meQuery1)):?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg">
                        <img src="../Shop/myfile/<?php echo $meResult1['shop_image'];?>" width="316px" height="270px" border="0">
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="../shopping/index_2.php?shop=<?php echo $meResult1["shop_username"];?>"><?php echo $meResult1['shop_name'];?></a></h6>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
        </div>
    </section>
   
    <!-- Featured Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo_fpd.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 2034/88 Italthai, 2034 Phetchaburi Rd, Huai Khwang, Bangkok 10310</li>
                            <li>Phone: +66 (0)2-250-9281-2</li>
                            <li>Email: contact@foodpanda.co.th</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn" style= "background: deeppink">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by Foodpanda
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>