<?php
$insert = false;
$empty = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "kamlesh01";

// create a connection object
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Sorry we failed to connect:". mysqli_connect_error());

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $description = $_POST['desc'];
    if($title =="" && $description == ""){
        $empty=true;
    }
    else{
        $sql = "INSERT INTO `notes` (`srno`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$description', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if($result){
        $insert = true;
    }
    else{
        echo mysqli_error($conn);
    }
    }
    
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Knotes - notes taking made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="icons8-notes.gif" type="image/x-icon">

    <!--Adding jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!--Adding Datatables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  </head>
  <body>
    <!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg bg-dark " data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PHP CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ContactUs</a>
        </li>
       
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <!--Alert Massage to user-->
    <?php
    if($insert){
        echo '<div class="alert alert-success" role="alert">
        Your Note has been inserted Successfully
      </div>';

    }
    ?>
    <?php
    if($empty){
        echo '<div class="alert alert-danger" role="alert">
        Please fill the note
      </div>';

    }
    ?>

    <!--Forms-->
    <div class="container my-5">
            <form action="phpCrud.php" method="post">
                <h2 class="mb-3 text-center">Add a Note</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Note Title</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Note Discription</label>
                    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" name="desc" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2"></label>
        </div>
        </div>
        <button type="submit" class="btn btn-primary ">Add Note</button>
        </form>
    </div>

    <!--Display the storage-->
    <div class="container mb-5">

    <table class="myTable" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $num = 1;
        while($row = mysqli_fetch_array($result)){
           echo"
            <tr>
        <th>".$num."</th>
        <th>".$row['title']."</th>
        <th>".$row['description']."</th>
        <th><button type='button' class='btn btn-dark'>Delete</button>
        </th>
        </tr>
           ";
           $num = $num+ 1;
        }
    ?>
  </tbody>
</table>

    </div>
    

<script>
        let table = new DataTable('#myTable');
    </script>

    
  </body>
</html>