<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<?php
	
	if(isset($_POST['submit']))	{
		
		$to = "jirczech@gmail.com";
		$subject = wordwrap(escape($_POST['subject']), 70);
		$body = escape($_POST['body']);
		$header = "From: " . escape($_POST['email']);
		
		mail($to, $subject, $body, $header);
		
	}
	
?>

<div class="container">
    
	<section id="login">
		    
        <div class="row">
	        
            <div class="col-xs-6 col-xs-offset-3">
	            
                <div class="form-wrap">
	                
                <h1>Send Message</h1>
                
                	<hr>
                
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
	                    
	                    <h6 class="text-center"><?php ?></h6>
	                    
						<div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email:">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="email" class="form-control" placeholder="Subject:">
                        </div>
                        
                        <div class="form-group">
                            <textarea name="body" class="form-control" cols="50" rows="10" placeholder="Message:"></textarea>                      
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                        
                    </form>
                 
                </div>
                
            </div>
            
        </div>
	    
	</section>
	
	<hr>

<?php include "includes/footer.php";?>