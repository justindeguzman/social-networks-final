<?php
use yii\helpers\Html;
use humhub\models\Setting;
?>

<div class="panel panel-default" id="spaces-statistics-panel">

    <!-- Display panel menu widget -->
    <?php \humhub\widgets\PanelMenu::widget(array('id' => 'spaces-statistics-panel')); ?>

    <div class="panel-heading">
        <?php echo Yii::t('DirectoryModule.widgets_views_spaceStats', '<strong>Space</strong> stats'); ?>
    </div>

    <div class="panel-body">
        <?php if (isset($statsSpaceMostMembers->name)) { ?>
            <div style="text-align: center;">
                <strong><?php echo Yii::t('DirectoryModule.widgets_views_spaceStats', 'Space with most members'); ?>:
                </strong> <?php echo Html::encode($statsSpaceMostMembers->name); ?>
            </div>
        <?php } ?>

        <hr>
        <div class="knob-container" style="text-align: center; opacity: 0;">
            <strong><?php echo Yii::t('DirectoryModule.widgets_views_spaceStats', 'Total spaces'); ?></strong><br><br>

            <input id="spaces-total" class="knob" data-width="120" data-displayprevious="true" data-readOnly="true"
                   data-fgcolor="<?php echo Setting::Get('colorPrimary'); ?>" data-skin="tron"
                   data-thickness=".2" value="<?php echo $statsCountSpaces; ?>"
                   data-max="<?php echo $statsCountSpaces; ?>"
                   style="font-size: 25px !important; margin-top: 44px !important;">
        </div>

        <hr>

        <div class="knob-container" style="text-align: center; opacity: 0;">
            <strong><?php echo Yii::t('DirectoryModule.widgets_views_spaceStats', 'Private spaces'); ?></strong><br><br>

            <input id="spaces-private" class="knob" data-width="120" data-displayprevious="true" data-readOnly="true"
                   data-fgcolor="<?php echo Setting::Get('colorPrimary'); ?>"
                   data-skin="tron"
                   data-thickness=".2" value="<?php echo $statsCountSpacesHidden; ?>"
                   data-max="<?php echo $statsCountSpaces; ?>"
                   style="font-size: 25px !important; margin-top: 44px !important;">
        </div>
        <hr>


            <div style="text-align: center;">
                <strong><?php echo Yii::t('DirectoryModule.widgets_views_spaceStats', 'Node Uptime Rankings (excludes nodes with unretrievable data)'); ?>
                </strong>
                <?php $cnt= 1 ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="font-size:13px;text-align: center;" >Rank</th>
                        <th style="font-size:13px;text-align: center;">Node</th>
                    </tr>
                    </thead>
                    <tbody>

                <?php foreach( $statsNodeRankings as $n){ ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $n; ?></td>
                    </tr>
                    <?php $cnt= 1+$cnt ?>

                <?php }  ?>
                    </tbody>
                </table>

            </div>
    </div>
</div>

<script>
    $(function () {
        $(".knob").knob();
        $(".knob-container").css("opacity", 1);
    });
</script>