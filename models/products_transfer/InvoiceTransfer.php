<?php

namespace app\models\products_transfer;
use app\models\Stores;
use app\models\Users;
use Yii;

/**
 * This is the model class for table "invoice_transfer".
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $description
 * @property integer $created_at
 * @property integer $user_id
 * @property integer $is_closed
 *
 * @property Stores $store
 * @property Users $user
 */
class InvoiceTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_transfer';
    }

    public function behaviors(){
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'created_at', 'user_id', 'is_closed'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'description' => 'Description',
            'created_at' => 'Create At',
            'user_id' => 'User ID',
            'is_closed' => 'Is Closed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
