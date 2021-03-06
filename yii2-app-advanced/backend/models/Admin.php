<?php

namespace backend\models;

use flyok666\qiniu\Qiniu;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $token
 * @property integer $create_at
 * @property integer $update_at
 * @property string $login_ip
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $rememberMe;
    public $role;
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','img', 'email'], 'required'],
            [['create_at', 'update_at'], 'integer'],
            [['username', 'password', 'email', 'token', 'login_ip'], 'string', 'max' => 255],
            [['salt'], 'string', 'max' => 6],
            [['email'],'email'],
            [['rememberMe'],'safe'],
            [['role','img'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户账号',
            'password' => '用户密码',
            'salt' => '盐',
            'email' => '用户邮箱',
            'token' => '自动登录',
            'create_at' => '注册时间',
            'update_at' => '最后登录时间',
            'login_ip' => '最后登录地点',
            'rememberMe'=>'自动登录',
            'role'=>"添加权限",
            'img'=>'用户头像'
        ];
    }
    public function getImages(){
        if(substr($this->logo,0,7)=="http://"){
            return $this->logo;
        }else{
            return "@web/".$this->logo;
        }
    }
    public function getDel($img,$key){
        $qiniu=new Qiniu(
            $config = [
                'accessKey'=>'3QPn6N0S6AZeETy9Pn0gohcabRm7Mkasyf-uc7Yd',
                'secretKey'=>'J68RwhjP6rufO7Wik33GnPVyAtFzsyLLa7x7Vvhx',
                'domain'=>'http://oyw02vzfa.bkt.clouddn.com',
                'bucket'=>$key,
                'area'=>Qiniu::AREA_HUANAN
            ]
        );
        $image=substr($img,-10);
//        exit($img);
        return $qiniu->delete($image,$key);
    }
    //注入系统内置时间行为
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    # AR类名::EVENT_BEFORE_UPDATE(修改时自动更新时间)=>['要更新的字段']
                    self::EVENT_BEFORE_INSERT=>['created_at'],

                ],
            ]
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
       return $this->token;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->token===$authKey;
    }
}
