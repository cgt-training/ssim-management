<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\Query;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $create_company;
    public $update_company;
    public $delete_company;
    public $create_branch;
    public $update_branch;
    public $delete_branch;
    public $create_department;
    public $update_department;
    public $delete_department;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['firstname', 'trim'],
            ['firstname','required'],
            ['lastname','trim'],
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['create_company','update_company','delete_company','create_branch','update_branch','delete_branch','create_department','update_department','delete_department'],'safe'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($user->save()!='')
        {
            if($this->create_company=='create_company')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->create_company,'user_id' => $user->id,])->execute();
            }
           if($this->update_company=='update_company')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->update_company,'user_id' => $user->id,])->execute();
            }
            if($this->delete_company=='delete_company')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->delete_company,'user_id' => $user->id,])->execute();
            }


            if($this->create_branch=='create_branch')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->create_branch,'user_id' => $user->id,])->execute();
            }
           if($this->update_branch=='update_branch')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->update_branch,'user_id' => $user->id,])->execute();
            }
            if($this->delete_branch=='delete_branch')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->delete_branch,'user_id' => $user->id,])->execute();
            }

            if($this->create_department=='create_department')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->create_department,'user_id' => $user->id,])->execute();
            }
           if($this->update_department=='update_department')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->update_department,'user_id' => $user->id,])->execute();
            }
            if($this->delete_department=='delete_department')
            {
                 Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => $this->delete_department,'user_id' => $user->id,])->execute();
            }

            // $sql = "INSERT INTO auth_assignment ('item_name','user_id') VALUES('".$this->create_company."','".$user->id."')";
            // $sql->execute();
            return $user;
        }
        else
        {
            return null;
        }
    }
}
