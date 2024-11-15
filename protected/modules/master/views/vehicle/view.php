<?php
/* @var $this VehicleController */
/* @var $model Vehicle */

$this->breadcrumbs=array(
	'Vehicles'=>array('index'),
	$model->id,
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Show Vehicle #<?php echo CHtml::encode(CHtml::value($model, 'id')); ?></h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('Manage', array("admin"), array('class' => 'btn btn-info btn-sm')); ?>
            <?php echo CHtml::link('Edit', array("update", 'id' => $model->id), array('class' => 'btn btn-warning btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Mesin #</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'machine_number')); ?></td>
                <th>Plat #</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'vehicle.plate_number')); ?></td>
            </tr>
            <tr>
                <th>Rangka #</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'frame_number')); ?></td>
                <th>Mobil Tipe</th>
                <td>
                    <?php echo CHtml::encode(CHtml::value($model, 'carMake.name')); ?> -
                    <?php echo CHtml::encode(CHtml::value($model, 'carModel.name')); ?> -
                    <?php echo CHtml::encode(CHtml::value($model, 'carSubModel.name')); ?>
                </td>
            </tr>
            <tr>
                <th>Customer</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.name')); ?></td>
                <th>Warna</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'colors.name')); ?></td>
            </tr>
            <tr>
                <th>Customer Type</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.customer_type')); ?></td>
                <th>Tahun</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'year')); ?></td>
            </tr>
            <tr>
                <th>Asuransi</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'insuranceCompany.name')); ?></td>
                <th>Chasis</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'chasis_code')); ?></td>
            </tr>
            <tr>
                <th>Transmisi</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'transmission')); ?></td>
                <th>Bensin/Diesel</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'fuel_type')); ?></td>
            </tr>
            <tr>
                <th>Power</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'power')); ?></td>
                <th>Drivetrain</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'drivetrain')); ?></td>
            </tr>
            <tr>
                <th>Note</th>
                <td colspan="3"><?php echo CHtml::encode(CHtml::value($model, 'notes')); ?></td>
            </tr>
        </tbody>
    </table>
<?php echo CHtml::endForm(); ?>

<fieldset class="border border-secondary rounded mb-3 p-3">
    <legend class="float-none w-auto text-dark px-1">History Vehicle Data</legend>
    <div class="row">
        <div class="col">
            <?php $this->renderPartial('_infoHistory', array(
                'model' => $model,
            )); ?>  
        </div>
    </div>
</fieldset>