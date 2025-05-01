<?php

class VehicleStatusController extends Controller {

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
        $vehicle = new Vehicle('search');
        $vehicle->unsetAttributes();  // clear any default values

        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $branchId = (isset($_GET['BranchId'])) ? $_GET['BranchId'] : '';
        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
        
        $vehicleEntryDataprovider = $vehicle->searchByEntryStatusLocation();
        $vehicleEntryDataprovider->pagination->pageVar = 'page_dialog';
        $vehicleEntryDataprovider->criteria->compare('t.plate_number', $plateNumber, true);
        
        $vehicleTransactionListSummary = new VehicleTransactionList($vehicle->search());
        $vehicleTransactionListSummary->setupLoading();
        $vehicleTransactionListSummary->setupPaging($pageSize, $currentPage);
        $vehicleTransactionListSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'branchId' => $branchId,
        );
        $vehicleTransactionListSummary->setupFilter($filters);

        $this->render('index', array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'vehicle' => $vehicle,
            'plateNumber' => $plateNumber,
            'vehicleEntryDataprovider' => $vehicleEntryDataprovider,
            'vehicleTransactionListSummary' => $vehicleTransactionListSummary,
        ));
    }
    
    public function actionAjaxHtmlUpdateVehicleEntryDataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
            $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
            $vehicle = new Vehicle('search');
            $vehicle->unsetAttributes();  // clear any default values

            $vehicleEntryDataprovider = $vehicle->searchByEntryStatusLocation();
            $vehicleEntryDataprovider->pagination->pageVar = 'page_dialog';
            $vehicleEntryDataprovider->criteria->compare('t.plate_number', $plateNumber, true);
        
            $this->renderPartial('_vehicleEntry', array(
                'vehicleEntryDataprovider' => $vehicleEntryDataprovider,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ));
        }
    }

    public function actionAjaxHtmlUpdateVehicleStatusDataTable() {
        if (Yii::app()->request->isAjaxRequest) {

            $vehicle = new Vehicle('search');
            $vehicle->unsetAttributes();  // clear any default values

            $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
            $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
            $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
            $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
            $branchId = (isset($_GET['BranchId'])) ? $_GET['BranchId'] : '';

            $vehicleTransactionListSummary = new VehicleTransactionList($vehicle->search());
            $vehicleTransactionListSummary->setupLoading();
            $vehicleTransactionListSummary->setupPaging($pageSize, $currentPage);
            $vehicleTransactionListSummary->setupSorting();
            $filters = array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'branchId' => $branchId,
            );
            $vehicleTransactionListSummary->setupFilter($filters);

            $this->renderPartial('_vehicleExit', array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'vehicleTransactionListSummary' => $vehicleTransactionListSummary,
            ));
        }
    }
}