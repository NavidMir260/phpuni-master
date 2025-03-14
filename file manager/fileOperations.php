<?php
if(isset($_POST['create'])){



    
    $name = $_POST['new_file_name'];
    $type = $_POST['type'];
    $current_dir = isset($_POST['current_dir']) ? $_POST['current_dir'] : '';
    $path = './uploads/'.$current_dir.'/'.$name;
    // $original_path = pathinfo('./uploads');
    $new_name_code_counter = 1;

    
    $directory = './uploads';
    $files = scandir($directory);


    $original_name = $name;
    foreach ($files as $file) {
        if (!is_dir($directory . '/' . $file)) {
            if ($name == $file) {
                while (file_exists($path)) {
                    $name = $original_name . '(' . $new_name_code_counter . ')';
                    $path = './uploads/' . $current_dir . '/' . $name;
                    $new_name_code_counter++;
                }
            }
        }
    }
        



    // var_dump($name);
    // var_dump($current_dir);
    if($current_dir !== ''){
        $path = './uploads/'.$current_dir.'/'.$name;
        // var_dump('if !== Null:'.$path."<br>");
    }else{
        $path = "./uploads/".$name;
        // var_dump('if == Null:'.$path."<br>");
    }






    if($type == 'file'){
        fopen($path , 'w');
    } else if($type == 'folder'){
        mkdir($path);
    }

header("location: index.php?dir=".urlencode($current_dir));
exit();
}



?>