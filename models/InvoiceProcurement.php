<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice_procurement".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property string $description
 * @property integer $created_at
 * @property integer $user_id
 * @property integer $is_closed
 *
 * @property Suppliers $supplier
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
            [['supplier_id', 'user_id'], 'required'],
            [['supplier_id', 'created_at', 'user_id', 'is_closed'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'id']],
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
            'supplier_id' => 'Поставщик',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
            'user_id' => 'Пользователь',
            'is_closed' => 'Закрыта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Suppliers::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getProducts() {
        return $this->hasMany(Products::className(), ['invoice_procur_id' => 'id']);
    }

    public function deleteTmpProducts() {
        //$products = $this->hasMany(ProductsTmp::className(), ['invoice_procur_id' => 'id']);
        ProductsTmp::deleteAll(['invoice_procur_id' => $this->id]);
    }
}
