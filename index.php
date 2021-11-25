<?php
session_start();
$conn=mysqli_connect('localhost','root','','facebook');
if(isset($_POST['submit'])){
  $uname= $_POST['uname'];
  $uphone= $_POST['uphone'];
  $upass= $_POST['upass'];
  if($uname==""||$uphone==""||$upass==""){
   $_SESSION['warning']="Field Must Be Needed";
   header('LOCATION:index.php');
   die();
   
  }
  $query="INSERT INTO `users`( `uname`, `uphone`, `upass`) VALUES ('$uname','$uphone','$upass')";
  mysqli_query($conn,$query);
  $_SESSION['success']="Data Insert Success Fully";
  header('LOCATION:index.php');
  die();
}
 if(isset($_GET['delete_id'])){
   $delete_id= $_GET['delete_id'];
   $query="DELETE FROM `users` WHERE users_id='$delete_id'";
   mysqli_query($conn,$query);
   header('LOCATION:index.php');
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!doctype html>
<html lang="en">
  <head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Crud System</title>
</head>
<body>
    <div class="form-crud">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <h2 style="margin-top:20px;">Crud System</h2>
                    <?php
           if(isset($_SESSION['warning'])){
               echo $_SESSION['warning'];
               unset($_SESSION['warning']); 
              }
             ?>     
             <?php
             if(isset($_SESSION['success'])){
                 echo $_SESSION['success'];
                 unset($_SESSION['success']);
             }
             ?>
           
                    <form action="" method="post" >
                        <div class="form-group" style="margin-top:20px;">
                            <input type="text" class="form-control" name="uname" placeholder="Enter Your Name" >
                        </div>

                        <div class="form-group" style="margin-top:20px;">
                            <input type="text" class="form-control " name="uphone" placeholder="Enter Your Phone Number" >
                        </div>

                        <div class="form-group" style="margin-top:20px;">
                            <input type="text" class="form-control" name="upass" placeholder="Enter Your Password"><br>
                            <input type="submit" class="form-control btn-primary" name="submit" style="margin-top:20px;" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="user-data">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="" method="get">
                        <div class="form-group" style="margin-top:20px;">
                            <input type="text" class="form-control" name="fname" placeholder="Enter User Name" id="fname">
                            <input type="submit" name="search" value="Search" id="search"  >
                            <button><a href="index.php" style="text-decoration:none;" class="reset">Reset</a></button>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
                <div class="col-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>User Name</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
         <?php
         $i=1;
         $fetch_query="SELECT * FROM `users` WHERE users_id > '0'";
         if(isset($_GET['fname'])){
            $fname=$_GET['fname'];
            $fetch_query.=" AND uname ='$fname'";

         }

         $sql=mysqli_query($conn,$fetch_query);
         while($row=mysqli_fetch_assoc($sql)){ ?>
                     
               <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $row['uname']?></td>
                  <td><?php echo $row['uphone']?></td>
                  <td><a href="index.php?delete_id=<?php echo $row['users_id']?>">Delete</a></td>
            </tr>
        <?php $i++; }
         
         ?>                   
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>