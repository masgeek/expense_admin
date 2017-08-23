<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login".
 *
 * @property string $name
 * @property int $pin
 * @property int $id
 */
class Login extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['pin'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'pin' => 'Pin',
            'id' => 'ID',
        ];
    }
}
