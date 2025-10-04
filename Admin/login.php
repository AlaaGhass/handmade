
<?php
	ob_start();
	session_start();
	$pageTitle = 'Login';
	if (isset($_SESSION['userAdmin'])) {
		header('Location:index.php');
	}

    include 'unity.php';



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['login'])) {

            $user = $_POST['userAdmin'];
            $pass = $_POST['passwordAdmin'];
       


            $stmt = $con->prepare("SELECT 
                                        handmade_id, UserName, Password 
                                    FROM 
                                        handmades
                                    WHERE 
                                        Username = ? 
                                    AND 
                                        Password = ?
                                    AND
                                        Group_Id=1
                                    ");

            $stmt->execute(array($user, $pass));

            $get = $stmt->fetch();

            $count = $stmt->rowCount();

       

            if ($count > 0) {

               $_SESSION['userAdmin'] = $user; 
                $_SESSION['handmade_id'] = $get['handmade_Id']; 

                header('Location: index.php'); 

                exit();
            }
}
       
        }

    

?>	
<div class="page-login">
<div class="">

            
		
	
    <!-- Start Login Form -->
    <div class="limiter">
        <div class="form">
            
  
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="limiterLogin container">
                      <div id="container_demo" >
                 <h1 class="text-center">
   تسجيل دخول كمسؤول
       
    </h1> 
        <div class="input-container">
            <input 
                class="form-control" 
                type="text" 
                name="userAdmin" 
                autocomplete="off"
                placeholder="اسم المستخدم" 
                required />
        </div>
        <div class="input-container">

            <input 
                class="form-control" 
                type="password" 
                name="passwordAdmin" 
                autocomplete="new-password"
                placeholder="كلمة المرور" 
                required />
                <i class="fa-user-circle-o focus-input" aria-hidden="true"></i>
        </div>
     

        <input class="btn btn-primary btn-block" name="login" type="submit" value="تسجيل الدخول" />
    
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
?>