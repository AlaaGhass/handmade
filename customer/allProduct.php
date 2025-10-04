<?php 
  include 'unity.php';
 $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
        if ($do == 'Manage') {
  $getSort = $con->prepare("SELECT * FROM category ");
    $getSort->execute();
    $sorts = $getSort->fetchAll();
    ?><div class="features text-center" >
  <div class="container" style="padding: 5pt;color: #fff">
    <?php
        foreach($sorts as $sort) {
?>
<div class="button col-lg-2 col-md-2 col-sm-12 col-xs-12" style="background-color: #000;color: #fff;border-radius: 7pt;margin-left: 10%;margin: 9pt"> 
      <h3><a  style="color: #fff" href="allProduct.php?do=sort&id=<?php echo $sort['Category_ID'] ?>"><?php  echo $sort['Category_Name']  ?></a></h3>
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
 <p style="text-align: right;color: #fff">السعر  &#8362;<del><?php echo $prod['price']?></del></p>
   <?php     }else{ ?>
 <p style="text-align: right;color: #fff"> السعر &#8362;<?php echo $prod['price']?></p>
 <?php       }?>
      
        <p  style="text-align: right;color: #fff"><a style="color: #fff" href="allProduct.php?do=handMade&id=<?php echo $prod['hand_id'] ?>"><?php echo $prod['handName']?><strong>البائع</strong></a></p>
        
       <a href="allProduct.php?do=More&id=<?php echo $prod['ID'] ?>" class="btn btn-default" role="button">مشاهدة التفاصيل</a> 
      </div>
    </div>
  </div>
<?php
 } ?>

<?php
        }elseif ($do == 'handMade') {
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

          //  echo "handmade", $id;

             $stmt = $con->prepare("SELECT * FROM handmades WHERE handmade_id = ?");
                   $stmt ->execute(array($id));
                   $info = $stmt->fetch();
                  ?>

<div class="data-profile"style="width: 70%;margin-left: 20%">
  
  <br>
  <h2 class="font-user">
<div class="nave-left" >
  <img src="layout/userWoman.png" style="margin-right: 40%">
  <br>
  <h2 class="font-user" style="text-align: center;">
  <?php 

  echo $info['UserName'] 
  
   ?>
   </h2>
   <h3><hr>
      <span style="text-align: left;margin-right: 14px;">الاسم الكامل  :</span>
      <?php 
    echo $info['handmade_Name']    
    ?>
  
    
   
   </h3><hr>
   <h3>
      <?php 
  echo $info['Phone'] 
    ?>
   <span style="text-align: left;margin-right: 14px;">:رقم الهاتف</span>
    
   
   </h3><hr>
   <h3>  
    <?php 
  echo $info['Email'] 
    ?>
    <span style="text-align: left;margin-right: 14px;">: الايميل</span>
    

   </h3>
   <hr>
   <h3>
    <span style="text-align: left;margin-right: 14px;">  العنوان  :</span>
    <?php 
  echo $info['address'] 
    ?>
    
   
    
   </h3>
   </div>
   
 </div>
<?php
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

      <p  style="text-align: right;"><a style="color: #000" href="products.php?do=handMade&id=<?php echo $prod['hand_id'] ?>"> <strong>البائع</strong> <?php echo $prod['handName']?></a></p>

         <h3>اسم المنتج<?php echo " : ", $prod['prodectName']?></h3>

         <p style="text-align: right;">السعر<?php echo $prod['price']?></p>

            <p><strong>معلومات عن المنتج</strong><?php echo "  ", $prod['Description']?></p>

            
         </div>  </div> 

<?php
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
        <p style="text-align: right;color: #fff">&#8362;السعر<?php echo $prod['price']?></p>
        <p  style="text-align: right;color: #fff">البائع <a style="color:#fff" href="?do=handMade&id=<?php echo $prod['hand_id'] ?>"><?php echo $prod['handName']?></a>  <strong></strong></p>
        
        <p> <a  href="?do=More&id=<?php echo $prod['ID'] ?>" class="btn btn-default" role="button">مشاهدة التفاصيل</a> </p>
      </div>
    </div>
  </div>
<?php
} }
?>