<div class="card-columns">
<?php
    
    $products = shopify_call($token, $shop_url, "/admin/api/2022-07/products.json", array(), 'GET');
    $products = json_decode($products['response'], JSON_PRETTY_PRINT);
    
    //echo print_r($products);
    foreach ($products as $product) {
        foreach ($product as $key => $value) {
             $images = shopify_call($token, $shop_url, "/admin/api/2022-07/products/" . $value['id'] . "/images.json", array(), 'GET');
    $images = json_decode($images['response'], JSON_PRETTY_PRINT);
          ?>
                <div class="card" product-id="<?php echo $value['id']; ?>">
                    <img class="card-img-top" src="<?php echo $images['images'][0]['src']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $value['title'];  ?></h5>
                    </div>
                </div>
            <?php
        }
    }
?>
</div>

<!-- Modal -->
<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="ajax.php" id="productForm">
            <div class="form-group">
                <label for="productName">Product Title</label>
                <input type="text" class="form-control" id="productName" name="productName">
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" row="7">
                    
                </textarea>
            </div>
            <div class="form-group">
                <select class="custom-select" id="productCollection" name="productCollection" multiple>
                    <?php
                        $custom_collections = shopify_call($token, $shop_url, "/admin/api/2022-07/custom_collections.json", array( ), 'GET');
                        $custom_collections = json_decode($custom_collections['response'], JSON_PRETTY_PRINT);
        
                        foreach ($custom_collections as $custom_collection) {
                            foreach ($custom_collection as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
                                <?php
                            }
                        }
                        
                        $smart_collections = shopify_call($token, $shop_url, "/admin/api/2022-07/smart_collections.jsonjson", array( ), 'GET');
                        $smart_collections = json_decode($smart_collections['response'], JSON_PRETTY_PRINT);
                        
                        foreach ($smart_collections as $smart_collection) {
                            foreach ($smart_collection as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="SaveProduct" product-id=''>Save changes</button>
      </div>
    </div>
  </div>
</div>
