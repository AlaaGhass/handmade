<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php getTitle() 
   ?></title>
		<link rel="stylesheet" href="layout/css/bootstrap.min.css" />
		<link rel="stylesheet" href="layout/css/front.css" />
	</head>
	<nav class="navbar navbar-inverse">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        
      </button>
     <div >
      <a class="navbar-brand" href="profile.php">
      
    <img src="hand.png" style="width: 100pt">
 

  </a>
</div>
    </div>
   
	<?php
			if (isset($_SESSION['userHand'])) {   /// show  session username
				
		?>

			<div class=" navbar-collapse navbar-right" id="app-nav">
				      <ul class="nav navbar-nav ">
        
            
    
           
           <li role="presentation"><a href="message.php" class="notification">
          الرسائل   
       <span class="badge"><?php
                 $getUser = $con->prepare("SELECT * FROM handmades WHERE UserName = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    $useridR = $info['handmade_id'];

                            $stmt2 = $con->prepare("SELECT COUNT(statusHand) FROM  message WHERE statusHand=0 AND handMessage= $useridR ");

                                  $stmt2->execute();

                               $countIhand=  $stmt2->fetchColumn();
                               $countsIhand=$countIhand;
          
                   echo $countsIhand; ?></span>
                  </a>
           </li>

           <li role="presentation"><a href="profile.php">
            <?php 
            echo $_SESSION['userHand']; ?>    </a>
           </li>
             <li role="presentation"><a href="requests.php"class="notification">
           طلبات البيع   <span class="badge"><?php
 
                            $stmt2 = $con->prepare("SELECT COUNT(status) FROM  requests WHERE status=0 AND hand_id=$useridR");

                                  $stmt2->execute();

                               $countIhand=  $stmt2->fetchColumn();
                               $countsIhand=$countIhand;
          
                   echo $countsIhand; ?></span>
                  </a>
           </li>
             <li role="presentation">
          <a href="logout.php" > تسجيل الخروج  
          </a>
         
          

        </li>

<!-- ------------------------------   !-->
</ul>

     </a>
   </li>
 </a>
</li></ul></div>

      
    		
				

<?php
}else{      //the user is not do login
		?>
	
       <ul class="nav navbar-nav navbar-right">
        
    
            <li><a href="login.php">login</a></li>
            
        </ul>
      </ul>

  
	
</div>
			<?php
}
?>
		
	</nav>
	<body>