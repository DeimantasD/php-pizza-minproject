<?php

try{
  $conn = mysqli_connect('localhost', 'deimis', 'test1234', 'git_pizza');
}
catch(mysqli_sql_exception){
  echo 'Could not connect <br>';
}
  


?>