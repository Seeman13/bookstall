<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%subscribers}}".
 *
 * @property int $id
 * @property string $email
 * @property int $date
 */

/**
 * Class Subscriber
 * @package app\models
 */
class Subscriber extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%subscribers}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['date']
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email'], 'required'],
            [['date'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id'    => 'ID',
            'email' => Yii::t('app', Yii::t('app', 'Email')),
            'date'  => Yii::t('app', Yii::t('app', 'Created at')),
        ];
    }
}
