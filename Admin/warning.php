<?php

	ob_start();
	session_start();
	$pageTitle = $_SESSION['userAdmin'];
	
	
	if (isset($_SESSION['userAdmin'])) {
	include 'unity.php';
  $stmtStatus = $con->prepare("UPDATE warning SET status=1 WHERE  status = 0");

        $stmtStatus->execute();

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
$getwarning = $con->prepare("SELECT warning . *,
                                           handmades.UserName AS UserHand,
                                           products.prodectName AS prodName
                                           FROM warning 
                                            INNER JOIN handmades ON handmades.handmade_id =  warning.handId
                                         INNER JOIN products ON products.ID =  warning.prodID
                                         
                                           ");
    $getwarning->execute();
    $warnings = $getwarning->fetchAll();
      ?>
    <div class="container">
        <div class="table-responsive">
          <table class="main-table  text-center table table-bordered" style="background-color: #000;color: #fff;margin-left: auto;margin-right: auto;">
            <tr>
              
              <td>رقم المنتج</td>
              <td>اسم المنتج</td>   
              <td>اسم البائع</td>
              <td>التبيه</td>
            
              
            </tr>
            <?php
                 foreach($warnings as $warning) {
                  echo "<tr>" ;     
echo "<td>" . $warning['prodID'] . "</td>";
echo "<td>" . $warning['prodName'] . "</td>";
echo "<td>" . $warning['UserHand'] . "</td>";
echo "<td>" . $warning['warning'] . "</td>";
 echo "</tr>" ; 
          ?>



<?php }
          echo "</table>" ;  
  echo "</div>" ;  
    echo "</div>" ; 
     ?>
<?php

	include 'includes/footer.php'; 
	ob_end_flush();
	}else{
	header('Location:login.php');
}
?>