<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operadoras".
 *
 * @property integer $id
 * @property string $operadora
 * @property string $spid
 * @property string $rn1
 * @property string $created_at
 */
class Operadoras extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operadoras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operadora'], 'required'],
            [['created_at'], 'safe'],
            [['operadora', 'spid', 'rn1'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'operadora' => Yii::t('app', 'Operadora'),
            'spid' => Yii::t('app', 'Spid'),
            'rn1' => Yii::t('app', 'Rn1'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
