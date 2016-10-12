<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "upload_file".
 *
 * @property integer $upload_id
 * @property string $upload_filename
 * @property string $upload_filetype
 * @property string $upload_date
 */
class UploadFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;
    public static function tableName()
    {
        return 'upload_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_filename', 'upload_filetype'], 'required'],
            [['upload_date'], 'safe'],
            [['upload_filename'], 'string', 'max' => 100],
            [['upload_filetype'], 'string', 'max' => 10],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'upload_filename' => 'Upload Filename',
            'upload_filetype' => 'Upload Filetype',
            'upload_date' => 'Upload Date',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
