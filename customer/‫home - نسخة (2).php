<?php

ob_start();
  //session_start();
  $pageTitle = 'handMade';

include 'unity.php';
 // include 'login.php';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['login'])) {

            $user = $_POST['username'];
            $pass = $_POST['password'];
            //$hashedPass = sha1($pass);

          

            $stmt = $con->prepare("SELECT 
                                        Cust_Id, UserName, Password 
                                    FROM 
                                        customer 
                                    WHERE 
                                        UserName = ? 
                                    AND 
                                        Password = ?");

            $stmt->execute(array($user, $pass));

            $get = $stmt->fetch();

            $count = $stmt->rowCount();

            // If Count > 0 This Mean The Database Contain Record About This Username

            if ($count > 0) {

               $_SESSION['UserName'] = $user; // Register Session Name

                $_SESSION['Cust_Id'] = $get['Cust_Id']; // Register User ID in Session

                header('Location: profile.php'); // Redirect To Dashboard Page

                exit();
            }
}


            }




  
?>
<!-- start header -->


 	<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="images/cover6.jpg" style="width:100%">
  
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="images/cover5.jpg" style="width:100%">
  
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="images/cover7.jpg" style="width:100%">
  
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
</div>
</div>
 		<!-- End header -->

 		<!-- start login -->	
    <form  class="limiterLogin container"  id="id01" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
        <div class="imgcontainer">

     <img src="images/user.png">

           <h1 class="text-center">
      مشتري </h1> 
       </div>
        <div class="input-container">
            <input 
                class="form-control" 
                type="text" 
                name="username" 
                autocomplete="off"
                placeholder="Type your username" 
                 />
        </div>
        <div class="input-container">

            <input 
                class="form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password"
                placeholder="Type your password" 
                 />
                <i class="fa-user-circle-o focus-input" aria-hidden="true"></i>
        </div>
        <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

        <input class="btn btn-primary btn-block" name="login" type="submit" value="Login" />
        <div class="text-center p-t-90">
                        <a class="txt1" href="#">
                            Forgot Password?
                        </a>.........
                        <a class="txt1" href="../employee/login.php">
                            login Handmade
                        </a>
                    </div>
              <a class="txt1" href="signup.php">..
                           انشاء حساب
                        </a> 
                              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </form>


      <i class="fa fa-chevron-down"  > </i>
      </span> 
 		</div>
 

 </div>
 	
  <!-- end login -->  
 <br><br><br>
<!--  start products           -->
  <div class="features" >
    <div class="container d-flex h-100 align-items-center">
      
  


   
   
       <form method="post" action="cart_update.php">

    
     <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/p3.png"/></a>
      <h3>جاكيت صوف</h3>
      <p>Price: 40$</p>
     </div>

        <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/p5.png"/></a>
      <h3>طقم اكسسوارات</h3>
      <p>Price: 23$</p>
     </div>

        <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/1.jpg"/></a>
      <h3>طباعة على مخده</h3>
      <p>Price: 20$</p>
     </div>
           <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/3.jpg"/></a>
      <h3>زينه</h3>
      <p>Price: 32$</p>
     </div>


     <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/5.jpg"/></a>
      <h3>فناجين قهوه</h3>
      <p>Price: 22$</p>
     </div>

     <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/2.jpg"/></a>
      <h3>كائس</h3>
      <p>Price: 12$</p>
     </div>
       <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/p14.png"/></a>
      <h3>زينه</h3>
      <p>Price: 10$</p>
     </div>
           <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/p18.png"/></a>
      <h3>تحف</h3>
      <p>Price: 10$</p>
     </div>
           <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c1.jpg"/></a>
      <h3>رسم حناء</h3>
      <p>Price: 100$</p>
     </div>

      <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c2.jpg"/></a>
      <h3>مدالية بيبي</h3>
      <p>Price: 20$</p>
     </div>

      <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c3.jpg"/></a>
      <h3>قمر مضيء</h3>
      <p>Price: 30$</p>
     </div>
        <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c4.jpg"/></a>
      <h3>حقيبة يد</h3>
      <p>Price: 70$</p>
     </div>
   <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c6.jpg"/></a>
      <h3>غطاء</h3>
      <p>Price: 17$</p>
     </div>
        <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c5.jpg"/></a>
      <h3>غطاء</h3>
      <p>Price: 22$</p>
     </div>
     <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/c7.jpg"/></a>
      <h3>مداليه</h3>
      <p>Price: 30$</p>
     </div>
      <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      <a class="box" ><img src="images/p12.png"/></a>
      <h3>مجسم</h3>
      <p>Price: 90$</p>
     </div>
   </form>
  
     
        
        <?php
            $getUser = $con->prepare("SELECT * FROM products LIMIT 12 ");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetchAll();
 
?>
  



        
      <a href="allProduct.php" class="href hrefButton container" title="More Brands">All Products</a>
      
        </div>
      </div>
    </div>
  </div>
  <!--     !-->
  
<br>
 <!-- Contact Section -->
  <section class="contact-section bg-black">
    <div class="container">

      <div class="row">

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="glyphicon glyphicon-map-marker text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Address</h4>
              <hr class="my-4">
              <div class="small text-black-50">Palestine</div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="glyphicon glyphicon-envelope text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Email</h4>
              <hr class="my-4">
              <div class="small text-black-50">
                <a href="#">handmade@gmail.com</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fa fa-mobile text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Phone</h4>
              <hr class="my-4">
              <div class="small text-black-50">056999999</div>
            </div>
          </div>
        </div>
      </div>

    
      

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
      Copyright &copy; Your Website 2019
    </div>
  </footer>
</div>
</div>
<?php
	include 'includes/footer.php';
	ob_end_flush();
?>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>