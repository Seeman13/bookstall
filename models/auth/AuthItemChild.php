<?php

namespace app\models\auth;

use Yii;
use yii\db\{ActiveQuery, ActiveRecord};

/**
 * This is the model class for table "{{%auth_item_child}}".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AuthItem $parent0
 * @property AuthItem $child0
 *
 * Class AuthItemChild
 * @package app\models\auth
 */
class AuthItemChild extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%auth_item_child}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist',
                'skipOnError' => true,
                'targetClass' => AuthItem::class,
                'targetAttribute' => ['parent' => 'name']
            ],
            [['child'], 'exist',
                'skipOnError' => true,
                'targetClass' => AuthItem::class,
                'targetAttribute' => ['child' => 'name']
            ]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'parent' => Yii::t('auth', 'Parent'),
            'child'  => Yii::t('auth', 'Child')
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getParent0(): ActiveQuery
    {
        return $this->hasOne(AuthItem::class, ['name' => 'parent']);
    }

    /**
     * @return ActiveQuery
     */
    public function getChild0(): ActiveQuery
    {
        return $this->hasOne(AuthItem::class, ['name' => 'child']);
    }
}
