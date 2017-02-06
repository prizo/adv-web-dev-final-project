<html>
  <?php
  require("HeadLinksScripts.html");
  ?>
<body>
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>CSC3700</strong> Register Form</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                      <div class="form-top">
                        <div class="form-top-left">
                          <h3>Register with us</h3>
                            <p>Enter a username and password to register:</p>
                        </div>
                        <div class="form-top-right">
                          <i class="fa fa-key"></i>
                        </div>
                        </div>
                        <div class="form-bottom">
                      <form role="form" action="Registration.php" method="post" class="login-form">
                        <div class="form-group">
                          <label class="sr-only">First Name</label>
                            <input type="text" name="form-first" placeholder="First Name" class="form-control" id="form-fName">
                        </div>
                        <div class="form-group">
                          <label class="sr-only">Last Name</label>
                            <input type="text" name="form-lName" placeholder="Last Name" class="form-control" id="form-LName">
                        </div>
                        <div class="form-group">
                          <label class="sr-only">Email </label>
                            <input type="text" name="form-email" placeholder="Email" class="form-control" id="form-LName">
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="form-username">Username</label>
                            <input type="text" name="form-username" placeholder="Username" class="form-username form-control" id="form-username">
                          </div>
                          <div class="form-group">
                            <label class="sr-only" for="form-password">Password</label>
                            <input type="password" name="form-password" placeholder="Password" class="form-password form-control" id="form-password">
                          </div>
                          <div class="form-group">
                            <label class="sr-only" for="form-password">Confirm Password</label>
                            <input type="password" name="form-confirm_password" placeholder="Confirm Password" class="form-password form-control" id="form-password">
                          </div>
                          <input type="submit" name="submit" class="btn" value="Register!"></button>
                      </form>
                        <p style="text-align:center"><br>
                          <a href="login.php" style="color:black">Already have an account? Login.</a>
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Javascript -->
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!--[if lt IE 10]>
        <script src="assets/js/placeholder.js"></script>
    <![endif]-->

</body>

</html>
