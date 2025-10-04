<?php
ob_start();
session_start();


  //session_start();
  $pageTitle = $_SESSION['userHand'];


    include 'unity.php';


		if (isset($_SESSION['userHand'])) {
		$getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['handmade_id'];




	?>
	<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-1"> -->
<div class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<div class="data-profile">
	
	<br>
	<h2 class="font-user">
<div class="nave-left">
	<?php 
  if (isset($info['imges'] )) {
	?>
	<img src="<?php echo 'images/'. $info['imges'] ?>" style="margin-right:30%;margin-top: 8pt">
	<?php
}else{ ?>
<img src="layout/iconuser.png" style="margin-right: 50pt">
<?php
}
	?>
	
	<br>
	<h2 class="font-user" style="text-align: center;">
	<?php 

	echo $_SESSION['userHand'];
	
	 ?>
	 </h2>
	 <h3><hr>
	 		<span style="text-align: left;margin-right: 14px;">الاسم الكامل</span>
	 		<?php 
    echo $info['handmade_Name']    
	 	?>
	 
	 	
	 
	 </h3><hr>
	 <h3>
	 		<?php 
	echo $info['Phone'] 
	 	?>
	 	<samp style="text-align: left;margin-right: 14px;">:رقم الهاتف  </samp>
	 	
	 
	 </h3><hr>
	 <h3>	
	 
	 	<?php 
	echo $info['Email'] 
	 	?>
	 
	 	
	<span style="text-align: left;margin-right: 14px;"> الايميل</span> 
	 </h3>
	 <hr>
	 <h3>
	 		<span style="text-align: left;margin-right: 14px;">العنوان</span>
	 <?php 
	echo $info['address'] 
	 	?>
	 
	 	
	 </h3><br><br>
	 <h4><a href="edit.php" style="color:#fff" >تعديل البيانات الشخصية</a></h4>
	 </div>
 </div>
</div>
</div>
<?php

?>

	<!-- Begin Best Prodect -->
<div class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
			
 		<div class=" d-flex h-100 align-items-center" style="color:#000">
 			


<?php

   if ($info['active'] ==0 ) {
   	echo '<div class="alert alert-danger"style="margin-top:10%;text-align:center">';
   echo '<h1 > الحساب غير مفعل</h1>';
   echo "<h3> يرجى مراجعة أدارة الموقع </h3>";
    echo '</div>';
}else {
	
 
	echo '	 <div class="cont">';
	
        echo '<h1> <a href="addProduct.php?do=Manage&handmade_id='. $info['handmade_id'] . '  title="More Brands" class="Button text-center">إضافة منتج</a></h1>';
       



?>
               
      
       <div class="prodect">
       	<h1 style="text-align: right;">منتجاتي</h1>
       	<?php
       
        $getProd = $con->prepare("SELECT * FROM products WHERE hand_id = $userid");
		$getProd->execute();
		$prods = $getProd->fetchAll();
		    foreach($prods as $prod) {
		    
       	?>
       
    
     
      
			<!-- End Best Prodect -->		
		<div class="media" style="background-color: #000;color: #fff;  height: 200pt;width: 550pt;padding: 10pt">
  <div class="media-left media-middle" style="width: 250pt" >
    <a href="#">
     <img  src="<?php echo 'imageUp/' . $prod['image'] ?>" alt="" width="160pt" height="110pt" style="width:140pt; height: 170pt;border-radius: 7px">
    </a>
  </div>
  <div class="media-body " >
    <h2 class="media-heading" style="text-align: right;margin-right: 15pt"><?php echo  $prod['prodectName']; ?></h2>
   
    	
    	  <?php    if (isset($prod['offerPrice'])) {?>
 
  <p style="text-align: right;color: red"><strong>سعر العرض   &#8362;<?php echo $prod['offerPrice']?></strong></p>
 <p style="text-align: right;color: #fff">السعر  &#8362;<del><?php echo $prod['price']?></del></p>
   <?php     }else{ ?>
 <p style="text-align: right;color: #fff"> السعر &#8362;<?php echo $prod['price']?></p>
 <?php       }?>
    <p style="text-align: right;font-size: 20px">عن المنتج <?php echo $prod['Description']?></p>
    	  <p><a style="width: 120pt" href="profile.php?do=delet&id=<?php echo $prod['ID'] ?>" class="btn btn-primary" role="button">حذف المنتج</a></p>
    	   <p><a style="width: 120pt" href="edit.php?do=EditProd&id=<?php echo $prod['ID'] ?>" class="btn btn-primary" role="button">تعديل</a></p>

  </div>
</div>
   	<?php
       }
   }
       	?>
		</div>
			</div>
			  </div>
	<?php

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
       if ($do == 'delet') {
       	 $Id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
       	 echo "string",$Id;
       	 echo "<h1 class='text-center'>حذف حساب صاحب الحرف</h1>";
			echo "<div class='container'>";

			


				$statement = $con->prepare("SELECT ID FROM products WHERE ID = ?");

	        	$statement->execute(array($Id));

		        $check = $statement->rowCount();

		

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM products WHERE ID = :zid");

					$stmt->bindParam(":zid", $Id);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' تم حذف الحساب</div>';
					header('Location:profile.php');

				} else {

					$theMsg = '<div class="alert alert-danger">لا يوجد حساب لاسم المستخدم هذا</div>';
					

				

				}

			echo '</div>';
       	}elseif  ($do == 'EditProd')  {
       			 


       	}

 ?>
<?php

	} else {
		header('Location: signup.php');
		exit();
	}
	include 'includes/footer.php';
	ob_end_flush();
?>