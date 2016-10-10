<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Company;
use yii\db\Query;
/**
 * CompanySearch represents the model behind the search form about `frontend\models\Company`.
 */
class BranchSearch extends Branch
{
     public $company_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id','company_fk_id'], 'integer'],
            [['branch_name', 'branch_created', 'branch_status','company_name'], 'safe'],
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
        $query = Branch::find()->joinWith('companyFk');//companyFk relation define in branch controller b/w branch and company

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

        //Sorting of company name is done by this attribute
        $dataProvider->sort->attributes['company_name'] = [
            'asc' => ['company.company_name' => SORT_ASC],//company->tablename   company_name->columnname
            'desc' => ['company.company_name' => SORT_DESC],
        ];

         
        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
        ]);

        $query->andFilterWhere(['like', 'branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'branch_status', $this->branch_status])
            ->andFilterWhere(['like', 'branch_created', $this->branch_created])
            ->andFilterWhere(['like','company.company_name',$this->company_name]);

        return $dataProvider;
    }
}
