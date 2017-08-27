<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice_procurement".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $description
 * @property integer $created_at
 * @property integer $user_id
 * @property integer $is_closed
 *
 * @property Branches $branch
 * @property Users $user
 */
class InvoiceProcurement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_procurement';
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
            [['branch_id', 'created_at', 'user_id', 'is_closed'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'branch_id' => 'Филиал',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
            'user_id' => 'Пользователь',
            'is_closed' => 'Закрыта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branches::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
