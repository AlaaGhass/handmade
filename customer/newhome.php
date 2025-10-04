<style type="text/css">
  .home{
    width: 100%;
    height: 600pt;
    background:  url("");
    padding: 10pt
  }
  .home img{
    width: 100%;
    height: 470pt;
     border-radius: 5pt
  }
  .categories{
     background-color: rgb(5 41 76 / 59%);
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
</style>


<?php
include 'unity.php';

?>

<div class="home">
<!--start login    -->
  <div class=" col-lg-3 col-md-3 col-sm-12 col-xs-12 homeLogin">
    <form  class=" "   action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
           <div class="imgcontainer">

<!--       !-->

           <h1 class="text-center">
      مشتري </h1> 
       </div>
        <div class="input-container">
            <input 
                class="form-control" 
                type="text" 
                name="username" 
                autocomplete="off"
                placeholder="Type your username" 
                 />
        </div>
        <div class="input-container">

            <input 
                class="form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password"
                placeholder="Type your password" 
                 />
                <i class="fa-user-circle-o focus-input" aria-hidden="true"></i>
        </div>
        <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

        <input class="btn btn-primary btn-block input-container" name="login" type="submit" value="Login" />
        <div class="text-center p-t-90">
                        <a class="txt1" href="#" style="text-align: center;">
                            هل نسيت كلمة المرور  ؟
                        </a><br>
                        <a class="txt1" href="../employee/login.php" style="text-align: center; font-style: initial;">
                            دخول صاحب حرف
                        </a>
                    <br>
              <a class="txt1" href="signup.php" style="text-align: center; font-style: initial;">
                           انشاء حساب
                        </a> 
                        </div>
                              
    </form>

  </div>
  <!--End login    -->
<!--Start slideshow    -->
  <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="slideshow-container">

<div class="mySlides fade">
  <img src="images/ncover7.jpg" style="width:100%"> 
</div>
<div class="mySlides fade">
  <img src="images/ncover2.jpg" style="width:100%">
</div>
<div class="mySlides fade">
  <img src="images/ncover3.jpg" style="width:100%">
</div>
<div class="mySlides fade">
  <img src="images/ncover4.jpg" style="width:100%">
</div>
<div class="mySlides fade">
  <img src="images/ncover5.jpg" style="width:100%">
</div>
<div class="mySlides fade"> 
  <img src="images/ncover6.jpg" style="width:100%">
</div>
<div class="mySlides fade">
  <img src="images/ncover1.jpg" style="width:100%">
</div>
<div class="mySlides fade">
  <img src="images/ncover8.jpg" style="width:100%">
</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
   <span class="dot"></span> 
  <span class="dot"></span> 
</div>
 <!--End slideshow    -->
</div>
</div>
  <!--start categories     -->
  <div class=" col-lg-2 col-md-2 col-sm-12 col-xs-12">
    <div class="categories">
      <h2 style="padding: 17pt">Hand Made</h2>
      <br>
      <ul ><h3 style="background-color: rgb(255 255 255 / 70%); color: #0a263e;">اصناف
      </h3>  
      <li>طعام</li>
      <li>ملابس</li>
      <li>  اكسسوارات</li>
       <li> اقمشة و تطريز </li>
        <li> تحف </li>
         <li> ادوات مطبخ </li>
      </ul>
    </div>
  </div>
   <!--categories end     -->
</div>


 <!-- Start features -->
<div class="features text-center">
  <div class="container">
    <div class="box col-lg-2 col-md-2 col-sm-12 col-xs-12">
      
      <img src="images/p4.png">
      <h3>ملابس</h3>
   
      
    </div>
    <div class="box col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <img src="images/p11.png">
      <h3>اكسسوارات</h3>
    
      
    </div>
    <div class="box col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <img src="images/6.jpg">
      <h3>تحف</h3> 
    </div>
    <div class="box col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <img src="images/ncover4.jpg">
      <h3>طعام</h3>
    </div>
      <div class="box col-lg-2 col-md-2 col-sm-12 col-xs-12">
       <img src="images/2.jpg">
      <h3>ادوات مطبخ</h3>
    </div>
      <div class="box col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <img src="images/p20.jpg">
      <h3>اقمشة و تطريز</h3>
    </div>

  </div>
  
</div>

</div>





<br>
 <!-- Contact Section -->
  <section class="contact-section bg-black">
    <div class="container">

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
              <i class="glyphicon glyphicon-envelope text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Email</h4>
              <hr class="my-4">
              <div class="small text-black-50">
                <a href="#">handmade@gmail.com</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
          <div class="card py-4 h-100">
            <div class="card-body text-center">
              <i class="fa fa-mobile text-primary mb-2"></i>
              <h4 class="text-uppercase m-0">Phone</h4>
              <hr class="my-4">
              <div class="small text-black-50">056999999</div>
            </div>
          </div>
        </div>
      </div>

    
      

    </div>
  </section>



<?php
$result = mysqli_query($con,"SELECT * FROM products");
?>
      <div id="tab1" class="tab_content">
  <table class="tablesorter" cellspacing="0"> 

      <thead>  <th Colspan="11">   Product Data Table </th></thead>
    <thead>
      </tr>
          
           
              <th> Name</th>        
        <th>Category</th>
        <th>Model</th>        
        <th> Type</th>
       <th>WareHouse</th>       
        <th> Description</th>
      <th>Price</th>        
        <th> Picture</th>
   
      </tr>
    </thead>
    <tbody>
     <?php while($row = mysqli_fetch_array($result))
    {?>

    <tr>
   
    <td><?Php echo $row['Product_ID']; ?></td>
    <td><?php echo $row['prodectName']; ?></td>
   <td><?php echo $row['Category_ID']; ?></td>
  <td><?php echo $row['Model']; ?></td>
    <td><?Php echo $row['Type']; ?></td>
    <td><?php echo $row['Warehouse_ID']; ?></td>
   <td><?php echo $row['Description']; ?></td>
  <td><?php echo $row['Price']; ?></td>
    <td> <img src="../images/<?php echo $row['image']; ?> " width="40" height="40"   ></td>
    <td> <a href="prodViewUpdate.php?update=<?php echo $row['Product_ID']; ?>"  onClick="edit(this);" title="empEdit" >  <input type="image" src="images/icn_edit.png" title="Edit"> </a>
     <a href="prodDelete.php?delete=<?php echo $row['Product_ID']; ?>" onClick="del(this);" title="Delete" class="delbutton"><input type="image" src="images/icn_trash.png" title="Trash">  </a></td>
    </tr>

  <?php }mysqli_close($mysqli);?>
</tbody>
</table>
    
 </div> 


  <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
      Copyright &copy; Your Website 2019
    </div>
  </footer>




<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2100); // Change image every 2 seconds
}
</script>