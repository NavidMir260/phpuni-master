<?php
$directory = isset($_GET['dir']) ? './uploads/'.$_GET['dir'] : './uploads';
$files = scandir($directory);

function getFileDetails($file_path){
    return[
        'size' => filesize($file_path),
        'modified' => date('F d Y H:i:s' , filemtime($file_path)),
        'created' => date('F d Y H:i:s' , filectime($file_path)),

    ];
}

function getbreadcrumb($dir){
    $parts = explode('/' , $dir);
    $breadcrumb = '';
    $currentpath = '';

    foreach($parts as $part){
        if($part !== ''){
            $currentpath .= $part . '/';
            $breadcrumb .= '<a href="index.php?dir=' . urlencode(rtrim($currentpath , '/')).'">'.htmlspecialchars($part). '</a>';
        }
    }
    return rtrim($breadcrumb , '/');

}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width , initial-scal=1.0">
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body>
        <div class="container">
        <h1>File Manager</h1>
        <form action="./fileOperations.php" method="post" class="creat_form">
            <input type="text" name="new_file_name" placeholder="enter a name">
            <select name="type">
                <option value="file">File</option>
                <option value="folder">Folder</option>
            </select>
            <input type="hidden" name="current_dir" value="<?php echo htmlspecialchars(isset($_GET['dir']) ? $_GET['dir'] : ''); ?>">
            <button type="submit" name="create">Create</button>
        </form>

        <?php if(isset($_GET['dir'])): ?>
            <a href="index.php?dir=<?php urldecode(dirname($_GET['dir'])); ?>">🔙</a>
            <?php endif; ?>

            <div class="breadcrumb">
                <?php echo "Current Directory:" . getbreadcrumb(isset($_GET['dir']) ? $_GET['dir'] : ""); ?> 
            </div>
        <form action="bulk_action.php" method="post" class="file">
 

        <ul>
        <?php foreach($files as $file): ?>
            <?php if($file == '.' || $file == '..') continue;
            $file_path = $directory.'/'.$file;
            $is_dir = is_dir($file_path);
            $details = $is_dir ? '' : getFileDetails($file_path);
            ?>
            <li>
            <input type="checkbox" name="selected_files[]" value="<?php echo htmlspecialchars($file); ?>">
            <?php if($is_dir): ?>
                    <a href="index.php?dir=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'].'/'.$file : $file); ?>">
                    📁<?php echo htmlspecialchars($file); ?>
                    </a>

                    <?php else: ?>
                    <a href="view_file.php?file=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'].'/'.$file : $file); ?>">
                    📜<?php echo htmlspecialchars($file); ?>
                    </a>

                    <span>(Size:<?php echo $details['size']; ?> Byte, Modified:<?php echo $details['modified']; ?>)</span>
                <?php endif; ?>
                <div class="file_actions">
                    <a href="rename.php?file=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'].'/'.$file : $file); ?>&dir=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'] : ''); ?>">Rename</a>
                    <a href="delete.php?file=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'].'/'.$file : $file); ?>&dir=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'] : ''); ?>">Delete</a>
                    <a href="download.php?file=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'].'/'.$file : $file); ?>&dir=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'] : ''); ?>">Download</a>
                    <a href="compress.php?file=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'].'/'.$file : $file); ?>&dir=<?php echo urlencode(isset($_GET['dir']) ? $_GET['dir'] : ''); ?>">compress</a>


                </div> 
                
             </li>
             <?php endforeach; ?>
    </ul>
    <button type="submit" name="delete_selected">Delete</button>
</form>



</form>
</div>
    </body>
</html>
