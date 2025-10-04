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

<div class="home">
  
 	<div class="cover">
 		<div class="container d-flex h-100 align-items-center">
 			
 		
 			
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
 	
 
 <!-- End header -->
<!--  start products           -->
  <div class="features" >
    <div class="container d-flex h-100 align-items-center">
      <div class="row">
  


  

  
     
        
        <?php
            $getUser = $con->prepare("SELECT * FROM products LIMIT 12 ");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetchAll();
 
?>
  
 <?php
            foreach ($info as $inf) {
             
       ?>
     <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
      
            
       <?php $image=$inf['image'];// "" <img height=127 width=127 src="'.$inf ['image'].'"> ?>
            <a class="box" ><img href="products.php" src="<?php echo $inf['img']?>"  />
            </a>

        
              <h3><b style="text-align: center;"><?php echo $inf['prodectName']?></b></h3>
              <p>Price:<big style="color:#f0534c">$<?php echo $inf['price']?></big></p>
          
            </div>
               </form>
       
           <?php } ?>
      <a href="allProduct.php" class="href hrefButton container" title="More Brands">All Products</a>
      
        </div>
      </div>

     
<!--  End products           -->
  
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