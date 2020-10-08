<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/signUp.js"></script>
    <title>SignUp</title>
</head>
<body class="p-0 m-0">
    <div id="central" class="container">
      <div class="row text-center">
        <div class="col-xl-4 offset-xl-4">
          <div class="container">
            <div class="row">
              <div class="col-xl-12">
                <div id="message">
                <?php
                    if(isset($_POST['submit'])){
                        include 'app/class/signUpUser.php';
                        $admin = new SignUpUser;
                        $admin->authUser($_POST['email'],$_POST['pass']);
                    }
                    ?>
                </div>
              </div>
            </div>
          </div>
          <form action="http://localhost/evidencija%20zaposlenih/index.php" method="POST">
            <img class="mb-4" src="asset/img/logo.png" alt="logo" width="72" height="72">
            <div class="form-group">
              <input type="text" placeholder="Upisi email" name="email" class="form-control text-center">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Upisi sifru" name="pass" class="form-control text-center">
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-success">SignUp</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>