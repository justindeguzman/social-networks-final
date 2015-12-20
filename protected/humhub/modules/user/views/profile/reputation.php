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
foreach( $myrep as $val):
    $justMyRepIdVal[] = $val['rep_id'];

endforeach;
?>
<div class="panel panel-default">
    <div
        class="panel-heading"><?php echo Yii::t('UserModule.views_profile_reputation', '<strong>Reputation</strong> of this user'); ?></div>

    <div class="panel-body">

        <?php $firstClass = "active"; ?>

<div class="panel_heading">Reputations table</div>


<table class="table table-bordered panel-body">

    <tr>
        <th> # </th>
        <th> Completed </th>
        <th> Description </th>
        <th> Point value </th>
    </tr>


    <?php foreach ($rep as $r): ?>


    <tr>




            <td style=" text-align: center;padding: 8px"><?php echo  $r['id']  ?> </td>
        <?php if( in_array($r['id'],$justMyRepIdVal) ){ ?>


            <td style="padding: 8px;text-align: center;" ><?php echo $thumbs_icon ?>
            </td>
        <?php } else { ?>
            <td style="padding: 8px; text-align: center;"></td>
        <?php } ?>
        <td style= "padding:8px; "><?php echo  $r['name']  ?> </td>
        <td style="padding:8px; text-align: center;"><?php echo  $r['point_value']  ?> </td>
<!--        <td>--><?php //echo  $r['is_badge']  ?><!-- </td>-->
        <?php endforeach; ?>



    </tr>

    <?php ChromePhp::log($user); ?>
    <?php ChromePhp::log($rep); ?>
    <?php ChromePhp::log($myrep); ?>

</table>
        </div>
    </div>




