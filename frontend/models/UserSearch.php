<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Users;

/**
 * UserSearch represents the model behind the search form about `frontend\models\Users`.
 */
class UserSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['user_firstname', 'user_lastname', 'user_email', 'user_password', 'user_status', 'user_created_on', 'user_updated_on'], 'safe'],
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
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'user_created_on' => $this->user_created_on,
            'user_updated_on' => $this->user_updated_on,
        ]);

        $query->andFilterWhere(['like', 'user_firstname', $this->user_firstname])
            ->andFilterWhere(['like', 'user_lastname', $this->user_lastname])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'user_password', $this->user_password])
            ->andFilterWhere(['like', 'user_status', $this->user_status]);

        return $dataProvider;
    }
}
