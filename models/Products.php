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
 * @property integer $category_id
 * @property integer $price_sell
 * @property integer $price_procur
 * @property string $art
 * @property double $weight
 * @property integer $probe
 *
 * @property ProdNames $prodName
 * @property Suppliers $supplier
 * @property Manufacturers $manufacturer
 * @property Branches $branch
 */
class Products extends \yii\db\ActiveRecord
{
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
            [['name_id', 'supplier_id', 'manufacturer_id', 'branch_id', 'category_id', 'price_sell', 'invoice_procur_id', 'probe'], 'integer'],
            [['weight', 'price_procur'], 'number'],
            [['art'], 'string', 'max' => 255],
            [['name_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdNames::className(), 'targetAttribute' => ['name_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturers::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProdCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['probe'], 'exist', 'skipOnError' => true, 'targetClass' => Probe::className(), 'targetAttribute' => ['probe' => 'id']],
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
            'art' => 'Art',
            'category_id' => 'Category ID',
            'weight' => 'Weight',
            'price_sell' => 'Price Sell',
            'price_procur' => 'Price Procur',
            'invoice_procur_id' => 'Invoice Procur ID',
            'probe' => 'Probe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdName()
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

    public function getCategory()
    {
        return $this->hasOne(ProdCategory::className(), ['id' => 'category_id']);
    }
}
