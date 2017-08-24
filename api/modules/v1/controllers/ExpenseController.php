<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 23-Aug-17
 * Time: 15:14
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\EXPENSE_MODEL;
use app\api\modules\v1\models\INCOME_MODEL;
use app\api\modules\v1\models\LOGIN_MODEL;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ExpenseController extends ActiveController
{
	public $modelClass = 'app\api\modules\v1\models\EXPENSE_MODEL';

	public function actionAdd()
	{
		/* @var $request LOGIN_MODEL */
		$message = [];

		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}
		$request = (object)Yii::$app->request->post();


		$expense = new EXPENSE_MODEL();
		//$user->setScenario(USER_MODEL::SCENARIO_CREATE);
		//assign the post data values
		$expense->type = isset($request->type) ? $request->type : null;
		$expense->amount = isset($request->amount) ? $request->amount : null;
		$expense->place = isset($request->place) ? $request->place : null;
		$expense->note = isset($request->note) ? $request->note : null;
		$expense->date = isset($request->date) ? $request->date : null;
		$expense->cheque = isset($request->cheque) ? $request->cheque : null;

		if ($expense->validate()) {
			if ($expense->save()) {
				$message = [$expense];
			}
		} else {
			$errors = $expense->getErrors();
			foreach ($errors as $key => $error) {
				$message[] = [
					'field' => $key,
					'message' => $error[0]
				];
			}
		}
		return $message;
	}

	public function actionCategory()
	{
		$query = EXPENSE_MODEL::find();

		// The problem is in the below sum
		// $query->joinWith('inventory');
		$query->select(['type', 'amount']);
		$query->groupBy('type');
		$query->sum('amount');
		$query->all();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		return $dataProvider;
	}

	public function actionAll()
	{
		$expenses = EXPENSE_MODEL::find()->sum('amount');
		$income = INCOME_MODEL::find()->sum('amount');

		$difference = ((float)$income) - ((float)$expenses);

		$msg = [
			'total_income'=>$income,
			'total_expenses'=>$expenses,
			'difference'=>(string)$difference,
		];
		return $msg;
	}

}