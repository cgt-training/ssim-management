<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use frontend\models\UploadFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            // $model = new UploadFile();
            // date_default_timezone_set('Asia/Kolkata');
            // $current_date = date("Y-m-d h:i:sa");
            // $model->upload_filename = $this->imageFile->baseName;
            // $model->upload_filetype = $this->imageFile->extension;
            // $model->upload_date = $current_date;
            //print_r($model);exit();
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            if($model->save())
            {
                 return true;
            }
            else
            {
                 return false;
            }
            
           
        } else {
            return false;
        }
    }
}