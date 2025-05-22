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
        $startDateIn = (isset($_GET['StartDateIn'])) ? $_GET['StartDateIn'] : date('Y-m-d');
        $endDateIn = (isset($_GET['EndDateIn'])) ? $_GET['EndDateIn'] : date('Y-m-d');
        $startDateOut = (isset($_GET['StartDateOut'])) ? $_GET['StartDateOut'] : date('Y-m-d');
        $endDateOut = (isset($_GET['EndDateOut'])) ? $_GET['EndDateOut'] : date('Y-m-d');
        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
        
        $vehicleEntryDataprovider = $vehicle->searchByEntryStatusLocation();
        $vehicleEntryDataprovider->pagination->pageVar = 'page_dialog';
        $vehicleEntryDataprovider->criteria->compare('t.plate_number', $plateNumber, true);
        $vehicleEntryDataprovider->criteria->addBetweenCondition('DATE(t.entry_datetime)', $startDateIn, $endDateIn);
        
        $vehicleTransactionListSummary = new VehicleTransactionList($vehicle->search());
        $vehicleTransactionListSummary->setupLoading();
        $vehicleTransactionListSummary->setupPaging($pageSize, $currentPage);
        $vehicleTransactionListSummary->setupSorting();
        $filters = array(
            'startDateOut' => $startDateOut,
            'endDateOut' => $endDateOut,
            'branchId' => $branchId,
        );
        $vehicleTransactionListSummary->setupFilter($filters);

        $this->render('index', array(
            'startDateIn' => $startDateIn,
            'endDateIn' => $endDateIn,
            'startDateOut' => $startDateOut,
            'endDateOut' => $endDateOut,
            'vehicle' => $vehicle,
            'plateNumber' => $plateNumber,
            'vehicleEntryDataprovider' => $vehicleEntryDataprovider,
            'vehicleTransactionListSummary' => $vehicleTransactionListSummary,
        ));
    }
    
    public function actionAjaxHtmlUpdateVehicleEntryDataTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';
            $startDateIn = (isset($_GET['StartDateIn'])) ? $_GET['StartDateIn'] : date('Y-m-d');
            $endDateIn = (isset($_GET['EndDateIn'])) ? $_GET['EndDateIn'] : date('Y-m-d');
            $vehicle = new Vehicle('search');
            $vehicle->unsetAttributes();  // clear any default values

            $vehicleEntryDataprovider = $vehicle->searchByEntryStatusLocation();
            $vehicleEntryDataprovider->pagination->pageVar = 'page_dialog';
            $vehicleEntryDataprovider->criteria->compare('t.plate_number', $plateNumber, true);
            $vehicleEntryDataprovider->criteria->addBetweenCondition('t.entry_datetime', $startDateIn, $endDateIn);
        
            $this->renderPartial('_vehicleEntry', array(
                'vehicleEntryDataprovider' => $vehicleEntryDataprovider,
                'startDateIn' => $startDateIn,
                'endDateIn' => $endDateIn,
            ));
        }
    }

    public function actionAjaxHtmlUpdateVehicleStatusDataTable() {
        if (Yii::app()->request->isAjaxRequest) {

            $vehicle = new Vehicle('search');
            $vehicle->unsetAttributes();  // clear any default values

            $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
            $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
            $startDateOut = (isset($_GET['StartDateOut'])) ? $_GET['StartDateOut'] : date('Y-m-d');
            $endDateOut = (isset($_GET['EndDateOut'])) ? $_GET['EndDateOut'] : date('Y-m-d');
            $branchId = (isset($_GET['BranchId'])) ? $_GET['BranchId'] : '';

            $vehicleTransactionListSummary = new VehicleTransactionList($vehicle->search());
            $vehicleTransactionListSummary->setupLoading();
            $vehicleTransactionListSummary->setupPaging($pageSize, $currentPage);
            $vehicleTransactionListSummary->setupSorting();
            $filters = array(
                'startDateOut' => $startDateOut,
                'endDateOut' => $endDateOut,
                'branchId' => $branchId,
            );
            $vehicleTransactionListSummary->setupFilter($filters);

            $this->renderPartial('_vehicleExit', array(
                'startDateOut' => $startDateOut,
                'endDateOut' => $endDateOut,
                'vehicleTransactionListSummary' => $vehicleTransactionListSummary,
            ));
        }
    }
}