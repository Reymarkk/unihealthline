<?php
    include_once '../pages/header.php';
?>    

<body>

<div class="wrapper">
    <div class="left">
        <img src="../imgs/default.jpg" 
        alt="user" width="200">
        <h4>Reymark Calexterio</h4>
         <p>Back-end Developer</p>
    </div>
    <div class="right">
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Enter Password</h4>
					<form action="#" method="POST" class="form">
						<div class="input-box">
							<input type="text" placeholder="Enter Email address" name="name" required/>
						</div>
                 </div>
                 <div class="data">
                   <h4>Confirm Password</h4>
						<div class="input-box">
							<input type="text" placeholder="Enter Email address" name="name" required/>
						</div>
              </div>
            </div>
        </div>
					</form>
					<input type="submit" class="send-delete-cta" value="Delete your Account">
      </div>
    </div>
</div>

<?php
    include_once '../pages/footer.php';
?>   

</html>