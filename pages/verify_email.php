<?php 

session_start();

if(!isset($_SESSION['email'])){
    header('Location: signup.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <!-- bootstrap cdn for css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- footstrap cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- css link -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">
    <!-- User Registration Form starts here -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-4  border border-secondary rounded bg-white p-0  pb-3 ">
                <div class="col-12 text-white text-center  bg-primary p-2 py-4 ">
                    <h1 class="">Verify Email</h1>
                </div>
                <div class="col-12 p-3 ">
                    <div class="col-12 mt-3">
                        <!-- form for Register Details start here -->
                        <form action="" id="otpForm"  autocomplete="off">
                            <div class="alert alert-success" role="alert">
                                Check Your Email! OTP has been sent to Your Email.
                              </div>
                              <div class="d-active mb-3 d-flex justify-content-center d-none">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                              </button>
                           </div> 
                            <div class="alert alert-danger notice d-none" role="alert">
                               
                              </div>
                            <div class="mb-3">
                                <label for="" class="form-label fs-5 ">OTP</label>
                                <input type="text"  pattern="[0-9]*" name="V_otp" id="v_otp" class="form-control border border-secondary" placeholder="Enter Your OTP...">
                            </div>
                           
                            <input type="submit" value="Submit" id="v_submit" class="btn btn-primary float-end">
                        </form>
                        <!-- form for Register Details end here -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User Registration Form end here -->
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="../js/javascript.js"></script>
    <script>
   
    </script>
</body>
</html>