<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title> <?php echo getTitle(); ?> </title>
		<link rel="stylesheet" href="layout/css/bootstrap.min.css" />   <!--add library bootstrap    !-->
		<link rel="stylesheet" href="layout/css/front.css" />     <!-- page=> front .css    !-->
    
	</head>
	
 
  
	<nav class="navbar navbar-inverse">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        
      </button>
     <div >
      <a class="navbar-brand" href="home.php">
      
         HandMade
 

  </a>
</div>
    </div>
   
	<?php
			if (isset($_SESSION['UserName'])) {   /// show  session username
				
		?>

			<div class=" navbar-collapse navbar-right" id="app-nav">
				      <ul class="nav navbar-nav ">
        
            
    
           
           <li role="presentation"><a href="message.php?do=Main" class="notification">
           الرسائل  <span class="badge"><?php
           $getUser = $con->prepare("SELECT * FROM customer WHERE UserName = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    $useridR = $info['Cust_Id'];
                            $stmt2 = $con->prepare("SELECT COUNT(statusCust) FROM  message WHERE statusCust=0 AND CustMessage=$useridR");

                                  $stmt2->execute();

                               $countIhand=  $stmt2->fetchColumn();
                               $countsIhand=$countIhand;
          
                   echo $countsIhand; ?></span>
                  </a>
           </li>

           <li role="presentation"><a href="profile.php">
            <?php 
            echo $_SESSION['UserName']; ?>    </a>
           </li>

<!-- ------------------------------   !-->
</ul>
    </li>
       
      <ul class="nav navbar-nav ">
             <li class="dropdown">
          <a href="products.php" > تصفح المنتجات</a>
        </li>
               <li class="dropdown">
          <a href="products.php?do=MyShop" > مشترياتي</a>
        </li>
         <li class="dropdown">
          <a href="products.php?do=shoppingcart" > سلة التسوق</a>
        </li>
        <li class="dropdown">
          <a href="logout.php" > تسجيل الخروج </a>
    

<?php
}else{      //the user is not do login
		?>
	
       <ul class="nav navbar-nav navbar-right">
        
    
            <li><a href="home.php">login</a></li>
            
        </ul>
      </ul>

  
	
</div>
			<?php
}
?>
		
	</nav>

<body>