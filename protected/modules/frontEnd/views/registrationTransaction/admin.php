<?php
/* @var $this RegistrationTransactionController */
/* @var $data RegistrationTransaction */

$this->breadcrumbs = array(
    'Registration Transactions' => array('admin'),
    'Manage',
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Manage BR/GR</h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('Add', array("saleEstimationList"), array('class' => 'btn btn-success btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<div id="registration_data_container">
    <?php $this->renderPartial('_registrationDataTable', array(
        'model' => $model,
        'dataProvider' => $dataProvider,
        'customerName' => $customerName,
        'plateNumber' => $plateNumber,
    )); ?>
</div>
