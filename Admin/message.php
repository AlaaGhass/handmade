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
    $do = isset($_GET['do']) ? $_GET['do'] : 'Main';
       if ($do=='Main') {
 $getMessage = $con->prepare("SELECT messageadmin . *,
                                           handmades.UserName AS UserHand
                                           FROM messageadmin 
                                       
                                          INNER JOIN handmades ON handmades.handmade_id =  messageadmin.send
                                           ");
    $getMessage->execute();
    $messages = $getMessage->fetchAll();
                 foreach($messages as $message) {
          ?>
<div class="container col-lg-2 col-md-2 col-sm-2 col-xs-2" style="width: 600pt">
  <img src="layout/iconuser.png" alt="Avatar" >
  <h5><a style="color: #000; " href='message.php?do=message&Id=<?php echo $message['send'] ?>'><?php echo  $message['UserHand'];   ?></a></h5>
 

</div>

<?php }}elseif ($do=='message') {
  $userid = isset($_GET['Id']) && is_numeric($_GET['Id']) ? intval($_GET['Id']) : 0;

  $getMessages = $con->prepare("SELECT messageadmin . *,
                                           handmades.UserName AS UserHand
                                           FROM messageadmin 
                                       
                                          INNER JOIN handmades ON handmades.handmade_id =  messageadmin.send
                                          WHERE messageadmin.send=$userid
                                           ");
    $getMessages->execute();
    $messagesA = $getMessages->fetchAll();
                 foreach($messagesA as $messageA) {
                            ?>

<div class="container" style="background-color: #000;width:50%;height: 8%;margin-left:180pt">
  <img src="layout/iconuser.png" alt="Avatar" style="width:50%;">
  <h5 style="color: #fff; "><?php echo  $messageA['UserHand'];   ?></h5>
  <p style="color: #fff; "><?php echo  $messageA['message'];   ?></p>
 
</div>
    <?php
                 }?>
            <form action="?do=sendMessage" method="POST"style="text-align: right;padding-right: 130pt;padding-left: 180pt;width: 50%">
              <label><?php echo  $messageA['UserHand'];   ?>المرسل اليه</label>
              <input type="text" name="message" class="form-control">
             
             <input type="hidden" name="handId" value="<?php echo $userid  ?> " width="90pt" />
              <input type="submit" name="" value="ارسال" class="button">
            </form>
        
            <?php
                
   }elseif ($do == 'sendMessage') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message   = $_POST['message'];
  
    $handId   = $_POST['handId'];

$stmt = $con->prepare("INSERT INTO messageadmin (message,send,recepion)
                        VALUES(:zmessage, :zCustMessage, 1) ");

$stmt->execute(array(

              'zmessage'  =>  $message,
              'zCustMessage'=> $handId 
     
            ));
echo "تم الارسال";
header('Location: message.php?do=Main');
      }
}

 ?>
<?php

	include 'includes/footer.php'; 
	ob_end_flush();
	}else{
	header('Location:login.php');
}
?>