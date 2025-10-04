
<?php
	ob_start();
	session_start();
	$pageTitle = 'Login';
	if (isset($_SESSION['UserName'])) {
		header('Location:home.php');
	}
	include 'unity.php';


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
            }elseif ($count = 0) {
              header('Location: signup.php');
            }
           
}


            }

        

    

?>	



    
   <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>


<!-- Start Login Form -->
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


    <!-- End Login Form -->



         
    
        

<?php 
include 'includes/footer.php';
	ob_end_flush();
?>