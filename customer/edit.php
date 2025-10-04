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

		<div class="profile col-lg-4 col-md-6 col-sm-12 col-xs-12">
			<form  action="" method="POST"enctype="multipart/form-data"  style="color: #000">
	<div class="data-profile" style="width:330pt">
	<img src="images/user.png" style="margin-left:  23%;margin-right: 23%">
	<br>
	<h2 style="text-align: center; color: #fff">
	<?php 

	echo $_SESSION['UserName'];
	 ?>
	 </h2><hr>
	
	 	 <input type="hidden" name="Id" value="<?php echo $info['Cust_Id' ]?>" />
	 
	 <h3>
	 <input type="text" name="Phone" value="<?php echo  $info['Phone']; ?>">
	 	<i style="text-align: left;margin-right: 14px;">:الهاتف</i>
	 
	 </h3><hr>
	 <h3>
	 		<input type="text" name="Email" value="<?php echo  $info['Email']; ?>">
	 	<i style="text-align: left;margin-right: 14px;">:الايميل</i>
	 
	 </h3><hr>
	 <h3>	
	 
	 			<input type="text" name="Adress" value="<?php echo  $info['Adress']; ?>">
	 	<i style="text-align: left;margin-right: 14px;">:العنوان</i>
<br><br>
	 		<i style="text-align: left;margin-right: 14px;">:الصورة</i>
	      <input type="file" name="image" >
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
    $target_dir = "image/";
    $target_file = $target_dir . basename($image);
if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	 	}else{
						echo "error";
					}
         $stmt = $con->prepare("UPDATE 
                       customer
                      SET 
                        
                        Phone = ?, 
                        Email = ?, 
                       Adress = ?,
                   image=?
               
                      WHERE 
                        Cust_Id = ?");

          $stmt->execute(array( $Phone, $Email, $Adress,$image,$id));
        header('Location:profile.php');
         

}}
?>