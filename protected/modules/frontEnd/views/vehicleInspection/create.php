<?php
/* @var $this VehicleInspectionController */
/* @var $model VehicleInspection */

$this->breadcrumbs=array(
	'Vehicle Inspections'=>array('admin'),
	'Create',
);
?>
<div id="maincontent">
    <?php $this->renderPartial('_form', array(
        'vehicleInspection'=>$vehicleInspection,
        'vehicleInspectionDetail'=>$vehicleInspectionDetail,
        'vehicleInspectionDetailDataProvider'=>$vehicleInspectionDetailDataProvider,
    )); ?>
</div>