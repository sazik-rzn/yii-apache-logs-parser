<?php

class SiteController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return CMap::mergeArray(parent::filters(), array(
                    'accessControl', // perform access control for CRUD operations
        ));
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        if (isset($_GET['json']) && !in_array($_GET['json'], [false, 'false', 0]) && Yii::app()->user->isGuest) {
            $login = new UserLogin;
            if (isset($_GET['login']) && isset($_GET['password'])) {
                $login->username = $_GET['login'];
                $login->password = $_GET['password'];
            }
            if (!$login->validate()) {
                echo json_encode([
                    'error' => 'Please set valid GET params: login, password'
                        ], JSON_PRETTY_PRINT);
                die;
            }
        }
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'index', 'view', 'delete'),
                'users' => UserModule::getAdmins(),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $json = false) {
        $model = $this->loadModel($id);
        if ($json) {
            echo json_encode($model->attributes, JSON_PRETTY_PRINT);
        } else {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id, $json = false) {
        $result = $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']) && !$json)
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        if ($json) {
            echo json_encode([
                'id' => $id,
                'deleted' => $result
                    ], JSON_PRETTY_PRINT);
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        return $this->redirect(['admin']);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($json = false) {
        $model = new Log('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Log']))
            $model->attributes = $_GET['Log'];
        if ($json) {
            $result = [];
            $dataProvider = $model->search();
            foreach ($dataProvider->getData() as $model) {
                $result[$model->id] = $model->attributes;
            }
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $this->render('admin', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Log::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'log-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
