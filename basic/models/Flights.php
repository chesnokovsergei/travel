<?php

namespace app\models;

use Yii;
use app\models\XmlHandler;

/**
 * This is the model class for table "flights".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property integer $back
 * @property string $start
 * @property string $stop
 * @property integer $adult
 * @property integer $child
 * @property integer $infant
 * @property string $price
 *
 * @property Airports $from0
 * @property Airports $to0
 */
class Flights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to', 'back', 'adult', 'child', 'infant'], 'integer'],
            [['start', 'stop'], 'safe'],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'back' => 'Back',
            'start' => 'Start',
            'stop' => 'Stop',
            'adult' => 'Adult',
            'child' => 'Child',
            'infant' => 'Infant',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(Airports::className(), ['id' => 'from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(Airports::className(), ['id' => 'to']);
    }


}