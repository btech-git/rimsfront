<?php
/* @var $this RegistrationTransactionController */
/* @var $model RegistrationTransaction */

$this->breadcrumbs = array(
    'Registration Transactions' => array('admin'),
    $model->id,
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Show BR/GR #<?php echo CHtml::encode(CHtml::value($model, 'id')); ?></h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('Manage', array("admin"), array('class' => 'btn btn-info btn-sm')); ?>
            <?php echo CHtml::link('Edit', array("update", 'id' => $model->id), array('class' => 'btn btn-warning btn-sm')); ?>
            <?php if (empty($model->sales_order_number)): ?>
                <?php echo CHtml::link('<i class="bi-plus"></i> Generate Sales Order', array("generateSalesOrder", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
            <?php endif; ?>

            <?php if (count($model->registrationServices) > 0 && empty($model->work_order_number)): ?>
                <?php echo CHtml::link('<i class="bi-plus"></i> Generate Work Order', array("generateWorkOrder", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
            <?php endif; ?>

            <?php if (empty($invoices)): ?>
                <?php if (!empty($model->registrationServices) && (!empty($model->registrationProducts) && $model->getTotalQuantityMovementLeft() == 0)): ?>
                    <?php echo CHtml::link('<i class="bi-check"></i> Approval', array("updateApproval", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
                <?php elseif (!empty($model->registrationServices) && empty($model->registrationProducts)): ?>
                    <?php echo CHtml::link('<i class="bi-check"></i> Approval', array("updateApproval", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
                <?php elseif (empty($model->registrationServices) && !empty($model->registrationProducts) && $model->getTotalQuantityMovementLeft() == 0): ?>
                    <?php echo CHtml::link('<i class="bi-check"></i> Approval', array("updateApproval", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if ($model->status == "Approved" && $model->status !== 'CANCELLED!!!'): ?>
                <?php echo CHtml::link('<i class="bi-plus"></i> Generate Invoice', array("/frontEnd/invoice/create", "registrationId" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<hr />

<div>
<?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td>Transaction #</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'transaction_number')); ?></td>
                <td>Customer</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.name')); ?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy H:m:s", CHtml::value($model, 'transaction_date'))); ?></td>
                <td>Type</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.customer_type')); ?></td>
            </tr>
            <tr>
                <td>Repair Type</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'repair_type')); ?></td>
                <td>Address</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.address')); ?></td>
            </tr>
            <tr>
                <td>Document Status</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'status')); ?></td>
                <td>Mobile Phone</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.mobile_phone')); ?></td>
            </tr>
            <tr>
                <td>Insurance Company</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'insuranceCompany.name')); ?></td>
                <td>Email</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.email')); ?></td>
            </tr>
            <tr>
                <td>Vehicle Status</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'vehicle.status_location')); ?></td>
                <td>Plate #</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'vehicle.plate_number')); ?></td>
            </tr>
            <tr>
                <td>Problem</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'problem')); ?></td>
                <td>Vehicle</td>
                <td>
                    <?php echo CHtml::encode(CHtml::value($model, 'vehicle.carMake.name')); ?> -
                    <?php echo CHtml::encode(CHtml::value($model, 'vehicle.carModel.name')); ?> -
                    <?php echo CHtml::encode(CHtml::value($model, 'vehicle.carSubModel.name')); ?>
                </td>
            </tr>
            <tr>
                <td>Sales Person</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'employeeIdSalesPerson.name')); ?></td>
                <td>Mileage (KM)</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'vehicle_mileage')); ?></td>
            </tr>
            <tr>
                <td>Assigned Mechanic</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'employeeIdAssignMechanic.name')); ?></td>
                <td>WO #</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'work_order_number')); ?></td>
            </tr>
            <tr>
                <td>Status Service</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'service_status')); ?></td>
                <td>SO #</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'sales_order_number')); ?></td>
            </tr>
            <tr>
                <td>Status Barang</td>
                <td><?php echo ($model->totalQuantityMovementLeft > 0) ? 'Pending' : 'Completed'; ?></td>
                <td>Invoice #</td>
                <td>
                    <?php $invoice = InvoiceHeader::model()->findByAttributes(array('registration_transaction_id' => $model->id, 'user_id_cancelled' => null)) ?>
                    <?php echo CHtml::encode(CHtml::value($invoice, 'invoice_number')); ?>
                </td>
            </tr>
            <tr>
                <td>Kondisi Awal</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'initial_condition_memo')); ?></td>
                <td>Rekomendasi Awal</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'initial_recommendation')); ?></td>
            </tr>
            <tr>
                <td>Kondisi Akhir</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'final_condition_memo')); ?></td>
                <td>Rekomendasi Akhir</td>
                <td><?php echo CHtml::encode(CHtml::value($model, 'final_recommendation')); ?></td>
            </tr>
        </tbody>
    </table>

    <hr />

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Message</th>
                <th>Date</th>
                <th>Sent By</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($registrationMemos) > 0): ?>
                <?php foreach ($registrationMemos as $i => $registrationMemo): ?>
                    <tr>
                        <td><?php echo $registrationMemo->memo; ?></td>
                        <td><?php echo $registrationMemo->date_time; ?></td>
                        <td><?php echo $registrationMemo->user->username; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No Messages!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('<i class="bi-plus"></i> Memo', array("addMemo", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
            <?php //echo CHtml::link('<i class="bi-plus"></i> Kondisi & Rekomendasi', array("addRecommendation", "id" => $model->id), array('class' => 'btn btn-success btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<div class="detail">
    <fieldset>
        <legend>Details</legend>
        <?php
        $tabsArray = array();
        $tabsArray['Billing'] = array(
            'id' => 'billing',
            'content' => $this->renderPartial('_viewBilling', array(
                'model' => $model,
                'products' => $products,
                'services' => $services,
            ), TRUE)
        );
        $tabsArray['Movement'] = array(
            'id' => 'movement',
            'content' => $this->renderPartial('_viewMovement', array(
                'model' => $model,
                'products' => $products,
            ), TRUE)
        );
        $tabsArray['History'] = array(
            'id' => 'history',
            'content' => $this->renderPartial('_viewHistory', array(
                'model' => $model
            ), TRUE)
        );
        ?>
        <?php $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs' => $tabsArray,
            // additional javascript options for the tabs plugin
            'options' => array('collapsible' => true),
        )); ?>
    </fieldset>
