<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

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

class UserController extends ActiveController
{
    /**
     * @var object
     */
    public $modelClass = 'app\api\modules\v1\models\LOGIN_MODEL';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update']);
        return $actions;
    }

    public function actionLogin()
    {
        /* @var $request LOGIN_MODEL */
        $message = [];
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $request = (object)Yii::$app->request->post();

        $name = $request->name;
        $pin = $request->pin;
        $user = LOGIN_MODEL::findOne(['name' => $name, 'pin' => $pin]);
        if ($user != null) {
            $message = $user;
        } else {
            $message = [
                'status' => false,
                'message' => 'Invalid Username/Password'
            ];
        }

        return $message;
    }

    public function actionRegister()
    {
        /* @var $request LOGIN_MODEL */
        $message = [];

        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $request = (object)Yii::$app->request->post();


        $user = new LOGIN_MODEL();
        //$user->setScenario(USER_MODEL::SCENARIO_CREATE);
        //assign the post data values
        $user->name = isset($request->name) ? $request->pin : null;
        $user->pin = isset($request->name) ? $request->name : null;

        if ($user->validate()) {
            if ($user->save()) {
                $message = [$user];
            }
        } else {
            $errors = $user->getErrors();
            foreach ($errors as $key => $error) {
                $message[] = [
                    'field' => $key,
                    'message' => $error[0]
                ];
            }
        }
        return $message;
    }

    public function actionUpdate($id)
    {
        /* @var $request LOGIN_MODEL */
        $message = [];

        if (!Yii::$app->request->isPut) {
            throw new BadRequestHttpException('Please use PUT');
        }

        $user = LOGIN_MODEL::findOne($id);
        if ($user == null) {
            throw new NotFoundHttpException('User not found', 5);
        }


        //$user->setScenario(USER_MODEL::SCENARIO_UPDATE);
        $request = (object)Yii::$app->request->bodyParams;
        $user->name = isset($request->name) ? $request->pin : null;
        $user->pin = isset($request->name) ? $request->name : null;

        if ($user->validate() && $user->save()) {
            $message = $user;
        } else {
            $errors = $user->getErrors();
            foreach ($errors as $key => $error) {
                $message[] = [
                    'field' => $key,
                    'message' => $error[0]
                ];
            }
        }

        return $message;
    }
}