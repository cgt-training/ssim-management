<?php

namespace frontend\models;

use Yii;

use yii\web\UploadedFile;
/**
 * This is the model class for table "company".
 *
 * @property integer $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_created
 * @property string $company_status
 *
 * @property Branch[] $branches
 * @property Department[] $departments
 */
class Company extends \yii\db\ActiveRecord
{
    /**class="form-group field-company-company_address required"
     * @inheritdoc
     */
    /**
     * @var UploadedFile
     */
    public $file;
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'company_email', 'company_address', 'company_status'], 'required'],
            [['company_created','company_profile'], 'safe'],
            [['company_status'], 'string'],
            [['company_name', 'company_email','company_profile'], 'string', 'max' => 100],
            [['company_address'], 'string', 'max' => 255],
            [['file'],'file'],
            //array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
            //array('title, image', 'length', 'max'=>255, 'on'=>'insert,update'), 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_created' => 'Company Created',
            'company_status' => 'Company Status',
            'file' => 'Profile Pictures',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branch::className(), ['company_fk_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['company_fk_id' => 'company_id']);
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
