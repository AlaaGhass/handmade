<?php
    ob_start();
    session_start();
    $pageTitle = 'signup';
    if (isset($_SESSION['userHand'])) {
        header('Location: profile.php');
    }
    include 'unity.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $formErrors = array();

            $username   = $_POST['username'];
            $name      =$_POST['name'];
            $password   = $_POST['password'];
            $password2  = $_POST['password2'];
            $email      = $_POST['email'];
            $address      = $_POST['address'];
            $identity      = $_POST['identity'];
            $phone      = $_POST['phone'];

            if (isset($username)) {

                $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

                if (strlen($filterdUser) < 4) {

                    $formErrors[] = 'Username Must Be Larger Than 4 Characters';

                }

            }

            if (isset($password) && isset($password2)) {

                if (empty($password)) {

                    $formErrors[] = 'Sorry Password Cant Be Empty';

                }

                if (sha1($password) !== sha1($password2)) {

                    $formErrors[] = 'Sorry Password Is Not Match';

                }

            }

            if (isset($email)) {

                $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

                if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {

                    $formErrors[] = 'This Email Is Not Valid';

                }

            }

            // Check If There's No Error Proceed The User Add

            if (empty($formErrors)) {
?>
   
<div class="alert alert-danger" role="alert">هذا الحساب موجود بالفعل</div>
               

              <?php
 $stmtL = $con->prepare("SELECT    UserName
                                    FROM 
                                        handmades
                                    WHERE 
                                        UserName = ? 
                                  
                                    ");

            $stmtL->execute(array($user));

            $getL = $stmtL->fetch();

            $countL = $stmtL->rowCount();

       

            if ($countL > 0) {
                echo "<h1 >", "اسم المستخدم هذا موجود بالفعل" ,"</h1>";
            }else{
                    // Insert Userinfo In Database

                    $stmt = $con->prepare("INSERT INTO 
                                            handmades (UserName,handmade_Name,Password, Email,Phone,identity,address)
                                        VALUES(:zuser,:zname, :zpass, :zmail,:zphone,:zidentity,:zaddress)");
                    $stmt->execute(array(

                        'zuser'  => $username,
                        'zname' =>$name,
                        'zpass'  => $password,
                        'zmail'  => $email,
                        'zphone' => $phone,
                        'zidentity'=>$identity,
                        'zaddress' =>$address



                    ));

                    // Echo Success Message

                 //   $succesMsg = 'Congrats You Are Now Registerd User';
                 
                    header('Location:forgotPassword.php?do=do');
                   


                }}

            }

        

?>
<!-- Start Signup Form -->
   <div class="limiter" style="width: 100%;">
    
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="limiterLogin ">
       <div class="">

    

           <h1 class="text-center">
      انشاء حساب صاحب حرف </h1> 
       </div>
        <div class="input-container ">
            <input 
                pattern=".{4,}"
                title="Username Must Be Between 4 Chars"
                class="form-control" 
                type="text" 
                name="username" 
                autocomplete="off"
                placeholder="اسم المستخدم" 
                required
                 />
               <span class="asterisk">  </span>  
    
        </div>
         <div class="input-container ">
            <input 
               
                
                class="form-control" 
                type="text" 
                name="name" 
                autocomplete="off"
                placeholder="الاسم الثلاثي" 
                required
                 />
               <span class="asterisk">  </span>  
    
        </div>
        <div class="input-container  ">
            <input 
                minlength="4"
                class="form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password"
                placeholder=" كلمة المرور " 
                required
                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input 
                minlength="4"
                class="form-control" 
                type="password" 
                name="password2" 
                autocomplete="new-password"
                placeholder=" تأكيد كلمة المرور " 
                required
                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input 
                class="form-control" 
                type="email" 
                name="email" 
                placeholder=" بريد الالكتروني "
                required />
                 <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input 
                class="form-control" 
                type="text" 
                name="phone" 
                autocomplete="off"
                placeholder="رقم الهاتف" 
                required
                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input
                class="form-control" 
                type="text" 
                name="address" 
                autocomplete="off"
                placeholder=" العنوان" 
                required

                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container  ">

            <input
                class="form-control" 
                type="text" 
                name="identity" 
                autocomplete="off"
                placeholder="رقم الهوية" 
                required
                
                 />
                  <span class="asterisk">  </span>  
        </div>
        <input class="btn  btn-block" name="signup" type="submit" value="Signup" />

          <div class="text-center p-t-90">
         <a class="txt1" href="login.php">
                            Login Handmade
                        </a>
                    </div>
              <a class="txt1" href="../customer/home.php">
                           تسجيل الدخول
                        </a> 

</div>


<?php

  


    include 'includes/footer.php';
    ob_end_flush();
    ?>