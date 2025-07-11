<?php

class CustomerController extends Controller {

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
        $model = new Customer;
        $model->user_id = Yii::app()->user->id;
        $model->date_created = date('Y-m-d H:i:s');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            
            if ($model->customer_type == 'Individual') {
                $model->coa_id = 1449;
            } else {
                if ($model->isNewRecord) {
                    $existingCoa = Coa::model()->findByAttributes(array('coa_sub_category_id' => 8, 'coa_id' => null), array('order' => 'id DESC'));
                    $ordinal = substr($existingCoa->code, -3);
                    $newOrdinal = $ordinal + 1;

                    $coa = new Coa;
                    $coa->name = 'Piutang ' . $model->name;
                    $coa->code = '121.00.' . sprintf('%03d', $newOrdinal);
                    $coa->coa_category_id = 1;
                    $coa->coa_sub_category_id = 8;
                    $coa->coa_id = null;
                    $coa->normal_balance = 'DEBIT';
                    $coa->cash_transaction = 'NO';
                    $coa->opening_balance = 0.00;
                    $coa->closing_balance = 0.00;
                    $coa->debit = 0.00;
                    $coa->credit = 0.00;
                    $coa->status = null;
                    $coa->date = date('Y-m-d');
                    $coa->date_approval = date('Y-m-d');
                    $coa->is_approved = 1;
                    $coa->user_id = Yii::app()->user->id;
                    $coa->save();
                    $this->saveMasterLog($coa);

                    $model->coa_id = $coa->id;
                }
            }

            if ($model->save()) {
                $this->saveMasterLog($model);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if ($model->save()) {
                $this->saveMasterLog($model);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function saveMasterLog($model) {
        $masterLog = new MasterLog();
        $masterLog->name = $model->name;
        $masterLog->log_date = date('Y-m-d');
        $masterLog->log_time = date('H:i:s');
        $masterLog->table_name = $model->tableName();
        $masterLog->table_id = $model->id;
        $masterLog->user_id = Yii::app()->user->id;
        $masterLog->username = Yii::app()->user->username;
        $masterLog->controller_class = Yii::app()->controller->module->id  . '/' . Yii::app()->controller->id;
        $masterLog->action_name = Yii::app()->controller->action->id;
        
        $newData = $model->attributes;
        $masterLog->new_data = json_encode($newData);

        $masterLog->save();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Customer');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
        $customer->unsetAttributes();  // clear any default values
        if (isset($_GET['Customer'])) {
            $customer->attributes = $_GET['Customer'];
        }
        
        $customerDataProvider = $customer->search();

        $this->render('admin', array(
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
        ));
    }

    public function actionAjaxHtmlUpdateCustomerDataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
            $customerDataProvider = $customer->search();
            $customerDataProvider->pagination->pageSize = 50;

            $this->renderPartial('_customerDataTable', array(
                'customerDataProvider' => $customerDataProvider,
            ));
        }
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Customer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Customer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Customer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
