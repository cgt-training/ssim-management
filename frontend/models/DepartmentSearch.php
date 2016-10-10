<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Department;
use frontend\models\Company;
use frontend\models\Branch;

/**
 * CompanySearch represents the model behind the search form about `frontend\models\Company`.
 */
class DepartmentSearch extends Department
{
    public $company_name;
    public $branch_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id','branch_fk_id','company_fk_id'], 'integer'],
            [['department_name', 'department_created', 'department_status','company_name','branch_name'], 'safe'],
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
        $query = Department::find()->joinWith('company')->joinWith('branch');
        //company is name of relation b/w department and company table define in department model
        //branch is name of relation b/w department and branch table define in department model

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

        // filter to sort company name on attribute company_name in index in department view
        $dataProvider->sort->attributes['company_name'] = [  // attribute name on index view
            'asc' => ['company.company_name' => SORT_ASC],
            'desc' => ['company.company_name' => SORT_DESC],
        ];

        // filter to sort branch name on attribute branch_name in index in department view
        $dataProvider->sort->attributes['branch_name'] = [  // attribute name on index view
            'asc' => ['branch.branch_name' => SORT_ASC],  //branch->tablename   branch_name->columnname
            'desc' => ['branch.branch_name' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'branch_fk_id' => $this->branch_fk_id,
            'company_fk_id' => $this->company_fk_id,
            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'department_name', $this->department_name])
            ->andFilterWhere(['like', 'department_created', $this->department_created])
            ->andFilterWhere(['like', 'company.company_name', $this->company_name])
            ->andFilterWhere(['like', 'branch.branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'department_status', $this->department_status]);

        return $dataProvider;
    }
}
