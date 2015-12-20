<?php

namespace humhub\modules\user\widgets;

use Yii;
use humhub\modules\user\models\User;

/**
 * ProfileMenuWidget shows the (usually left) navigation on user profiles.
 *
 * Only a controller which uses the 'application.modules_core.user.ProfileControllerBehavior'
 * can use this widget.
 *
 * The current user can be gathered via:
 *  $user = Yii::$app->getController()->getUser();
 *
 * @package humhub.modules_core.user.widgets
 * @since 0.5
 * @author Luke
 */
class ProfileMenu extends \humhub\widgets\BaseMenu
{

    public $user;
    public $template = "@humhub/widgets/views/leftNavigation";

    public function init()
    {
        $this->addItemGroup(array(
            'id' => 'profile',
            'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', '<strong>Profile</strong> menu'),
            'sortOrder' => 100,
        ));

        $this->addItem(array(
            'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Stream'),
            'group' => 'profile',
            'url' => $this->user->createUrl('//user/profile'),
            'sortOrder' => 200,
            'isActive' => (Yii::$app->controller->id == "profile" && Yii::$app->controller->action->id == "index"),
        ));

        //if (Yii::$app->getController()->getUser()->profile->about != "") {
        $this->addItem(array(
            'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'About'),
            'group' => 'profile',
            'url' => $this->user->createUrl('//user/profile/about'),
            'sortOrder' => 300,
            'isActive' => (Yii::$app->controller->id == "profile" && Yii::$app->controller->action->id == "about"),
        ));

        $this->addItem(array(
            'label' => Yii::t('UserModule.widgets_ProfileMenuWidget', 'Reputation'),
            'group' => 'profile',
            'url' => $this->user->createUrl('//user/profile/reputation'),
            'sortOrder' => 400,
            'isActive' => (Yii::$app->controller->id == "profile" && Yii::$app->controller->action->id == "reputation"),
        ));

        //}

        parent::init();
    }

    public function run()
    {
        if (Yii::$app->user->isGuest && $this->user->visibility != User::VISIBILITY_ALL) {
            return;
        }

        return parent::run();
    }

}

?>
