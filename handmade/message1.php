
<?php
  ob_start();
session_start();
include 'unity.php';
  $pageTitle = $_SESSION['userHand'];



  if (isset($_SESSION['userHand'])) {
  

$getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    $userid = $info['handmade_id'];
/* start statuse update */

    $stmtActive = $con->prepare("UPDATE message SET statusHand=1 WHERE  statusHand = 0 AND handMessage =$userid");

        $stmtActive->execute();
/*End statuse update */
    $do = isset($_GET['do']) ? $_GET['do'] : 'Main';
        if ($do=='Main') {
  ?>
<h2 style='text-align: center;color: #000'>جهات الاتصال </h2>
<h3 style='text-align: right; '><a style="color: #000" href="message.php?do=messageAdmin">مراسلة إدارة الموقع</a> </h3>
  <?php
$getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    $userid = $info['handmade_id'];

         $getMessage = $con->prepare("SELECT message . *,
                                          customer.UserName AS UserCust,
                                          handmades.UserName AS UserHand
                                           FROM message 
                                          INNER JOIN customer ON customer.Cust_Id = message.CustMessage
                                          INNER JOIN handmades ON handmades.handmade_id = message.handMessage
                                         WHERE message.handMessage=$userid
                                           ");
    $getMessage->execute();
   $users = $getMessage->fetchAll();
         foreach($users as $usere) {
          ?>
<div class="container" style="background-color: #000;margin-left: 20pt">
 <img src="layout/iconuser.png" alt="Avatar" style="width:100%;background-color: #000">
      <h4><a style="color: #fff; " href='message.php?do=message&Id=<?php echo $usere['CustMessage'] ?>'>
    <?php echo  $usere['UserCust']  ?></a>  </h4>
</div>
          <?php
        }

//  $do=='message'   //

  $do = isset($_GET['do']) ? $_GET['do'] : 'message';
  }elseif ($do=='message') {

          $CustId = isset($_GET['Id']) && is_numeric($_GET['Id']) ? intval($_GET['Id']) : 0;
        
 $getMessage = $con->prepare("SELECT message . *,
                                          customer.UserName AS UserCust,
                                          handmades.UserName AS UserHand
                                           FROM message 
                                          INNER JOIN customer ON customer.Cust_Id = message.CustMessage
                                          INNER JOIN handmades ON handmades.handmade_id = message.handMessage
                                         WHERE message.CustMessage=$CustId
                                           ");
    $getMessage->execute();
    $messages = $getMessage->fetchAll();
                 foreach($messages as $message) {
          ?>
<div class="container" style="background-color: #000;margin-left: 20pt">
  <img src="layout/iconuser.png" alt="Avatar" style="width:100%;">
  <h5><?php echo  $message['UserHand'];   ?></h5>
  <p><?php echo  $message['message'];   ?></p>

</div>


<?php } ?>
            <form action="?do=sendMessage" method="POST"style="text-align: right;padding-right: 130pt;padding-left: 130pt;width: auto;">
              <label><?php echo  $message['UserCust'];   ?>المرسل اليه</label>
              <input type="text" name="message" class="form-control"  width="90pt">
             <input type="hidden" name="CustId" value="<?php echo $CustId ?>" />
             <input type="hidden" name="handId" value="<?php echo $userid ?> " />
              <input type="submit" name="" value="ارسال" class="button" style="background-color: #000">
            </form>
        
            <?php
                
   }elseif ($do == 'sendMessage') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message   = $_POST['message'];
    $CustId   = $_POST['CustId'];
    $handId   = $_POST['handId'];

$stmt = $con->prepare("INSERT INTO  message(message,CustMessage,handMessage)
                        VALUES(:zmessage, :zCustMessage, :zhandMessage) ");

$stmt->execute(array(

              'zmessage'  =>  $message,
              'zCustMessage'=> $CustId,
              'zhandMessage'=> $handId
            ));
echo "تم الارسال";
header('Location: message.php?do=Main');
      }
  }elseif ($do=='messageAdmin') {
   
         
        
 $getMessage = $con->prepare("SELECT messageadmin . *,
                                          
                                          handmades.UserName AS UserHand
                                           FROM messageadmin 
                                       
                                          INNER JOIN handmades ON handmades.handmade_id =  messageadmin.send
                                         WHERE messageadmin.send=$userid 
                                           ");
    $getMessage->execute();
    $messages = $getMessage->fetchAll();
                 foreach($messages as $message) {
          ?>
<div class="container" style="width:100%;background-color: #000;color: #fff">
  <img src="layout/iconuser.png" alt="Avatar" >
  <h5><?php echo  $message['UserHand'];   ?></h5>
  <p><?php echo  $message['message'];   ?></p>

</div>

<?php
$recepionId="1";
} ?>
            <form action="?do=sendAdmin" method="POST"style="text-align: right;padding-right: 130pt;padding-left: 130pt;width: auto;">
              <label style="color: #000"> ارسال الى مدير الموق </label>
              <input type="text" name="message" class="form-control"  width="90pt">
             <input type="hidden" name="recepion" value="<?php echo "1" ?>" />
             <input type="hidden" name="handId" value="<?php echo $userid ?> " />

              <input type="submit" name="" value="ارسال" class="button" style="background-color: #000">
            </form>
        
            <?php
                
   }elseif ($do == 'sendAdmin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message   = $_POST['message'];
    $recepion   = $_POST['recepion'];
    $handId   = $_POST['handId'];

$stmt = $con->prepare("INSERT INTO  messageadmin(message,recepion,send)
                        VALUES(:zmessage, :zrecepion, :zhandMessage) ");

$stmt->execute(array(

              'zmessage'  =>  $message,
              'zrecepion'=> $recepion,
              'zhandMessage'=> $handId
            ));
echo "تم الارسال";
header('Location: message.php?do=messageAdmin');
      }
  }
  } else {
    header('Location: login.php');
    exit();
  }
  include 'includes/footer.php';
  ob_end_flush();
?>