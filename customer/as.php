<?php
	ob_start();
	session_start();
	
	include 'connect.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['login'])) {

            $email = $_POST['email'];
            $pass = $_POST['pass'];
            //$hashedPass = sha1($pass);

          echo"1";

            $stmt = $con->prepare("SELECT 
                                        id, email, password 
                                    FROM 
                                        user 
                                    WHERE 
                                        email = ? 
                                    AND 
                                      password = ?");

            $stmt->execute(array($email, $pass));

            $get = $stmt->fetch();

            $count = $stmt->rowCount();
            echo"2";
            // If Count > 0 This Mean The Database Contain Record About This Username
            //header('Location:profile.php'); // Redirect To Dashboard Page
            if ($count > 0) {

            $_SESSION['UserName'] = $email; // Register Session Name

              $_SESSION['id'] = $get['id']; // Register User ID in Session

                header('Location:profile.php'); // Redirect To Dashboard Page

                exit();
            }elseif ($count = 0) {
              header('Location:signup.php');
            }
           
}


            }

        

    

?>	
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['doctor'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];
    //$hashedPass = sha1($pass);

  echo"1";

    $stmt = $con->prepare("SELECT 
                                id, email, pas 
                            FROM 
                            doctor 
                            WHERE 
                                email = ? 
                            AND 
                              pas = ?");

    $stmt->execute(array($email, $pass));

    $get = $stmt->fetch();

    $count = $stmt->rowCount();
    echo"2";
    // If Count > 0 This Mean The Database Contain Record About This Username
    //header('Location:profile.php'); // Redirect To Dashboard Page
    if ($count > 0) {

    $_SESSION['UserName'] = $email; // Register Session Name

      $_SESSION['id'] = $get['id']; // Register User ID in Session

        header('Location:profiledr.php'); // Redirect To Dashboard Page

        exit();
    }elseif ($count = 0) {
      header('Location:signupdr.php');
    }
   
}


    }





?>	
  <div id="blog" class="our-blog section">
    <div class="container">
      <div class="row">
        <div class=" col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h4></h2>
           
            <img src="assets/images/image.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
            <form id="contact" action="" method="post" name="doctor">
              <h4><span>دخول الاطباء الى النظام </span> </h4><br>
                <div class="row">
                <div class="col-lg-12">
                    <fieldset>
                      <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="البريد الالكتروني" required="">
                    </fieldset>
                  </div>

                  <div class="col-lg-12">
                    <fieldset>
                      <input type="password" name="password" id="name" placeholder="كلمة المرور" autocomplete="on" required>
                    </fieldset>
                  </div>
               
                
                  <div class="col-lg-12">
                   
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="main-button ">تسجيل الدخول</button>
                    </fieldset>
                  </div>
                </div>
                <div class="contact-dec">
                  <img src="assets/images/contact-decoration.png" alt="">
                </div>
                <a href="signupdr.php">انشاء حساب</a>
              </form>
        </div>
      </div>
    </div>
  </div>