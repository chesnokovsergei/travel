<?php

namespace app\models;

use Yii;
use app\models\Query;


/**
 * This is the model class for table "airports".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $country
 *
 * @property Flights[] $flights
 * @property Flights[] $flights0
 */
class Airports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'airports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country'], 'integer'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlights()
    {
        return $this->hasMany(Flights::className(), ['from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlights0()
    {
        return $this->hasMany(Flights::className(), ['to' => 'id']);
    }

    public static function getAirportIdByCode($code)
    {
        $query = new \yii\db\Query();

        return $query
            ->select('id')
            ->from(Airports::tableName())
            ->where(['code' => $code])
            ->scalar();
    }

}