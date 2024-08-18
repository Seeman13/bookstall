<?php

namespace app\models;

use Yii;

use yii\base\{Exception, InvalidConfigException};
use yii\behaviors\TimestampBehavior;
use yii\db\{ActiveQuery, ActiveRecord, Expression};
use yii\web\IdentityInterface;

use app\models\auth\{AuthAssignment, AuthItem};

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id                              ID
 * @property string $ip_address                   IP Address at registration
 * @property string $name                         Login (username)
 * @property string $email                        Email address
 * @property string|null $phone                   Telephone number
 * @property string|null $firstName               First name
 * @property string|null $lastName                Last name
 * @property string|null $password                Password
 * @property string|null $forgotten_password_code Forgotten password code
 * @property string|null $auth_key                Auth key
 * @property string $created_at                   Created at
 * @property string|null $updated_at              Updated at
 * @property string|null $last_activity           Last activity
 * @property string|null $deleted_at              Deleted at
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at', 'last_activity'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at'],
                    self::EVENT_AFTER_REFRESH => ['last_activity'],
                ],
                'value' => new Expression('NOW()')
            ],
        ];
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%users}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['ip_address', 'name', 'email', 'created_at'], 'required'],
            [['created_at', 'updated_at', 'last_activity', 'deleted_at'], 'safe'],
            [['ip_address'], 'string', 'max' => 45],
            [['name', 'phone', 'first_name', 'last_name'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['password', 'forgotten_password_code'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id'                      => 'ID',
            'ip_address'              => 'IP Address at registration',
            'name'                    => 'Login (username)',
            'email'                   => 'Email address',
            'phone'                   => 'Telephone number',
            'first_name'              => 'First name',
            'last_name'               => 'Last name',
            'password'                => 'Password',
            'forgotten_password_code' => 'Forgotten password code',
            'auth_key'                => 'Auth key',
            'created_at'              => 'Created at',
            'updated_at'              => 'Updated at',
            'last_activity'           => 'Last activity',
            'deleted_at'              => 'Deleted at'
        ];
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id): User | IdentityInterface | null
    {
        return static::findOne($id);
    }

    /**
     * @param mixed $token
     * @param mixed $type
     * @return User|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null): User | IdentityInterface | null
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username (customize email).
     *
     * @param string $username
     * @return User|null
     */
    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * @return int|string
     */
    public function getId(): int | string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password.
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthAssignment(): ActiveQuery
    {
        return $this->hasOne(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getItemNames(): ActiveQuery
    {
        return $this->hasMany(AuthItem::class, ['name' => 'item_name'])
            ->viaTable('auth_assignment', ['user_id' => 'id']);
    }
}
