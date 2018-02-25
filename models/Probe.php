<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "probe".
 *
 * @property integer $id
 */
class Probe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'probe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Проба',
        ];
    }

    public static function getAll() {
        return self::find()->asArray()->all();
    }

}
