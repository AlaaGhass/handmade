<?php

	ob_start();
	session_start();
	$pageTitle = $_SESSION['userAdmin'];
	
	
	if (isset($_SESSION['userAdmin'])) {
	include 'unity.php';

		?>
<div class="vertical-menu col-lg-1 col-md-1 col-sm-1 col-xs-1" style="background-color: #000;color: #fff;">
  <a href="index.php" class="active">Home</a>
  <a href="customer.php"> حسابات المشترين</a><hr>
  <a href="handmade.php?do=Manage&page=shut">اصحاب الحرف الغير مفعلين</a><hr>
  <a href="handmade.php">ادارة اصحاب الحرف</a><hr>
  <a href="warning.php">تنبيهات</a><hr>
    <a href="message.php">الرسائل</a><hr>
    <a href="suggestion.php">الاقتراحات و الاراء</a><hr>
</div>
<!--
		<div class="nav-index col-lg-3 col-md-3 col-sm-2 col-xs-2">
	<div class="nave-left ">
<div class="list-group">
  <a href="#" class="list-group-item active">
   <?php //echo'Admin' //$_SESSION['Username'];?>
  </a>
 
  <a href="#" class="list-group-item">أصحاب الحرف</a>
  <a href="#" class="list-group-item">الطلبات المعلقة</a>
  <a href="categories.php" class="list-group-item"> ادارة الفئات </a>

</div>
</div>
</div>
!-->




	<div class="home-stats col-lg-1 col-md-1 col-sm-1 col-xs-1">
			<div class="container text-center">
				<h1>Admin</h1>
				<div class="row">
					<div class="col-md-4 " >
						<div class="rowsA stat st-members" style="background-color: #000;color: #fff;">
							<i class="fa fa-users"></i>
							<div class="info">
								مجموع حسابات المشترين
								<span><br>
									<a href="customer.php"><?php
				                  	$stmt2 = $con->prepare("SELECT COUNT(Cust_Id) FROM customer");

	       	                        $stmt2->execute();

		                           $countItems=  $stmt2->fetchColumn();
					
									 echo $countItems; ?></a>
								</span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="rowsB stat st-pending" style="background-color: #000;color: #fff;">
							<i class="fa fa-user-plus"></i>
							<div class="info">
								اصحاب الحرف غير مفعلين
								<span><br>
									<a href="handmade.php?do=Manage&page=shut">
										<?php 
										$statement = $con->prepare("SELECT active FROM handmades WHERE active = ?");

		                                $statement->execute(array(0));

	                                 	$count = $statement->rowCount();
	                                	$counts= $count- 1;
	                                	if($counts<=0){echo "<p> فارغ </p>";}else{
										 echo $counts;}
										 ?>
									</a>
								</span>
							</div>
						</div>
					</div>

				

					<div class="col-md-4">
						<div class="rowsC stat st-items" style="background-color: #000;color: #fff;">
							<i class="fa fa-tag"></i>
							<div class="info">
								جميع اصحاب الحرف
								<span><br>
									<a href="handmade.php">
									<?php
				                  	$stmt2 = $con->prepare("SELECT COUNT(handmade_id) FROM handmades");

	       	                        $stmt2->execute();

		                           $countIhand=  $stmt2->fetchColumn();
		                           $countsIhand=$countIhand-1;
					
									 echo $countsIhand; ?>
									</a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="rowsB stat st-items" style="background-color: #000;color: #fff;">
							<i class="fa fa-tag"></i>
							<div class="info">
							
								<span><br>
								<a href="categories.php?do=Manage">
									ادارة الفئات
								</a>
									
								</span>
							</div>
						</div>
					</div>
				<div class="col-md-4">
						<div class="rowsC stat st-items" style="background-color: #000;color: #fff;">
							<i class="fa fa-tag"></i>
							<div class="info">
								
								<span><br>
									<a href="message.php"class="notification">
								الرسائل
								
  <span class="badge"><?php
				                  	$stmt2 = $con->prepare("SELECT COUNT(statusHand) FROM messageadmin WHERE statusHand=0");

	       	                        $stmt2->execute();

		                           $countIhand=  $stmt2->fetchColumn();
		                           $countsIhand=$countIhand;
					
									 echo $countsIhand; ?></span>
									</a>

								</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="rowsA stat st-items" style="background-color: #000;color: #fff;">
							<i class="fa fa-tag"></i>
							<div class="info">
								
								<span><br>
									<a href="warning.php" class="notification">
									تنبيهات
									<span class="badge"><?php
				                  	$stmt2 = $con->prepare("SELECT COUNT(status) FROM  warning WHERE status=0");

	       	                        $stmt2->execute();

		                           $countIhand=  $stmt2->fetchColumn();
		                           $countsIhand=$countIhand;
					
									 echo $countsIhand; ?></span>
									</a>

								</span>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>

	
<?php

	include 'includes/footer.php'; 
	ob_end_flush();
	}else{
	header('Location:login.php');
}
?>