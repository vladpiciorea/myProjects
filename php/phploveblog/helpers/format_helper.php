<?php
// Format data
function formatDate($date){
    return date('F j,Y,g:i a',strtotime($date));
}

// Format text
function shortenText($text,$cahars = 450){
    $text = $text.' ';
    $text = substr($text, 0, $cahars);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.'...';
    return $text;
}
?>