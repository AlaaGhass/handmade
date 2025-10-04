<?php

	ob_start();
	session_start();
	$pageTitle = $_SESSION['userAdmin'];
	
	
	if (isset($_SESSION['userAdmin'])) {
	include 'unity.php';
        $stmtActive = $con->prepare("UPDATE messageadmin SET statusHand=1 WHERE  statusHand = 0");

        $stmtActive->execute();
		?>
<!--  Start navbar vetical  -->
<div class="vertical-menu col-lg-2 col-md-2 col-sm-2 col-xs-2" style="background-color: #000;color: #fff;">
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
 $getMessage = $con->prepare("SELECT  *
                                          FROM suggestion 
                                           ");
    $getMessage->execute();
    $messages = $getMessage->fetchAll();
                 foreach($messages as $message) {
          ?>
<div class="container col-lg-2 col-md-2 col-sm-2 col-xs-2" style="width: 600pt">
  <img src="layout/iconuser.png" alt="Avatar" >
 
  <p><?php echo  $message['suggestion'];   ?></p>

</div>

<?php } ?>
<?php

	include 'includes/footer.php'; 
	ob_end_flush();
	}else{
	header('Location:login.php');
}
?>