<?php
  $conn = mysqli_connect("localhost", "root", "", "handmade");
  $results = mysqli_query($conn, "SELECT * FROM products");
  $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>All product</title>
  <!-- Bootstrap CSS -->
 
</head>
<body>
 <div class="features" >
    <div class="container d-flex h-100 align-items-center">
      <div class="row">
    
        <br>
        <br>
        
            <?php foreach ($users as $user): ?>
             <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
                <a class="box" > <img src="<?php echo 'images/' . $user['image'] ?>" width="90" height="90" alt=""> </a>
                <h3> <?php echo $user['prodectName']; ?> </h3>
              <?php  echo "<img src='image/" . $user['image'] . "' alt='' />"; ?>
                <p>Price:<big style="color:#f0534c">$<?php echo $user['price']?></big></p>
             </div>
            <?php endforeach; ?>
       
      </div>
    </div>
  </div>
</body>
</html>