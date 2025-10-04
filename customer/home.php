<style type="text/css">
  .home{
    width: 100%;
    height: 600pt;
       padding: 10pt
  }
  .home img{
    width: 100%;
    height: 470pt;
     border-radius: 5pt
  }
  .categories{
     background-color: #000;
    width: 200pt;
    height: 450pt;
     border-radius: 5pt;
      margin: 5pt;
     
      text-align: center; font-style: initial;
  }
  .categories ul{
width: 100%
  }
  .categories li{
text-align: right;
font-size: 16px;
margin-right: 29pt;
  }
  .boxP{
    width: 20pt
    height:12pt;
  }
   .boxP img{
    width: 120pt;
    height:102pt;
  }
</style>

<?php
  ob_start();
  session_start();
  $pageTitle = 'Login';
  if (isset($_SESSION['UserName'])) {
    header('Location:profile.php');
  }
  include 'unity.php';

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['login'])) {

            $user = $_POST['username'];
            $pass = $_POST['password'];
            //$hashedPass = sha1($pass);


            $stmt = $con->prepare("SELECT 
                                        Cust_Id, UserName, Password 
                                    FROM 
                                        customer 
                                    WHERE 
                                        UserName = ? 
                                    AND 
                                        Password = ?");

            $stmt->execute(array($user, $pass));

            $get = $stmt->fetch();

            $count = $stmt->rowCount();

            // If Count > 0 This Mean The Database Contain Record About This Username

            if ($count > 0) {

               $_SESSION['UserName'] = $user; // Register Session Name

                $_SESSION['Cust_Id'] = $get['Cust_Id']; // Register User ID in Session

                header('Location: profile.php'); // Redirect To Dashboard Page

                exit();
            }else {

             echo '<div class="alert alert-danger">';
               echo '<h1>' , 'كلمة المرور خاطئة ','</h1>'; echo '<h1>' , 'هل تود','<a href="signup.php">انشاء حساب </a>','</h1>';
              echo '</div>';

            //} 
        // header('Location: signup.php');
       }
//}


            }}




  
?>
<!-- start header -->
<div  style="width: 250pt;height:60pt;margin: 10pt;margin-left: 40%; font-size: 50pt;color: #000;font-style: italic;font-family: initial;">Handmade</div>
 
<div class="home">
<!--start login    -->

  <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12 homeLogin" >
    <form  class=" "   action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
           <div class="imgcontainer">

<!--       !-->

           <h1 class="text-center"style="fONT-STYLE:NORMAL">
      مشتري </h1> 
       </div>
        <div class="input-container"style="margin-right:10pt">
            <input 
                class="form-control" 
                type="text" 
                name="username" 
                autocomplete="off"
                placeholder="اسم المستخدم" 
                 />
        </div>
        <div class="input-container" style="margin-right:10pt">

            <input 
                class="form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password"
                placeholder="كلمة المرور" 
                 />
                <i class="fa-user-circle-o focus-input" aria-hidden="true"></i>
        </div>
        
<div class="input-container"style="margin-right:10pt">
    <input class="btn btn-primary btn-block input-container" name="login" type="submit" value="دخول" /></div>
        <div class="text-center p-t-90">
                        <a class="txt1" href="forgotPassword.php" style="text-align: center;color: #fff;">
                            هل نسيت كلمة المرور  ؟
                        </a><br>
                        <a class="txt1" href="../handmade/login.php" style="text-align: center; font-style: initial;color: #fff;">
                            دخول كصاحب حرف
                        </a>
                    <br>
              <a class="txt1" href="signup.php" style="text-align: center; font-style: initial;color: #fff;">
                           انشاء حساب
                        </a> 
                        </div>
                              
    </form>

  </div>
  <!--End login    -->


<!--Start slideshow    -->

<span class=""></span>

  <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="slideshow-container">
  <img src="images/ncover7.jpg" style="width:100%"> 

</div>
<br>

 <!--End slideshow    -->
</div>
 <?php
   $getSort = $con->prepare("SELECT * FROM category ");
    $getSort->execute();
    $sorts = $getSort->fetchAll();
    ?>
  <!--start categories     -->
  <div class=" col-lg-2 col-md-2 col-sm-12 col-xs-12">
    <div class="categories">
     <img src="logo.png" style="height: 90px;width: 130px;margin: 10px;">
      <br>
      <ul ><h3 style="background-color: rgb(255 255 255 / 70%); color: #0a263e;">اصناف
      </h3>  
          <?php
        foreach($sorts as $sort) {
?>
      <li><a style="color: #fff;" href="allProduct.php?do=sort&id=<?php echo $sort['Category_ID'] ?>"><?php echo $sort['Category_Name'] ?></a></li>
<?php } ?>
      </ul>
    </div>
  </div>
   <!--categories end     -->
</div>

</div>
 <!-- Start features -->
 <?php
   $getSort = $con->prepare("SELECT * FROM category ");
    $getSort->execute();
    $sorts = $getSort->fetchAll();
    ?><div class="features text-center" style="margin-top: -200pt;margin-left: 9%" >
  <div class="container" style="padding: 5pt;color: #fff;">
    <?php
        foreach($sorts as $sort) {
?>
<div class="button col-lg-3 col-md-3 col-sm-12 col-xs-12" style="background-color: #000;color: #fff;border-radius: 7pt;margin-right: 12pt; margin: 9pt;width:230pt"> 
      <h3 ><a  style="color: #fff" href="?do=sort&id=<?php echo $sort['Category_ID'] ?>"><?php  echo $sort['Category_Name']  ?></a></h3>
    </div>


<?php
        }?>
</div>
</div>

