

<?php


 // $pageTitle = $_SESSION['UserName'];

 // $conn = mysqli_connect("localhost", "root", "", "handmade");
  ob_start();
session_start();
include 'unity.php';
if (isset($_SESSION['userHand'])) {
	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		// Start Manage Page
//echo "<h1>ضف فئات","</h1>";
		if ($do == 'Manage') {
			$handId = isset($_GET['handmade_id']) && is_numeric($_GET['handmade_id']) ? intval($_GET['handmade_id']) : 0;
			
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



			
    // for the database
				
       $name   = $_POST['nameProd'];
        $desc     = $_POST['description'];
        $price    = $_POST['price'];
        $type     = $_POST['type'];
        $hand     =$_POST['hand'];
        

	  $imag = time() . '-' . $_FILES["image"]["name"];


    // For image upload
    $target_dir = "imageUp/";
    $target_file = $target_dir . basename($imag);
         


if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

			$stmt = $con->prepare("INSERT INTO 
													products(prodectName, Description,price, Category_ID,image,hand_id)
												VALUES(:znameProd, :zDesc, :zPrice, :zType,:zimage,:zhand) ");
						$stmt->execute(array(

							'znameProd' 	=>  $name,
							'zhand'  => $hand  ,
							'zDesc' 	=> $desc,
							'zPrice' 	=> $price,
							'zType' 	=> $type ,
							'zimage'	=> $imag

						));
					echo '<div class="alert alert-success" role="alert">تمت عملية الاضافه بنجاح</div>';	
					}else{
						echo "error";
					}

  }
?>
	<h1 class="text-center" style="color: #000">أضافة منتجات</h1>
			<div class="container" style="margin-left: 30%;">
				<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" >
							<?php  $getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['handmade_id'];

					  ?>
					<input type="hidden" name="hand" value="<?php echo $userid ?>" />

					<!-- Start type Field -->
					<div class="form-group form-group-lg">
					
						<div class="col-sm-10 col-md-6">
							<select name="type" style="color: #000;"class="form-control">
     
        <option value="0">...</option>
       <?php 
       $getPaths = $con->prepare("SELECT * FROM category ");
    $getPaths->execute();
    $cats = $getPaths->fetchAll();
    foreach($cats as $cat) {
      echo "<option value='" . $cat['Category_ID'] . "'>" . $cat['Category_Name'] . "</option>";

    }
       ?>
      </select>
						</div>
					</div>
					<!-- End type Field -->

					<!-- Start Name Field -->

					<div class="form-group form-group-lg">
						
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="nameProd" 
								class="form-control" 
								required="required"  
								placeholder="اسم منتج" />
						</div>
					</div>
					<!-- End Name Field -->
					
					<!-- Start Price Field -->
					<div class="form-group form-group-lg">
						
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="price" 
								 class="form-control"
								required="required" 
								placeholder="السعر" />
						</div>
					</div>
					<!-- End Price Field -->
	
					
			
				
					<!-- Start Description Field -->
					<div class="form-group form-group-lg">
						
						<div class="col-sm-10 col-md-6">
							<input 
							  maxlength="910s"
								type="textare" 
								name="description" 
								class="form-control" 
								required="required" 
								row="9" 
								placeholder="تفاصيل" />
						</div>
					</div>
					<!-- End Description Field -->
						<!-- Start images Field -->
					<div class="form-group form-group-lg">
						
						<div class="col-sm-10 col-md-6">
				 <input type="file" id="image" name="image" class="form-control" >
				 
				</div>
			</div>
					<!-- End images Field -->
					<!-- Start Submit Field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="اضف منتج" class="btn btn-primary btn-sm" />
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
			</div>


<?php
}
	} else {
		header('Location: login.php');
		exit();
	}
	include 'includes/footer.php';
	ob_end_flush();
?>