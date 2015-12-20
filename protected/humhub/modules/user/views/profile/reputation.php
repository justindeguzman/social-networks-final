<?php

use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('UserModule.views_profile_reputation', '<strong>Reputation</strong> of this user'); ?></div>

    <div class="panel-body">

        <?php $firstClass = "active"; ?>


∏            <?php foreach ($user->profile->getProfileFieldCategories() as $category): ?>
                <li class="<?php echo $firstClass;
                $firstClass = ""; ?>"><a href="#profile-category-<?php echo $category->id; ?>"
                                         data-toggle="tab"><?php echo Html::encode(Yii::t($category->getTranslationCategory(), $category->title)); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php $firstClass = "active"; ?>

        <table class="table table-bordered">
            <?php Console.log( $user->profile->getUser()->getId()) ?>

            <?php echo $user->profile->getUser()->getId() ?>

</table>
        </div>
    </div>
</div>
