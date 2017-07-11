<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\modules\rbac\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends RbacValidationController
{
    private $data;

    public function behaviors()
    {
        $this->setRole(get_class(), Yii::$app->user->id);
        $additionalBehavior = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ]
        ];
        $this->setAdditional($additionalBehavior);

        return parent::behaviors();
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'permissions' => $this->getPermissions()['actions']
        ]);
    }


    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';
        $this->data = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->assingPermissions($this->data, $model->id);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'permissions' => $this->getAvailablePermissionsByJSON(),
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->data = Yii::$app->request->post();
        if ($model->load($this->data) && $model->save()) {
            $this->removePermissions($this->data, $id);
            $this->assingPermissions($this->data, $id);

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            $permissionsByUser = $this->getPermissionsByUser($id);

            return $this->render('update', [
                'model' => $model,
                'permissions' => $this->getAvailablePermissionsByJSON(),
                'permissionsByUser' => $permissionsByUser,
            ]);
        }
    }

    public function actionActive($id) {
        $model = $this->findModel($id);
        if ($model->status) {
            $model->status = 0;
            $model->save();
        } else {
            $model->status = 10;
            $model->save();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChangePassword()
    {
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);
        $this->data = Yii::$app->request->post();
        $newPass = new \common\models\changePasswordForm;
        if ($newPass->load(Yii::$app->request->post()) && $newPass->changePassword($model)) {
            $model->password_hash = Yii::$app
                    ->security
                    ->generatePasswordHash($newPass->password);
            $model->save();
            Yii::$app->session->setFlash('success', 'Tu contraseña fue cambiada');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->render('changePassword', [
                'model' => $model,
                'newPass' => $newPass
            ]);
        }
    }
}
