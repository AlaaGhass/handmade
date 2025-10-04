<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php getTitle() ?></title>
		<link rel="stylesheet" href="layout/css/bootstrap.min.css" />
		<link rel="stylesheet" href="layout/css/front.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>

<nav class="navbar navbar-inverse">
 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
       
      </button>
      <a class="navbar-brand" href="index.php">
   HnadMade
    </a>
    </div>
    <?php
      if (isset($_SESSION['userAdmin'])) {
        //echo "string";


    ?>
    <div class="collapse navbar-collapse" id="app-nav">
      
      <ul class="nav navbar-nav navbar-right">
        
        
<li role="presentation">
  <a href="logout.php" style="color: #fff">
</a>
 
</li>
<li class="dropdown">
  <a href="logout.php" style="color: #fff">
        <i>loguot</i>
            </a>
         
        </li>
      </ul>
    </div>
    <?php
}
  ?>
  </div>
</nav>