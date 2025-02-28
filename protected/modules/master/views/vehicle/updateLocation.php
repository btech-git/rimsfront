<?php
/* @var $this VehicleController */
/* @var $model Vehicle */

$this->breadcrumbs=array(
	'Vehicle'=>array('admin'),
	'Vehicles'=>array('admin'),
	//$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Vehicle', 'url'=>array('index')),
	array('label'=>'Create Vehicle', 'url'=>array('create')),
	array('label'=>'View Vehicle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Vehicle', 'url'=>array('admin')),
);
?>

<div id="maincontent">
    <h1>Update Location Vehicle <?php echo $model->plate_number; ?></h1>

    <div class="row">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Mesin #</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'machine_number')); ?></td>
                    <th>Plat #</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'plate_number')); ?></td>
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
                    <th>Warna</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'colors.name')); ?></td>
                    <th>Tahun</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'year')); ?></td>
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
                    <th>Asuransi</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'insuranceCompany.name')); ?></td>
                    <th>Chasis</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'chasis_code')); ?></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'status_location')); ?></td>
                    <th>Note</th>
                    <td><?php echo CHtml::encode(CHtml::value($model, 'notes')); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
        
    <div class="row">
        <?php $customer = Customer::model()->findByPk($model->customer_id) ?>
        <h5>Customer</h5>
        <table class="table table-bordered table-sm">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Type</td>
                    <td>Address</td>
                    <td>Province</td>
                    <td>City</td>
                    <td>Email</td>
                    <td>Note</td>
                </tr>

                <tr>
                    <td><?php echo CHtml::link($customer->id, array("/master/customer/view", "id"=>$customer->id), array('target' => '_blank')) ?></td>
                    <td><?php echo CHtml::link($customer->name, array("/master/customer/view", "id"=>$customer->id), array('target' => '_blank')) ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($customer, 'customer_type')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($customer, 'address')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($customer, 'province.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($customer, 'city.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($customer, 'email')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($customer, 'note')); ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'vehicle-form',
            'enableAjaxValidation' => false,
        )); ?>
        <div class="row">
            Status Location
            <?php echo CHtml::activeDropDownList($model, 'status_location', array(
                'Masuk Bengkel' => 'Masuk Bengkel',
                'Mulai Service' => 'Mulai Service',
                'Selesai Service' => 'Selesai Service',
                'Keluar Bengkel' => 'Keluar Bengkel',
            ), array('empty' => '-- Pilih Status --')); ?>
            <?php echo CHtml::error($model, 'status_location'); ?>
        </div>
        
        <hr />
        
        <div class="field buttons text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'button cbutton')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
