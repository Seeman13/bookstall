<?php

namespace app\models\auth;

use Yii;
use yii\db\{ActiveQuery, ActiveRecord};

use app\models\User;

/**
 * This is the model class for table "{{%auth_assignment}}".
 *
 * @property string $item_name
 * @property string $user_id
 * @property string $created_at
 *
 * @property User $user
 * @property AuthItem $itemName
 *
 * Class AuthAssignment
 * @package app\models\auth
 */
class AuthAssignment extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%auth_assignment}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [['user_id'], 'unique'],
            [['user_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
            [['item_name'], 'exist',
                'skipOnError' => true,
                'targetClass' => AuthItem::class,
                'targetAttribute' => ['item_name' => 'name']
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'item_name'  => Yii::t('auth', 'Role Name'),
            'user_id'    => Yii::t('auth', 'User ID'),
            'created_at' => Yii::t('auth', 'Date created role')
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getItemName(): ActiveQuery
    {
        return $this->hasOne(AuthItem::class, ['name' => 'item_name']);
    }
}
