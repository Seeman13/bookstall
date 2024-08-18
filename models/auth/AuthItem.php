<?php

namespace app\models\auth;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\{ActiveQuery, ActiveRecord};

use app\models\User;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property User[] $users
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 *
 * Class AuthItem
 * @package app\models\auth
 */
class AuthItem extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['description'], 'unique'],
            [['rule_name'], 'exist',
                'skipOnError' => true,
                'targetClass' => AuthRule::class,
                'targetAttribute' => ['rule_name' => 'name']
            ]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name'        => Yii::t('auth', 'Role Name'),
            'type'        => Yii::t('auth', 'Type'),
            'description' => Yii::t('auth', 'Key description'),
            'rule_name'   => Yii::t('auth', 'The title of the role?'),
            'data'        => Yii::t('auth', 'Date of role assignment?'),
            'created_at'  => Yii::t('auth', 'Date created role'),
            'updated_at'  => Yii::t('auth', 'The date the role was updated')
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthAssignments(): ActiveQuery
    {
        return $this->hasMany(AuthAssignment::class, ['item_name' => 'name']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable('auth_assignment', ['item_name' => 'name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRuleName(): ActiveQuery
    {
        return $this->hasOne(AuthRule::class, ['name' => 'rule_name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthItemChildren(): ActiveQuery
    {
        return $this->hasMany(AuthItemChild::class, ['parent' => 'name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthItemChildren0(): ActiveQuery
    {
        return $this->hasMany(AuthItemChild::class, ['child' => 'name']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getChildren(): ActiveQuery
    {
        return $this->hasMany(AuthItem::class, ['name' => 'child'])
            ->viaTable('auth_item_child', ['parent' => 'name']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getParents(): ActiveQuery
    {
        return $this->hasMany(AuthItem::class, ['name' => 'parent'])
            ->viaTable('auth_item_child', ['child' => 'name']);
    }
}
