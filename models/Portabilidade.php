<?php

namespace app\models;

use Yii;
use yii\base\Exception;


/**
 * This is the model class for table "portabilidade".
 *
 * @property string $id
 * @property string $phone
 * @property string $rn1
 * @property string $date
 * @property string $operations
 * @property string $cnl
 * @property string $eot
 * @property string $created_at
 */
class Portabilidade extends \yii\db\ActiveRecord
{

    const security = "#@qu4l0pe4d0r4@#";
    private $telefone = array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portabilidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'created_at'], 'safe'],
            [['phone'], 'string', 'max' => 30],
            [['rn1', 'operations', 'cnl', 'eot'], 'string', 'max' => 100]
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
            'phone' => Yii::t('app', 'Phone'),
            'rn1' => Yii::t('app', 'Rn1'),
            'date' => Yii::t('app', 'Date'),
            'operations' => Yii::t('app', 'Operations'),
            'cnl' => Yii::t('app', 'Cnl'),
            'eot' => Yii::t('app', 'Eot'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getPortabilidade(){
        $dataJson['status'] = false;
        $dataJson['message'] = "notFound";
        $dataJson['data'] = array();

        if( is_array($this->getTelefone()) && sizeof($this->getTelefone()) > 0 )
        {
            $telefonesPortabilidade = array_fill_keys($this->getTelefone(), true); //Setando todos o numeros como nao portado

            $portabilidade = $this->getPortabilidadeByTelefones();

            $dataJson  = array();

            if(!is_null($portabilidade))
            {
                $dataJson['status'] = true;
                $dataJson['message'] = "found";
                $dataJson['data'] = array();

                foreach($portabilidade As $item)
                {
                    $telefonesPortabilidade[$item->phone] = false;
                    $dataJson['data'][] = [
                        'phone' => $item->phone,
                        'portabilidade' => true,
                        'encontrado' => true,
                        'date' => date('d/m/Y H:i:s', strtotime($item->date)),
                        'rn1' => $item->rn1,
                        'operadora_anterior' => $this->getRn1Anterior($item->phone),
                        'operadora' => str_replace("'", null, $item->operadoras[0]->operadora)
                    ];
                    $this->saveLogger((string) $item->phone, Loggers::FOUND_YES);
                }


                $telefonesNaoPortados = array_keys(array_filter($telefonesPortabilidade));
                $telefonesNaoEncontrados = array_filter($telefonesPortabilidade);
                if(sizeof($telefonesNaoPortados) > 0)
                {

                    $telefonesNaoPortadosComDDD = array();
                    foreach($telefonesNaoPortados As $i => $item)
                    {
                        $ddd = substr($item, 0, 2);
                        $telefonesNaoPortadosComDDD[$i]['ddd'] = $ddd;
                        $prefixos = $this->getPrefixo($item);
                        $telefonesNaoPortadosComDDD[$i]['prefixo'] = $prefixos;
                    }


                    $prefixos = $this->getNaoPortados($telefonesNaoPortadosComDDD);

                    foreach($prefixos->all() as $i => $item)
                    {
                        $telefonesNaoEncontrados[$telefonesNaoPortados[$i]] = false;
                        $dataJson['data'][] = [
                            'phone' => (string) $telefonesNaoPortados[$i],
                            'portabilidade' => false,
                            'encontrado' => true,
                            'uf' => $item->uf,
                            'ddd' => $item->ddd,
                            'rn1' => $item->rn1,
                            'prefixo' => $item->prefixo,
                            'operadora' => str_replace("'", null, $item->operadora)
                        ];
                        $this->saveLogger((string) $telefonesNaoPortados[$i], Loggers::FOUND_YES);
                    }

                    $telefonesNaoEncontrados = array_filter($telefonesNaoEncontrados);
                    foreach($telefonesNaoEncontrados As $phone => $item)
                    {
                        $dataJson['data'][] = [
                            'phone' => (string) $phone,
                            'portabilidade' => false,
                            'encontrado' => false,
                        ];
                        $this->saveLogger((string) $telefonesNaoPortados[$i], Loggers::FOUND_NO);
                    }

                }
            }
        }
        else
        {
            $dataJson['message'] = "notFound";
        }

        return $dataJson;
    }

    private function getPortabilidadeByTelefones()
    {
        return Portabilidade::find()
            ->select(['portabilidade.id', 'portabilidade.phone', 'portabilidade.date', 'portabilidade.rn1', 'operadoras.operadora'])
            ->innerJoinWith('operadoras', ['rn1' => 'rn1'])
            ->where(['phone' => $this->getTelefone()])
            ->all();
    }

    private function getPrefixo($item)
    {
        $item = substr($item, 2);
        $phone = substr($item, -8);
        $phone = substr($phone, 0, 4);

        if(substr($item, -9, 1) == '9')
        {
            return '9'.$phone;
        }
        else
        {
            return $phone;
        }
    }

    private function getNaoPortados($telefonesNaoPortadosComDDD)
    {
        $prefixos = Prefixos::find()->select(['prefixos.id', 'prefixos.operadora', 'prefixos.rn1', 'prefixos.ddd', 'prefixos.uf', 'prefixos.prefixo']);
        foreach($telefonesNaoPortadosComDDD As $item)
        {
            $prefixos->orWhere(['ddd' => $item['ddd'], 'prefixo' => $item['prefixo']]);
        }
        $prefixos->groupBy('prefixo');

        return $prefixos;
    }

    public static function isSecury($json)
    {
        if(isset($json['token_id']) && isset($json['token_cryp']))
        {
            if($json['token_cryp'] === md5(Portabilidade::security.$json['token_id']))
            {
                return true;
            }
            else
            {
                throw new Exception('Erro autenticacao incorreta!');
            }
        }
        else
        {
            throw new Exception('Parametros inxistente');
        }
    }

    private function getRn1Anterior($telefone = null)
    {
        $ddd = substr($telefone, 0, 2);
        $prefixo = $this->getPrefixo($telefone, $ddd);

        $prefixos = Prefixos::find()->select(['prefixos.id', 'prefixos.operadora', 'prefixos.rn1', 'prefixos.ddd', 'prefixos.uf', 'prefixos.prefixo'])
            ->where(['ddd' => $ddd, 'prefixo' => $prefixo])->one();

        if($prefixos != null){
            return str_replace("'", null, $prefixos->operadora);
        }
        return null;

    }

    private function addNonoDigito($ddd)
    {
        $ddd = (string)$ddd;
        $dddNaoAceitaNono = "31, 32, 33, 34, 35, 37, 38, 71, 73, 74, 75, 77, 79, 81, 82, 83, 84, 85, 86, 87, 88, 89, 41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61,62, 63, 64, 65, 66, 67, 68, 69";
        if (strpos($dddNaoAceitaNono, $ddd) == "") {
            return true;
        } else {
            return false;
        }
    }

    private function saveLogger($phone, $saved = "no")
    {
        $logger = new Loggers();
        $logger->phone = $phone;
        $logger->found = $saved;

        return $logger->save();
    }
}
