<?php

class SiteController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('login'));
        }
                
        $vehicle = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
        $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : '');
        $customer = Search::bind(new Customer('search'), isset($_GET['Customer']) ? $_GET['Customer'] : '');
        $service = Search::bind(new Service('search'), isset($_GET['Service']) ? $_GET['Service'] : '');

        $endDate = date('Y-m-d');
        $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
        $vehicleDataProvider = $vehicle->searchByDashboard();
        $productDataProvider = $product->searchByStockCheck($pageNumber, $endDate, '<>');
        $customerDataProvider = $customer->searchByDashboard();
        $serviceDataProvider = $service->searchByDashboard();
        
        $branches = Branch::model()->findAll();

//        $vehicleDataProvider->criteria->with = array(
//            'customer',
//        );

        if (isset($_GET['Vehicle'])) {
            $vehicle->attributes = $_GET['Vehicle'];
        }

        if (isset($_GET['Customer'])) {
            $customer->attributes = $_GET['Customer'];
        }

        if (isset($_GET['Product'])) {
            $vehicle->attributes = $_GET['Product'];
        }
        
        if (isset($_GET['Service'])) {
            $service->attributes = $_GET['Service'];
        }
        
        if (isset($_GET['ResetFilter'])) {
            $this->redirect(array('marketing'));
        }
        
        $this->render('index', array(
            'vehicle' => $vehicle,
            'vehicleDataProvider' => $vehicleDataProvider,
            'product' => $product, 
            'productDataProvider' => $productDataProvider, 
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
            'service' => $service,
            'serviceDataProvider' => $serviceDataProvider,
            'branches' => $branches,
            'endDate' => $endDate,
        ));
    }
    
    public function actionAjaxHtmlUpdateCarModelSelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $vehicle = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
            $carMakeId = isset($_GET['Vehicle']['car_make_id']) ? $_GET['Vehicle']['car_make_id'] : 0;

            $this->renderPartial('_carModelSelect', array(
                'vehicle' => $vehicle,
                'carMakeId' => $carMakeId,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateCarSubModelSelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $vehicle = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
            $carModelId = isset($_GET['Vehicle']['car_model_id']) ? $_GET['Vehicle']['car_model_id'] : 0;

            $this->renderPartial('_carSubModelSelect', array(
                'vehicle' => $vehicle,
                'carModelId' => $carModelId,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateVehicleDataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $vehicle = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
            $vehicleDataProvider = $vehicle->search();
            $vehicleDataProvider->pagination->pageSize = 50;

            $this->renderPartial('_vehicleDataTable', array(
                'vehicleDataProvider' => $vehicleDataProvider,
            ));
        }
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
    
    public function actionAjaxHtmlUpdateProductStockTable() {
        if (Yii::app()->request->isAjaxRequest) {
            $endDate = date('Y-m-d');
            
            $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : '');
            $productPageNumber = isset($_GET['product_page']) ? $_GET['product_page'] : 1;
            $productDataProvider = $product->searchBySaleEstimation($endDate);
            $productDataProvider->pagination->pageVar = 'product_page';
            $productDataProvider->pagination->pageSize = 50;
            $productDataProvider->pagination->currentPage = $productPageNumber - 1;

            $branches = Branch::model()->findAll();
            
            $this->renderPartial('_productDataTable', array(
                'productDataProvider' => $productDataProvider,
                'branches' => $branches,
                'endDate' => $endDate,
            ));
        }
    }

    public function actionAjaxHtmlUpdateProductSubBrandSelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : '');

            $this->renderPartial('_productSubBrandSelect', array(
                'product' => $product,
            ));
        }
    }

    public function actionAjaxHtmlUpdateProductSubBrandSeriesSelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : '');

            $this->renderPartial('_productSubBrandSeriesSelect', array(
                'product' => $product,
            ));
        }
    }

    public function actionAjaxHtmlUpdateProductSubMasterCategorySelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : '');

            $this->renderPartial('_productSubMasterCategorySelect', array(
                'product' => $product,
            ));
        }
    }

    public function actionAjaxHtmlUpdateProductSubCategorySelect() {
        if (Yii::app()->request->isAjaxRequest) {
            $product = Search::bind(new Product('search'), isset($_GET['Product']) ? $_GET['Product'] : '');

            $this->renderPartial('_productSubCategorySelect', array(
                'product' => $product,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateServiceDataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $service = Search::bind(new Service('search'), isset($_GET['Service']) ? $_GET['Service'] : '');
            $serviceDataProvider = $service->search();
            $serviceDataProvider->pagination->pageSize = 50;

            $this->renderPartial('_serviceDataTable', array(
                'serviceDataProvider' => $serviceDataProvider,
            ));
        }
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '//layouts/main';
        
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
