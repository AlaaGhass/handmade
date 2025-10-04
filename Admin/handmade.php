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
  <a href="warning.php">تنبيهات</a><hr>
    <a href="message.php">الرسائل</a><hr>
         <a href="suggestion.php">الاقتراحات و الاراء</a><hr>
</div>
<!--  End navbar vetical  -->
<?php
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') { // Manage Members Page

			$query = '';

			if (isset($_GET['page']) && $_GET['page'] == 'shut') {

				$query = 'AND active = 0';

			}

			// Select All handmade 

			$stmt = $con->prepare("SELECT * FROM handmades WHERE Group_Id != 1 $query ORDER BY handmade_id DESC");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$rows = $stmt->fetchAll();

			if (! empty($rows)) {

			?>

			<h1 class="text-center"> ادارة الحرفين</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table manage-members text-center table table-bordered">
						<tr>
							
							<td>صورة الشخصية</td>
							<td>اسم المستخدم</td>
							<td>بريد الالكتروني</td>
							<td>الاسم الثلاثي</td>
							<td>رقم الهاتف</td>
							<td>العنوان</td>
							<td>رقم الهوية</td>
						</tr>
						<?php
							foreach($rows as $row) {
								echo "<tr>";
									
									echo "<td>";
									if (empty($row['Picture'])) {
										echo 'لا يوجد';
									} else {
										echo "<img src='uploads/avatars/" . $row['Picture'] . "' alt='' />";
									}
									echo "</td>";

									echo "<td>" . $row['UserName'] . "</td>";
									echo "<td>" . $row['Email'] . "</td>";
									echo "<td>" . $row['handmade_Name'] . "</td>";
									echo "<td>" . $row['Phone'] ."</td>";
									echo "<td>" . $row['address'] ."</td>";
									echo "<td>" . $row['identity'] ."</td>";
									echo "<td>
										<a href='handmade.php?do=Maseg&handmade_id=" . $row['handmade_id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> مراسلة </a>

										<a href='handmade.php?do=Delete&handmade_id=" . $row['handmade_id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";

										if ($row['active'] == 0) {
											echo "<a 
													href='handmade.php?do=Activate&handmade_id=" . $row['handmade_id'] . "' 
													class='btn btn-warning activate'style='color:#000'>
													<i class='fa fa-check'></i> تفعيل </a>";
										}elseif ($row['active'] == 1) {
										echo "<a 
													href='handmade.php?do=notActivate&handmade_id=" . $row['handmade_id'] . "' 
													class='btn btn-warning activate'style='color:#000'>
													<i class='fa fa-check'></i> تجميد </a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
					</table>
				</div>
				<a href="handmade.php?do=addHandmade" class="btn btn-primary container" style="width:90pt" style="margin-right: 850pt;">
					<i class="fa fa-plus"></i> اضافة حرفي
				</a>
			</div>

			<?php } else {

				echo '<div class="container" >';
					echo '<div class="alert alert-info" style="margin=20pt;">لا يوجد حرفيون</div>';
					echo '<a href="handmade.php?do=Add" class="btn btn-primary">
							<i class="fa fa-plus"></i> اضافة اصحاب حرف
						</a>';
				echo '</div>';

			} ?>

		<?php 
	/*  start add handMade user  */
		} elseif ($do == 'addHandmade') { // Add Page ?>
		<h1 class='text-center'>اضافة حساب حرفين</h1>
			<div class='container'>
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
               
                title="الرجاء ادخال الاسم الكامل"
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

            $username   = $_POST['username'];///
            $fullName   =$_POST['fullName'];
            $password   = $_POST['password'];
            $password2  = $_POST['password2'];
            $email      = $_POST['email'];
            $address      = $_POST['address'];
            $identity      = $_POST['identity'];
            $phone      = $_POST['phone'];

                   // Insert Userinfo In Database

                     $stmt = $con->prepare("INSERT INTO 
                                            handmades (UserName,handmade_Name,Password, Email,Phone,identity,address,active)
                                        VALUES(:zuser, :zFullName,:zpass, :zmail,:zphone,:zidentity,:zaddress,1)");
                    $stmt->execute(array(

                        'zuser'  => $username,
                        'zFullName'=>$fullName,
                        'zpass'  => $password,
                        'zmail'  => $email,
                        'zphone' => $phone,
                        'zidentity'=>$identity,
                        'zaddress' =>$address



                    ));

                    // Echo Success go page

                
                    header('Location:handmade.php');


                

            }
		?>			
<!--    End add handMade user  !-->
	<?php
	/*  start masege  */ 
		} elseif ($do == 'Maseg') {
echo "<h1 class='text-center'>المراسلات</h1>";
			echo "<div class='container'>";

		

		
/*  End masege  */ 
	/*  start Delete  */
		} elseif ($do == 'Delete') { 

			echo "<h1 class='text-center'>حذف حساب صاحب الحرف</h1>";
			echo "<div class='container'>";

			

				$handId = isset($_GET['handmade_id']) && is_numeric($_GET['handmade_id']) ? intval($_GET['handmade_id']) : 0;


				$statement = $con->prepare("SELECT handmade_id FROM handmades WHERE handmade_id = ?");

	        	$statement->execute(array($handId));

		        $check = $statement->rowCount();

		

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM handmades WHERE handmade_id = :zid");

					$stmt->bindParam(":zid", $handId);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم حذف الحساب</div>';
					header('Location:handmade.php?do=Manage');

				} else {

					$theMsg = '<div class="alert alert-danger">لا يوجد حساب لاسم المستخدم هذا</div>';
					

				

				}

			echo '</div>';

		} elseif ($do == 'Activate') {


			echo "<h1 class='text-center'>تفعيل الحرفين</h1>";
			echo "<div class='container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$handId = isset($_GET['handmade_id']) && is_numeric($_GET['handmade_id']) ? intval($_GET['handmade_id']) : 0;

				

			

			  $statement = $con->prepare("SELECT handmade_id FROM handmades WHERE handmade_id = ?");

	        	$statement->execute(array($handId));

		        $check = $statement->rowCount();
		        


				if ($check > 0) {

					$stmt = $con->prepare("UPDATE handmades SET active = 1 WHERE handmade_id = ?");

					$stmt->execute(array($handId));
					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم التفعيل</div>';
					header('Location:handmade.php?do=Manage');

				

					

		} else {

					$theMsg = '<div class="alert alert-danger">لا يوجد اسم مستخدم</div>';

					
				}

			echo '</div>';

		
		} elseif ($do == 'notActivate') {


			echo "<h1 class='text-center'>تفعيل الحرفين</h1>";
			echo "<div class='container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$handId = isset($_GET['handmade_id']) && is_numeric($_GET['handmade_id']) ? intval($_GET['handmade_id']) : 0;

				

			

			  $statement = $con->prepare("SELECT handmade_id FROM handmades WHERE handmade_id = ?");

	        	$statement->execute(array($handId));

		        $check = $statement->rowCount();
		        


				if ($check > 0) {

					$stmt = $con->prepare("UPDATE handmades SET active = 0 WHERE handmade_id = ?");

					$stmt->execute(array($handId));
					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . 'تم تجميد عملية البيع </div>';
					header('Location:handmade.php?do=Manage');

				

					

		} else {

					$theMsg = '<div class="alert alert-danger">لا يوجد اسم مستخدم</div>';

					
				}

			echo '</div>';

		}


	include 'includes/footer.php'; 
	//ob_end_flush();
	}else{
	header('Location:login.php');


		exit();
	
}
	ob_end_flush(); 

?>