<?php


 // $pageTitle = $_SESSION['UserName'];

 // $conn = mysqli_connect("localhost", "root", "", "handmade");
  ob_start();
session_start();
include 'unity.php';
if (isset($_SESSION['userHand'])) {
	$do = isset($_GET['do']) ? $_GET['do'] : '';

		// Start Manage Page

		if ($do == '') {
			
	$getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$hand_id = $info['handmade_id'];
/* start statuse update */
  $stmtActive = $con->prepare("UPDATE requests SET status=1 WHERE  status = 0 AND hand_id =$hand_id");

        $stmtActive->execute();
/*End statuse update */
	$getShop = $con->prepare("SELECT requests . *,
                                          products.prodectName AS prodName,
                                          customer.UserName AS custName
                                           FROM requests 
                                          INNER JOIN products ON products.ID = requests.prodect_id
                                          INNER JOIN handmades ON handmades.handmade_id = requests.hand_id
                                           INNER JOIN customer ON customer.Cust_Id = requests.cust
                                          WHERE requests.hand_id=$hand_id
                                           ");
		$getShop->execute();
		$shops = $getShop->fetchAll();
		?>
		<div class="">
				<div class="table-responsive" style="width: 70%;margin-left: 9%">
					<table class="main-table  text-center table table-bordered" style="background-color: #000;color: #fff;margin-right: auto;margin-left: auto;">
						<tr>
							
							<td>رقم المنتج</td>
							<td>تاريخ الشراء</td>
							
							<td>اسم المشتري</td>
							<td>اسم المنتج</td>
							<td>تحكم</td>
							<td>حالة منتج</td>
							
						</tr>
						<?php
							 foreach($shops as $shop) {

	echo "<tr>"	;    	
echo "<td>" . $shop['prodect_id'] . "</td>";

echo "<td>" . $shop['time']. "</td>";

echo "<td>" .$shop['custName']. "</td>";
echo "<td>" .$shop['prodName']. "</td>";


echo "<td>";
 if ($shop['stopSelling']==0){
	echo "<a 
													href='?do=stopSelling&prod_id=" . $shop['Id'] . "' 
													class='btn btn-warning activate'>
													<i class='fa fa-check'></i> تجميد البيع</a>";
}elseif ($shop['stopSelling']==1){
	echo "<a 
													href='?do=NotstopSelling&prod_id=" . $shop['Id'] . "' 
													class='btn btn-warning activate'>
													<i class='fa fa-check'></i>إلغاء التجميد </a>";
}
echo "</td>";

echo "<td>";
 if ($shop['Delivered']==0){
	echo "لم يتم التسليم بعد";
}else{
	echo "تم التسليم";
}
echo "</td>";

			?>
<?php
}


}elseif ($do == 'stopSelling') {
   $prod = isset($_GET['prod_id']) && is_numeric($_GET['prod_id']) ? intval($_GET['prod_id']) : 0;
   $stmt = $con->prepare("UPDATE requests SET stopSelling = 1 WHERE Id = ?");

					$stmt->execute(array($prod));
					echo "تم تسليم الطلب";
						header('Location:requests.php');


}elseif ($do == 'NotstopSelling') {
   $prod = isset($_GET['prod_id']) && is_numeric($_GET['prod_id']) ? intval($_GET['prod_id']) : 0;
   $stmt = $con->prepare("UPDATE requests SET stopSelling =0 WHERE Id = ?");

					$stmt->execute(array($prod));
					echo "تم تسليم الطلب";
						header('Location:requests.php');


}
	} else {
		header('Location: login.php');
		exit();
	}
	include 'includes/footer.php';
	ob_end_flush();
?>