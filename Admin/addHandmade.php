   <?php 

  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $password2  = $_POST['password2'];
            $email      = $_POST['email'];
            $address      = $_POST['address'];
            $identity      = $_POST['identity'];
            $phone      = $_POST['phone'];


            
            $stmt = $con->prepare("INSERT INTO 
                                            handmade (handmade_Name,Password, Email,Phone,identity,address)
                                        VALUES(:zuser, :zpass, :zmail,:zphone,:zidentity,:zaddress)");
                    $stmt->execute(array(

                        'zuser'  => $username,
                        'zpass'  => $password,
                        'zmail'  => $email,
                        'zphone' => $phone,
                        'zidentity'=>$identity,
                        'zaddress' =>$address



                    ));
                }
                    ?>
<div class=" ">
    
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="?do=Insert" class="limiterLogin ">
       <div class="">

     <img src="images/user.png">

           <h1 class="text-center">
      انشاء حساب صاحب حرف </h1> 
       </div>
        <div class="input-container ">
            <input 
                pattern=".{4,}"
                title="Username Must Be Between 4 Chars"
                class="form-control" 
                type="text" 
                name="username" 
                autocomplete="off"
                placeholder="اسم المستخدم" 
                required
                 />
               <span class="asterisk">  </span>  
    
        </div>
        <div class="input-container  ">
            <input 
                minlength="4"
                class="form-control" 
                type="password" 
                name="password" 
                autocomplete="new-password"
                placeholder=" كلمة المرور " 
                required
                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input 
                minlength="4"
                class="form-control" 
                type="password" 
                name="password2" 
                autocomplete="new-password"
                placeholder=" تأكيد كلمة المرور " 
                required
                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input 
                class="form-control" 
                type="email" 
                name="email" 
                placeholder=" بريد الالكتروني "
                required />
                 <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input 
                class="form-control" 
                type="text" 
                name="phone" 
                autocomplete="off"
                placeholder="رقم الهاتف" 
                required
                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container ">
            <input
                class="form-control" 
                type="text" 
                name="address" 
                autocomplete="off"
                placeholder=" العنوان" 
                required

                 />
                  <span class="asterisk">  </span>  
        </div>
        <div class="input-container  ">

            <input
                class="form-control" 
                type="text" 
                name="identity" 
                autocomplete="off"
                placeholder="رقم الهوية" 
                required
                
                 />
                  <span class="asterisk">  </span>  
        </div>
        <input class="btn  btn-block" name="signup" type="submit" value="Signup" />
