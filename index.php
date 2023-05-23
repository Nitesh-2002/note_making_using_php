<?php
//connecting to the database
$insert=false;
$update=false;
$delete=false;
$servername="localhost";
$username="root";
$password="";
$database="note";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
  die("sorry! we can't connect.please recheck it".mysqli_error($conn));
}
;
// echo $_GET['update'];
// exit();
if(isset($_GET['delete']))
{
  $SNO=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `SNO` =$SNO";
  $result=mysqli_query($conn,$sql);
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if(isset($_POST['SNOEdit']))
  {
    //update the record
    $SNO=$_POST["SNOEdit"];
    $Title=$_POST["TitleEdit"];
    $Description=$_POST["DescriptionEdit"];
    $sql="UPDATE `notes` SET `Title` = '$Title' , `Description`='$Description' WHERE `notes`.`SNO` = $SNO ";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
      $update=true;
    }
    else{
      echo "not updated successfully";
    }
  }
  else{
    //insert the record
  
  $Title=$_POST["Title"];
  $Description=$_POST["Description"];
  $sql="INSERT INTO `notes` ( `Title`, `Description`) VALUES ('$Title', '$Description')";
  $result=mysqli_query($conn,$sql);
  if($result)
  {
    $insert=true;
  }
  else{
    echo "not inserted Successfully".mysqli_error($conn);
  }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
   

    <title>inotes-notes taking make it easy</title>
        <!-- <script>
          edits=document.getElementsByClassName('edit');
          Array.from(edits).forEach((element)=>)
    {
        element.addEventListener("click",(e)=>{
            console.log("edit ",e);
        });
    }
        </script> -->
  </head>
  <body>
    <!--Modal-->
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
   edit Modal 
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/crud/index.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="SNOEdit" id="SNOEdit">
        <div class="form-group">
          <label for="Title">Title of the note</label>
          <input type="text" class="form-control" id="TitleEdit" name="TitleEdit" aria-describedby="emailHelp" placeholder="Enter Name">
          
        </div>

        <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="DescriptionEdit" name="DescriptionEdit" rows="3"></textarea>
          </div>
        <!-- <button type="submit" class="btn btn-primary">Update a Note</button> -->
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
    <!-- <h1>Hello, world!</h1> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="1.png" height="28px" alt="not found"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ABOUT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">CONTACT US</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<?php
if($insert){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your notes has been submitted successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<?php
if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your notes has been delete successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<?php
if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your notes has been update successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<div class="container mt-3 ">
    <h2>Add a Note</h2>
    <form action="/crud/index.php" method="post">
        <div class="form-group">
          <label for="Title">Title of the note</label>
          <input type="text" class="form-control" id="Title" name="Title" aria-describedby="emailHelp" placeholder="Enter Title">
          
        </div>

        <div class="form-group">
            <label for="desc">Note Description</label>
            <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Add A Note</button>
      </form>
</div>
<div class="container mt-3">
    <!-- <?php
    $sql="SELECT * FROM `notes`";
    $result=mysqli_query($conn,$sql);
    //find the number of rows returned
   
    
      while($row=mysqli_fetch_assoc($result))
      {
        // echo $row['SNO'] .  ". title ". $row['title'] ." Description ". $row['descrirption'];
        echo var_dump($row);
        echo "<br>";
      }
  
    



?> -->
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">SNO</th>
      <th scope="col">TITLE
      <th scope="col">DESC.</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody> 
  <?php
    $sql="SELECT * FROM `notes`";
    $result=mysqli_query($conn,$sql);
    //find the number of rows returned
      $SNO=0;

    
      while($row=mysqli_fetch_assoc($result))
      {
        $SNO=$SNO+1;
        echo"    <tr>
        <th scope='row'>".$SNO."</th>
        <td>".$row['Title']."</td>
        <td>".$row['Description']."</td>
        <td><button class='edit btn btn-sm btn-primary' id=".$row['SNO'].">Edit </button> <button button class='delete btn btn-sm btn-primary' id=d".$row['SNO'].">Delete</button></td>
      </tr>";
        // echo $row['SNO'] .  ". title ". $row['title'] ." Description ". $row['descrirption'];
        // echo var_dump($row);
        // echo "<br>";
      }
      
      
    



?>


  </tbody>
</table> 
</div>
<hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    

    <script>
      $(document).ready(function () {
        $('#myTable').dataTable();
      });
    </script>
        <script>
      edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
    element.addEventListener("click",(e)=>{
        console.log("edit ",);
        tr=  e.target.parentNode.parentNode;
        Title=tr.getElementsByTagName("td")[0].innerText;
        Description=tr.getElementsByTagName("td")[1].innerText;
        console.log(Title,Description);
        TitleEdit.value=Title;
        DescriptionEdit.value=Description;
        SNOEdit.value=e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })
    deletes=document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
    element.addEventListener("click",(e)=>{
        console.log("edit ",);
        SNO=e.target.id.substr(1,);
        if(confirm("Are You Sure you want to delete!")){
          console.log("yes");
          window.location=`/crud/index.php?delete=${SNO}`;
          //create a form and use post request to submit a form
        }
        else{
          console.log("no");
        }
       
      })
    })
    </script>
  </body>
</html>