<?php
ob_start();
session_start();


  //session_start();
  $pageTitle = $_SESSION['userHand'];

  include 'unity.php';
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
       if ($do == 'Manage') {
if (isset($_SESSION['userHand'])) {

		$getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
	//	$userid = $info['Cust_Id'];



		?>

		<div class="profile col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<form  action="" method="POST"enctype="multipart/form-data"  style="color: #000">
	<div class="data-profile" style="width:330pt">
	<img src="images/user.png" style="margin-right:30%">
	<br>
	<h2 style="text-align: center;color: #fff">
	<?php 

	echo $_SESSION['userHand'];
	 ?>
	 </h2><hr>

	 	 <input type="hidden" name="Id" value="<?php echo $info['handmade_id' ]?>" />
	 
	 	
	
	 <h3>
	 <input type="text" name="Phone" value="<?php echo  $info['Phone']; ?>">
	 	<i style="text-align: left;margin-right: 14px;">:الهاتف</i>
	 
	 </h3><hr>
	 <h3>
	 		<input type="text" name="Email" value="<?php echo  $info['Email']; ?>">
	 	<i style="text-align: left;margin-right: 14px;">:الايميل</i>
	 
	 </h3><hr>
	 <h3>	
	 
	 			<input type="text" name="Adress" value="<?php echo  $info['address']; ?>">
	 	<i style="text-align: left;margin-right: 14px;">:العنوان</i>
<br><br>
	 		<i style="text-align: left;margin-right: 14px;">:الصورة</i>
	      <input type="file" name="image" style="color: #fff">
	 </h3><br><br>
 <input type="submit" value="حفظ التغيرات"  >
	</div>

</div>
		
</form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id  = $_POST['Id'];
 
     $Phone =$_POST['Phone'];
       $Email =$_POST['Email'];
         $Adress =$_POST['Adress'];

   $image = time() . '-' . $_FILES["image"]["name"];

    // For image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	 	}else{
						echo "error";
					}
         $stmt = $con->prepare("UPDATE 
                      handmades
                      SET 
                    
                        Phone = ?, 
                        Email = ?, 
                      address = ?,
                   imges=?
               
                      WHERE 
                       handmade_id = ?");

          $stmt->execute(array( $Phone, $Email, $Adress,$image,$id));
          header('Location:profile.php');
         

}}}elseif ($do=='EditProd') {
	if (isset($_SESSION['userHand'])) {
		$Id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
       			 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id  = $_POST['Id'];
   $prodectName=$_POST['prodectName'];
   $price=$_POST['price'];
   $Description=$_POST['Description'];
    $offerPrice=$_POST['offerPrice'];

 $stmt = $con->prepare("UPDATE 
                       products
                      SET 
                       prodectName= ?, 
                        price = ?, 
                        Description = ?,
                        offerPrice=?
                 
               
                      WHERE ID = ?");

          $stmt->execute(array($prodectName, $price, $Description,$offerPrice,$id));
          header('Location:profile.php');
}
       		$statement = $con->prepare("SELECT * FROM products WHERE ID = ?");

	        	$statement->execute(array($Id));

		       // $check = $statement->rowCount();
		        	//	$statement->execute();
		$prod = $statement->fetch();

		        ?>
		        	<div class="media" style="background-color: #000;color: #000;  height: auto;width: 550pt;padding: 10pt;margin-left: 20%">
  <div class="media-left media-middle" style="width: 250pt;color: #fff" >
		        <form action="" method="POST" style=";margin-left: 50%;width: 100%;text-align: right;">
		        <br>	 <h2 class="media-heading" style="text-align: right;margin-right: 15pt;color: #fff">تعديل المنتج</h2><br><br>

		     <input type="hidden" name="Id" value="<?php echo $prod['ID' ]?>" />
		     <h3>الاسم</h3>
		    <input type="text" name="prodectName" class="form-control"  value="<?php echo  $prod['prodectName']; ?>"/>
		      <h3>السعر</h3>
		    <input type="text" name="price" class="form-control"  value="<?php echo $prod['price'];?>"/>
		      <h3>التفاصيل</h3>
		    <input type="text" name="Description"class="form-control"  value="<?php echo $prod['Description'];?>"/><br>
		     <h3>سعر العرض</h3>
		    <input type="text" name="offerPrice" class="form-control"  value="<?php echo $prod['offerPrice'];?>"/>
		  <input type="submit" value="حفظ التغيرات"  class="btn btn-primary" role="button";/><br>
		  </form>
</div>
</div>
<?php
	}}
?>