<?php

class CashierController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'cashier') {
            if (!(Yii::app()->user->checkAccess('cashierApproval'))) {
                $this->redirect(array('/site/login'));
            }
        }
        
        if ($filterChain->action->id === 'customerWaitlist') {
            if (!(Yii::app()->user->checkAccess('customerQueueApproval'))) {
                $this->redirect(array('/site/login'));
            }
        }

        $filterChain->run();
    }

    public function actionInvoiceList() {
        $invoice = Search::bind(new InvoiceHeader('search'), isset($_GET['InvoiceHeader']) ? $_GET['InvoiceHeader'] : '');
        $invoice->unsetAttributes();
        
        if (isset($_GET['InvoiceHeader'])) {
            $invoice->attributes = $_GET['InvoiceHeader'];
        }
        
        $invoiceCriteria = new CDbCriteria;
        $invoiceCriteria->compare('t.invoice_number', $invoice->invoice_number, true);
        $invoiceCriteria->compare('t.status', $invoice->status);
        $invoiceCriteria->compare('t.branch_id', $invoice->branch_id);
        $invoiceCriteria->compare('t.insurance_company_id', $invoice->insurance_company_id);
//        $invoiceCriteria->addCondition('t.branch_id = :branch_id');
//        $invoiceCriteria->params[':branch_id'] = Yii::app()->user->branch_id;
        $invoiceCriteria->addCondition("t.status != 'CANCELLED' AND t.registration_transaction_id IS NOT NULL AND invoice_date > '2023-01-01' AND t.payment_left > 0");
        
        $invoiceDataProvider = new CActiveDataProvider('InvoiceHeader', array(
            'criteria' => $invoiceCriteria, 
            'sort' => array(
                'defaultOrder' => 'invoice_date DESC',
            ),
            'pagination' => array(
                'pageSize' => 25,
            )
        ));

        $customer = new Customer('search');
        $customer->unsetAttributes();  // clear any default values

        if (isset($_GET['Customer'])) {
            $customer->attributes = $_GET['Customer'];
        }

        $customerCriteria = new CDbCriteria;
        $customerCriteria->compare('name', $customer->name, true);
        $customerCriteria->compare('customer_type', $customer->customer_type, true);
        $customerCriteria->compare('email', $customer->email . '%', true, 'AND', false);

        $customerDataProvider = new CActiveDataProvider('Customer', array(
            'criteria' => $customerCriteria,
        ));

        $this->render('invoiceList', array(
            'invoice' => $invoice,
            'invoiceDataProvider' => $invoiceDataProvider,
            'customer' => $customer,
            'customerDataProvider' => $customerDataProvider,
        ));
    }

    public function actionCreate($invoiceId) {
        $paymentIn = $this->instantiate(null);
        $invoice = InvoiceHeader::model()->findByPk($invoiceId);
        $customer = Customer::model()->findByPk($invoice->customer_id);
        
        $paymentIn->header->customer_id = $customer->id;
        $paymentIn->header->payment_date = date('Y-m-d');
        $paymentIn->header->payment_time = date('H:i:s');
        $paymentIn->header->created_datetime = date('Y-m-d H:i:s');
        $paymentIn->header->branch_id = 1; //Yii::app()->user->branch_id;
        $paymentIn->header->status = 'Draft';
        $paymentIn->header->user_id = Yii::app()->user->id;
        $paymentIn->addInvoice($invoiceId);

        $invoiceHeader = Search::bind(new InvoiceHeader('search'), isset($_GET['InvoiceHeader']) ? $_GET['InvoiceHeader'] : array());
        $invoiceHeaderDataProvider = $invoiceHeader->searchForPaymentIn();

        if (!empty($customer->id)) {
            $invoiceHeaderDataProvider->criteria->addCondition("t.customer_id = :customer_id");
            $invoiceHeaderDataProvider->criteria->params[':customer_id'] = $customer->id;
        }
        
        if (isset($_POST['Cancel'])) {
            $this->redirect(array('admin'));
        }

        if (isset($_POST['Submit']) && IdempotentManager::check()) {
            $this->loadState($paymentIn);
            $paymentIn->generateCodeNumber(Yii::app()->dateFormatter->format('M', strtotime($paymentIn->header->payment_date)), Yii::app()->dateFormatter->format('yyyy', strtotime($paymentIn->header->payment_date)), $paymentIn->header->branch_id);
            
            if ($paymentIn->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $paymentIn->header->id));
            }
        }

        $this->render('create', array(
            'paymentIn' => $paymentIn,
            'customer' => $customer,
            'invoiceHeader' => $invoiceHeader,
            'invoiceHeaderDataProvider' => $invoiceHeaderDataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new PaymentIn('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['PaymentIn'])) {
            $model->attributes = $_GET['PaymentIn'];
        }
        
        $dataProvider = $model->search();
//        $dataProvider->criteria->addCondition('t.branch_id = :branch_id');
//        $dataProvider->criteria->params[':branch_id'] = Yii::app()->user->branch_id;
        $this->render('admin', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id) {
        
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionPdf($id) {
        $invoiceHeader = InvoiceHeader::model()->findByPk($id);
        $invoiceDetailsData = $this->getInvoiceDetailsData($invoiceHeader);
        $customer = Customer::model()->findByPk($invoiceHeader->customer_id);
        $vehicle = Vehicle::model()->findByPk($invoiceHeader->vehicle_id);
        $branch = Branch::model()->findByPk($invoiceHeader->branch_id);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L');

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot') . '/css/pdf.css');
        $mPDF1->SetTitle('Invoice');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($this->renderPartial('pdf', array(
            'invoiceHeader' => $invoiceHeader,
            'invoiceDetailsData' => $invoiceDetailsData,
            'customer' => $customer,
            'vehicle' => $vehicle,
            'branch' => $branch,
        ), true));
        $mPDF1->Output('Invoice ' . $invoiceHeader->invoice_number . '.pdf', 'I');
    }
    
    public function getInvoiceDetailsData($invoiceHeader) {
        $pageSize = 9;
        
        $invoiceDetails = array();
        foreach ($invoiceHeader->invoiceDetails as $invoiceDetail) {
            if (!empty($invoiceDetail->product_id)) {
                $invoiceDetails[] = $invoiceDetail;
            }
        }
        foreach ($invoiceHeader->invoiceDetails as $invoiceDetail) {
            if (!empty($invoiceDetail->service_id)) {
                $invoiceDetails[] = $invoiceDetail;
            }
        }
        
        $invoiceDetailsData = array();
        foreach ($invoiceDetails as $i => $invoiceDetail) {
            $currentPage = intval($i / $pageSize);
            if (!empty($invoiceDetail->product_id)) {
                $invoiceDetailsData['items'][$currentPage]['p'][] = $invoiceDetail;
                $invoiceDetailsData['lastpage']['p'] = $currentPage;
            } else if (!empty($invoiceDetail->service_id)) {
                $invoiceDetailsData['items'][$currentPage]['s'][] = $invoiceDetail;
                $invoiceDetailsData['lastpage']['s'] = $currentPage;
            }
        }
        
        return $invoiceDetailsData;
    }

    public function actionPdfPayment($id) {
        $invoiceHeader = InvoiceHeader::model()->findByPk($id);
        $invoiceDetailsData = $this->getInvoiceDetailsData($invoiceHeader);
        $paymentInDetail = PaymentInDetail::model()->findByAttributes(array('invoice_header_id' => $id));
        $customer = Customer::model()->findByPk($invoiceHeader->customer_id);
        $vehicle = Vehicle::model()->findByPk($invoiceHeader->vehicle_id);
        $branch = Branch::model()->findByPk($invoiceHeader->branch_id);
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L');

        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot') . '/css/pdf.css');
        $mPDF1->SetTitle('Tanda Terima');
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->SetWatermarkText('LUNAS');
        $mPDF1->showWatermarkText = true;
        $mPDF1->watermark_font = 'DejaVuSansCondensed'; 
        $mPDF1->WriteHTML($this->renderPartial('pdfPayment', array(
            'invoiceHeader' => $invoiceHeader,
            'invoiceDetailsData' => $invoiceDetailsData,
            'paymentInDetail' => $paymentInDetail,
            'customer' => $customer,
            'vehicle' => $vehicle,
            'branch' => $branch,
        ), true));
        $mPDF1->Output('Tanda Terima ' . $invoiceHeader->invoice_number . '.pdf', 'I');
    }

    public function actionMemo($id) {
        $this->layout = '//layouts/main_memo';
        $model = $this->loadModel($id);
        $services = RegistrationService::model()->findAllByAttributes(array(
            'registration_transaction_id' => $id,
            'is_body_repair' => 0
        ));
        $products = RegistrationProduct::model()->findAllByAttributes(array('registration_transaction_id' => $id));

        $this->render('memo', array(
            'model' => $model,
            'services' => $services,
            'products' => $products,
        ));
    }

    public function actionAjaxJsonAmount($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $paymentIn = $this->instantiate($id);
            $this->loadState($paymentIn);

            $taxServiceAmount = CHtml::value($paymentIn->details[$index], 'taxServiceAmount');

            $object = array(
                'paymentAmount' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($paymentIn->details[$index], 'amount'))),
                'taxServiceAmountFormatted' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $taxServiceAmount)),
                'totalPayment' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($paymentIn, 'totalPayment'))),
                'totalInvoice' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($paymentIn, 'totalInvoice'))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonGrandTotal($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $paymentIn = $this->instantiate($id);
            $this->loadState($paymentIn);

            $object = array(
                'totalPayment' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($paymentIn, 'totalPayment'))),
                'totalInvoice' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($paymentIn, 'totalInvoice'))),
            );

            echo CJSON::encode($object);
        }
    }
    
    public function loadModel($id) {
        $model = PaymentIn::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function instantiate($id) {
        
        if (empty($id)) {
            $paymentIn = new Cashier(new PaymentIn(), array());
        } else {
            $paymentInModel = $this->loadModel($id);
            $paymentIn = new Cashier($paymentInModel, $paymentInModel->paymentInDetails);
        }
        
        return $paymentIn;
    }

    public function loadState($paymentIn) {
        if (isset($_POST['PaymentIn'])) {
            $paymentIn->header->attributes = $_POST['PaymentIn'];
        }
        
        if (isset($_POST['PaymentInDetail'])) {
            foreach ($_POST['PaymentInDetail'] as $i => $item) {
                if (isset($paymentIn->details[$i])) {
                    $paymentIn->details[$i]->attributes = $item;
                } else {
                    $detail = new PaymentInDetail();
                    $detail->attributes = $item;
                    $paymentIn->details[] = $detail;
                }
            }
            if (count($_POST['PaymentInDetail']) < count($paymentIn->details)) {
                array_splice($paymentIn->details, $i + 1);
            }
        } else {
            $paymentIn->details = array();
        }
    }

}
