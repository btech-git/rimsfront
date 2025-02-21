<?php

class RegistrationTransactionVehicleListController extends Controller {

    public $layout = '//layouts/column1';

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'index') {
            if (!(Yii::app()->user->checkAccess('director'))) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    public function actionIndex() {
        $registrationTransaction = new RegistrationTransaction('search');
        $registrationTransaction->unsetAttributes();  // clear any default values

        $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
        $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
        $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
        $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
        $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
        $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
        $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
        $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
        $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
        $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
        $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
        $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
        $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
        $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
//        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
//        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
        $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
        $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
        $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
        $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
        $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
        $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
        $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

        $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
        $registrationTransactionVehicleList->setupLoading();
        $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
        $registrationTransactionVehicleList->setupSorting();
        $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

        $this->render('index', array(
            'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            'startDate1' => $startDate1,
            'endDate1' => $endDate1,
            'startDate2' => $startDate2,
            'endDate2' => $endDate2,
            'startDate3' => $startDate3,
            'endDate3' => $endDate3,
            'startDate4' => $startDate4,
            'endDate4' => $endDate4,
            'startDate5' => $startDate5,
            'endDate5' => $endDate5,
            'startDate6' => $startDate6,
            'endDate6' => $endDate6,
            'startDate7' => $startDate7,
            'endDate7' => $endDate7,
//            'customerName' => $customerName,
//            'plateNumber' => $plateNumber,
        ));
    }
    
    public function actionUpdateLocation($id, $vehicleId) {
        $vehicle = Vehicle::model()->findByPk($vehicleId);
        $registrationTransaction = RegistrationTransaction::model()->findByPk($id);

        if (isset($_POST['Vehicle'])) {
            $vehicle->attributes = $_POST['Vehicle'];
            
            if ($vehicle->status_location == 'Masuk Bengkel') {
                $vehicle->entry_datetime = date('Y-m-d H:i:s');
                $registrationTransaction->vehicle_entry_datetime = date('Y-m-d H:i:s');
            } elseif ($vehicle->status_location == 'Mulai Service') {
                $vehicle->start_service_datetime = date('Y-m-d H:i:s');
                $registrationTransaction->vehicle_start_service_datetime = date('Y-m-d H:i:s');
            } elseif ($vehicle->status_location == 'Selesai Service') {
                $vehicle->finish_service_datetime = date('Y-m-d H:i:s');
                $registrationTransaction->vehicle_finish_service_datetime = date('Y-m-d H:i:s');
            } elseif ($vehicle->status_location == 'Keluar Bengkel') {
                $vehicle->exit_datetime = date('Y-m-d H:i:s');
                $registrationTransaction->vehicle_exit_datetime = date('Y-m-d H:i:s');
            } else {
                $vehicle->entry_datetime = null;
                $vehicle->start_service_datetime = null;
                $vehicle->finish_service_datetime = null;
                $vehicle->exit_datetime = null;
                $registrationTransaction->vehicle_entry_datetime = null;
                $registrationTransaction->vehicle_start_service_datetime = null;
                $registrationTransaction->vehicle_finish_service_datetime = null;
                $registrationTransaction->vehicle_exit_datetime = null;
            }
            
            if ($vehicle->save() && $registrationTransaction->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('updateLocation', array(
            'vehicle' => $vehicle,
        ));
    }

    public function actionAjaxHtmlUpdateRegistrationTransactionBranch1DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch1DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateRegistrationTransactionBranch2DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch2DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateRegistrationTransactionBranch3DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch3DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateRegistrationTransactionBranch4DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch4DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateRegistrationTransactionBranch5DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch5DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateRegistrationTransactionBranch6DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch6DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
    
    public function actionAjaxHtmlUpdateRegistrationTransactionBranch7DataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $registrationTransaction = new RegistrationTransaction('search');
            $registrationTransaction->unsetAttributes();  // clear any default values

            $startDate1 = (isset($_GET['StartDate1'])) ? $_GET['StartDate1'] : date('Y-m-d');
            $endDate1 = (isset($_GET['EndDate1'])) ? $_GET['EndDate1'] : date('Y-m-d');
            $startDate2 = (isset($_GET['StartDate2'])) ? $_GET['StartDate2'] : date('Y-m-d');
            $endDate2 = (isset($_GET['EndDate2'])) ? $_GET['EndDate2'] : date('Y-m-d');
            $startDate3 = (isset($_GET['StartDate3'])) ? $_GET['StartDate3'] : date('Y-m-d');
            $endDate3 = (isset($_GET['EndDate3'])) ? $_GET['EndDate3'] : date('Y-m-d');
            $startDate4 = (isset($_GET['StartDate4'])) ? $_GET['StartDate4'] : date('Y-m-d');
            $endDate4 = (isset($_GET['EndDate4'])) ? $_GET['EndDate4'] : date('Y-m-d');
            $startDate5 = (isset($_GET['StartDate5'])) ? $_GET['StartDate5'] : date('Y-m-d');
            $endDate5 = (isset($_GET['EndDate5'])) ? $_GET['EndDate5'] : date('Y-m-d');
            $startDate6 = (isset($_GET['StartDate6'])) ? $_GET['StartDate6'] : date('Y-m-d');
            $endDate6 = (isset($_GET['EndDate6'])) ? $_GET['EndDate6'] : date('Y-m-d');
            $startDate7 = (isset($_GET['StartDate7'])) ? $_GET['StartDate7'] : date('Y-m-d');
            $endDate7 = (isset($_GET['EndDate7'])) ? $_GET['EndDate7'] : date('Y-m-d');
    //        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
    //        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $currentPage1 = (isset($_GET['page_1'])) ? $_GET['page_1'] : '';
            $currentPage2 = (isset($_GET['page_2'])) ? $_GET['page_2'] : '';
            $currentPage3 = (isset($_GET['page_3'])) ? $_GET['page_3'] : '';
            $currentPage4 = (isset($_GET['page_4'])) ? $_GET['page_4'] : '';
            $currentPage5 = (isset($_GET['page_5'])) ? $_GET['page_5'] : '';
            $currentPage6 = (isset($_GET['page_6'])) ? $_GET['page_6'] : '';
            $currentPage7 = (isset($_GET['page_7'])) ? $_GET['page_7'] : '';

            $registrationTransactionVehicleList = new RegistrationTransactionVehicleList($registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search(), $registrationTransaction->search());
            $registrationTransactionVehicleList->setupLoading();
            $registrationTransactionVehicleList->setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7);
            $registrationTransactionVehicleList->setupSorting();
            $registrationTransactionVehicleList->setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7);

            $this->renderPartial('_branch7DataTable', array(
                'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
            ));
        }
    }
}