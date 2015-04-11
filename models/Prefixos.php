<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prefixos".
 *
 * @property integer $id
 * @property string $nome_operadora
 * @property string $tipo
 * @property string $nr1
 * @property string $ddd
 * @property string $prefixo
 * @property string $mdcu_inicial
 * @property string $mdcu_final
 * @property string $eot
 * @property string $uf
 * @property string $cnl
 * @property string $created_at
 */
class Prefixos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefixos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['operadora', 'tipo', 'nr1', 'ddd', 'prefixo', 'mdcu_inicial', 'mdcu_final', 'eot', 'uf', 'cnl'], 'string', 'max' => 100]
        ];
    }

    public function getOperadoras()
    {
        return $this->hasMany(Operadoras::className(), ['rn1' => 'rn1']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'operadora' => Yii::t('app', 'Nome Operadora'),
            'tipo' => Yii::t('app', 'Tipo'),
            'nr1' => Yii::t('app', 'Nr1'),
            'ddd' => Yii::t('app', 'Ddd'),
            'prefixo' => Yii::t('app', 'Prefixo'),
            'mdcu_inicial' => Yii::t('app', 'Mdcu Inicial'),
            'mdcu_final' => Yii::t('app', 'Mdcu Final'),
            'eot' => Yii::t('app', 'Eot'),
            'uf' => Yii::t('app', 'Uf'),
            'cnl' => Yii::t('app', 'Cnl'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
