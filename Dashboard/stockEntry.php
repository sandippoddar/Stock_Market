<?php
require './Dashboard/stockEntryProcess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Entry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
  <header>
    <?php include './Dashboard/navbar.php' ?>
  </header>
  <section>
    <div class="container" style="width: 600px;">
      <h1 class="mb-3">Add Your Stock</h1>
      <form action="/enterstock" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter Stock Name: </label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="name">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Enter Stock Price: </label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="price">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </section>
  <section class="stock">
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
  </section>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId" name="editId">
                    <div class="form-group">
                        <label for="editName">Stock Name:</label>
                        <input type="text" class="form-control" id="editName" name="editName">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Stock Price:</label>
                        <input type="text" class="form-control" id="editPrice" name="editPrice">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./AJAX/stockOperation.js"></script>
</html>
