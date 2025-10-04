<?php
session_start();
//session_start();
  $pageTitle = $_SESSION['UserName'];

  include 'unity.php';

  if (isset($_SESSION['UserName'])) {
    $do = isset($_GET['do']) ? $_GET['do'] : 'Main';
       if ($do=='Main') {
           

$getUser = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    $userid = $info['Cust_Id'];

/* start statuse update */
 $stmtActive = $con->prepare("UPDATE message SET statusCust=1 WHERE  statusCust = 0 AND CustMessage= $userid");
        $stmtActive->execute();

/*End statuse update */
         $getMessage = $con->prepare("SELECT message . *,
                                          customer.UserName AS UserCust,
                                          handmades.UserName AS UserHand
                                           FROM message 
                                          INNER JOIN customer ON customer.Cust_Id = message.CustMessage
                                          INNER JOIN handmades ON handmades.handmade_id = message.handMessage
                                         WHERE message.CustMessage=$userid
                                           ");
    $getMessage->execute();
  $users = $getMessage->fetchAll();
  echo " <h1 style='text-align: center;color:#000'>جهات الاتصال </h1>";
         foreach($users as $usere) {
          ?>
<div class="container" style="background-color: #000">
  <img src="images/user.png" alt="Avatar" style="width:100%;">
  <h4><a style="color: #fff; " href='message.php?do=message&Id=<?php echo $usere['handMessage'] ?>'>
    <?php echo  $usere['UserHand']  ?></a>  </h4>
</div>
          <?php
        }

        //  $do=='message'   //

  $do = isset($_GET['do']) ? $_GET['do'] : 'message';
       
        } elseif ($do=='message') {
         
        

          $userid = isset($_GET['Id']) && is_numeric($_GET['Id']) ? intval($_GET['Id']) : 0;
         

          $getCust = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
    $getCust->execute(array($sessionUser));
    $customer = $getCust->fetch();
    echo "customer", $customer['Cust_Id'];
    $CustId=$customer['Cust_Id'];

 $getMessage = $con->prepare("SELECT message . *,
                                          customer.UserName AS UserCust,
                                          handmades.UserName AS UserHand
                                           FROM message 
                                          INNER JOIN customer ON customer.Cust_Id = message.CustMessage
                                          INNER JOIN handmades ON handmades.handmade_id = message.handMessage
                                         WHERE message.handMessage=$userid
                                           ");
    $getMessage->execute();
    $messages = $getMessage->fetchAll();
  
                 foreach($messages as $message) {
               

          ?>

<div class="container" style="background-color: #000">
  <img src="images/user.png" alt="Avatar" style="width:100%;">
  <h5 style="color: #fff; "><?php echo  $message['UserHand'];   ?></h5>
  <p style="color: #fff; "><?php echo  $message['message'];   ?></p>
 
</div>
    <?php }
     ?>
            <form action="?do=sendMessage" method="POST"style="text-align: right;padding-right: 130pt;padding-left: 130pt">
              <label><?php echo  $message['UserHand'];   ?>المرسل اليه</label>
              <input type="text" name="message" class="form-control">
             <input type="hidden" name="CustId" value="<?php echo $CustId ?>" />
             <input type="hidden" name="handId" value="<?php echo $userid ?> " width="90pt" />
              <input type="submit" name="" value="ارسال" class="button">
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
}
       
        

          // WHERE message.CustMessage=$userid
          ?>



<?php
  } else {
    
    header('Location: home.php');
    exit();
  }
  include 'includes/footer.php';
  ob_end_flush();
?>

