<?php
ob_start();
	session_start();
	$pageTitle = 'Admin';
	
    include 'unity.php';


?>



<div id="container">

	  
	  
	   <div id="header">
 
         
		<div id="logo-banner">
		   
				<div id="logo">
					<a href="index.php"><img src="images/logo.png" alt="" /></a>
				</div>
				
				<div id="banner">
                
				</div>
		
		</div>
		</div> <!--DHAMAADKA hedaerka-->
		

	
			
	

		 <table>
<form class="register active" id="myForm" action="insertCategory.php" method="POST" name="addEmployee" >

					<h2>  Add Category</h2> 
						

   <tr>
    <td>  

	  <label>Category Name:</label>
		
		<input type="text" id="empValid" name="categoryName" placeholder="Category Name" required>
		
	</td>
   <td>   

	<label>Description:</label>

		<input type="text" id="empValid" name="description" placeholder="Description" required>
		
		

   </td>
       <td>  

		<label> Select Image:</label>
		
		<input type="file" name="picture" id="picture"  required>
		
                               
	</td>

   </tr>



   
   <tr>
						<div class="bottom">

						<td colspan="3">	
						
						<button name="submit" id="save" title="Click to Save"  class="a-btn"> <span class="a-btn-text">Add Category</span></button>
						
						</td>
							
							<div class="clear"></div>
						</div>
						
		
	</tr>
	</form>
					
	</table>
	</div>


		

		<div class="tab_container">




</tbody>
</table>
	  
 </div> 

</div><!-- end of .tab_container -->

		
	</section>
          </div>
   </div>
    
