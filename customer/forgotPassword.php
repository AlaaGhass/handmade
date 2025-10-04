<?php
  include 'unity.php';
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		    if ($do == 'Manage') {

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //include 'unity.php';
            $user = $_POST['user'];
            $email = $_POST['email'];
       


            $stmt = $con->prepare("SELECT 
                                        Cust_Id, UserName, Email,Password
                                    FROM 
                                       customer
                                    WHERE 
                                       UserName = ? 
                                    AND 
                                        Email = ?
                                 
                                    ");

            $stmt->execute(array($user, $email));

            $get = $stmt->fetch();

            $count = $stmt->rowCount();

       

            if ($count > 0) {

              //echo "string";

              //  header('Location: index.php'); 
              $to      = $email;
              $pass=$get['Password'];
              $messages= "كلمة الرور الخاصه بك هي " .$get['Password'];
$subject = 'handmademessages@gmail.com ';
$message = $messages;
$headers = 'From: HandMade' . "\r\n" .
    'Reply-To: handmademessages@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

                exit();
            }else{
            	echo "الايميل أو اسم المستخدم غير صحياً";
            }

       
        }


    

?>	
<div class="page-login">
<div class="">

            
		
	
    <!-- Start Login Form -->
    <div class="limiter" style="height:100%;">
        <div class="form">
            
  
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="limiterLogin container" style="background-color: #000;margin-left: 40%;margin-top: 10%">
                      <div id="container_demo" >
                 <h1 class="text-center">
   هل نسيت كلمة المرور
       
    </h1> 
     <div class="input-container">

            <input 
                class="form-control" 
                type="text" 
                name="email" 
               
                placeholder="ادخل اسم المستخدم" 
            />
                <i class="fa-user-circle-o focus-input" aria-hidden="true"></i>
        </div>
        <div class="input-container">
            <input 
                class="form-control" 
                type="text" 
                name="user" 
                autocomplete="off"
                placeholder="أدخل بريدك الأكتروني" 
               />
        </div>
       
     

        <input class="btn btn-primary btn-block" name="login" type="submit" value="ارسال" />
    
    </form>
</div>
</div>
    <!-- End Login Form -->



                </div>  
            </section>
        </div>

<?php 
include 'includes/footer.php';
	ob_end_flush();


}elseif ($do=='do') {
	
                  ?>
             <div class="alert alert-success" role="alert">
             	<h1>تم إنشاء حسابك بنجاح <a href="home.php">تسجيل الدخول</a></h1>
             </div>
                  <?php
}
?>