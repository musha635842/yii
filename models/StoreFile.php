<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * UploadForm is the model behind the upload form.
 */
class StoreFile extends ActiveRecord
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    public static function tableName()
    {
        return 'filestore';
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'maxFiles' => 5], // <--- here! 
            [['name'], 'string'],
            [['data'], 'string'],
            [['storemark'], 'safe'], 
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'name',
            'data' => 'data',
            'storemark' => 'storemark',
        ];
    }

}