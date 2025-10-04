<?php

	ob_start(); 
	session_start();
$pageTitle = $_SESSION['userHand'];



	if (isset($_SESSION['userHand'])) {

		  include 'unity.php';
?>

<?php
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page

		if ($do == 'Manage') {
		

	$stmt = $con->prepare("SELECT * FROM category ");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$rows = $stmt->fetchAll();

			

			?>
			<h1 class="text-center"  style='color:#000;'> ادارة الفئات</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table manage-members text-center table table-bordered"  style='color:#000;border-style: #000'>
						<tr>
							
							<td>ID</td>
							<td>اسم الفئة</td>
					
						</tr>
						<?php
							foreach($rows as $row) {
								echo "<tr>";

									echo "<td>" . $row['Category_ID'] . "</td>";
									echo "<td>" . $row['Category_Name'] . "</td>";
									echo "<td>
									<a href='categories.php?do=Delete&ID=" . $row['Category_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف </a>";
													echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
					</table>
				</div>
				<a href="categories.php?do=addCat" class="btn btn-primary container" style="width:90pt" style="margin-right: 850pt;">
					<i class="fa fa-plus"></i> اضافة فئات
				</a>
			</div>
			<?php 
	/*  start add handMade user  */
		} elseif ($do == 'addCat') { // Add Page ?>
		
			<div class='container'  style='color:#000;'>
				<!-- Start Signup Form -->
 <div class=" " style="text-align: right;">
    
    <form  action="?do=add" method="POST" class="limiterLogin " style="text-align: right;" >
 <h1 class='text-center'>اضافة فئة جديدة</h1>
        <div class="input-container ">
            <input 
            
                class="form-control" 
                type="text" 
                name="name" 
                autocomplete="off"
                placeholder="ادخل اسم الفئة" 
                required
                 />
             
    
        </div>
                <input class="btn  btn-block" name="signup" type="submit" value="حفظ" />

</div>
</form>
<?php 

		} elseif ($do == 'add') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	   $name   = $_POST['name'];///
 $stmt = $con->prepare("INSERT INTO 
                                            category (Category_Name)
                                        VALUES(:zname)");
                    $stmt->execute(array(

                        'zname'  => $name
                    ));

                    header('Location:categories.php');
}
}elseif ($do == 'Delete') {
	echo "<h1 class='text-center' style='color:#000;'>حذف عضو</h1>";
			echo "<div class='container'>";

			

				$Id = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;


				$statement = $con->prepare("SELECT Category_ID FROM category WHERE Category_ID = ?");

	        	$statement->execute(array($Id));

		        $check = $statement->rowCount();

		

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM category WHERE Category_ID = :zid");

					$stmt->bindParam(":zid", $Id);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم الحف بنجاح</div>';
					header('Location:categories.php?do=Manage');

				} else {

					$theMsg = '<div class="alert alert-danger">لا يوجد حساب لاسم المستخدم هذا</div>';
					

				

				}

			echo '</div>';
}}