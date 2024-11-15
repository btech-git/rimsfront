<?php
/* @var $this RegistrationTransactionController */
/* @var $model RegistrationTransaction */

$this->breadcrumbs=array(
	'Customer Registration'=>array('admin'),
	'Vehicle List',
); ?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Outstanding Registration</h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('Manage', array("admin"), array('class' => 'btn btn-info btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<div id="registration_data_container">
    <?php $this->renderPartial('_registrationDataTable', array(
        'registrationTransaction' => $registrationTransaction,
        'registrationTransactionDataProvider' => $registrationTransactionDataProvider,
        'customerName' => $customerName,
        'plateNumber' => $plateNumber,
    )); ?>
</div>