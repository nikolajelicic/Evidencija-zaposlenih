<?php
if(isset($_POST['logout'])){
  session_destroy();
  header("Location: http://localhost/evidencija%20zaposlenih/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Profil radnika</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="asset/css/sidebar.css" rel="stylesheet">
  <script src="asset/js/homePage.js"></script>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Dashboard<p id="userId" class="d-none"><?php session_start(); echo $_SESSION['id'];?></p></div>
      <div class="list-group list-group-flush">
        <a href="#" id="homePage" class="list-group-item list-group-item-action bg-light">Pocetna strana</a>
        <a href="#" id="workingHours" class="list-group-item list-group-item-action bg-light">Radni sati</a>
        <a href="#" id="edit" class="list-group-item list-group-item-action bg-light">Promena podataka</a>
      </div>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"><?php echo "<strong>Korisnik:</strong> " . $_SESSION['user']; ?></a>
            </li>
          </ul>
          <form action="http://localhost/evidencija%20zaposlenih/profile.php" method="POST">
            <button class="btn btn-danger" name="logout">LOGOUT</button>
          </form>
        </div>
      </nav>

      <div class="container-fluid" id="centralPage">
      <div class="row">
    <div class="col-xl-6 offset-xl-3 text-center">
            <h2 class="mb-4">Status plata</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>MESEC</th>
                    <th>GODINA</th>
                    <th>PLATA</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody id="salaryTable"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        var id = $("#userId").html()
        $.ajax({
            url: 'http://localhost/evidencija%20zaposlenih/app/object/getSalaryInfo.php',
            type: 'POST',
            data:{id:id},
            dataType: 'JSON',
            success: function(data){
                //console.log(data)
                for(var i=0;i<data.length;i++){
                    $("#salaryTable").append("<tr><td>"+data[i].month+"</td>"+"<td>"+data[i].year+"</td>"+"<td>"+data[i].salary+" din"+"</td>"+"<td>ISPLACENA</td>")
                }
            }
        })
    })
</script>
      </div> <!--end #centralPage-->
      </div>

  </div>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</html>