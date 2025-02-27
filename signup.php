<?php
session_start();
include('dbconnect.php');
include('header.php');

if (isset($_SESSION['patient_id'])) {
    header("Location: index.php");
    exit();
}

// Initialize variables
$fname = $lname = $email = $password = $cpassword = $contact = $gender = "";
$errors = [];
$successMsg = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['patsub1'])) {
    // Validate and set form fields
    $fname = trim($_POST["fname"] ?? "");
    $lname = trim($_POST["lname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $cpassword = $_POST["cpassword"] ?? "";
    $contact = $_POST["contact"] ?? "";
    $gender = $_POST["gender"] ?? "";

    // Validating mandatory fields
    if (empty($fname) || empty($lname)) $errors['name'] = "First and last name are required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Valid email is required";
    if (empty($password) || strlen($password) < 6) $errors['password'] = "Password must be at least 6 characters";
    if ($password !== $cpassword) $errors['cpassword'] = "Passwords do not match";
    if (empty($contact) || !preg_match('/^\d{10}$/', $contact)) $errors['contact'] = "Valid 10-digit phone number required";

    // Save to database if no errors
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO patients (patient_id, first_name, last_name, email, password, contact, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $patient_id = uniqid();
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bind_param("sssssss", $patient_id, $fname, $lname, $email, $hashed_password, $contact, $gender);

        if ($stmt->execute()) {
            $successMsg = "Sign-up successful! You can now <a href='login.php'>login</a>.";
        } else {
            $errors['general'] = "An error occurred while saving data.";
        }
        $stmt->close();
    }
}
?>

<!-- link  -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
<!-- <link rel="stylesheet" type="text/css" href="style1.css"> -->
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- style start  -->
<style>
    body {
        background: linear-gradient(to right, #3931af, #00c6ff);
        background-size: cover;
        font-family: 'IBM Plex Sans', sans-serif;
    }

    .form-control {
        border-radius: 0.5rem;
        padding: 10px;
        font-size: 14px;
    }

    .register {
        margin-top: 5%;
        padding: 3%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 5%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: #f8f9fa;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 3%;
    }

    .register-left img {
        width: 30%;
        animation: bounce 1.5s infinite alternate;
    }

    @keyframes bounce {
        0% { transform: translateY(0); }
        100% { transform: translateY(-10px); }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 10%;
    }

    .btnRegister {
        float: right;
        border: none;
        border-radius: 1.5rem;
        padding: 10px 20px;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .btnRegister:hover {
        background: #004b9b;
    }

    .register .nav-tabs {
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 40%;
        float: right;
    }

    .register .nav-tabs .nav-link-home {
        padding: 1%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-radius: 1.5rem;
    }

    .register .nav-tabs .nav-link-home.active {
        background: #fff;
        color: #0062cc;
        border: 2px solid #0062cc;
    }

    .register-heading {
        text-align: center;
        margin-top: 5%;
        margin-bottom: 2%;
        color: #495057;
        font-size: 24px;
        font-weight: bold;
    }

    .form-group input {
        border: 1px solid #ccc;
        transition: all 0.3s ease-in-out;
    }

    .form-group input:focus {
        border-color: #0062cc;
        box-shadow: 0 0 5px rgba(0, 98, 204, 0.5);
    }

    @media (max-width: 768px) {
        .register-right {
            padding: 5%;
        }

        .btnRegister {
            width: 100%;
        }

        .register .nav-tabs {
            width: 100%;
            text-align: center;
        }
    }
</style>
 <!-- style end  -->
<!-- script -->
<script>
    var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('cpassword').value) {
    document.getElementById('message').style.color = '#5dd05d';
    document.getElementById('message').innerHTML = 'Matched';
  } else {
    document.getElementById('message').style.color = '#f55252';
    document.getElementById('message').innerHTML = 'Not Matching';
  }
}

function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};

function checklen()
{
    var pass1 = document.getElementById("password");  
    if(pass1.value.length<6){  
        alert("Password must be at least 6 characters long. Try again!");  
        return false;  
  }  
}

</script>
 <!-- end -->
<div>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <?php
        include 'topmenu.php';
        ?>
    </nav>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <div id="BigBag">

        <!-- LEFT***************** -->
        <div id="signup-leftBox">
            <img src="https://static.naukimg.com/s/7/104/assets/images/green-boy.c8b59289.svg">

            <div id="leftRegister">
                <h5>On registering, you can </h5>
                <ul id="leftlist">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <p>Build your profile and let recruiters find you</p>
                    </li>

                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <p>Get job postings delivered right to your email</p>
                    </li>

                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        <p>Find a job and grow your career</p>
                    </li>
                </ul>
            </div>
        </div>


        <!-- RIGHT***************** -->
        <?php
            if (!empty($successMsg)) {
            echo "<div class='alert alert-success text-center' role='alert'>$successMsg</div>";
            }
        ?>
        <div class="container register" style="font-family: 'IBM Plex Sans', sans-serif;">
                <!-- <div class="row"> -->
                    <!-- <div class="col-md-3 register-left" style="margin-top: 10%;right: 5%">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                       
                    </div> -->
                    <div class="col-md-9 register-right" style="margin-top: 40px;left: 80px;">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="width: 40%;">
                            <li class="nav-item">
                                <a class="nav-link-home active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Patient</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link-home" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Doctor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link-home" id="profile-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Receptionist</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Register as Patient</h3>
                            <form method="post" action="signup.php">
                                <div class="row register-form">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="First Name *" name="fname"  onkeydown="return alphaOnly(event);" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email *" name="email"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" id="password" name="password" onkeyup='check();' required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="Male" checked>
                                                    <span> Male </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="Female">
                                                    <span>Female </span> 
                                                </label>
                                            </div>
                                            <a href="login.php">Already have an account?</a>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name *" name="lname" onkeydown="return alphaOnly(event);" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="tel" minlength="10" maxlength="10" name="contact" class="form-control" placeholder="Your Phone *"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"  id="cpassword" placeholder="Confirm Password *" name="cpassword"  onkeyup='check();' required/><span id='message'></span>
                                        </div>
                                        <input type="submit" class="btnRegister" name="patsub1" onclick="return checklen();" value="Register"/>
                                    </div>

                                </div>
                            </form>
                        </div>    
                        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3  class="register-heading">Login as Doctor</h3>
                            <form method="post" action="func1.php">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="User Name *" name="username3" onkeydown="return alphaOnly(event);" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" name="password3" required/>
                                        </div>
                                        
                                        <input type="submit" class="btnRegister" name="docsub1" value="Login"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show" id="admin" role="tabpanel" aria-labelledby="profile-tab">
                            <h3  class="register-heading">Login as Admin</h3>
                            <form method="post" action="func3.php">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="User Name *" name="username1" onkeydown="return alphaOnly(event);" required/>
                                        </div>
                                        


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" name="password2" required/>
                                        </div>
                                        
                                        <input type="submit" class="btnRegister" name="adsub" value="Login"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <?php
        include 'footer.php';
        ?>
    </div>


</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".nav-link-home");

        tabs.forEach(tab => {
            tab.addEventListener("click", function (event) {
                event.preventDefault();

                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove("active"));
                this.classList.add("active");

                // Hide all tab content
                document.querySelectorAll(".tab-pane").forEach(tabPane => {
                    tabPane.classList.remove("show", "active");
                });

                // Show the selected tab content
                const target = this.getAttribute("href");
                document.querySelector(target).classList.add("show", "active");
            });
        });
    });
</script>
