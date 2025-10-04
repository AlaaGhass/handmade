
<?php
    ob_start();
    session_start();
    $pageTitle = 'Login';
    if (isset($_SESSION['userHand'])) {
        header('Location:profile.php');
    }

    include 'unity.php';



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['login'])) {

            $user = $_POST['userHand'];
            $pass = $_POST['passwordHand'];
       


            $stmt = $con->prepare("SELECT 
                                        handmade_id, UserName, Password 
                                    FROM 
                                        handmades
                                    WHERE 
                                        UserName = ? 
                                    AND 
                                        Password = ?
                                    AND
                                        Group_Id=0
                                    ");

            $stmt->execute(array($user, $pass));

            $get = $stmt->fetch();

            $count = $stmt->rowCount();

       

            if ($count > 0) {

               $_SESSION['userHand'] = $user; 
                $_SESSION['handmade_id'] = $get['handmade_id']; 

                header('Location:profile.php'); 

                exit();
            }else{
                 echo '<div class="alert alert-danger">';
               echo '<h1>' , 'كلمة المرور خاطئة ','</h1>'; echo '<h1>' , 'هل تود','<a href="signup.php">انشاء حساب </a>','</h1>';
              echo '</div>';
            }
}
       
        }

    

?>  



            
        
    
    <!-- Start Login Form -->
    <div class="limiter" style="width: 100%">
                   
            
   
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="limiterLogin ">
            

     <img src="images/user.png" class="" style="margin-left: 50pt">

           <h1 class="text-center">
      اصحاب الحرف الصغيرة </h1> 
       
        <div class="input-container  ">
            <input 
                class="form-control" 
                type="text" 
                name="userHand" 
                autocomplete="off"
                placeholder="اسم المستخدم" 
                 />
        </div>
        <div class="input-container">

            <input 
                class="form-control" 
                type="password" 
                name="passwordHand" 
                autocomplete="new-password"
                placeholder="كلمة المرور" 
                />
                <i class="fa-user-circle-o focus-input" aria-hidden="true"></i>
        </div>
       

        <input class="btn btn-primary btn-block" name="login" type="submit" value="تسجيل الدخول" />
        <div class="text-center p-t-90">
                        <a class="txt1" href="forgotPassword.php">
                            هل نسيت كلمة المرور?
                        </a>
                        <br>
                             <a class="txt1" href="signup.php">
                            هل تود انشاء حساب
                        </a>
                    </div>
    </form>
</div>
</div>
    <!-- End Login Form -->



                </div>  
         
        </div>

<?php 
include 'includes/footer.php';
    ob_end_flush();
?>