<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 *
 * @property InvoiceProcurement[] $invoiceProcurements
 * @property InvoiceSales[] $invoiceSales
 * @property InvoiceTransfer[] $invoiceTransfers
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProcurements()
    {
        return $this->hasMany(InvoiceProcurement::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceSales()
    {
        return $this->hasMany(InvoiceSales::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceTransfers()
    {
        return $this->hasMany(InvoiceTransfer::className(), ['user_id' => 'id']);
    }
}
