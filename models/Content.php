<?php

namespace app\models;

use Yii;
use \yii\helpers\Html;
use \yii\db\Expression;

/**
 * This is the model class for table "content".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 *
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['name', 'content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Content Description',
            'content' => 'Site Content (HTML Accepted)',
        ];
    }

}
