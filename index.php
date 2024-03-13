<?php 

include('config/db_conntect.php');


  // write query for all pizzas
  $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

  // make query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the resulting rows as an array
  $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free result from memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($conn);


  
  
?>


<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>


<section id="context">
<h4>Pizzas!</h4>
  <div class="container">

    <?php if(empty($pizzas)): ?>
        <h4><?php echo "Sorry, we don't have any pizzas :("; ?></h4>
      <?php else: ?>
    <?php foreach($pizzas as $pizza): ?>
      <div class="pizza-container">
      <img src="img/pizza.svg" alt="pizza" class="pizza-img">
        <div class="pizza-details">
        <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
        <ul>
              <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                    <li><?php echo htmlspecialchars($ing); ?></li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="more-info">
            <a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>">MORE INFO</a>
          </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
</div>
</section>

<?php include('templates/footer.php') ?>

</html>
