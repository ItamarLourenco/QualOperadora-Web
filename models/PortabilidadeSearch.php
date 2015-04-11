<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Portabilidade;

/**
 * PortabilidadeSearch represents the model behind the search form about `app\models\Portabilidade`.
 */
class PortabilidadeSearch extends Portabilidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['phone', 'rn1', 'date', 'operations', 'cnl', 'eot', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Portabilidade::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'rn1', $this->rn1])
            ->andFilterWhere(['like', 'operations', $this->operations])
            ->andFilterWhere(['like', 'cnl', $this->cnl])
            ->andFilterWhere(['like', 'eot', $this->eot]);

        return $dataProvider;
    }
}
