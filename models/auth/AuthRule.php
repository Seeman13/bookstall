<?php

namespace app\models\auth;

use Yii;
use yii\db\{ActiveQuery, ActiveRecord};

/**
 * This is the model class for table "{{%auth_rule}}".
 *
 * @property string $name
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AuthItem[] $authItems
 *
 * Class AuthRule
 * @package app\models\auth
 */
class AuthRule extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%auth_rule}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name'       => Yii::t('auth', 'Name'),
            'data'       => Yii::t('auth', 'Role data'),
            'created_at' => Yii::t('auth', 'Date added'),
            'updated_at' => Yii::t('auth', 'Date of renewal')
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthItems(): ActiveQuery
    {
        return $this->hasMany(AuthItem::class, ['rule_name' => 'name']);
    }
}