</div>

<br />

<?php if (!empty($model->work_order_number) && $model->total_service > 0): ?>
    <?php echo CHtml::link('<i class="bi-printer"></i> Print Work Order', array("pdfWorkOrder", "id" => $model->id), array(
        'class' => 'btn btn-secondary btn-sm',
        'target' => '_blank'
    )); ?>
<?php endif; ?>
<?php if (!empty($model->sales_order_number) && $model->status !== 'Finished'): ?>
    <?php echo CHtml::link('<i class="bi-printer"></i> Print Sales Order', array("pdfSaleOrder", "id" => $model->id), array(
        'class' => 'btn btn-secondary btn-sm',
        'target' => '_blank'
    )); ?>
<?php endif; ?>
<?php echo CHtml::endForm(); ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'cancel-message-dialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Cancel Message',
        'autoOpen' => false,
        'width' => 'auto',
        'modal' => false,
    ),
));?>
<div>
    <?php $hasFlash = Yii::app()->user->hasFlash('message'); ?>
    <?php if ($hasFlash): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('message'); ?>
        </div>
    <?php endif; ?>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<script>
    $(document).ready(function() {
        var hasFlash = <?php echo $hasFlash ? 'true' : 'false' ?>;
        if (hasFlash) {
            $("#cancel-message-dialog").dialog({modal: 'false'});
        }
    });
</script>