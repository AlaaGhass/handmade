
<?php
session_start();

//session_start();
  $pageTitle = $_SESSION['UserName'];

  include 'unity.php';

  if (isset($_SESSION['UserName'])) {
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		    if ($do == 'Manage') {
  $getSort = $con->prepare("SELECT * FROM category ");
		$getSort->execute();
		$sorts = $getSort->fetchAll();
		?>
		<div class="features text-center" >
  <div class="container" style="padding: 5pt;color: #fff">
		<?php
		    foreach($sorts as $sort) {
?>
<div class="button col-lg-2 col-md-2 col-sm-12 col-xs-12" style="background-color: #000;color: #fff;border-radius: 7pt;margin-left: 10%;margin: 9pt"> 
      <h3><a  style="color: #fff" href="products.php?do=sort&id=<?php echo $sort['Category_ID'] ?>"><?php  echo $sort['Category_Name']  ?></a></h3>
    </div>


<?php
		    }?>
</div>
</div>
		    <?php
		    

        $getProd = $con->prepare("SELECT products . *,
                                          category.Category_Name AS catName,
                                          handmades.UserName AS handName
                                           FROM products 
                                          INNER JOIN category ON category.Category_ID = products.Category_ID
                                          INNER JOIN handmades ON handmades.handmade_id = products.hand_id
                                           ");
		$getProd->execute();
		$prods = $getProd->fetchAll();
		?><div class="row" >
		    <?php
		    foreach($prods as $prod) {
		    	?>
		    
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="text-align: center;margin-left:  6%;color">
    <div class="thumbnail"  style="background-color: #000;color: #fff;height: auto;width: 220pt;">
      <img src="<?php echo '../handmade/imageUp/' . $prod['image'] ?>" alt="..." style="height: 145pt;width: 170pt">
      <div class="caption" style=": #fff">
        <h3 style="color: #fff"><?php echo $prod['prodectName']?></h3>
        <?php   if (isset($prod['offerPrice'])) {?>
 
  <p style="text-align: right;color: red"><strong>سعر العرض   &#8362;<?php echo $prod['offerPrice']?></strong></p>
 <p style="text-align: right;color: #fff"> &#8362; السعر  <del><?php echo $prod['price']?></del></p>
   <?php     }else{ ?>
 <p style="text-align: right;color: #fff"> &#8362; السعر <?php echo $prod['price']?></p>
 <?php       }?>
      
        <p  style="text-align: right;color: #fff"><a style="color: #fff" href="products.php?do=handMade&id=<?php echo $prod['hand_id'] ?>"><?php echo $prod['handName']?><strong> البائع  </strong></a></p>
        
        <p><a href="products.php?do=message&id=<?php echo $prod['hand_id'] ?>" class="btn btn-primary" role="button">مراسلة </a> <a href="products.php?do=More&id=<?php echo $prod['ID'] ?>" class="btn btn-default" role="button">مشاهدة التفاصيل</a> </p>
    </a> <a href="products.php?do=shoppingcartAdd&id=<?php echo $prod['ID'] ?>&idHand=<?php echo $prod['hand_id'] ?>" class="btn btn-default" role="button">اضف الى سلة التسوق</a> </p>
      </div>
    </div>
  </div>
<?php
 } ?>

<?php
		    }elseif ($do == 'handMade') {
		    	  $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

		    	  echo "handmade", $id;

		    	   $stmt = $con->prepare("SELECT * FROM handmades WHERE handmade_id = ?");
                   $stmt ->execute(array($id));
                   $info = $stmt->fetch();
                  ?>

<div class="data-profile">
	
	<br>
	<h2 class="font-user">
<div class="nave-left">
	<img src="layout/userWoman.png" style="margin-right: 50pt">
	<br>
	<h2 class="font-user" style="text-align: center;">
	<?php 

	echo $_SESSION['userHand'];
	
	 ?>
	 </h2>
	 <h3><hr>
	 		<?php 
    echo $info['handmade_Name']    
	 	?>
	 	<span style="text-align: left;margin-right: 14px;">الاسم الكامل</span>
	 	
	 
	 </h3><hr>
	 <h3>
	 		<?php 
	echo $info['Phone'] 
	 	?>
	 	<i style="text-align: left;margin-right: 14px;">:رقم الهاتف</i>
	 	
	 
	 </h3><hr>
	 <h3>	 
	 	<?php 
	echo $info['Email'] 
	 	?>
	 	<span style="text-align: left;margin-right: 14px;">: الايميل</span>
	 	

	 </h3>
	 <hr>
	 <h3><?php 
	echo $info['address'] 
	 	?>
	 	<span style="text-align: left;margin-right: 14px;">:العنوان</span>
	 
	 	
	 </h3>
	 </div>
	 <a href="products.php?do=message&id=<?php echo $prod['hand_id'] ?>" class="btn btn-primary" role="button">مراسلة</a>
 </div>


<?php
		    }elseif ($do == 'message') {
		    	 $handId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
		    	 
$getCust = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
		$getCust->execute(array($sessionUser));
		$customer = $getCust->fetch();
		echo "customer", $customer['Cust_Id'];
		$CustId=$customer['Cust_Id'];
		$getHand = $con->prepare("SELECT * FROM handmades WHERE handmade_id = ?");
		$getHand->execute(array($handId));
		$handmade = $getHand->fetch()




		    	  ?>
		    	  <form action="?do=sendMessage" method="POST" style="text-align: right;padding-right: 150pt;padding-left: 150pt;color: #000">
		    	  	<label><?php  echo $handmade['UserName'] ; ?> ارسال الى</label>
		    	  	<input type="text" name="message" class="form-control">
		    	   <input type="hidden" name="CustId" value="<?php echo $CustId ?>" />
		    	   <input type="hidden" name="handId" value="<?php echo $handmade['handmade_id'] ?>" />
		    	  	<input type="submit" name="" value="ارسال" class="button">
		    	  </form>
		    	  
		    	  <?php


		    	  		 }elseif ($do == 'sendMessage') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message   = $_POST['message'];
    $CustId   = $_POST['CustId'];
    $handId   = $_POST['handId'];

$stmt = $con->prepare("INSERT INTO 	message(message,CustMessage,handMessage)
												VALUES(:zmessage, :zCustMessage, :zhandMessage) ");

$stmt->execute(array(

							'zmessage' 	=>  $message,
							'zCustMessage'=> $CustId,
							'zhandMessage'=> $handId
						));
echo '<div class="alert alert-success" role="alert">';
echo "<h1>","تم الارسال" ,"</h1>";
echo "</div>";
		  }
}elseif ($do == 'More') {
	$hand = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
	
    $getProd = $con->prepare("SELECT products . *,
                                          category.Category_Name AS catName,
                                          handmades.UserName AS handName
                                           FROM products 
                                          INNER JOIN category ON category.Category_ID = products.Category_ID
                                          INNER JOIN handmades ON handmades.handmade_id = products.hand_id
                                          WHERE ID = $hand
                                           ");
		$getProd->execute();
		$prod = $getProd->fetch(); 
		
		?>
		<div style="margin-left: auto;margin-right:auto;color: #000; width:500pt;height: auto;text-align: right;padding-right: 12pt;margin-top: 80pt;font-size: 18px">
			<div class=" col-lg-4 col-md-6 col-sm-12 col-xs-12" style="margin-right: 30pt">
 
		 <img src="<?php echo '../handmade/imageUp/' . $prod['image'] ?>" alt="..."  style="margin-left: auto;margin-right: auto;border-radius: 7pt;width: 270pt;height: 270">
</div>
<div class=" col-lg-4 col-md-6 col-sm-12 col-xs-12" style="margin-left: 90pt">

		 <p>رقم المنتج<?php echo " "," : ", $prod['ID']?></p>

		  <p  style="text-align: right;"><a style="color: #000" href="products.php?do=handMade&id=<?php echo $prod['hand_id'] ?>"><?php echo $prod['handName']?></a><strong>البائع</strong></p>

         <h3>اسم المنتج<?php echo " : ", $prod['prodectName']?></h3>

         <p style="text-align: right;">السعر<?php echo $prod['price']?></p>

            <p><strong>معلومات عن المنتج</strong><?php echo "  ", $prod['Description']?></p>

            <p><a style="width: 120pt" href="products.php?do=shop&id=<?php echo $prod['ID'] ?>&HandId=<?php echo $prod['hand_id'] ?>" class="btn btn-primary" role="button">شراء</a>
            <p><a style="width: 120pt" href="products.php?do=warning&id=<?php echo $prod['ID'] ?>&HandId=<?php echo $prod['hand_id'] ?>" class="btn btn-primary" role="button">ابلاغ</a></p>
         </div>  </div> 

<?php
}elseif ($do == 'shop') {
	$prod = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
	$hand = isset($_GET['HandId']) && is_numeric($_GET['HandId']) ? intval($_GET['HandId']) : 0;
	 $getCust = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
    $getCust->execute(array($sessionUser));
    $customer = $getCust->fetch();
   
    $CustId=$customer['Cust_Id'];
	?>
	<form action="?do=sendShop" method="POST" style="text-align: right;">
	  <input type="hidden" name="IdProd" value="<?php echo $prod ?>" />
	    <input type="hidden" name="IdHand" value="<?php echo $hand ?>" />
	       <input type="hidden" name="Cust" value="<?php echo $CustId ?>" />
	<div style="margin-left: auto;margin-right:500pt;margin-left: auto; color: #000; width:500pt;height: auto;margin-top:80pt">

<h1 style='color:#000'> شراء المنتج رقم <strong><?php echo $prod ?></strong></h1>
<h4 style='color:#000'>  سيتم ارسال المنتج خلال ثلاثة ايام </h4>
<h4 style='color:#000'>  بلامكان التواصل مع البائع</h4>
 <input type="submit" name="" value="تأكيد الشراء" class="button" style="background-color: #000;color: #fff;font-size: 22px;width: 120pt">
</div>
</form>
<?php
}elseif ($do == 'sendShop') {
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 	    $IdProd   = $_POST['IdProd'];
 
    $handId   = $_POST['IdHand'];
   $cust  =$_POST['Cust'];

$stmt = $con->prepare("INSERT INTO  requests(prodect_id,hand_id,cust,time)
                        VALUES(:zProd, :zHand,:zCust,now()) ");

$stmt->execute(array(

              'zProd'  =>   $IdProd,
              'zHand'=> $handId,
              'zCust'=> $cust
              
            ));

echo '<div class="alert alert-success" style="font-size:50px;" role="alert" margin-top="90pt; height="120pt">';
echo "تم تأكيد الشراء";
echo "<a href='products.php?do=MyShop'> انقر لمشاهدة المشتريات </a>";
echo "</div>";
 }
}elseif ($do == 'MyShop') {

       $getCust = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
    $getCust->execute(array($sessionUser));
    $customer = $getCust->fetch();
 
    $CustId=$customer['Cust_Id'];


	$getShop = $con->prepare("SELECT requests . *,
                                          products.prodectName AS prodName,
                                          handmades.UserName AS handName
                                           FROM requests 
                                          INNER JOIN products ON products.ID = requests.prodect_id
                                          INNER JOIN handmades ON handmades.handmade_id = requests.hand_id
                                           INNER JOIN customer ON customer.Cust_Id = requests.cust
                                          WHERE requests.cust=$CustId
                                           ");
		$getShop->execute();
		$shops = $getShop->fetchAll();
		?>
		<div class="" style="width: 70%;margin-left: 7%">
				<div class="table-responsive">
					<table class="main-table  text-center table table-bordered" style="background-color: #000;color: #fff;">
						<tr>
							
							<td>رقم المنتج</td>
							<td>تاريخ الشراء</td>
							<td>اسم البائع</td>
							<td>اسم المنتج</td>
							<td>عمليات البيع</td>
							<td>حالة منتج</td>
							
						</tr>
						<?php
							 foreach($shops as $shop) {

	echo "<tr>"	;   ?> 	
<td><a style="color:#fff" href="products.php?do=More&id=<?php echo $shop['hand_id'] ?>"><?php echo $shop['prodect_id']?></a> </td>
<?php

echo "<td>" . $shop['time']. "</td>";

echo "<td>" .$shop['handName']. "</td>";
echo "<td>" .$shop['prodName']. "</td>";
echo "<td>";
 if ($shop['stopSelling']==0){
	echo " عملية البيع مستمرة";
}else{
	echo "تم تجميد عملية البيع";
}
echo "</td>";
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


<?php
}elseif ($do == 'Delivered') {
   $prod = isset($_GET['prod_id']) && is_numeric($_GET['prod_id']) ? intval($_GET['prod_id']) : 0;
   $stmt = $con->prepare("UPDATE requests SET Delivered = 1 WHERE Id = ?");

					$stmt->execute(array($prod));
					echo "تم تسليم الطلب";
						header('Location:products.php?do=MyShop');


}elseif ($do == 'warning') {
	 $prod = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
	  $HandId = isset($_GET['HandId']) && is_numeric($_GET['HandId']) ? intval($_GET['HandId']) : 0;
	  echo "<div style='margin-left:auto;margin-right:auto;margin-top:80pt'>";
echo "<h1 style='text-align:center;color:#000'>ابلاغ عن المنتج رقم <strong>" . $prod." <strong></h1>";
?>
<div style="margin-left: auto;margin-right:auto;color: #000; width:500pt;height: auto;text-align: right;padding-right: 12pt">
<form action="?do=sendWarning" method="POST"style="text-align: right;padding-right: 130pt;padding-left: 130pt;width: auto;">
<select name="warning" style="width: 200pt;height: 30pt">
	<option value="محتوى زائف"> محتوى زائف"</option>
	<option value="منتج مكرر">منتج مكرر</option>
	<option value="محتوى غير لائق">محتوى غير لائق</option>
	<option value="تعرضت للنصب">تعرضت للنصب</option>
</select>
 <input type="hidden" name="handId" value="<?php echo $HandId ?> " />
  <input type="hidden" name="prod" value="<?php echo $prod ?> " />
<input type="submit" name="" value="ابلاغ" class="button" style="height: 30pt;width:200pt;color: #fff;background-color: #000;border-radius: 8pt;margin-top: 10pt">
</form>
</div>
<?php

}elseif ($do == 'sendWarning') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $warning   = $_POST['warning'];
    $prod   = $_POST['prod'];
    $handId   = $_POST['handId'];

$stmt = $con->prepare("INSERT INTO  warning(warning,prodID,handId)
                        VALUES(:zwarning,:zprodID,:zhand) ");

$stmt->execute(array(

              'zwarning' => $warning,
              'zprodID'=> $prod,
              'zhand'=> $handId
            ));
 echo "<div style='margin-left:auto;margin-right:auto;margin-top:80pt'>";
echo "<h1 style='text-align:center;color:#000'>تم ارسال الابلاغ","</h1>";
echo"</div>";
header('Location:products.php');
      }
}elseif ($do == 'sort') {
 $cat = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
 $getProd = $con->prepare("SELECT products . *,
                                          category.Category_Name AS catName,
                                          handmades.UserName AS handName
                                           FROM products 
                                          INNER JOIN category ON category.Category_ID = products.Category_ID
                                          INNER JOIN handmades ON handmades.handmade_id = products.hand_id
                                          WHERE products.Category_ID=$cat
                                           ");
		$getProd->execute();
		$prods = $getProd->fetchAll();
		?><div class="row" >
		    <?php
		    foreach($prods as $prod) {
		    	?>
		    
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="text-align: center;margin-left:  10pt;color">
    <div class="thumbnail"  style="background-color: #000;color: #fff;height: auto;width: 190pt;">
      <img src="<?php echo '../handmade/imageUp/' . $prod['image'] ?>" alt="..." style="height: 145pt;width: 170pt">
      <div class="caption" style=": #fff">
        <h3 style="color: #fff"><?php echo $prod['prodectName']?></h3>
        <p style="text-align: right;color: #fff">السعر<?php echo $prod['price']?>&#8362;</p>
        <p  style="text-align: right;color: #fff"><a href="products.php?do=handMade&id=<?php echo $prod['hand_id'] ?>"><?php echo $prod['handName']?></a><strong>البائع</strong></p>
        
        <p><a href="products.php?do=message&id=<?php echo $prod['hand_id'] ?>" class="btn btn-primary" role="button">مراسلة</a> <a href="products.php?do=More&id=<?php echo $prod['hand_id'] ?>" class="btn btn-default" role="button">مشاهدة التفاصيل</a> </p>
      </div>
    </div>
  </div>
<?php
} }elseif ($do == 'shoppingcart') {
	 $prod_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
	  $IdHand = isset($_GET['IdHand']) && is_numeric($_GET['IdHand']) ? intval($_GET['IdHand']) : 0;

	  $getProd = $con->prepare("SELECT shoppingcart . *,
                                          products.prodectName AS proName,
                                           products.image AS images,
                                            products.price AS priceS,
                                             products.hand_id AS hand_id
                                           FROM shoppingcart
                                          INNER JOIN products ON products.ID = shoppingcart.products
                                          
                                          WHERE customer = $useridR 
                                           ");
		$getProd->execute();
		$prods = $getProd->fetchAll(); 
			    foreach($prods as $prod) {
		    	?>
		    
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="text-align: center;margin-left:  10pt;color">
    <div class="thumbnail"  style="background-color: #000;color: #fff;height: auto;width: 190pt;">
      <img src="<?php echo '../handmade/imageUp/' . $prod['images'] ?>" alt="..." style="height: 145pt;width: 170pt">
      <div class="caption" style=": #fff">
        <h3 style="color: #fff"><?php echo $prod['proName']?></h3>
        <p style="text-align: right;color: #fff">السعر<?php echo $prod['priceS']?>&#8362;</p>
        <p  style="text-align: right;color: #fff"><a style="color: #fff" href="products.php?do=handMade&id=<?php echo $prod['hand_id'] ?>">تواصل مع البائع</a><strong></strong></p>
        
        <p><a href="products.php?do=message&id=<?php echo $prod['hand_id'] ?>" class="btn btn-primary" role="button">مراسلة</a> <a href="products.php?do=More&id=<?php echo $prod['hand_id'] ?>" class="btn btn-default" role="button">مشاهدة التفاصيل</a> </p>
      </div>
    </div>
  </div>
<?php

}
	}elseif ($do == 'shoppingcartAdd') {
		 $prod_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
		$stmt = $con->prepare("INSERT INTO  shoppingcart(products,customer)
                        VALUES(:zproducts,:zuseridR) ");

$stmt->execute(array(

              'zproducts'=> $prod_id,
              'zuseridR'=> $useridR 
            ));
header('Location: products.php');

	}
	} else {
		
		header('Location: home.php');
		exit();
	}
	include 'includes/footer.php';
	ob_end_flush();
?>

