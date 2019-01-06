<?php
    $path = '/dir/myfile.php';
    // **retureneaza filename**
    // echo basename($path);

    // **Returneaza fara terminatia .php**
    // echo basename($path,'.php')

    // **Returneeaza path-ul**
    // echo dirname($path);

    //  **verific existenta fisierului file1.txt poate sa verifice daca exista si un dir**
     $file = 'file1.txt';
    // echo file_exists($file);

    // **Ia absolute path**
    // echo realpath($file);

    // **Verifica daca exista fisierul**
    // echo is_file($file);

    // **Verifica daca se poate scrie**
    // echo is_writable($file);
    // **Se poate citi**
    // echo is_readable($file);

    // **Dimensiunea fisierului file size**
    // echo filesize($file);

    // **Creare dir**
    // mkdir('testing');
    
    // **Strege dir daca e gol**
    // rmdir('testing');

    // **Copiere fisierul**
    // echo copy('file1.txt','file2.txt');

    // **Redenumire fisier**
    // rename('file2.txt', 'myfile.txt');

    // **Sterge un fisier**
    // unlink('myfile.txt');

    // **Scrie din file in string**
    // echo file_get_contents($file);

    // **Scrie string in fisier si sterge ce e in el**
    // each file_put_contents($file, 'Good by old');

    // **Pentru a nu strege ce exista in fisier**
    // $curren = file_get_contents($file);
    // $curren .= ' Goodby world';
    // file_put_contents($file,$curren);

    // Deschide un fisier pt al citi 
    // $handle = fopen($file, 'r');
    // $data = fread($handle, filesize($file));
    // echo $data;

    // Deschide fisierul pt a se scrie se si creaza in acelas timp
    $handle = fopen('file2.txt', 'w');
    $text = 'Vlad';
    fwrite($handle, $text);
?>