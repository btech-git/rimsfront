<?php
/* @var $this RegistrationTransactionController */
/* @var $registrationTransaction->header RegistrationTransaction */

$this->breadcrumbs = array(
    'Registration Transactions' => array('admin'),
    $registrationTransaction->header->id,
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Show BR/GR #<?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'id')); ?></h4>
    </div>
</div>

<hr />
<div>
<?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td>Transaction #</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'transaction_number')); ?></td>
                <td>Customer</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'customer.name')); ?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy H:m:s", CHtml::value($registrationTransaction->header, 'transaction_date'))); ?></td>
                <td>Type</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'customer.customer_type')); ?></td>
            </tr>
            <tr>
                <td>Repair Type</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'repair_type')); ?></td>
                <td>Address</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'customer.address')); ?></td>
            </tr>
            <tr>
                <td>Document Status</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'status')); ?></td>
                <td>Mobile Phone</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'customer.mobile_phone')); ?></td>
            </tr>
            <tr>
                <td>Insurance Company</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'insuranceCompany.name')); ?></td>
                <td>Email</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'customer.email')); ?></td>
            </tr>
            <tr>
                <td>Vehicle Status</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'vehicle.status_location')); ?></td>
                <td>Plate #</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'vehicle.plate_number')); ?></td>
            </tr>
            <tr>
                <td>Problem</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'problem')); ?></td>
                <td>Vehicle</td>
                <td>
                    <?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'vehicle.carMake.name')); ?> -
                    <?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'vehicle.carModel.name')); ?> -
                    <?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'vehicle.carSubModel.name')); ?>
                </td>
            </tr>
            <tr>
                <td>Sales Person</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'employeeIdSalesPerson.name')); ?></td>
                <td>Mileage (KM)</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'vehicle_mileage')); ?></td>
            </tr>
            <tr>
                <td>Assigned Mechanic</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'employeeIdAssignMechanic.name')); ?></td>
                <td>WO #</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'work_order_number')); ?></td>
            </tr>
            <tr>
                <td>Status Service</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'service_status')); ?></td>
                <td>SO #</td>
                <td><?php echo CHtml::encode(CHtml::value($registrationTransaction->header, 'sales_order_number')); ?></td>
            </tr>
            <tr>
                <td>Status Barang</td>
                <td><?php echo ($registrationTransaction->header->totalQuantityMovementLeft > 0) ? 'Pending' : 'Completed'; ?></td>
                <td>Invoice #</td>
                <td>
                    <?php $invoice = InvoiceHeader::model()->findByAttributes(array('registration_transaction_id' => $registrationTransaction->header->id, 'user_id_cancelled' => null)) ?>
                    <?php echo CHtml::encode(CHtml::value($invoice, 'invoice_number')); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <hr />

    <table class="table table-bordered table-responsive">
        <tbody>
            <tr>
                <td>Kondisi Awal</td>
                <td>Rekomendasi Awal</td>
            </tr>
            <tr>
                <td><?php echo CHtml::activeTextArea($registrationTransaction->header, 'initial_condition_memo', array('class' => 'form-control')); ?></td>
                <td><?php echo CHtml::activeTextArea($registrationTransaction->header, 'initial_recommendation', array('class' => 'form-control')); ?></td>
            </tr>
            <tr>
                <td>Kondisi Akhir</td>
                <td>Rekomendasi Akhir</td>
            </tr>
            <tr>
                <td><?php echo CHtml::activeTextArea($registrationTransaction->header, 'final_condition_memo', array('class' => 'form-control')); ?></td>
                <td><?php echo CHtml::activeTextArea($registrationTransaction->header, 'final_recommendation', array('class' => 'form-control')); ?></td>
            </tr>
        </tbody>
    </table>
    
    <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn btn-success')); ?>
    <?php echo IdempotentManager::generate(); ?>
</div>