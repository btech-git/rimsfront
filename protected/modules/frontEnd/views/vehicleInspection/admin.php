<?php
/* @var $this VehicleInspectionController */
/* @var $model VehicleInspection */

$this->breadcrumbs = array(
    'Vehicle Inspections' => array('admin'),
    'Vehicle List',
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Inspeksi Kendaraan</h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php //echo CHtml::link('Add', array("create"), array('class' => 'btn btn-success btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<div id="registration_data_container">
    <?php $this->renderPartial('_vehicleInspectionDataTable', array(
        'registrationTransaction' => $registrationTransaction,
        'registrationTransactionDataProvider' => $registrationTransactionDataProvider,
        'customerName' => $customerName,
        'plateNumber' => $plateNumber,
    )); ?>
</div>
