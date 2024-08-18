<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\{ActiveQuery, ActiveRecord, Expression};

/**
 * This is the model class for table "{{%author_books}}".
 *
 * @property int $author_id Author ID
 * @property int $book_id Book ID
 *
 * @property Author $author
 * @property Book $book
 */
class AuthorBook extends ActiveRecord
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
        return '{{%author_books}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['author_id', 'book_id'], 'required'],
            [['author_id', 'book_id'], 'integer'],
            [['author_id', 'book_id'], 'unique', 'targetAttribute' => ['author_id', 'book_id']],
            [['author_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Author::class,
                'targetAttribute' => ['author_id' => 'id']
            ],
            [['book_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Book::class,
                'targetAttribute' => ['book_id' => 'id']
            ]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'author_id' => Yii::t('app', 'Author ID'),
            'book_id' => Yii::t('app', 'Book ID')
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Book]].
     *
     * @return ActiveQuery
     */
    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }
}
