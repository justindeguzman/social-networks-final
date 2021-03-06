<?php

namespace humhub\modules\space\models;

use Yii;
use humhub\modules\content\models\WallEntry;
use humhub\modules\activity\models\Activity;
use humhub\modules\comment\models\Comment;

/**
 * This is the model class for table "space_membership".
 *
 * @property integer $space_id
 * @property integer $user_id
 * @property string $originator_user_id
 * @property integer $status
 * @property string $request_message
 * @property string $last_visit
 * @property integer $invite_role
 * @property integer $admin_role
 * @property integer $share_role
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Membership extends \yii\db\ActiveRecord
{

    const STATUS_INVITED = 1;
    const STATUS_APPLICANT = 2;
    const STATUS_MEMBER = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'space_membership';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['space_id', 'user_id'], 'required'],
            [['space_id', 'user_id', 'originator_user_id', 'status', 'invite_role', 'admin_role', 'share_role', 'created_by', 'updated_by'], 'integer'],
            [['request_message'], 'string'],
            [['last_visit', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'space_id' => 'Space ID',
            'user_id' => 'User ID',
            'originator_user_id' => 'Originator User ID',
            'status' => 'Status',
            'request_message' => 'Request Message',
            'last_visit' => 'Last Visit',
            'invite_role' => 'Invite Role',
            'admin_role' => 'Admin Role',
            'share_role' => 'Share Role',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(\humhub\modules\user\models\User::className(), ['id' => 'user_id']);
    }

    public function getOriginator()
    {
        return $this->hasOne(\humhub\modules\user\models\User::className(), ['id' => 'originator_user_id']);
    }

    public function getSpace()
    {
        return $this->hasOne(\humhub\modules\space\models\Space::className(), ['id' => 'space_id']);
    }

    public function beforeSave($insert)
    {
        Yii::$app->cache->delete('userSpaces_' . $this->user_id);
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        Yii::$app->cache->delete('userSpaces_' . $this->user_id);
        return parent::beforeDelete();
    }

    /**
     * Update last visit
     */
    public function updateLastVisit()
    {
        $this->last_visit = new \yii\db\Expression('NOW()');
        $this->update(false, ['last_visit']);
    }

    /**
     * Counts all new Items for this membership
     */
    public function countNewItems($since = "")
    {
        $query = WallEntry::find()->joinWith('content');
        $query->where(['!=', 'content.object_model', Activity::className()]);
        $query->andWhere(['wall_entry.wall_id' => $this->space->wall_id]);
        $query->andWhere(['>', 'wall_entry.created_at', $this->last_visit]);
        $count = $query->count();

        $count += Comment::find()->where(['space_id' => $this->space_id])->andWhere(['>', 'created_at', $this->last_visit])->count();
        return $count;
    }




    /*
     *
     * Select  MAX(cnt),user_id from
        (select user_id, COUNT(user_id) cnt
        from space_membership group
        by user_id a
        ) AS T;

     */

    public static function GetUserInMostSpaces()
    {


        $cacheId = "MostSpaces";

        $mostspaces = Yii::$app->cache->get($cacheId);



        if ($mostspaces === false) {


            $mostspaces= Yii::$app->db
                ->createCommand("Select  MAX(cnt),user_id,username from
(select user_id , COUNT(user_id) cnt, username
from user, space_membership where space_membership.user_id=user.id group
by space_membership.user_id
) AS T")->queryAll();

            $userspaces = array();

            foreach ($mostspaces as $ms) {
                $userspaces[] = $ms['username'];
            }
            Yii::$app->cache->set($cacheId, $userspaces);
        }
        return $userspaces;
    }

    /**
     * Returns a list of all spaces of the given userId
     *
     * @param type $userId
     */
    public static function GetUserSpaces($userId = "")
    {
        if ($userId == "")
            $userId = Yii::$app->user->id;

        $cacheId = "userSpaces_" . $userId;

        $spaces = Yii::$app->cache->get($cacheId);
        if ($spaces === false) {

            $orderSetting = \humhub\models\Setting::Get('spaceOrder', 'space');
            $orderBy = 'name ASC';
            if ($orderSetting != 0) {
                $orderBy = 'last_visit DESC';
            }
            $memberships = self::find()->joinWith('space')->where(['user_id' => $userId, 'space_membership.status' => self::STATUS_MEMBER])->orderBy($orderBy);

            $spaces = array();
            foreach ($memberships->all() as $membership) {
                $spaces[] = $membership->space;
            }
            Yii::$app->cache->set($cacheId, $spaces);
        }
        return $spaces;
    }


}
