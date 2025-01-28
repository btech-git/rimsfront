<?php

class ProductPricingRequestController extends Controller {

    public $layout = '//layouts/column1';

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'create') {
            if (!(Yii::app()->user->checkAccess('saleInvoiceCreate'))) {
                $this->redirect(array('/site/login'));
            }
        }

        if (
            $filterChain->action->id === 'delete' ||
            $filterChain->action->id === 'update'
        ) {
            if (!(Yii::app()->user->checkAccess('saleInvoiceEdit'))) {
                $this->redirect(array('/site/login'));
            }
        }

        if (
            $filterChain->action->id === 'admin' ||
            $filterChain->action->id === 'index' ||
            $filterChain->action->id === 'view' ||
            $filterChain->action->id === 'viewInvoices'
        ) {
            if (!(Yii::app()->user->checkAccess('saleInvoiceCreate')) || !(Yii::app()->user->checkAccess('saleInvoiceEdit'))) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new ProductPricingRequest;
        $model->user_id_request = Yii::app()->user->id;
        $model->request_date = date('Y-m-d');
        $model->request_time = date('H:i:s');
        $model->branch_id_request = Yii::app()->user->branch_id;
        $model->user_id_reply = null;
        $model->reply_date = null;
        $model->reply_time = null;
        $model->reply_note = null;
        $model->recommended_price = '0.00';
        $model->branch_id_reply = null;
        
        if (isset($_POST['Cancel'])) {
            $this->redirect(array('admin'));
        }

        if (isset($_POST['ProductPricingRequest']) && IdempotentManager::check()) {

            $model->attributes = $_POST['ProductPricingRequest'];
            
            $fileName = CUploadedFile::getInstanceByName('file');
            $model->file = $fileName;
            $model->extension = $fileName;

            if ($model->save(Yii::app()->db)) {
                $this->saveImageFile($model);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if (isset($_POST['Cancel'])) {
            $this->redirect(array('admin'));
        }

        if (isset($_POST['ProductPricingRequest']) && IdempotentManager::check()) {

            $model->attributes = $_POST['ProductPricingRequest'];
            
            $file = CUploadedFile::getInstanceByName('file');
            $model->file = $file;
            $model->extension = $file->extensionName;

            if ($model->save(Yii::app()->db)) {
                $this->saveImageFile($model);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function saveImageFile($model) {
        $originalPath = dirname(Yii::app()->request->scriptFile) . '/images/product_pricing_request/' . $model->id . '.' . $model->extension;
        $model->file->saveAs($originalPath);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ProductPricingRequest('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProductPricingRequest'])) {
            $model->attributes = $_GET['ProductPricingRequest'];
        }
        
        $dataProvider = $model->search();
        
        $this->render('admin', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    public function loadModel($id) {
        $model = ProductPricingRequest::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        
        return $model;
    }
}