<?php

class VehicleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Vehicle;

        $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
        $customerDataProvider = $customer->search();
        
        if (isset($_POST['Vehicle'])) {
            $model->attributes = $_POST['Vehicle'];
            
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
        $customerDataProvider = $customer->search();
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Vehicle'])) {
            $model->attributes = $_POST['Vehicle'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
        ));
    }

    public function actionUpdateLocation($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Vehicle'])) {
            $model->attributes = $_POST['Vehicle'];
            
            if ($model->status_location == 'Masuk Bengkel') {
                $model->entry_datetime = date('Y-m-d H:i:s');
            } elseif ($model->status_location == 'Mulai Service') {
                $model->start_service_datetime = date('Y-m-d H:i:s');
            } elseif ($model->status_location == 'Selesai Service') {
                $model->finish_service_datetime = date('Y-m-d H:i:s');
            } elseif ($model->status_location == 'Keluar Bengkel') {
                $model->exit_datetime = date('Y-m-d H:i:s');
            } else {
                $model->entry_datetime = null;
                $model->start_service_datetime = null;
                $model->finish_service_datetime = null;
                $model->exit_datetime = null;
            }
            
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('updateLocation', array(
            'model' => $model,
        ));
    }

    public function actionAddRecommendation($id) {
        $model = $this->loadModel($id);

        $initialCondition = isset($_GET['InitialCondition']) ? $_GET['InitialCondition'] : '';
        $initialRecommendation = isset($_GET['InitialRecommendation']) ? $_GET['InitialRecommendation'] : '';
        $note = isset($_GET['Note']) ? $_GET['Note'] : '';

        if (isset($_POST['Submit'])) {

            $conditionRecommendation = new VehicleConditionRecommendation();
            $conditionRecommendation->vehicle_id = $id;
            $conditionRecommendation->initial_condition = $initialCondition;
            $conditionRecommendation->initial_recommendation = $initialRecommendation;
            $conditionRecommendation->final_condition = null;
            $conditionRecommendation->final_recommendation = null;
            $conditionRecommendation->note = $_POST['Note'];
            $conditionRecommendation->initial_date = date('Y-m-d');
            $conditionRecommendation->initial_time = date('H:i:s');
            $conditionRecommendation->user_id = Yii::app()->user->id;
            $conditionRecommendation->save();
            
            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('addRecommendation', array(
            'model' => $model,
            'initialCondition' => $initialCondition,
            'initialRecommendation' => $initialRecommendation,
            'note' => $note,
        ));
    }

    public function actionUpdateRecommendation($id) {
        $conditionRecommendation = VehicleConditionRecommendation::model()->findByPk($id);
        $model = $this->loadModel($conditionRecommendation->vehicle_id);

        $finalCondition = isset($_GET['FinalCondition']) ? $_GET['FinalCondition'] : '';
        $finalRecommendation = isset($_GET['FinalRecommendation']) ? $_GET['FinalRecommendation'] : '';
        $note = isset($_GET['Note']) ? $_GET['Note'] : '';

        if (isset($_POST['Submit'])) {

            $conditionRecommendation->final_condition = $_POST['FinalCondition'];
            $conditionRecommendation->final_recommendation = $_POST['FinalRecommendation'];
            $conditionRecommendation->note = $_POST['Note'];
            $conditionRecommendation->final_date = date('Y-m-d');
            $conditionRecommendation->final_time = date('H:i:s');
            $conditionRecommendation->save();
            
            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('updateRecommendation', array(
            'model' => $model,
            'conditionRecommendation' => $conditionRecommendation,
            'finalCondition' => $finalCondition,
            'finalRecommendation' => $finalRecommendation,
            'note' => $note,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Vehicle');
        
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Vehicle('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Vehicle'])) {
            $model->attributes = $_GET['Vehicle'];
        }

        $modelDataProvider = $model->search();
        
        $this->render('admin', array(
            'vehicle' => $model,
            'vehicleDataProvider' => $modelDataProvider,
        ));
    }

    public function actionAjaxHtmlUpdateVehicleDataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $model = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
            $modelDataProvider = $model->search();
            $modelDataProvider->pagination->pageSize = 50;

            $this->renderPartial('_vehicleDataTable', array(
                'vehicleDataProvider' => $modelDataProvider,
            ));
        }
    }
    
    public function actionAjaxJsonCustomer($id) {

        if (Yii::app()->request->isAjaxRequest) {
            $customer = Customer::model()->findByPk($id);

            $object = array(
                'customer_name' => $customer->name,
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlUpdateCustomerPicSelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);

            $this->renderPartial('_customerPicSelect', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Vehicle the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Vehicle::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Vehicle $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vehicle-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
