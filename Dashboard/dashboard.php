<?php

require_once './Database/Query.php';
require_once './Dashboard/dashboardSession.php';

$queryOb = new Query();
$result = $queryOb->fetchAllStock();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <header>
    <?php include_once './Dashboard/navbar.php' ?>
  </header>
  <section class="stock">
  <?php if (!$result): ?>
    <h1>No Stock Available!!</h1>
    <?php else: ?>
      <table class="table">
        <tr>
          <th>Stock Name</th>
          <th>User Email</th>
          <th>Stock Price</th>
          <th>Created At</th>
          <th>Updated At</th>
        </tr>
        <?php foreach ($result as $row) : ?>
          <tr>
            <td><?php echo $row['Stock_Name']?></td>
            <td><?php echo $row['Email']?></td>
            <td><?php echo $row['Stock_Price']?></td>
            <td><?php echo $row['CreatedTime']?></td>
            <td><?php echo $row['UpdatedTime']?></td>
            <?php if ($row['Email'] == $_SESSION['userEmail']) : ?>
            <td><button class="btn btn-primary edit" data-stock-id="<?php echo $row['Stock_Id'] ?>">Edit</button></td>
            <td><button class="btn btn-danger remove" data-stock-id="<?php echo $row['Stock_Id'] ?>">delete</button></td>
            <?php  endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
  <?php endif;?>
  </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
