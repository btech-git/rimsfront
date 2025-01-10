<?php

class RegistrationTransactionComponent extends CComponent {

    public $header;
    public $serviceDetails;
    public $productDetails;

    public function __construct($header, array $serviceDetails, array $productDetails) {
        $this->header = $header;
        $this->serviceDetails = $serviceDetails;
        $this->productDetails = $productDetails;
    }

    public function generateCodeNumber($currentMonth, $currentYear, $branchId) {
        $arr = array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        $cnYearCondition = "substring_index(substring_index(substring_index(transaction_number, '/', 2), '/', -1), '.', 1)";
        $cnMonthCondition = "substring_index(substring_index(substring_index(transaction_number, '/', 2), '/', -1), '.', -1)";
        $registrationTransaction = RegistrationTransaction::model()->find(array(
            'order' => ' id DESC',
            'condition' => "$cnYearCondition = :cn_year AND $cnMonthCondition = :cn_month AND branch_id = :branch_id",
            'params' => array(':cn_year' => $currentYear, ':cn_month' => $arr[$currentMonth], ':branch_id' => $branchId),
        ));

        if ($registrationTransaction == null) {
            $branchCode = Branch::model()->findByPk($branchId)->code;
        } else {
            $branchCode = $registrationTransaction->branch->code;
            $this->header->transaction_number = $registrationTransaction->transaction_number;
        }

        $this->header->setCodeNumberByNext('transaction_number', $branchCode, RegistrationTransaction::CONSTANT, $currentMonth, $currentYear);
    }

    public function generateCodeNumberWorkOrder($currentMonth, $currentYear, $branchId) {
        $arr = array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        $cnYearCondition = "substring_index(substring_index(substring_index(work_order_number, '/', 2), '/', -1), '.', 1)";
        $cnMonthCondition = "substring_index(substring_index(substring_index(work_order_number, '/', 2), '/', -1), '.', -1)";
        $registrationTransaction = RegistrationTransaction::model()->find(array(
            'order' => ' id DESC',
            'condition' => "$cnYearCondition = :cn_year AND $cnMonthCondition = :cn_month AND branch_id = :branch_id",
            'params' => array(':cn_year' => $currentYear, ':cn_month' => $arr[$currentMonth], ':branch_id' => $branchId),
        ));

        if ($registrationTransaction == null) {
            $branchCode = Branch::model()->findByPk($branchId)->code;
        } else {
            $branchCode = $registrationTransaction->branch->code;
            $this->header->work_order_number = $registrationTransaction->work_order_number;
        }

        $this->header->setCodeNumberByNext('work_order_number', $branchCode, RegistrationTransaction::CONSTANT_WORK_ORDER, $currentMonth, $currentYear);
    }

    public function generateCodeNumberSaleOrder($currentMonth, $currentYear, $branchId) {
        $arr = array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
        $cnYearCondition = "substring_index(substring_index(substring_index(sales_order_number, '/', 2), '/', -1), '.', 1)";
        $cnMonthCondition = "substring_index(substring_index(substring_index(sales_order_number, '/', 2), '/', -1), '.', -1)";
        $registrationTransaction = RegistrationTransaction::model()->find(array(
            'order' => ' id DESC',
            'condition' => "$cnYearCondition = :cn_year AND $cnMonthCondition = :cn_month AND branch_id = :branch_id",
            'params' => array(':cn_year' => $currentYear, ':cn_month' => $arr[$currentMonth], ':branch_id' => $branchId),
        ));

        if ($registrationTransaction == null) {
            $branchCode = Branch::model()->findByPk($branchId)->code;
        } else {
            $branchCode = $registrationTransaction->branch->code;
            $this->header->sales_order_number = $registrationTransaction->sales_order_number;
        }

        $this->header->setCodeNumberByNext('sales_order_number', $branchCode, RegistrationTransaction::CONSTANT_SALE_ORDER, $currentMonth, $currentYear);
    }

    public function addDetails($estimationId) {

        $saleEstimationHeader = SaleEstimationHeader::model()->findByPk($estimationId);

        if (!empty($saleEstimationHeader)) {
            foreach ($saleEstimationHeader->saleEstimationProductDetails as $productDetail) {
                $detailProduct = new RegistrationProduct();
                $detailProduct->product_id = $productDetail->product_id;
                $detailProduct->quantity = $productDetail->quantity;
                $detailProduct->discount = $productDetail->discount_value;
                $detailProduct->discount_type = $productDetail->discount_type;
                $detailProduct->sale_price = $productDetail->sale_price;
                $detailProduct->total_price = $productDetail->total_price;
                $detailProduct->sale_estimation_product_detail_id = $productDetail->id;
                $this->productDetails[] = $detailProduct;
            }
            foreach ($saleEstimationHeader->saleEstimationServiceDetails as $serviceDetail) {
                $detailService = new RegistrationService();
                $detailService->service_id = $serviceDetail->service_id;
                $detailService->price = $serviceDetail->price;
                $detailService->discount_price = $serviceDetail->discount_value;
                $detailService->discount_type = $serviceDetail->discount_type;
                $detailService->total_price = $serviceDetail->total_price;
                $detailService->service_type_id = $serviceDetail->service_type_id;
                $detailService->sale_estimation_service_detail_id = $serviceDetail->id;
                $this->serviceDetails[] = $detailService;
            }
            $this->header->total_product = $saleEstimationHeader->total_quantity_product; 
            $this->header->subtotal_product = $saleEstimationHeader->sub_total_product; 
            $this->header->subtotal_service = $saleEstimationHeader->sub_total_service; 
            $this->header->subtotal = $saleEstimationHeader->sub_total; 
            $this->header->tax_percentage = $saleEstimationHeader->tax_product_percentage; 
            $this->header->ppn_price = $saleEstimationHeader->tax_product_amount; 
            $this->header->grand_total = $saleEstimationHeader->grand_total; 
        }
    }

