<?php

require_once __DIR__.'/../Database/Query.php';
require_once __DIR__.'/../Dashboard/dashboardSession.php';

$queryOb = new Query();
$stockId = $_POST['stockId'];
$email = $_SESSION['userEmail'];
$queryOb->deleteStock($stockId, $email);
$result = $queryOb->fetchStock($_SESSION['userEmail']);
?>
<?php if (!$result): ?>
  <h1>No Stock Available Add Some Stocks</h1>
  <?php else: ?>
    <table class="table">
      <tr>
        <th>Stock Name</th>
        <th>Stock Price</th>
        <th>Created At</th>
        <th>Updated At</th>
      </tr>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo $row['Stock_Name']?></td>
          <td><?php echo $row['Stock_Price']?></td>
          <td><?php echo $row['CreatedTime']?></td>
          <td><?php echo $row['UpdatedTime']?></td>
          <td><button class="btn btn-primary edit" data-stock-id="<?php echo $row['Stock_Id'] ?>">Edit</button></td>
          <td><button class="btn btn-danger remove" data-stock-id="<?php echo $row['Stock_Id'] ?>">delete</button></td>
        </tr>
      <?php endforeach; ?>
    </table>
<?php endif;?>
