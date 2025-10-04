	<?php

	ob_start(); 
	session_start();

	$pageTitle = 'Admin';

	if (isset($_SESSION['userAdmin'])) {

		include 'unity.php';
?>
<!--  Start navbar vetical  -->
<div class="vertical-menu col-lg-1 col-md-1 col-sm-1 col-xs-1" style="background-color: #000;color: #fff;">
   <a href="index.php" class="active">Home</a>
  <a href="customer.php"> حسابات المشترين</a><hr>
  <a href="handmade.php?do=Manage&page=shut">اصحاب الحرف الغير مفعلين</a><hr>
  <a href="handmade.php">ادارة اصحاب الحرف</a><hr>
  <a href="#">تنبيهات</a><hr>
    <a href="#">الرسائل</a><hr>
       <a href="suggestion.php">الاقتراحات و الاراء</a><hr>
</div>
<!--  End navbar vetical  -->
<?php
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			$query = '';

		$stmt = $con->prepare("SELECT * FROM customer  ORDER BY Cust_Id DESC");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$rows = $stmt->fetchAll();

			if (! empty($rows)) {

			?>

			<h1 class="text-center"> ادارة حسابات المشترين</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table manage-members text-center table table-bordered">
						<tr>
							
							<td>اسم المستخدم</td>
							<td>بريد الالكتروني</td>
							<td>الاسم الثلاثي</td>
							<td>رقم الهاتف</td>
							<td>العنوان</td>
							<td>المدينة</td>
							<td>رقم الهوية</td>
						</tr>
						<?php
							foreach($rows as $row) {
								echo "<tr>";
									echo "<td>" . $row['UserName'] . "</td>";
									echo "<td>" . $row['Email'] . "</td>";
									echo "<td>" . $row['FullName'] . "</td>";
									echo "<td>" . $row['Phone'] ."</td>";
									echo "<td>" . $row['Adress'] ."</td>";
									echo "<td>" . $row['City'] ."</td>";
									echo "<td>" . $row['identity'] ."</td>";
									echo "<td>
										<a href='customer.php?do=Maseg&Cust_Id=" . $row['Cust_Id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> مراسلة </a>

										<a href='customer.php?do=Delete&Cust_Id=" . $row['Cust_Id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
					</table>
				</div>
				<?php }
				?>
				<a href="customer.php?do=addCustomer" class="btn btn-primary container" style="width:90pt" style="margin-right: 850pt;">
					<i class="fa fa-plus"></i> اضافة حساب مشتري
				</a>
			</div>

<?php
} elseif ($do == 'Delete') { 

			echo "<h1 class='text-center'>حذف حساب المشتري</h1>";
			echo "<div class='container'>";

			

				$custId = isset($_GET['Cust_Id']) && is_numeric($_GET['Cust_Id']) ? intval($_GET['Cust_Id']) : 0;


				$statement = $con->prepare("SELECT Cust_Id FROM customer WHERE Cust_Id = ?");

	        	$statement->execute(array($custId));

		        $check = $statement->rowCount();

		

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM customer WHERE Cust_Id = :zid");

					$stmt->bindParam(":zid", $custId);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم حذف الحساب</div>';
					header('Location:customer.php?do=Manage');

				} else {

					//$theMsg = '<div class="alert alert-danger">لا يوجد حساب لاسم المستخدم هذا</div>';
					

				

				}

			echo '</div>';

		} elseif ($do == 'addCustomer') { // Add Page ?>
		<h1 class='text-center'>اضافة مشتري</h1>
			<div class='container'>";
				<!-- Start Signup Form -->
 <div class="limiter " style="text-align: right;">
    
    <form  action="?do=add" method="POST" class="limiterLogin " style="text-align: right;" >
 
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
                minlength="20"
                title="الرجاء ادخال الاسم الثلاثي"
                class="form-control" 
                type="text" 
                name="fullName" 
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
                name="city" 
                autocomplete="off"
                placeholder="المدينة"
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

</div>
</form>
<!--End form signup  -->
	<?php 

		} elseif ($do == 'add') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $formErrors = array();

            $username    = $_POST['username'];
            $password    = $_POST['password'];
            $email        = $_POST['email'];
            $address      = $_POST['address'];
            $identity      = $_POST['identity'];
            $phone         = $_POST['phone'];
             $city        = $_POST['city'];
             $fullName    =$_POST['fullName'];

                   // Insert Userinfo In Database

                     $stmt = $con->prepare("INSERT INTO 
                                            customer (UserName,Password, Email,Phone,identity,Adress,City,fullName)
                                              VALUES(:zuser ,:zpass, :zmail,:zphone,:zidentity,:zaddress,:zCity,:zfullName)");
                    $stmt->execute(array(

                        'zuser'  => $username,
                        'zfullName' =>$fullName,
                        'zpass'  => $password,
                        'zmail'  => $email,
                        'zphone' => $phone,
                        'zidentity'=>$identity,
                        'zaddress' =>$address,
                        'zCity'=>$city



                    ));

                    // Echo Success go page

                
                    header('Location:customer.php');


                

            }
			}

	include 'includes/footer.php'; 
	//ob_end_flush();
	}else{
	header('Location:login.php');


		exit();
	
}
	ob_end_flush(); 

?>