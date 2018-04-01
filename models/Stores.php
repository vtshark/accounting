<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
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
     * @param array $params
     * @return array|bool
     */
    public static function getStores(array $params) {
        return self::find()->where($params)->asArray()->indexBy('id')->all();
    }

}
