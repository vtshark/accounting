<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice_sales".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $description
 * @property integer $create_at
 * @property integer $user_id
 * @property integer $is_closed
 *
 * @property Branches $branch
 * @property Users $user
 */
class InvoiceSales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'create_at', 'user_id', 'is_closed'], 'integer'],
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
            'id' => 'ID',
            'branch_id' => 'Branch ID',
            'description' => 'Description',
            'create_at' => 'Create At',
            'user_id' => 'User ID',
            'is_closed' => 'Is Closed',
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
