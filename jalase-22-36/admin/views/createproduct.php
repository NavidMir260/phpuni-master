<?php  
include '../controllers/checklogin.php';
include '../../database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $product_code = $_POST['product_code'];
    $product_title = $_POST['product_title'];
    $image_url = $_POST['image_url'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $stock_quantity = $_POST['stock_quantity'];
    $short_description = $_POST['short_description'];

    try {
        $stmt = $pdo->prepare("INSERT INTO products (product_code, product_title, image_url, category , price , brand, stock_quantity, short_description) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$product_code, $product_title, $image_url, $category, $price, $brand,$stock_quantity, $short_description]);
    
        $_SESSION['message'] = "محصول جدید با کد $product_code ایجاد شد.";
        header('Location:../views/products.php');
        exit();

    } catch (PDOException $e) {
        die(" خطا در ذخیره سازی اطلاعات". $e->getMessage());
    } 
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <!-- sidebar -->
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h1>ایجاد محصول جدید</h1>
        <form action="createproduct.php" method="post">
            <div class="mb-3">
                <label for="product_code" class="form-label">کد محصول</label>
                <input type="text" class="form-control" id="product_code" name="product_code" required>
            </div>
            <div class="mb-3">
                <label for="product_title" class="form-label">عنوان محصول</label>
                <input type="text" class="form-control" id="product_title" name="product_title" required>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">تصویر محصول</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">دسته بندی محصول</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">برند محصول</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">قیمت محصول</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">تعداد محصول</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
            </div>
            <div class="mb-3">
                <label for="short_description" class="form-label">توضیحات محصول</label>
                <input type="text" class="form-control" id="short_description" name="short_description" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Save Product</button>

          
        </form>
    </div>
</body>
</html>