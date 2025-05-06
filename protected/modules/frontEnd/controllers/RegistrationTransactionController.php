<?php

class RegistrationTransactionController extends Controller {

    public $layout = '//layouts/column1';

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'create') {
            if (!(Yii::app()->user->checkAccess('bodyRepairCreate'))) {
                $this->redirect(array('/site/login'));
            }
        }

        if ($filterChain->action->id === 'update') {
            if (!(Yii::app()->user->checkAccess('bodyRepairEdit'))) {
                $this->redirect(array('/site/login'));
            }
        }

        if (
            $filterChain->action->id === 'admin' ||
            $filterChain->action->id === 'addProductService' ||
            $filterChain->action->id === 'generateInvoice' ||
            $filterChain->action->id === 'generateSalesOrder' ||
            $filterChain->action->id === 'generateWorkOrder' ||
            $filterChain->action->id === 'insuranceAddition' ||
            $filterChain->action->id === 'view' ||
            $filterChain->action->id === 'showRealization'
        ) {
            if (!(Yii::app()->user->checkAccess('bodyRepairCreate')) || !(Yii::app()->user->checkAccess('bodyRepairEdit'))) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    public function actionVehicleList() {
        $vehicle = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
        $vehicleDataProvider = $vehicle->searchByDashboard();
        $vehicleDataProvider->criteria->addCondition('t.status_location = "Keluar Bengkel"');
        if (isset($_GET['Vehicle'])) {
            $vehicle->attributes = $_GET['Vehicle'];
        }

        $this->render('vehicleList', array(
            'vehicle' => $vehicle,
            'vehicleDataProvider' => $vehicleDataProvider,
        ));
    }
    
    public function actionEntryVehicle($vehicleId) {
        $vehicle = Vehicle::model()->findByPk($vehicleId);
        $vehicle->status_location = 'Masuk Bengkel';
        $vehicle->entry_datetime = date('Y-m-d H:i:s');
        
        if ($vehicle->save(Yii::app()->db)) {
            $this->redirect(array('saleEstimationList'));
        } else {
            $this->redirect(array('vehicleList'));
        }
        
    }
    
//    public function actionSaleEstimationList() {
//        $registrationTransactionHeader = Search::bind(new SaleEstimationHeader('search'), isset($_GET['SaleEstimationHeader']) ? $_GET['SaleEstimationHeader'] : '');
//        $registrationTransactionHeaderDataProvider = $registrationTransactionHeader->searchByRegistration();
//
//        $this->render('saleEstimationList', array(
//            'saleEstimationHeader' => $registrationTransactionHeader,
//            'saleEstimationHeaderDataProvider' => $registrationTransactionHeaderDataProvider,
//        ));
//    }
    
    public function actionCreate($estimationId) {
        $registrationTransaction = $this->instantiate(null);
        $saleEstimationHeader = SaleEstimationHeader::model()->findByPk($estimationId);
        
//        if (empty($saleEstimationHeader->customer_id && $saleEstimationHeader->vehicle_id)) {
            $vehicle = Search::bind(new Vehicle('search'), isset($_GET['Vehicle']) ? $_GET['Vehicle'] : '');
            $vehicleDataProvider = $vehicle->search();
//        } else {
            $customer = Customer::model()->findByPk($saleEstimationHeader->customer_id);
            $vehicleData = Vehicle::model()->findByPk($saleEstimationHeader->vehicle_id);
//        }

        $registrationTransaction->header->transaction_date = date('Y-m-d H:i:s');
        $registrationTransaction->header->work_order_time = null;
        $registrationTransaction->header->created_datetime = date('Y-m-d H:i:s');
        $registrationTransaction->header->user_id = Yii::app()->user->id;
        $registrationTransaction->header->vehicle_id = empty($saleEstimationHeader->vehicle_id) ? null : $saleEstimationHeader->vehicle_id;
        $registrationTransaction->header->customer_id = empty($saleEstimationHeader->customer_id) ? null :$saleEstimationHeader->customer_id;
        $registrationTransaction->header->branch_id = Yii::app()->user->branch_id;
        $registrationTransaction->header->status = 'Registration';
        $registrationTransaction->header->vehicle_status = 'DI BENGKEL';
        $registrationTransaction->header->repair_type = 'GR';
        $registrationTransaction->header->service_status = 'Pending';
        $registrationTransaction->header->product_status = 'Draft';
        $registrationTransaction->header->priority_level = 2;
        $registrationTransaction->header->sale_estimation_header_id = $estimationId;
        $registrationTransaction->header->vehicle_entry_datetime = null;
        $registrationTransaction->header->vehicle_exit_datetime = null;
        $registrationTransaction->header->vehicle_start_service_datetime = null;
        $registrationTransaction->header->vehicle_finish_service_datetime = null;
        
        $registrationTransaction->addDetails($estimationId);

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            $this->loadState($registrationTransaction);
            $registrationTransaction->generateCodeNumber(Yii::app()->dateFormatter->format('M', strtotime($registrationTransaction->header->transaction_date)), Yii::app()->dateFormatter->format('yyyy', strtotime($registrationTransaction->header->transaction_date)), $registrationTransaction->header->branch_id);

            if ($registrationTransaction->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $registrationTransaction->header->id));
            }
        }

        $this->render('create', array(
            'registrationTransaction' => $registrationTransaction,
            'customer' => $customer,
            'vehicleData' => $vehicleData,
            'vehicle' => $vehicle,
            'vehicleDataProvider' => $vehicleDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $registrationTransaction = $this->instantiate($id);
        $vehicle = Vehicle::model()->findByPk($registrationTransaction->header->vehicle_id);
        $customer = Customer::model()->findByPk($vehicle->customer_id);
        $registrationTransaction->header->edited_datetime = date('Y-m-d H:i:s');
        $registrationTransaction->header->user_id_edited = Yii::app()->user->id;
        $registrationTransaction->header->status = 'Update Registration';

        if (isset($_POST['RegistrationTransaction'])) {
            $this->loadState($registrationTransaction);
            
            if ($registrationTransaction->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $registrationTransaction->header->id));
            }
        }

        $this->render('update', array(
            'registrationTransaction' => $registrationTransaction,
            'vehicle' => $vehicle,
            'customer' => $customer,
        ));
    }

    public function actionAddRecommendation($id) {
        $registrationTransaction = $this->instantiate($id);
        $vehicle = Vehicle::model()->findByPk($registrationTransaction->header->vehicle_id);
        $customer = Customer::model()->findByPk($vehicle->customer_id);

        if (isset($_POST['RegistrationTransaction'])) {
            $this->loadState($registrationTransaction);
            
            if ($registrationTransaction->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $registrationTransaction->header->id));
            }
        }

        $this->render('addRecommendation', array(
            'registrationTransaction' => $registrationTransaction,
            'vehicle' => $vehicle,
            'customer' => $customer,
        ));
    }

    public function actionAddMemo($id) {
        $registrationTransaction = $this->instantiate($id);
        $vehicle = Vehicle::model()->findByPk($registrationTransaction->header->vehicle_id);
        $customer = Customer::model()->findByPk($vehicle->customer_id);
        
        $memo = isset($_GET['Memo']) ? $_GET['Memo'] : '';

        if (isset($_POST['Submit']) && !empty($_POST['Memo'])) {
            $registrationMemo = new RegistrationMemo();
            $registrationMemo->registration_transaction_id = $id;
            $registrationMemo->memo = $_POST['Memo'];
            $registrationMemo->date_time = date('Y-m-d H:i:s');
            $registrationMemo->user_id = Yii::app()->user->id;
            $registrationMemo->save();

            $this->redirect(array('view', 'id' => $registrationTransaction->header->id));
        }

        $this->render('addMemo', array(
            'registrationTransaction' => $registrationTransaction,
            'vehicle' => $vehicle,
            'customer' => $customer,
            'memo' => $memo,
        ));
    }

    public function actionView($id) {
        
        $model = $this->loadModel($id);
        $memo = isset($_GET['Memo']) ? $_GET['Memo'] : '';
        $services = RegistrationService::model()->findAllByAttributes(array(
            'registration_transaction_id' => $id,
            'is_body_repair' => 0
        ));
        $products = RegistrationProduct::model()->findAllByAttributes(array('registration_transaction_id' => $id));
        $registrationMemos = RegistrationMemo::model()->findAllByAttributes(array('registration_transaction_id' => $id));
        $registrationBodyRepairDetails = RegistrationBodyRepairDetail::model()->findAllByAttributes(array('registration_transaction_id' => $id));

        $this->render('view', array(
            'model' => $model,
            'services' => $services,
            'products' => $products,
            'registrationMemos' => $registrationMemos,
            'registrationBodyRepairDetails' => $registrationBodyRepairDetails,
            'memo' => $memo,
        ));
    }

    public function actionAdmin() {
        $model = new RegistrationTransaction('search');
        $model->unsetAttributes();  // clear any default values

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
        $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
        $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';

        if (isset($_GET['RegistrationTransaction'])) {
            $model->attributes = $_GET['RegistrationTransaction'];
        }

        $dataProvider = $model->search();
//        $dataProvider->criteria->addCondition('t.branch_id = :branch_id');
//        $dataProvider->criteria->params[':branch_id'] = Yii::app()->user->branch_id;
//        $dataProvider->criteria->addBetweenCondition('SUBSTRING(t.transaction_date, 1, 10)', $startDate, $endDate);

        $this->render('admin', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'customerName' => $customerName,
            'plateNumber' => $plateNumber,
        ));
    }

    public function actionUpdateApproval($id) {
        $registrationTransaction = $this->loadModel($id);
        $historis = RegistrationApproval::model()->findAllByAttributes(array('registration_transaction_id' => $id));
        $model = new RegistrationApproval;
        $model->date = date('Y-m-d H:i:s');
        
        if (isset($_POST['RegistrationApproval'])) {
            $model->attributes = $_POST['RegistrationApproval'];
            if ($model->save()) {
                $registrationTransaction->status = $model->approval_type;
                $registrationTransaction->save(false);

                $this->saveTransactionLog('approval', $registrationTransaction);
        
                $this->redirect(array('view', 'id' => $id));
            }
        }

        $this->render('updateApproval', array(
            'model' => $model,
            'registrationTransaction' => $registrationTransaction,
            'historis' => $historis,
        ));
    }

    public function actionGenerateSalesOrder($id) {
        $model = $this->instantiate($id);

        $model->generateCodeNumberSaleOrder(Yii::app()->dateFormatter->format('M', strtotime($model->header->transaction_date)), Yii::app()->dateFormatter->format('yyyy', strtotime($model->header->transaction_date)), $model->header->branch_id);
        $model->header->sales_order_date = date('Y-m-d');
        $model->header->status = 'Processing SO';

        if ($model->header->update(array('sales_order_number', 'sales_order_date', 'status'))) {

            $real = new RegistrationRealizationProcess();
            $real->registration_transaction_id = $model->header->id;
            $real->name = 'Sales Order';
            $real->checked = 1;
            $real->checked_date = date('Y-m-d');
            $real->checked_by = Yii::app()->user->getId();
            $real->detail = 'Generate Sales Order with number #' . $model->header->sales_order_number;
            $real->save();

            $this->redirect(array('view', 'id' => $id));
        }
    }

    public function actionGenerateWorkOrder($id) {
        $registrationTransaction = $this->instantiate($id);
        $customer = Customer::model()->findByPk($registrationTransaction->header->customer_id);
        $vehicle = Vehicle::model()->findByPk($registrationTransaction->header->vehicle_id);

        $registrationTransaction->generateCodeNumberWorkOrder(Yii::app()->dateFormatter->format('M', strtotime($registrationTransaction->header->transaction_date)), Yii::app()->dateFormatter->format('yyyy', strtotime($registrationTransaction->header->transaction_date)), $registrationTransaction->header->branch_id);
        $registrationTransaction->header->work_order_date = isset($_POST['RegistrationTransaction']['work_order_date']) ? $_POST['RegistrationTransaction']['work_order_date'] : date('Y-m-d');
        $registrationTransaction->header->work_order_time = date('H:i:s');
        $registrationTransaction->header->status = 'Waitlist';

        if (isset($_POST['Cancel'])) {
            $this->redirect(array('view', 'id' => $id));
        }

        if (isset($_POST['Submit'])) {
            $registrationTransaction->header->update(array('work_order_number', 'work_order_date', 'work_order_time', 'status'));
            if ($registrationTransaction->header->repair_type == 'GR') {
                $real = new RegistrationRealizationProcess();
                $real->checked = 1;
                $real->checked_date = date('Y-m-d');
                $real->checked_by = 1;
                $real->detail = 'Add When Generate Work Order. WorkOrder#' . $registrationTransaction->header->work_order_number;
                $real->save();
            }

            $this->redirect(array('view', 'id' => $id));
        }
        
        $this->render('generateWorkOrder', array(
            'bodyRepair' => $registrationTransaction,
            'vehicle' => $vehicle,
            'customer' => $customer,
        ));
    }

    public function actionCancel($id) {
        
        $movementOutHeader = MovementOutHeader::model()->findByAttributes(array('registration_transaction_id' => $id, 'user_id_cancelled' => null));
        $invoiceHeader = InvoiceHeader::model()->findByAttributes(array('registration_transaction_id' => $id, 'user_id_cancelled' => null));
        if (empty($movementOutHeader && $invoiceHeader)) { 
            $model = $this->loadModel($id);
            $model->status = 'CANCELLED!!!';
            $model->payment_status = 'CANCELLED!!!';
            $model->service_status = 'CANCELLED!!!';
            $model->vehicle_status = 'CANCELLED!!!';
            $model->cancelled_datetime = date('Y-m-d H:i:s');
            $model->user_id_cancelled = Yii::app()->user->id;
            $model->update(array('status', 'payment_status', 'service_status', 'vehicle_status', 'cancelled_datetime', 'user_id_cancelled'));
            
            Yii::app()->user->setFlash('message', 'Transaction is successfully cancelled');
        } else {
            Yii::app()->user->setFlash('message', 'Transaction cannot be cancelled. Check related transactions!');
            $this->redirect(array('view', 'id' => $id));
        }

        $this->redirect(array('admin'));
    }

    public function actionPdfSaleOrder($id) {
        $generalRepairRegistration = RegistrationTransaction::model()->find('id=:id', array(':id' => $id));
        $customer = Customer::model()->findByPk($generalRepairRegistration->customer_id);
        $vehicle = Vehicle::model()->findByPk($generalRepairRegistration->vehicle_id);
        $branch = Branch::model()->findByPk($generalRepairRegistration->branch_id);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L');

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot') . '/css/pdf.css');
        $mPDF1->SetTitle('Sales Order');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($this->renderPartial('pdfSaleOrder', array(
            'generalRepairRegistration' => $generalRepairRegistration,
            'customer' => $customer,
            'vehicle' => $vehicle,
            'branch' => $branch,
        ), true));
        $mPDF1->Output('SO ' . $generalRepairRegistration->sales_order_number . '.pdf', 'I');
    }

    public function actionPdfWorkOrder($id) {
        $generalRepairRegistration = RegistrationTransaction::model()->findByPk($id);
        $customer = Customer::model()->findByPk($generalRepairRegistration->customer_id);
        $vehicle = Vehicle::model()->findByPk($generalRepairRegistration->vehicle_id);
        $branch = Branch::model()->findByPk($generalRepairRegistration->branch_id);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L');

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot') . '/css/pdf.css');
        $mPDF1->SetTitle('Work Order');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($this->renderPartial('pdfWorkOrder', array(
            'generalRepairRegistration' => $generalRepairRegistration,
            'customer' => $customer,
            'vehicle' => $vehicle,
            'branch' => $branch,
        ), true));
        $mPDF1->Output('WO ' . $generalRepairRegistration->work_order_number . '.pdf', 'I');
    }

    public function actionAjaxJsonVehicle($id) {
        if (Yii::app()->request->isAjaxRequest) {

            $registrationTransaction = $this->instantiate($id);
            $this->loadState($registrationTransaction);

            $vehicle = $registrationTransaction->header->vehicle(array('scopes' => 'resetScope', 'with' => 'customer:resetScope'));

            $object = array(
                'vehicle_name' => CHtml::value($vehicle, 'carMakeModelSubCombination'),
                'customer_name' => CHtml::value($vehicle, 'customer.name'),
                'customer_id' => CHtml::value($vehicle, 'customer_id'),
                'vehicle_plate_number' => CHtml::value($vehicle, 'plate_number'),
                'vehicle_frame_number' => CHtml::value($vehicle, 'frame_number'),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotalService($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $registrationTransaction = $this->instantiate($id);
            $this->loadState($registrationTransaction);

            $totalPriceService = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($registrationTransaction->serviceDetails[$index], 'totalAmount')));
            $totalDiscount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->totalDiscount));
            $subTotalService = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->subTotalService));
            $subTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->subTotalTransaction));
            $taxTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->taxItemAmount));
            $grandTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->grandTotalTransaction));

            echo CJSON::encode(array(
                'totalPriceService' => $totalPriceService,
                'totalDiscount' => $totalDiscount,
                'subTotalService' => $subTotalService,
                'subTotalTransaction' => $subTotalTransaction,
                'taxTotalTransaction' => $taxTotalTransaction,
                'grandTotalTransaction' => $grandTotalTransaction,
            ));
        }
    }

    public function actionAjaxJsonTotalProduct($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $registrationTransaction = $this->instantiate($id);
            $this->loadState($registrationTransaction);

            $totalPriceProduct = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($registrationTransaction->productDetails[$index], 'totalPrice')));
            $totalDiscount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->totalDiscount));
            $totalQuantityProduct = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $registrationTransaction->totalQuantityProduct));
            $subTotalProduct = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->subTotalProduct));
            $subTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->subTotalTransaction));
            $taxTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->taxItemAmount));
            $grandTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->grandTotalTransaction));

            echo CJSON::encode(array(
                'totalPriceProduct' => $totalPriceProduct,
                'totalQuantityProduct' => $totalQuantityProduct,
                'totalDiscount' => $totalDiscount,
                'subTotalProduct' => $subTotalProduct,
                'subTotalTransaction' => $subTotalTransaction,
                'taxTotalTransaction' => $taxTotalTransaction,
                'grandTotalTransaction' => $grandTotalTransaction,
            ));
        }
    }

    public function actionAjaxJsonGrandTotal($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $registrationTransaction = $this->instantiate($id);
            $this->loadState($registrationTransaction);

            $taxTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->taxItemAmount));
            $grandTotalTransaction = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $registrationTransaction->grandTotalTransaction));
            
            echo CJSON::encode(array(
                'taxTotalTransaction' => $taxTotalTransaction,
                'grandTotalTransaction' => $grandTotalTransaction,
            ));
        }
    }

    public function actionAjaxHtmlUpdateRegistrationTable() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $model = Search::bind(new RegistrationTransaction('search'), isset($_POST['RegistrationTransaction']) ? $_POST['RegistrationTransaction'] : '');
            $dataProvider = $model->search();
