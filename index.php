<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      
      <div class="container">
        <?php
            include_once("inc/functions.php");
            include_once("inc/mysql_connect.php");
            include_once("header.php");
            include_once("products.php");
        ?>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        var shop = '<?php echo $shop_url; ?>';
    
        $('div[product-id]').on('click', function(e) {
            //$('#productCollection option').removeAttr('selected');
            $.ajax({
                method: 'POST',
                data: {
                    url: shop,
                    id: $(this).attr('product-id'),
                    type: 'GET'
                },
                url: 'ajax.php',
                dataType: 'json',
                success: function(json){
                    console.log(json);
                    
                    $('#productName').val(json['title']);
                    $('#productDescription').val(json['description']);
                    
                    $('#productCollection option').each(function(i){
                        var optionCollection = $(this).val();
                        
                        console.log(optionCollection);
                        
                        json['collections'].forEach(function(productCollection){
                            if(productCollection['id'] == optionCollection) {
                                $('#productCollection option[value=' + optionCollection + ']').attr('selected', 'selected');
                            }
                        });
                    });
                    
                    json['collections'].forEach(function(item) {
                        
                    });
                    
                    $('#SaveProduct').attr('product-id', json['id']);
                    $('#productsModal').modal('show');
                }
            });
        });
        
        $('#productsModal').on('hide.bs.modal', function() {
            $('#SaveProduct').attr('product-id', ' ');
            $('#productCollection option').removeAttr('selected');
        });
        
         $('#SaveProduct').on('click', function() {
             var productID = $(this).attr('product-id');
             
              $.ajax({
                method: 'POST',
                data: {
                    url: shop,
                    id: productID,
                    product: $('#productForm').serialize(),
                    type: 'PUT'
                },
                url: 'ajax.php',
                dataType: 'html',
                success: function(json){
                    console.log(json);
                }
            });
         }); 
    </script>
  </body>
</html>