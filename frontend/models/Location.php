<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $location_id
 * @property string $zip_code
 * @property string $city
 * @property string $provience
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip_code', 'city', 'provience'], 'required'],
            [['zip_code', 'city', 'provience'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'provience' => 'Provience',
        ];
    }
}
