<?php

namespace app\controllers;

use app\models\Profile;
use app\models\User;
use Yii;
use app\models\TaskTracker;
use app\models\TaskTrackerSearch;
use app\controllers\BehaviorsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskTrackerController implements the CRUD actions for TaskTracker model.
 */
class TaskTrackerController extends BehaviorsController
{

    /**
     * Lists all TaskTracker models.
     * @return mixed
     */
    public function actionIndex()
    {
        $administrators = "";
        $admins = User::find()->where(["role" => "20"])->all();

        foreach ($admins as $admin) {
            $administrators[] = Profile::findOne(["user_id" => $admin->id]);
        }
        $searchModel = new TaskTrackerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'admins' => $administrators,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskTracker model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $administrators = "";
        $admins = User::find()->where(["role" => "20"])->all();

        foreach ($admins as $admin) {
            $administrators[] = Profile::findOne(["user_id" => $admin->id]);
        }

        return $this->render('view', [
            'admins' => $administrators,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaskTracker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskTracker();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaskTracker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaskTracker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaskTracker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskTracker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskTracker::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
