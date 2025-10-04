<?php include_once('processForm.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Image Preview and Upload PHP</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
 <style type="text/css">
   .form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
#profileDisplay { display: block; height: 210px; width: 60%; margin: 0px auto; border-radius: 50%; }
.img-placeholder {
  width: 60%;
  color: white;
  height: 100%;
  background: black;
  opacity: .7;
  height: 210px;
  border-radius: 50%;
  z-index: 2;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  margin-top: 40%;
  color: white;
}
.img-div:hover .img-placeholder {
  display: block;
  cursor: pointer;
}
 </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-4 offset-md-4 form-div">
        <a href="profiles.php">View all profiles</a>
        <form action="form.php" method="post" enctype="multipart/form-data">
          <h2 class="text-center mb-3 mt-3">Update profile</h2>
          <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4>Update image</h4>
              </div>
              <img src="images/avatar.jpg" onClick="triggerClick()" id="profileDisplay">
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
            <label>Profile Image</label>
          </div>
          <div class="form-group">
            <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">الاسم</label>
            <div class="col-sm-10 col-md-6">
              <input 
                type="text" 
                name="nameHand" 
                class="form-control" 
                required="required"  
                placeholder="اسم منتج" />
            </div>
          </div>
          <!-- End Name Field -->
          <!-- Start Description Field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">تفاصيل</label>
            <div class="col-sm-10 col-md-6">
              <input 
                type="text" 
                name="description" 
                class="form-control" 
                required="required"  
                placeholder="تفاصيل" />
            </div>
          </div>
          <!-- End Description Field -->
          <!-- Start Price Field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">السعر</label>
            <div class="col-sm-10 col-md-6">
              <input 
                type="text" 
                name="price" 
                class="form-control" 
                required="required" 
                placeholder="السعر" />
            </div>
          </div>
          <!-- End Price Field -->
        
          <!-- Start type Field -->
          <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label"  >النوع</label>
            <div class="col-sm-10 col-md-6">
              <select name="type" style="color: #000" required="required">
                <option value="1">ادوات مطبخ</option>
                <option value="1">اكسسوارات</option>
                <option value="3">زينه</option>
                <option value="4">ادوات مطبخ</option>
                <option value="5">ملابس</option>
                <option value="6">مطرزات</option>
                <option value="7">اقمشة و ستائر</option>
                <option value="8">صابون</option>
                <option value="9">شموع</option>
                <option value="10">توزيعات </option>
                <option value="11"> رسم حناء</option>
              </select>
            </div>
          </div>
          <!-- End type Field -->





          </div>
          <div class="form-group">
            <button type="submit" name="save_profile" class="btn btn-primary btn-block">Save </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

