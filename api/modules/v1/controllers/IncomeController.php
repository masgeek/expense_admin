<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 23-Aug-17
 * Time: 15:14
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\LOGIN_MODEL;
use app\models_extended\INCOME_MODEL;
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
use app\models_extended\EXPENSE_MODEL;

class IncomeController extends ActiveController
{
	public $modelClass = 'app\api\modules\v1\models\INCOME_MODEL';

	public function actionAdd()
	{
		$message = [];

		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}
		$request = (object)Yii::$app->request->post();


		$expense = new INCOME_MODEL();
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
		$query = INCOME_MODEL::find();

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

	public function actionGraph()
	{
		$points = [];
		$expenses = \app\api\modules\v1\models\INCOME_MODEL::find()
			->orderBy(['date' => SORT_ASC])
			->all();
		$i = 0;
		foreach ($expenses as $key => $value) {
			$points[] = [
				'point' => $i,
				'value' => (int)$value->amount,
				'date'=>$value->date
			];

			$i++;
		}
		return $points;
	}
}