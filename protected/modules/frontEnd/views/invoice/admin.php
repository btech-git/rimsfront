<?php
/* @var $this InvoiceHeaderController */
/* @var $model InvoiceHeader */

$this->breadcrumbs = array(
    'Invoice Headers' => array('admin'),
    'Manage',
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Manage Invoice</h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('Add', array("registrationList"), array('class' => 'btn btn-success btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<div id="invoice_data_container">
    <?php $this->renderPartial('_invoiceDataTable', array(
        'model' => $model,
        'dataProvider' => $dataProvider,
        'customerName' => $customerName,
        'plateNumber' => $plateNumber,
    )); ?>
</div>