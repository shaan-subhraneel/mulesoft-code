<html>
  <body>
<?php

$servername = "localhost";
$username = "root";
$password = "root";
    
  // Create connection
$conn = new mysqli($servername, $username, $password);
    
  // Check connection
if ($conn->connect_error)
{
  echo "Error in connection: " . $conn->connect_error;
}

  //creation of the database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE)
{
    echo "New Database created successfully";
}
else
{
    echo $conn->error;
}
?>
<br/>
<?php
mysqli_select_db($conn, "myDB");

  //creation of the movie table
$sql= "CREATE TABLE movies (
        id int(6) AUTO_INCREMENT PRIMARY KEY,
        movie_name varchar(20) NOT NULL,
        lead_actor varchar(20) NOT NULL,
        lead_actress varchar(20) NOT NULL,
        release_year integer(4) NOT NULL,
        director_name varchar(20) NOT NULL)";
if ($conn->query($sql) === TRUE)
{
    echo "Table Movies created successfully";
}
else
{
    echo $conn->error;
}
?>
<!-- The form from where you insert data into the table movies -->
<form action="" method="post">
    <input type="text" placeholder="Movie Name" name="movie_name"/>
    <input type="text" placeholder="Lead Actor" name="lead_actor"/>
    <input type="text" placeholder="Leader Actress" name="lead_actress"/>
    <input type="text" placeholder="Release Year" name="release_year"/>
    <input type="text" placeholder="Director's Name" name="director_name"/>
    <input type="submit" name="submit"/>
</form>
<?php
//insert data into the table
if(isset($_POST['submit'])){

  $mname=$_POST['movie_name'];
  $actor=$_POST['lead_actor'];
  $actress=$_POST['lead_actress'];
  $year=$_POST['release_year'];
  $director=$_POST['director_name'];
  
  if (empty($mname)||empty($actor)||empty($actress)||empty($year)||empty($director)) {
    echo "Fill the form, it should not be empty.<br>";
  }
  else{

  $sql = "INSERT INTO movies (movie_name, lead_actor, lead_actress, release_year, director_name) VALUES ('$mname','$actor','$actress','$year','$director')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     ?>
     <p>The Movie Table</p>
     <?php
     $sql2 = "SELECT * FROM movies";
     $result = $conn->query($sql2);
     while($rows=$result->fetch_assoc())
     {
  ?>
  <table border="1">
 <tr>
     
     <td><?php echo $rows['movie_name'];?></td>
     <td><?php echo $rows['lead_actor'];?></td>
     <td><?php echo $rows['lead_actress'];?></td>
     <td><?php echo $rows['release_year'];?></td>
     <td><?php echo $rows['director_name'];?></td>
 </tr>
     </table>
 <?php
     }
    }
  }
?>
</body>


