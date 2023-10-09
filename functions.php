<?php
 
    function remove($arr, $valueToRemove ){
     
     $index = array_search($valueToRemove, $arr);
     print($index);
     if ($index !== false) {
        unset($arr[$index]);
     }
     
     return $arr;
     }

?>