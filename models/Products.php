<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $name_id
 * @property integer $supplier_id
 * @property integer $manufacturer_id
 * @property integer $branch_id
 * @property integer $size_id
 * @property integer $price
 *
 * @property ProdNames $name
 * @property Suppliers $supplier
 * @property Manufacturers $manufacturer
 * @property Branches $branch
 * @property Sizes $size
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_id', 'supplier_id', 'manufacturer_id', 'branch_id', 'size_id', 'price'], 'integer'],
            [['name_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdNames::className(), 'targetAttribute' => ['name_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturers::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['size_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sizes::className(), 'targetAttribute' => ['size_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_id' => 'Name ID',
            'supplier_id' => 'Supplier ID',
            'manufacturer_id' => 'Manufacturer ID',
            'branch_id' => 'Branch ID',
            'size_id' => 'Size ID',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName()
    {
        return $this->hasOne(ProdNames::className(), ['id' => 'name_id']);
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
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturers::className(), ['id' => 'manufacturer_id']);
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
    public function getSize()
    {
        return $this->hasOne(Sizes::className(), ['id' => 'size_id']);
    }
}
