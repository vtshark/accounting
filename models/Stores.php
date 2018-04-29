<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $store_type_id
 *
 * @property StoreTypes $type
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['store_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreTypes::className(), 'targetAttribute' => ['store_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    public static function getAll() {
        return self::find()->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(StoreTypes::className(), ['id' => 'store_type_id']);
    }

    /**
     * @param array $conditions
     * @return array|bool
     */
    public static function getStores(array $conditions) {
        return self::find()->where($conditions)->asArray()->indexBy('id')->all();
    }

}
