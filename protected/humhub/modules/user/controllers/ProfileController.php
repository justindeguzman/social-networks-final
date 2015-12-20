<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\controllers;

use humhub\modules\content\components\ContentContainerController;
use humhub\modules\content\components\ContentAddonActiveRecord;
use humhub\modules\user\models;
use Yii;
use yii\db\Query;
use humhub\modules\user\models\ReputationHistory;

/**
 * ProfileController is responsible for all user profiles.
 * Also the following functions are implemented here.
 *
 * @author Luke
 * @package humhub.modules_core.user.controllers
 * @since 0.5
 */
class ProfileController extends ContentContainerController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => \humhub\components\behaviors\AccessControl::className(),
                'guestAllowedActions' => ['index', 'stream', 'about', 'reputation']
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\content\components\actions\ContentContainerStream::className(),
                'mode' => \humhub\modules\content\components\actions\ContentContainerStream::MODE_NORMAL,
                'contentContainer' => $this->getUser()
            ),
        );
    }

    /**
     *
     */
    public function actionIndex()
    {
        return $this->render('index', ['user' => $this->contentContainer]);
    }

    /**
     *
     */
    public function actionAbout()
    {
        return $this->render('about', ['user' => $this->contentContainer]);
    }

    public function actionReputation(){
        $query = new Query;
        $query2 = new Query;


         $query->addSelect('*')->from('reputation r');
        $fullrep = $query->all();

        $query2->select('id, user_id, rep_id, timestamp')->from('`reputation_history`')->where('user_id = ' . $this->getUser()->getId());
            $myrep = $query2->all();
        $sum =  ReputationHistory::getReputationHistorySum($this->contentContainer->getId());
        return $this->render('reputation', ['user' => $this->contentContainer->attributes, 'rep' => $fullrep, 'myrep' => $myrep, 'sum' => $sum]);
    }




    /**
     * Unfollows a User
     *
     */
    public function actionFollow()
    {
        $this->forcePostRequest();
        $this->getUser()->follow();
        return $this->redirect($this->getUser()->getUrl());
    }

    /**
     * Unfollows a User
     */
    public function actionUnfollow()
    {
        $this->forcePostRequest();
        $this->getUser()->unfollow();
        return $this->redirect($this->getUser()->getUrl());
    }

}

?>
