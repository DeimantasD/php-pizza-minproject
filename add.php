<?php 
include('config/db_conntect.php');

$title = $email = $ingredients = '';

$errors = array('email' => '', 'title' => '', 'ingredients' => '');

  

  if(isset($_POST['submit'])){

    // check email
    if(empty($_POST['email'])){
      $errors['email'] = 'An email is required <br>';
    } else {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $errors['email'] = 'email must be a valid email adress';
      }
    }


    // check title
    if(empty($_POST['title'])){
      $errors['title'] = 'A title is required <br>';
    } else {
     $title = $_POST['title'];
     if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
        $errors['title'] = 'Title must be letters and spaces only';
     }
    }


    // check ingredients
    if(empty($_POST['ingredients'])){
      $errors['ingredients'] = 'At one ingredient is required <br>';
    } else {
      $ingredients = $_POST['ingredients'];
     if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors['ingredients'] = 'ingredients must be a comma separated list';
     }
    }

    if(array_filter($errors)){
      //echo 'There are erros in the form';
    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        // create sql

        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

        // save to db and check
        if(mysqli_query($conn, $sql)){
          // success
          header('Location: index.php');
        } else {
          // error
          echo 'query error: ' . mysqli_error($conn);
        }
      
    }
  }; 
?>


<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<section id="add">
  <h4>Add a Pizza</h4>
<div class="add-container">
<form action="add.php" method="post" class="white">
  <label>Email: </label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" >
    <div class="error"><?php echo $errors['email'] ?></div>
    <label>Pizza title: </label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" >
    <div class="error"><?php echo $errors['title'] ?></div>
    <label>Ingredients: </label>
    <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>" place>
    <div class="error"><?php echo $errors['ingredients'] ?></div>
    <div class="center">
      <input type="submit" name="submit" value="Add a pizza" >
    </div>
  </form>
</div>
  
</section>

<?php include('templates/footer.php') ?>


</html>
