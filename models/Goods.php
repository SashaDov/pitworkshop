<?php
namespace app\models;

use app\common\AppModel;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Goods
 * @package app\models
 *
 * @property integer $category
 * @property integer $chapter
 * @property integer $rubric
 * @property string $title
 * @property string $description
 * @property-read File[] $files
 * @property-read File $file
 * @property-read Lang $lang
 */
class Goods extends AppModel
{
    //CATEGORIES
    const KNITTED = 1;
    const BOOKS = 2;
    const SOFTBOOKS = 3;
    const STATIONERY = 4;
    const HANDBAGS = 5;
    const CASKETS_BOXES = 6;
    const ACCESSORIES = 7;

    //RUBRICS
    const ESOTERIC = 1;
    const SERIALS = 2;
    const MOVIES = 3;
    const HARRY_POTTER = 4;
    const SOUVENIRS_GIFTS = 5;

    //CHAPTERS
    const IN_STOCK = 1;
    const FOR_EXAMPLE = 2;

    /**
     * @return array
     */
    public static function categories()
    {
        return [
            self::KNITTED => \Yii::t('app', 'Knitted'),
            self::BOOKS => \Yii::t('app', 'Books'),
            self::SOFTBOOKS => \Yii::t('app', 'Softbooks'),
            self::STATIONERY => \Yii::t('app', 'Stationery'),
            self::HANDBAGS => \Yii::t('app', 'Handbags'),
            self::CASKETS_BOXES => \Yii::t('app', 'Caskets and boxes'),
            self::ACCESSORIES => \Yii::t('app', 'Accessories'),
        ];
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        $categories = static::categories();
        return !isset($categories[$this->category]) ?: $categories[$this->category];
    }

    /**
     * @return array
     */
    public static function rubrics()
    {
        return [
            self::ESOTERIC => \Yii::t('app', 'Esoteric'),
            self::SERIALS => \Yii::t('app', 'Serials'),
            self::MOVIES => \Yii::t('app', 'Movies'),
            self::HARRY_POTTER => \Yii::t('app', 'Harry Potter'),
            self::SOUVENIRS_GIFTS => \Yii::t('app', 'Souvenirs and gifts'),
        ];
    }

    /**
     * @return string
     */
    public function getRubricName()
    {
        $rubrics = static::rubrics();
        return !isset($rubrics[$this->rubric]) ?: $rubrics[$this->rubric];
    }

    /**
     * @return array
     */
    public static function chapters()
    {
        return [
            self::IN_STOCK => \Yii::t('app', 'In stock'),
            self::FOR_EXAMPLE => \Yii::t('app', 'For example'),
        ];
    }

    /**
     * @return string
     */
    public function getChapterName()
    {
        $chapters = static::chapters();
        return !isset($chapters[$this->chapter]) ?: $chapters[$this->chapter];
    }

    /**
     * @var
     */
    public $records;
    /**
     * @var UploadedFile[]
     */
    public $documents;


    public static function tableName()
    {
        return '{{goods}}';
    }

    public function rules()
    {
        return [
            [['title', 'alias', 'description', 'materials', 'tags', 'service_recomendation', 'size'], 'string'],
            [['documents'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc, docx, jpg, png, pdf', 'maxFiles' => 7],
            [['category', 'chapter', 'rubric', 'work_duration'], 'integer'],
            [['price'], 'double'],
            [['date_start', 'date_end', 'date_order'], 'date', 'format' => 'php:Y-m-d'],
            [['date_start', 'date_end', 'date_order'], 'default', 'value' => date('Y-m-d')],
            [['alias'], 'unique'],
            [['alias', 'category', 'chapter'], 'required'],
            [['records'], 'validateRecords'],
        ];
    }

    public function validateRecords($attribute)
    {
        foreach ($this->{$attribute} as $record) {
            if(!is_string($record)) {
                return false;
            }
        }
        return true;
    }

    public function attributeLabels()
    {
        return [
            'alias' => \Yii::t('app', 'Alias'),
            'chapter' => \Yii::t('app', 'Chapter'),
            'rubric' => \Yii::t('app', 'Rubric'),
            'category' => \Yii::t('app', 'Category'),
            'price' => \Yii::t('app', 'Price'),
            'size' => \Yii::t('app', 'Size'),
            'work_duration' => \Yii::t('app', 'Work duration'),
            'date_start' => \Yii::t('app', 'Start date'),
            'documents' => \Yii::t('app', 'Files loading'),
        ];
    }

    /**
     * Получить все файлы, принадлежащие товару
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::class, ['entity_id' => 'id'])
            ->andOnCondition(['entity_type' => 'goods']);
    }

    /**
     * Получить любой файл, принадлежащий определенному товару
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['entity_id' => 'id'])
            ->andOnCondition(['entity_type' => 'goods']);
    }

    /**
     * Атрибуты, которые в товарах переводятся на языки
     * @return array
     */
    public function langAttributes()
    {
        return [
            'title',
            'description',
            'service_recomendation',
        ];
    }

    /**
     * Получить информацию на соответствующем языке определенного атрибута
     * @param string $attr
     * @return \yii\db\ActiveQuery
     */
    public function getLang($attr = 'title')
    {
        return $this->hasOne(Lang::class, ['id' => $attr]);
    }
}
