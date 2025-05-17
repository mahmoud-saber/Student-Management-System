<?php
function filter($requesrname){
    
    return htmlspecialchars(strip_tags($_POST[$requesrname]));
}
?>