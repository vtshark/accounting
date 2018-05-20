<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property Stores[] $stores
 */
class StoreTypes extends \yii\db\ActiveRecord
{
    CONST TMP_TYPE_ID = 1;
    CONST DEFAULT_TYPE_ID = 2;
    CONST STORE_TYPE_ID = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Stores::className(), ['store_type_id' => 'id']);
    }
    public static function getTypes(array $conditions) {
        return self::find()->where($conditions)->asArray()->indexBy('id')->all();
    }
}
