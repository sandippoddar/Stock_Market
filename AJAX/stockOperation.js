$(document).ready(function () {

  // It implemnts to open the Modal to edit any stock.
  $(document).on("click",".edit",function() {
    var Id = $(this).data('stock-id');
    $('#editModal').modal('show');
    $('#editId').val(Id);
  })

  // It implements to edit Stock details.
  $('#editForm').submit(function (e) {
    e.preventDefault();
    var id = $('#editId').val();
    var name = $('#editName').val();
    var price = $('#editPrice').val();

    $.ajax({
      type: 'POST',
      url: '../Dashboard/editStock.php',
      data: {id: id, name: name, price: price},
      success: function (response) {
        $('#editModal').modal('hide');
        $('.stock').html(response);
      },
    })
  });

  // It implements to delete any stock.
  $(document).on("click",".remove", function () {
    var stockId = $(this).data('stock-id');
    $.ajax({
      type: 'POST',
      url: '../Dashboard/removeStockProcess.php', 
      data: { stockId: stockId },
      success: function(response) {
        $('.stock').html(response);
      }
    });
  })

})
