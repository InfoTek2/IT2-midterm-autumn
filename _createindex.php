<?php

$filestream = fopen(getcwd() . "/index.html", "w");
fwrite($filestream, '<html><head><meta charset="utf-8"><title>IT2 heldagsprøve høst</title></head><body>');

$files = scandir(getcwd());
foreach($files as $file) {
    if(substr($file, 0, strlen(".")) == ".")
        continue;
    
    if(!is_dir($file))
        continue;

    fwrite($filestream, "<a href=\"./" . $file . "\">" . $file . "</a><br/>");

    $fp = fopen(getcwd() . "/" . $file . "/index.html", "w");

    fwrite($fp, '<html><head><meta charset="utf-8"><title>' . $file . '</title></head><body><h1>Directory: '. $file . '</h1><ul>');
    
    $subdir_files = scandir($file);
    foreach($subdir_files as $subdir_file) {
        if(substr($subdir_file, 0, strlen(".")) == ".")
            continue;
        
        if(is_dir(getcwd() . "/" . $file . "/" . $subdir_file))
            continue;

        if($subdir_file == "index.html")
            continue;

        $path =  "./" . $subdir_file;
        fwrite($fp, '<li><a href="' . $path . '">'. $subdir_file . '</a></li>');
    }

    fwrite($fp, '</ul></body></html>');
    fclose($fp);
}    

fwrite($filestream, '</body></html>');   
fclose($filestream);