<?php
include 'app/class/logout.php';
$logout = new Logout;
$logout->logoutAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin pelen - Evidencija zaposlenih</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="asset/css/sidebar.css" rel="stylesheet">
  <script src="asset/js/sidebar.js"></script>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Dashboard</div>
      <div class="list-group list-group-flush">
        <a href="#" id="homePage" class="list-group-item list-group-item-action bg-light">Pocetna strana</a>
        <a href="#" id="newWorker" class="list-group-item list-group-item-action bg-light">Novi radnik</a>
        <a href="#" id="allWorker" class="list-group-item list-group-item-action bg-light">Svi radnici</a>
        <a href="#" id="done" class="list-group-item list-group-item-action bg-light">Uradjeno</a>
        <a href="#" id="boxes" class="list-group-item list-group-item-action bg-light">Kutije</a>
        <a href="#" id="payTheSalary" class="list-group-item list-group-item-action bg-light">Isplata plate</a>
        <a href="#" id="doneBoxes1" class="list-group-item list-group-item-action bg-light">Upis uradjenih kutija</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"><?php session_start(); echo "<strong>Korisnik:</strong> " . $_SESSION['name']; ?></a>
            </li>
          </ul>
          <form action="http://localhost/evidencija%20zaposlenih/admin/adminpanel.php" method="POST">
            <button class="btn btn-danger" name="logout">LOGOUT</button>
          </form>
        </div>
      </nav>

      <div class="container-fluid" id="centralPage">
        <div class="row ml-1">
            <div class="col-xl-6 col-sm-4">
              <div class="continer-fluid">
                <div class="row mt-3">
                  <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4 p-1">
                        <img src="asset/img/users.png" class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Ukupno zaposlenih</h5>
                            <p><strong id="numberOfWorker"></strong></p>
                          <button id="detaljnijeZaposleni" data-toggle="modal" data-target="#workPlaces1" class="btn btn-success">Detaljnije</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-sm-4">
              <div class="continer-fluid">
                <div class="row mt-3">
                  <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4 p-1">
                        <img src="asset/img/kutija.png" class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Vrste kutija</h5>
                            <p><strong id="numberOfBoxes"></strong> vrsta kutija</p>
                          <button id="detaljnijeKutije" data-toggle="modal" data-target="#boxes1" class="btn btn-success">Detaljnije</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="row">
              <div class="col-xl-6">
                <div class="alert alert-secondary">
                    <h3>NAJVECA ISPLACENA PLATA</h3>
                    <p>Mesec: <strong id="monthMax"></strong></p>
                    <p>Godina: <strong id="yearMax"></strong></p>
                    <p>Plata: <strong id="salaryMax"></strong> din</p>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="alert alert-secondary">
                    <h3>NAJMANJE ISPLACENA PLATA</h3>
                    <p>Mesec: <strong id="monthMin"></strong></p>
                    <p>Godina: <strong id="yearMin"></strong></p>
                    <p>Plata: <strong id="salaryMin"></strong> din</p>
                </div>
              </div>
            </div>
        </div> <!--end #centralPage-->
      </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->


  <?php include 'app/view/modal/modalInfoWorker.php';
        include 'app/view/modal/modalEditWorker.php';
        include 'app/view/modal/modalDeleteWorker.php';
        include 'app/view/modal/modalEditPrice.php';
        include 'app/view/modal/modalNewBoxes.php';
        include 'app/view/modal/modalBoxes.php';
        include 'app/view/modal/modalWorkPlaces.php';
  ?>  
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $(document).ready(function(){
      $.ajax({
        url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/numberOfWorker.php',
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
          //console.log(data)
          for(var i=0;i<data.length;i++){
            $("#numberOfWorker").append(data[i].numberOfWorker)
          }
        }
      })
      $.ajax({
        url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/numberOfBoxes.php',
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
          //console.log(data)
          for(var i=0;i<data.length;i++){
            $("#numberOfBoxes").append(data[i].total)
          }
        }
      })
      $.ajax({
        url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/getMaxSalary.php',
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
          //console.log(data)
          for(var i=0;i<data.length;i++){
            $("#monthMax").append(data[i].month)
            $("#yearMax").append(data[i].year)
            $("#salaryMax").append(data[i].salary)
          }
        }
      })
      $.ajax({
        url: 'http://localhost/evidencija%20zaposlenih/admin/app/object/getMinSalary.php',
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
          //console.log(data)
          for(var i=0;i<data.length;i++){
            $("#monthMin").append(data[i].month)
            $("#yearMin").append(data[i].year)
            $("#salaryMin").append(data[i].salary)
          }
        }
      })
    })

  </script>

</body>
</html>