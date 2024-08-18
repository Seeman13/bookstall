<?php

namespace app\models;

use Yii;

use yii\base\InvalidConfigException;
use yii\db\{ActiveQuery, ActiveRecord, Expression};
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property int $id                  ID
 * @property string $name             Name of book
 * @property string $release          Release date
 * @property string|null $description Description of book
 * @property string|null $isbn        ISBN number
 * @property string|null $image       Image of book
 * @property string $created_at       Created at
 * @property string|null $updated_at  Updated at
 *
 * @property AuthorBook[] $authorBooks
 * @property Author[] $authors
 */
class Book extends ActiveRecord
{
    public array $list_authors = [];

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
        return '{{%books}}';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'release', 'list_authors'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['release'], 'string', 'max' => 4],
            [['isbn'], 'string', 'max' => 13],
            [['image'], 'string', 'max' => 100]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'name'        => Yii::t('app', 'Name of book'),
            'release'     => Yii::t('app', 'Release date'),
            'description' => Yii::t('app', 'Description of book'),
            'isbn'        => Yii::t('app', 'ISBN number'),
            'image'       => Yii::t('app', 'Image of book'),
            'created_at'  => Yii::t('app', 'Created at'),
            'updated_at'  => Yii::t('app', 'Updated at'),

            'list_authors' => Yii::t('app', 'List authors')
        ];
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @return void
     */
    public function afterSave($insert, $changedAttributes): void
    {
        $this->unlinkAll('authors', true);
        foreach ($this->list_authors as $author_id) {
            if ($author = Author::findOne($author_id)) {
                $this->link('authors', $author);
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Gets query for [[AuthorBooks]].
     *
     * @return ActiveQuery
     */
    public function getAuthorBooks(): ActiveQuery
    {
        return $this->hasMany(AuthorBook::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable('{{%author_books}}', ['book_id' => 'id']);
    }
}
