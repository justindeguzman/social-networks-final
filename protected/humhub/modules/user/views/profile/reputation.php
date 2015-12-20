<?php

use yii\bootstrap\Html;

include 'ChromePhp.php';
require_once('FirePHPCore/FirePHP.class.php');


$firstClass = "active";
$fire_php = FirePHP::getInstance(true);
ob_start();

//$fire_php->info($this);
$fire_php->group(array("this" => "is", "group" => "output"));


$fire_php->table("table",$user);
$fire_php->groupEnd();
$thumbs_icon = yii\bootstrap\Html::icon("thumbs-up");

$justMyRepIdVal= array();
foreach($val as $myrep){
    $justMyRepIdVal[] = $val['rep_id'];
}

?>


<table class="table table-bordered">
    <thead>Reputations table</thead>
    <tr>
        <th> # </th>
        <th> Completed </th>
        <th> Description </th>
        <th> Point value </th>
    </tr>


    <?php foreach ($rep as $r): ?>


    <tr>


             <?php if( in_array($r['id'],$justMyRepIdVal) ){ ?>


                <td><?php echo $thumbs_icon ?>
           </td>
        <?php } else { ?>
        <td></td>
       <?php } ?>

            <td><?php echo  $r['id']  ?> </td>
        <td><?php echo  $r['name']  ?> </td>
        <td><?php echo  $r['point_value']  ?> </td>
        <td><?php echo  $r['is_badge']  ?> </td>



    </tr>
    <?php endforeach; ?>

    <?php ChromePhp::log($user); ?>
    <?php ChromePhp::log($rep); ?>
    <?php ChromePhp::log($myrep); ?>

</table>



