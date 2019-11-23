<?php 
include 'config.php';


$lot = 1;
$block = 1;
$house_id=3;
$subd_id = 2;


$sql = 'SELECT hd.house_id,
h.lot,
h.block,
h.subdivision_id,
h.model_name,
hd.house_name,
hd.member_id,
h.terms_id,
hd.member_id,
h.house_desc 
 
FROM `housing_detail` as hd inner join house as h on hd.house_id = h.id  where hd.house_id = "'.$house_id.'" and h.lot= "'.$lot.'" and h.block = "'.$block.'" and h.subdivision_id = "'.$subd_id.'"';

$result = mysqli_query($conn,$sql);
    
$row = mysqli_fetch_array($result);


 print_r($row);
?>