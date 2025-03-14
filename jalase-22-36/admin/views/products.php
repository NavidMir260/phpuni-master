<?php
   include '../controllers/checklogin.php';
   include '../../database.php';
    $test = "SKU001";
    try {
        $stmt = $pdo->query("SELECT * FROM products");
        // $stmt = $pdo->query("SELECT * FROM products WHERE product_code = '$test'");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Query Error:'. $e->getMessage());
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
    .product-table{
        margin: 20px auto;
        max-width: 90%;
    }
    .product-image{

    }
  
    thead{
        background-color: #343a40 !important;
        color: white !important;
    }
</style>



</head>
<body>
    <!-- sidebar -->
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
    <h1>Product</h1>
        <!-- ایجاد محصول جدید -->
         <div class="text-end">
         <a href="createproduct.php" class="btn btn-primary">Add Product</a>
         </div>
       
         <h1 class="text-center my-4">Product List</h1>

         <?php if(count($products) > 0 ): ?>

         <table class="table table-borderd table-hover product-table">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product Code</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product):?>
                <tr id="product-<?php echo $product['id'];?>">
                    <td><?php echo htmlspecialchars($product['id']) ;?></td>
                    <td><?php echo $product['product_code'];?></td>
                    <td><?php echo $product['product_title'];?></td>
                    <td><?php echo $product['category'];?></td>
                    <td><?php echo $product['brand'];?></td>
                    <td><img class="product-image" src="<?php echo $product['image_url'];?>" alt="<?php echo $product['product_title'];?>" width="50" height="60"></td>
                    <td><?php echo $product['price'];?></td>
                    <td><?php echo $product['stock_quantity'];?></td>
                    <td>
                        <a href="../contrlolers/editproduct.php?id=<?php echo $product['id'];?>" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $product['id']; ?>">Delete</button>
            </tbody>
            <?php endforeach;?>
         </table>
         <?php else:?>
             <p>No Products Found.</p>
         <?php endif;?>
    </div>

    <script>
       $(document).ready(function(){
        $('.delete-product').click(function(){
            var productId = $(this).data('id');
            var row = $('#product-' + productId);
            if(confirm('Are you sure to delete this product?')){
                $.ajax({
                    url: '../controllers/deleteproduct.php',
                    type: 'POST',
                    data: {id: productId},
                    success: function(response){
                        if(response.success){
                            row.remove();
                            alert('Product deleted successfully!');
                        } else {
                            alert('Failed to delete product!');
                        }
                    },
                    error: function(){
                            alert('Failed to delete product!');
                    }
                });
            }
        });
       });
            
    </script>
</body>
</html>