</div>
<?php
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if ($do == 'sort') {  
          $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
          ?>
 <div class="row"  style="padding-top: 70pt">
<div class="features" style="height: auto;margin-top: -200pt" >
   
      <?php
        $getProd = $con->prepare("SELECT products . *,
                                          category.Category_Name AS catName,
                                          handmades.UserName AS handName
                                           FROM products 
                                          INNER JOIN category ON category.Category_ID = products.Category_ID
                                          INNER JOIN handmades ON handmades.handmade_id = products.hand_id
                                          WHERE products.Category_ID=$id
                                          LIMIT 8

                                           ");
    $getProd->execute();
    $prods = $getProd->fetchAll();
        foreach($prods as $prod) {
          ?>
       
  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: center;margin-top: 9%;">
    <div class="thumbnail"  style="background-color: #000;color: #fff;height: 210pt;width: 160pt;border-radius: 7pt">
      <img src="<?php echo '../handmade/imageUp/' . $prod['image'] ?>" alt="..."  style="height: 145pt;width: 150pt">
      <div class="caption" style="color: #fff">
        <h5><?php echo $prod['prodectName']?></h5>
        <p style="text-align: right;"> &#8362;السعر<?php echo $prod['price']?> </p>
        
      </div>
    </div>
  </div>

<?php
        }}
        ?>

<br>
        
       </div>
        </div>
        
     
 <h2 style="color: #fff;text-align: center;background-color: #000;width: 190pt;margin-left: 60%">المنتجات الاكثر مبيعاُ</h2>
<div class="row"  style="padding-top: 70pt">
<div class="features" style="height: auto;margin-top: -200pt" >
  <div style="width: 90%;margin-top: 150pt;">
<?php 
// start best selling products ////
 // $stmt2 = $con->prepare("SELECT COUNT(prodect_id) FROM requests WHERE stopSelling=0 AND Delivered=1");

   //                               $stmt2->execute();

//                               $countItems=  $stmt2->fetchColumn();
          
                //   echo $countItems;
              $stmt3 = $con->prepare("SELECT prodect_id, SUM(Delivered) AS TotalQuantity
FROM requests
GROUP BY prodect_id
ORDER BY SUM(Delivered) DESC
LIMIT 8   "); 
     $stmt3->execute();
                 $bestPs=  $stmt3->fetchAll();
                //echo $coun['TotalQuantity'];
                //echo "///";
             //   echo $coun['prodect_id'];
          
                       foreach($bestPs as $bestP) {
                    $bestProdectId=  $bestP['prodect_id'];
                     //  echo "<h1 style='color:#000'>", $bestP['prodect_id'],"</h1>";
       $getProd = $con->prepare("SELECT requests . *,
                                          products.prodectName AS prodectName,
                                           products.image AS prodectImage,
                                          handmades.UserName AS handName
                                           FROM requests
                                          INNER JOIN products ON products.ID = requests.prodect_id

                                          INNER JOIN handmades ON handmades.handmade_id = requests.hand_id
                                          WHERE prodect_id = $bestProdectId
                                           ");
    $getProd->execute();
    $prod = $getProd->fetch();
    ?>
   
     <div class="" > 
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="text-align: center;">
    <div class="thumbnail "  style="background-color: #000;color: #fff;height: 210pt;width: 160pt;border-radius: 7pt">
      <img src="<?php echo '../handmade/imageUp/' . $prod['prodectImage'] ?>" alt="..." style="height: 145pt;width: 170pt">
      <div class="caption" style=": #fff">
        <h3 style=" color: #fff"><?php echo $prod['prodectName']?></h3>
       
      
    
        
   
    </a> 
      </div>
    </div></div>
  </div>
  <?php
}//}
// end best selling products ////
?>

</div>
</div>
<?php
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if ($do == 'suggestion') {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $suggestion   = $_POST['suggestion'];
  

$stmt = $con->prepare("INSERT INTO  suggestion(suggestion)
                        VALUES(:zsuggestion) ");

$stmt->execute(array(

              'zsuggestion'  =>  $suggestion
          
            ));
          }}
?>



  <section id="signup" class="signup-section" style="margin-left: 25%">
    <div class=" "  style="background-color: #e4e4e4;">
      <div class="row">
        <div class=" col-md-10 col-lg-8 mx-auto text-center">

         
          <h2 class=" mb-5 " style="color:#000">شاركنا ارائك في كل وقت</h2>

          <form class="form-inline d-flex" action="?do=suggestion" method="POST">
            <input type="text" name="suggestion" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="شاركنا ارائك">
            <button type="submit" class="btn btn-primary mx-auto">شارك</button>
          </form>

        </div>
      </div>
    </div>
  </section>
      <!-- End  Signup Section   -->

<br>
 <!-- Contact Section -->
  <div class="col-md-4 mb-3 mb-md-0" style="color: #000">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="glyphicon glyphicon-envelope text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Email</h4>
              <hr class="my-4">
              <div class="small text-black-50">
                <a href="mailto:handmademessages@gmail.com?subject=Feedback&body=Message">handmade@gmail.com</a>
              </div>
            </div>
          </div>
        </div>
  <section class="contact-section bg-black" style="background-color: #e4e4e4">
    <div class="container"  style="background-color: #e4e4e4;margin-left: 10%;">

      <div class="row">

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="glyphicon glyphicon-map-marker text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Address</h4>
              <hr class="my-4">
              <div class="small text-black-50">Palestine</div>
            </div>
          </div>
        </div>

       

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fa fa-mobile text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Phone</h4>
              <hr class="my-4">
              <div class="small text-black-50">0569991158</div>
            </div>
          </div>
        </div>
      </div>

    
      

    </div>
  </section>



    
 </div> 







