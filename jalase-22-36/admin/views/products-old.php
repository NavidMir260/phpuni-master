<?php 
include '../controllers/checklogin.php';
include '../../database.php';

try {
    $stmt = $pdo->query("SELECT * FROM products ");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    die("خطا در جستجوی کالا در دیتابیس".$e->getMessage());
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
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
        <?php if(count($products) > 0):?>
            <table class="table table-borderd table-hover product-table ">            
                <thead class="table-warning">
                <tr>
                    <th>ID</th>
                    <th>Product Code</th>
                    <th>Title </th>
                    <th>Ctegory</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody class="table-light">
                    <?php foreach($products as $product):?>
                        <tr >
                            <td><?php echo $product['id'];?></td>
                            <td><?php echo $product['product_code'];?></td>
                            <td><?php echo $product['product_title'];?></td>
                            <td><?php echo $product['category'];?></td>
                            <td><?php echo $product['brand'];?></td>
                            <td><img class="product-image" src="<?php echo $product['image_url'];?>" alt="<?php echo $product['product_title'];?>" width="50"></td>
                            <td><?php echo $product['price'];?></td>
                            <td><?php echo $product['stock_quantity'];?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php else:?>
                <h3>محصولی پیدا نشد</h3>
            <?php endif;?>

     </div>
</body>
</html>