    public function removeServiceDetailAt($index) {
        array_splice($this->serviceDetails, $index, 1);
    }

    public function removeProductDetailAt($index) {
        array_splice($this->productDetails, $index, 1);
    }

    public function validate() {

        $valid = $this->header->validate(array('car_mileage', 'problem', 'insurance_company_id'));
        if ($this->header->isNewRecord) {
            $valid = $valid && $this->validateExistingCustomer();
        }

        return $valid;
    }

    public function validateExistingCustomer() {
        $valid = true;

        $registrationTransaction = RegistrationTransaction::model()->findByAttributes(array(
            'transaction_date' => $this->header->transaction_date, 
            'vehicle_id' => $this->header->vehicle_id
        ));

        if (!empty($registrationTransaction)) {
            $valid = false;
            $this->header->addError('error', 'Kendaraan customer sudah ada di database hari ini.');
        }

        return $valid;
    }

    public function save($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = $this->validate() && IdempotentManager::build()->save() && $this->flush();
            if ($valid) {
                $dbTransaction->commit();
            } else {
                $dbTransaction->rollback();
            }
        } catch (Exception $e) {
            $dbTransaction->rollback();
            $valid = false;
            $this->header->addError('error', $e->getMessage());
        }

        return $valid;
    }

    public function flush() {
        $isNewRecord = $this->header->isNewRecord;
        if ($isNewRecord) {
            $this->header->status = 'Registration';
            $this->header->vehicle_status = 'DI BENGKEL';
            $this->header->service_status = 'Bongkar - Pending';
        }

        $this->header->total_product = $this->getTotalQuantityProduct();
        $this->header->subtotal_product = $this->getSubTotalProduct();
        $this->header->subtotal_service = $this->getSubTotalService();
        $this->header->subtotal = $this->getSubTotalTransaction();
        $this->header->ppn_price = $this->getTaxItemAmount();
        $this->header->grand_total = $this->getGrandTotalTransaction();
        $this->header->total_quickservice = 0;
        $this->header->total_quickservice_price = 0;
        $this->header->priority_level = 2;

        $valid = $this->header->save();

        if ($isNewRecord && $valid) {
            $serviceNames = array('Bongkar', 'Sparepart', 'KetokLas', 'Dempul', 'Epoxy', 'Cat', 'Pasang', 'Cuci', 'Poles');
            foreach ($serviceNames as $serviceName) {
                $registrationBodyRepairDetail = new RegistrationBodyRepairDetail();
                $registrationBodyRepairDetail->service_name = $serviceName;
                $registrationBodyRepairDetail->registration_transaction_id = $this->header->id;

                $valid = $valid && $registrationBodyRepairDetail->save();
                if (!$valid) {
                    break;
                }
            }
        }

        //save request detail
        if (count($this->serviceDetails) > 0) {
            foreach ($this->serviceDetails as $serviceDetail) {
                $serviceDetail->registration_transaction_id = $this->header->id;
                $valid = $serviceDetail->save(false) && $valid;
            }
        }

        //save request detail
        if (count($this->productDetails) > 0) {
            foreach ($this->productDetails as $productDetail) {
                $productDetail->registration_transaction_id = $this->header->id;
                $productDetail->total_price = $productDetail->totalPrice;

                $valid = $productDetail->save(false) && $valid;
            }
        }

        return $valid;
    }

    public function getSubTotalService() {
        $total = 0.00;

        foreach ($this->serviceDetails as $detail) {
            $total += $detail->totalAmount;
        }

        return $total;
    }

    public function getTotalDiscountService() {
        $total = 0.00;

        foreach ($this->serviceDetails as $detail) {
            $total += $detail->discountAmount;
        }

        return $total;
    }

    public function getSubTotalServiceBeforeDiscount() {
        $total = 0.00;

        foreach ($this->serviceDetails as $detail) {
            $total += $detail->price;
        }

        return $total;
    }

    public function getTotalQuantityProduct() {
        $quantity = 0;

        foreach ($this->productDetails as $detail) {
            $quantity += $detail->quantity;
        }

        return $quantity;
    }

    public function getSubTotalProduct() {
        $total = 0.00;

        foreach ($this->productDetails as $detail) {
            $total += $detail->totalPrice;
        }

        return $total;
    }

    public function getTotalDiscountProduct() {
        $total = 0.00;

        foreach ($this->productDetails as $detail) {
            $total += $detail->discountAmount;
        }

        return $total;
    }

    public function getTotalDiscount() {
       
        return $this->totalDiscountService + $this->totalDiscountProduct;        
    }

    public function getSubTotalProductBeforeDiscount() {
        $total = 0.00;

        foreach ($this->productDetails as $detail) {
            $total += $detail->totalBeforeDiscount;
        }

        return $total;
    }

    public function getSubTotalTransaction() {
        
        return $this->subTotalServiceBeforeDiscount + $this->subTotalProductBeforeDiscount;
    }

    public function getTaxItemAmount() {
        return ($this->header->ppn == 2) ? 0 : $this->subTotalTransaction * $this->header->tax_percentage / 100;
    }

    public function getGrandTotalTransaction() {
        return $this->subTotalTransaction - $this->totalDiscount + $this->taxItemAmount;
    }
}