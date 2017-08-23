<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 23-Aug-17
 * Time: 15:14
 */

namespace app\api\modules\v1\controllers;


use yii\rest\ActiveController;

class ExpenseController extends ActiveController
{
    public $modelClass = 'app\api\modules\v1\models\EXPENSE_MODEL';
}