<?php
    ob_start();
    session_start();
    $pageTitle = 'signup';
    if (isset($_SESSION['UserName'])) {
        header('Location: home.php');
    }
    include 'unity.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $formErrors = array();

            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $password2  = $_POST['password2'];
            $email      = $_POST['email'];
            $fullName   = $_POST['fullName'];
            $phone   = $_POST['phone'];
            $city   = $_POST['city'];
            $address   = $_POST['address'];
            $identity   = $_POST['identity'];

            if (isset($username)) { //user is min in 4 characters

                $filterUser = filter_var($username, FILTER_SANITIZE_STRING);

                if (strlen($filterUser) < 5) {

                    echo  'لا يمكن للاسم ان يكون اقل من خمس حروف';

                }

            }

            if (isset($password) && isset($password2)) {

                if (empty($password)) { //Do you password is empty?

                    echo  'لا يمكن لكلمة المرور انن تكون فارغة'; // print message password is empty

                }

                if (sha1($password) !== sha1($password2)) {

                   echo  'لا يوجد تطابق بكلمات المرور';

                }

            }

            if (isset($email)) {

                $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

                if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {

                   echo  'هذا البريد غير صحيح';

                }

            }

            

            if (empty($formErrors)) {

               

               // $check = checkItem("UserName", "customer", $username);
        

            // If Count > 0 This Mean The Database Contain Record About This Username

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

                    // Insert User In Database

                    $stmt = $con->prepare("INSERT INTO 
                                            customer(UserName, Password, Email,identity,Phone,FullName,City,Adress)
                                        VALUES(:cuser, :cpass, :cmail , :zidentity, :cPhone,:cfullName,:ccity,:caddress)");     
                    $stmt->execute(array(

                        'cuser' => $username,      //values html username
                        'cpass' => $password,    //values html password
                        'cmail' => $email ,
                        'zidentity'=> $identity,
                        'cPhone' =>   $phone,
                        'cfullName'=>  $fullName,
                        'ccity'=>   $city ,
                        'caddress'=> $address


                                     //values html email

                    ));

                    //  Success Insert
 //     echo'<div class="alert alert-success" role="alert">';
                    echo "<h1>","تم إنشاء حسابك بنجاح ","<a herf='login.php'>قم بتسجيل الدخول</a>","</h1>";
             
                  //  echo "</div>";
                   // $succesMsg = 'Congrats You Are Now Registerd User';
              header('Location:forgotPassword.php?do=do');


                }

            }

        }

?>
<!-- Start Signup Form -->
 <div class="limiter ">

    <form class="limiterLogin " action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" style="background-color: #000">
         <div class="imgcontainer">

     
         <h2 class="text-center">
        انشاء حساب مشتري
       </h2> 
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
           <div class="input-container">
            <input 
               minlength="15"
                class="form-control" 
                type="text" 
                name="fullName" 
                autocomplete="off"
                placeholder="ادخل الاسم الكامل" 
                required
                 />
        <span class="asterisk">  </span>
        </div>
               <div class="input-container">
            <input 
               minlength="10"
                class="form-control" 
                type="text" 
                name="phone" 
                autocomplete="off"
                placeholder="رقم الهاتف" 
                required
                 />
        <span class="asterisk">  </span>
        </div>
        <div class="input-container">
            <input 
             
                class="form-control" 
                type="text" 
                name="city" 
                autocomplete="off"
                placeholder="المدينة" 
                required
                 />
        <span class="asterisk">  </span>
        </div>
             <div class="input-container">
            <input 
              
                class="form-control" 
                type="text" 
                name="address" 
                autocomplete="off"
                placeholder="العنوان" 
                required
                 />
        <span class="asterisk">  </span>
        </div>
                  <div class="input-container">
            <input 
               minlength="9"
                class="form-control" 
                type="text" 
                name="identity" 
                autocomplete="off"
                placeholder="رقم الهوية" 
                required
                 />
        <span class="asterisk">  </span>
        </div>
        <div class="input-container ">
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
        <div class="input-container">
            <input 
                minlength="4"
                class="form-control " 
                type="password" 
                name="password2" 
                autocomplete="new-password"
                placeholder=" تأكيد كلمة المرور " 
                required
                 />
        <span class="asterisk">  </span>
        </div>
        <div class="input-container">
            <input 
                class="form-control" 
                type="email" 
                name="email" 
                placeholder=" بريد الالكتروني "
                required />
       <span class="asterisk">  </span>
        </div>
        <input class="btn  btn-block" name="signup" type="submit" value="Signup" />

          <div class="text-center p-t-90">
         <a class="txt1" href="../Handmade/signup.php">
                          انشاء حساب صاحب حرف
                        </a>
                    </div>
              <a class="txt1" href="home.php">
                           تسجيل الدخول
                        </a> 
    </form>
</div>

    <!-- End Signup Form -->