<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loggers".
 *
 * @property integer $id
 * @property string $phone
 * @property string $found
 * @property string $created_at
 */
class Loggers extends \yii\db\ActiveRecord
{

    const FOUND_YES = "yes";
    const FOUND_NO = "no";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loggers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['found'], 'string'],
            [['created_at'], 'safe'],
            [['phone'], 'string', 'max' => 100],
            [['operadora'], 'string', 'max' => 100],
            [['json'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'found' => Yii::t('app', 'Found'),
            'operadora' => Yii::t('app', 'Operadora'),
            'json' => Yii::t('app', 'Json'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
