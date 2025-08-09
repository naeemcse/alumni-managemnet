<?php
<?php 
$pageTitle = "New Alumni Registration";
$additionalCSS = '<link href="css/signup.css" rel="stylesheet" type="text/css">';
include 'includes/header.php'; 
?>

<body>


    <div class="container">
         <form action="_connection.php" method="POST" class="form-signup mt-5" enctype="multipart/form-data">
            <!-- <?php
            if($showAlert==true){ 
            echo '
            <div class="alert alert-info" role="alert">
                Submit Sucessfullly. Thanks!
              </div>';
        }
              ?>  -->
            <h2>Register as a New Alumni</h2>
            <h4>Give Your Information Here.</h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="firstname" placeholder="First Name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="lastname" placeholder="Last Name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="email" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="number" placeholder="Your contact Number">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row"> 
                <div class="col-md-6"> 

                    <input type="number" name="session" placeholder="Your Passing Year">
                </div>
                <div class="col-md-6">
                    <input type="number" name="id" placeholder="Your ID">
                </div>
            </div>
             </div>
            <div class="form-group">
                <div class="row">
                <div class="col-md-6">
                    <input type="text" name="industry" placeholder="Company Name">
                </div>
                <div class="col-md-6">
                    <input type="text" name="position" placeholder="Your Job Title">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="mb-6">
                <!-- <label class="form-label">Upload Your Picture</label> -->
                <input type="file" name = "uploadfile" class="form-controls">
                <input type="submit" name="submit" value="Upload File">
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    <h4>All informations are correct. Yes?</h4>
                    <input type="checkbox" name=" " class="checkboxx">
                </label>
            </div>
            <input type="submit" class="btn btn-success mt-2" name="submit" value="Submit">
         </form>
    </div>
</body>
</html>

<?php include 'includes/footer.php'; ?>