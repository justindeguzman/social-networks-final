<?php
namespace humhub\modules\user\models;

use Yii;


/* @property integer $user_id
 * @property integer $rep_id
  @property integer $point_value
@property integer $boolean
*/
class ReputationHistory extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reputation_history';
    }

    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        $rules = [
//            [['user_id'], 'required'],
//            [['user_id'], 'integer'],
//
//            [['rep_id'], 'required'],
//            [['rep_id'], 'integer'],
//        ];
//
//        foreach (ReputationHistroy::find()->all() as $rephist) {
//
//            // Not visible fields: Admin Only
//            if (!$rephist->visible && $this->scenario != 'editAdmin')
//                continue;
//
//            // Not Editable: only visibible on Admin Edit or Registration (if enabled)
//            if (!$rephist->editable && $this->scenario != 'editAdmin' && $this->scenario != 'registration')
//                continue;
//
//            //if ($this->scenario == 'achievedPoints' && !rephist->show_in_modal);
//            //  continue;
//
//            $rules = array_merge($rules, $rephist->getReputationType()->getReputationRules());
//        }
//        return $rules;
//    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['editAdmin'] = array();
        $scenarios['achievedPoints'] = array();
        $scenarios['editProfile'] = array();

        $fields = array();
        foreach (ReputationHistory::find()->all() as $reputation) {
            $scenarios['editAdmin'][] = $reputation->internal_name;
            if ($reputation->editable) {
                $scenarios['editProfile'][] = $reputation->internal_name;
            }
//            if ($reputation->show_at_registration) {
//                $scenarios['registration'][] = $reputation->internal_name;
//            }
        }
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        /**
         * Hack for Yii Messages Command
         *
         * Yii::t('UserModule.models_Profile', 'Firstname')
         * Yii::t('UserModule.models_Profile', 'Lastname')
         * Yii::t('UserModule.models_Profile', 'Title')
         * Yii::t('UserModule.models_Profile', 'Street')
         * Yii::t('UserModule.models_Profile', 'Zip')
         * Yii::t('UserModule.models_Profile', 'City')
         * Yii::t('UserModule.models_Profile', 'Country')
         * Yii::t('UserModule.models_Profile', 'State')
         * Yii::t('UserModule.models_Profile', 'About')
         * Yii::t('UserModule.models_Profile', 'Birthday')
         * Yii::t('UserModule.models_Profile', 'Hide year in profile')
         *
         * Yii::t('UserModule.models_Profile', 'Gender')
         * Yii::t('UserModule.models_Profile', 'Male')
         * Yii::t('UserModule.models_Profile', 'Female')
         * Yii::t('UserModule.models_Profile', 'Custom')
         * Yii::t('UserModule.models_Profile', 'Hide year in profile')         *
         *
         * Yii::t('UserModule.models_Profile', 'Phone Private')
         * Yii::t('UserModule.models_Profile', 'Phone Work')
         * Yii::t('UserModule.models_Profile', 'Mobile')
         * Yii::t('UserModule.models_Profile', 'Fax')
         * Yii::t('UserModule.models_Profile', 'Skype Nickname')
         * Yii::t('UserModule.models_Profile', 'MSN')
         * Yii::t('UserModule.models_Profile', 'XMPP Jabber Address')
         *
         * Yii::t('UserModule.models_Profile', 'Url')
         * Yii::t('UserModule.models_Profile', 'Facebook URL')
         * Yii::t('UserModule.models_Profile', 'LinkedIn URL')
         * Yii::t('UserModule.models_Profile', 'Xing URL')
         * Yii::t('UserModule.models_Profile', 'Youtube URL')
         * Yii::t('UserModule.models_Profile', 'Vimeo URL')
         * Yii::t('UserModule.models_Profile', 'Flickr URL')
         * Yii::t('UserModule.models_Profile', 'MySpace URL')
         * Yii::t('UserModule.models_Profile', 'Google+ URL')
         * Yii::t('UserModule.models_Profile', 'Twitter URL')
         */
        $labels = [];
        foreach (ReputationHistory::find()->all() as $reputation) {
            $labels = array_merge($labels, $reputation->fieldType->getLabels());
        }
        return $labels;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Returns the Profile as CForm
     * //     */
//    public function getFormDefinition()
//    {
//
//        $definition = array();
//        $definition['elements'] = array();
//
//        foreach (ProfileFieldCategory::find()->orderBy('sort_order')->all() as $profileFieldCategory) {
//
//            $category = array(
//                'type' => 'form',
//                'title' => Yii::t($profileFieldCategory->getTranslationCategory(), $profileFieldCategory->title),
//                'elements' => array(),
//            );
//
//            foreach (ProfileField::find()->orderBy('sort_order')->where(['profile_field_category_id' => $profileFieldCategory->id])->all() as $profileField) {
//
//                if (!$profileField->visible && $this->scenario != 'editAdmin')
//                    continue;
//
//                if ($this->scenario == 'registration' && !$profileField->show_at_registration)
//                    continue;
//
//                // Mark field as editable when we are on register scenario and field should be shown at registration
//                if ($this->scenario == 'registration' && $profileField->show_at_registration)
//                    $profileField->editable = true;
//
//                // Mark field as editable when we are on adminEdit scenario
//                if ($this->scenario == 'editAdmin') {
//                    $profileField->editable = true;
//                }
//
//                // Dont allow editing of ldap syned fields - will be overwritten on next ldap sync.
//                if ($this->user !== null && $this->user->auth_mode == User::AUTH_MODE_LDAP && $profileField->ldap_attribute != "") {
//                    $profileField->editable = false;
//                }
//
//                $fieldDefinition = $profileField->fieldType->getFieldFormDefinition();
//                $category['elements'] = array_merge($category['elements'], $fieldDefinition);
//            }
//
//            $definition['elements']['category_' . $profileFieldCategory->id] = $category;
//        }
//
//        return $definition;
//    }

//    public function beforeSave($insert)
//    {
//        foreach (ReputationHistory::find()->all() as $rephist) {
//            $key = $rephist->internal_name;
//            $this->$key = $rephist->getFieldType()->beforeProfileSave($this->$key);
//        }
//
//        return parent::beforeSave($insert);
//    }

    /**
     * Checks if the given column name already exists on the profile table.
     *
     * @param String $name
     * @return Boolean
     */
    public static function columnExists($name)
    {
        $table = Yii::$app->getDb()->getSchema()->getTableSchema(self::tableName(), true);
        $columnNames = $table->getColumnNames();
        return (in_array($name, $columnNames));
    }

//    /**
//     * Returns all profile field categories with some user data
//     *
//     * @todo Optimize me
//     * @return Array ProfileFieldCategory
//     */
//    public function getProfileFieldCategories()
//    {
//
//        $categories = array();
//
//        foreach (ProfileFieldCategory::find()->orderBy('sort_order')->all() as $category) {
//
//            if (count($this->getProfileFields($category)) != 0) {
//                $categories[] = $category;
//            }
//        }
//
//        return $categories;
//    }


    public function getReputationHistoryForACharacter( $user_id)
    {
        $fields = array();

        $query = ReputationHistory::find();
        $query->orderBy('sort_order');
//        if ($repid !== null) {
//            $query->andWhere(['rep_id' => $repid]);
//        }
        foreach ($query->all() as $field) {

            if ($field['user_id'] === $user_id) {
                $fields[] = $field;
            }
        }

        return $fields;
    }

    public function getReputationHistoryForAReputation( $repid, $user_id)
    {
        $fields = array();

        $query = ReputationHistory::find();
        $query->orderBy('sort_order');
        if ($repid !== null) {
            $query->andWhere(['rep_id' => $repid]);
        }
//        foreach ($query->all() as $field) {
//
//            if ($field['user_id'] === $user_id) {
//                $fields[] = $field;
//            }
//        }

        return $fields;
    }

//select point_value from reputation inner join (select * from reputation_history where user_id=1) al on reputation.id = al.rep_id
    public  static function getReputationHistorySum( $user_id)
    {

        $sum = Yii::$app->db->createCommand();
        $sum->setSql("select sum(point_value) from reputation inner join (select * from reputation_history where user_id=:here) al on reputation.id = al.rep_id")->bindValue(":here",$user_id);


        $s = $sum->queryAll();

        return $s;
    }
    public  static function addReputation( $user_id,$rep_id){

        $query = Yii::$app->db->createCommand();

        $query->setSql("insert into reputation_history(user_id,rep_id) VALUES ($user_id,$rep_id)")->execute();




    }






}




//
//    /**
// * Returns all profile fields with user data by given category
// *
// * @todo Optimize me
// * @param ProfileFieldCategory $category
// * @return Array ProfileFields
// */
//public function getProfileFields(ProfileFieldCategory $category = null)
//{
//    $fields = array();
//
//    $query = ProfileField::find();
//    $query->where(['visible' => 1]);
//    $query->orderBy('sort_order');
//    if ($category !== null) {
//        $query->andWhere(['profile_field_category_id' => $category->id]);
//    }
//    foreach ($query->all() as $field) {
//
//        if ($field->getUserValue($this->user) != "") {
//            $fields[] = $field;
//        }
//    }

  //  return $fields;
//}



