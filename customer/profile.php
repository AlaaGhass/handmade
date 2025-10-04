<?php
ob_start();
session_start();


  //session_start();
  $pageTitle = $_SESSION['UserName'];

  include 'unity.php';

if (isset($_SESSION['UserName'])) {
		$getUser = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['Cust_Id'];


	?>
	<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-1"> -->
<div class="profile col-lg-4 col-md-6 col-sm-12 col-xs-12">

	<div class="data-profile" style="width:330pt">
	<?php 
  if (isset($info['image'] )) {
	?>
	<img src="<?php echo 'image/'. $info['image'] ?>" style="margin-right:30%;margin-top: 8pt">
	<?php
}else{ ?>
	<img src="images/user.png" style="margin-right: 30%">
<?php
}
	?>
	<br>
	<h2 style="text-align: center;">
	<?php 

	echo $_SESSION['UserName'];
	 ?>
	 </h2><hr>
	 <h3>
	 		<span style="text-align: left;margin-right: 14px;">الاسم </span>
	 	:
	 	<?php 
    echo $info['FullName']    
	 	?>
	 
	 </h3><hr>
	 <h3>
	 		<?php 
	echo $info['Phone'] 
	 	?>
	 	<span style="text-align: left;margin-right: 14px;">:الهاتف</span>
	 
	 </h3><hr>
	 <h3>
	 		<?php 
	echo $info['Email'] 
	 	?>
	 	<span style="text-align: left;margin-right: 14px;">:الايميل</span>
	 
	 </h3><hr>
	 <h3>	
	 	<span style="text-align: left;margin-right: 14px;">العنوان  </span>:
	 	<?php 
	echo $info['Adress'] 
	 	?>
	 	
	 
	 </h3><br><br>
	 <h4><a href="edit.php" style="color:#fff;text-align: center;" >تعديل البيانات الشخصية</a></h4>
	</div>

</div>
		

</div>


			
<!-- Begin Best Prodect -->
			<div >
 		<div >
 			<div class="row">
				
			<div class="best-product text-center">
				<?php
				       $getCust = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
    $getCust->execute(array($sessionUser));
    $customer = $getCust->fetch();
 
    $CustId=$customer['Cust_Id'];


	$getShop = $con->prepare("SELECT requests . *,
                                          products.prodectName AS prodName,
                                          products.image AS image,
                                          handmades.UserName AS handName
                                           FROM requests 
                                          INNER JOIN products ON products.ID = requests.prodect_id

                                          INNER JOIN handmades ON handmades.handmade_id = requests.hand_id
                                           INNER JOIN customer ON customer.Cust_Id = requests.cust
                                          WHERE requests.cust=$CustId AND Delivered=0
                                           ");
		$getShop->execute();
		$shops = $getShop->fetchAll();
		?>
		<div class="container">
				<div class="table-responsive">
					<table class="main-table  text-center table table-bordered" style="background-color: #000;color: #fff;width: 80%;margin-left: 10%" >
						<tr>
							
							<td>رقم المنتج</td>
							<td>تاريخ الشراء</td>
							<td>اسم البائع</td>
							<td>اسم المنتج</td>
							
							<td>حالة المنتج</td>
						</tr>
						<?php
							 foreach($shops as $shop) {

	echo "<tr>"	;    	
?>

<td><a style="color:#fff" href="products.php?do=More&id=<?php echo $shop['hand_id'] ?>"><?php echo $shop['prodect_id']?></a> </td>
<?php

echo "<td>" . $shop['time']. "</td>";

echo "<td>" .$shop['handName']. "</td>";
echo "<td>" .$shop['prodName']. "</td>";


echo "<td>";
 if ($shop['Delivered']==0){
	echo "<a 
													href='products.php?do=Delivered&prod_id=" . $shop['Id'] . "' 
													class='btn btn-warning activate'>
													<i class='fa fa-check'></i> تم الاستلام</a>";
}else{
	echo "مستلم";
}
	echo "</tr>"	; 



		    }
		    	echo "</table>"	;  
	echo "</div>"	;  
		echo "</div>"	; 
       	?>

</div>
			</div>


   
        </div>
      </div>
			<!-- End Best Prodect -->		

											             




			
		</div>
		<!-- End Main -->

	</div>
	<!-- End Wrapper -->
	


<?php
	} else {
		header('Location: home.php');
		exit();
	}
	include 'includes/footer.php';
	ob_end_flush();
?>