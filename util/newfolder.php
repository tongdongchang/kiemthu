<?php  
$id=$_POST['id'];
if (!file_exists('../data/img/'.$id)) {
    mkdir('../data/img/'.$id, 0777, true);
}
?>