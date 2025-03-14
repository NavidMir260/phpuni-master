<?php 
if(isset($_GET['file'])){
    $file = './uploads/'.$_GET['file'];
    $parent_dir = isset($_GET['dir']) ? $_GET['dir'] : "";

    if(is_dir($file)){
    deleteDirectory($file);
}else{
    unlink($file);
}

    $redirect_url = 'index.php'.($parent_dir ? '?dir='.urldecode($parent_dir) : '');
    header("location:$redirect_url");
}

function deleteDirectory($dir){
    if(!is_dir($dir)){
        return unlink($dir);
    }
    $items = array_diff(scandir($dir),array('.','..'));

    foreach($items as $item){
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        
        if(is_dir($path)){
            deleteDirectory($path);
        }else{
            unlink($path);
        }
    }
    return rmdir($dir);
}

?>