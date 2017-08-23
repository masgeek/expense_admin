<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income".
 *
 * @property int $id
 * @property string $type
 * @property int $amount
 * @property string $place
 * @property string $note
 * @property int $cheque
 * @property string $date
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'place', 'note', 'date'], 'string'],
            [['amount', 'cheque'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'amount' => 'Amount',
            'place' => 'Place',
            'note' => 'Note',
            'cheque' => 'Cheque',
            'date' => 'Date',
        ];
    }
}