//            $dataProvider->criteria->addCondition('t.branch_id = :branch_id');
//            $dataProvider->criteria->params[':branch_id'] = Yii::app()->user->branch_id;
            $customerName = (isset($_GET['CustomerName'])) ? $_GET['CustomerName'] : '';
            $plateNumber = (isset($_GET['PlateNumber'])) ? $_GET['PlateNumber'] : '';

            $this->renderPartial('_registrationDataTable', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
                'customerName' => $customerName,
                'plateNumber' => $plateNumber,
            ));
        }
    }

    public function loadModel($id) {
        $model = RegistrationTransaction::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    public function instantiate($id) {
        if (empty($id)) {
            $registrationTransaction = new RegistrationTransactionComponent(new RegistrationTransaction(), array(), array(), array());
        } else {
            $registrationTransactionModel = $this->loadModel($id);
            $registrationTransaction = new RegistrationTransactionComponent($registrationTransactionModel, $registrationTransactionModel->registrationServices, $registrationTransactionModel->registrationProducts);
        }
        return $registrationTransaction;
    }

    public function loadState($registrationTransaction) {
        if (isset($_POST['RegistrationTransaction'])) {
            $registrationTransaction->header->attributes = $_POST['RegistrationTransaction'];
        }

        if (isset($_POST['RegistrationService'])) {
            foreach ($_POST['RegistrationService'] as $i => $item) {
                if (isset($registrationTransaction->serviceDetails[$i])) {
                    $registrationTransaction->serviceDetails[$i]->attributes = $item;
                } else {
                    $detail = new RegistrationService();
                    $detail->attributes = $item;
                    $registrationTransaction->serviceDetails[] = $detail;
                }
            }
            if (count($_POST['RegistrationService']) < count($registrationTransaction->serviceDetails)) {
                array_splice($registrationTransaction->serviceDetails, $i + 1);
            }
        } else {
            $registrationTransaction->serviceDetails = array();
        }

        if (isset($_POST['RegistrationProduct'])) {
            foreach ($_POST['RegistrationProduct'] as $i => $item) {
                if (isset($registrationTransaction->productDetails[$i])) {
                    $registrationTransaction->productDetails[$i]->attributes = $item;
                } else {
                    $detail = new RegistrationProduct();
                    $detail->attributes = $item;
                    $registrationTransaction->productDetails[] = $detail;
                }
            }
            if (count($_POST['RegistrationProduct']) < count($registrationTransaction->productDetails)) {
                array_splice($registrationTransaction->productDetails, $i + 1);
            }
        } else {
            $registrationTransaction->productDetails = array();
        }
    }
}