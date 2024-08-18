<?php

namespace app\models;

use Yii;

use yii\base\InvalidConfigException;
use yii\db\{ActiveQuery, ActiveRecord, Expression};
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%authors}}".
 *
 * @property int $id                 ID
 * @property string|null $firstName  First name
 * @property string|null $lastName   Last name
 * @property string $created_at      Created at
 * @property string|null $updated_at Updated at
 *
 * @property AuthorBook[] $authorBooks
 * @property Book[] $books
 */
class Author extends ActiveRecord
{
    /**
     * @var string|null
     */
    public string|null $count_books = null;

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at']
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
        return '{{%authors}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['created_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 25]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First name'),
            'last_name'  => Yii::t('app', 'Last name'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at')
        ];
    }

    /**
     * Gets query for [[AuthorBooks]].
     *
     * @return ActiveQuery
     */
    public function getAuthorBooks(): ActiveQuery
    {
        return $this->hasMany(AuthorBook::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->viaTable('{{%author_books}}', ['author_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return "$this->first_name $this->last_name";
    }
}
