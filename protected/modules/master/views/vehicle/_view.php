<?php
/* @var $this VehicleController */
/* @var $data Vehicle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_number')); ?>:</b>
	<?php echo CHtml::encode($data->plate_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_number_prefix_id')); ?>:</b>
	<?php echo CHtml::encode($data->plate_number_prefix_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_number_ordinal')); ?>:</b>
	<?php echo CHtml::encode($data->plate_number_ordinal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_number_suffix')); ?>:</b>
	<?php echo CHtml::encode($data->plate_number_suffix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('machine_number')); ?>:</b>
	<?php echo CHtml::encode($data->machine_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frame_number')); ?>:</b>
	<?php echo CHtml::encode($data->frame_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('car_make_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_make_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_model_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_model_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_sub_model_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_sub_model_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('car_sub_model_detail_id')); ?>:</b>
	<?php echo CHtml::encode($data->car_sub_model_detail_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color_id')); ?>:</b>
	<?php echo CHtml::encode($data->color_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_pic_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_pic_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insurance_company_id')); ?>:</b>
	<?php echo CHtml::encode($data->insurance_company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chasis_code')); ?>:</b>
	<?php echo CHtml::encode($data->chasis_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transmission')); ?>:</b>
	<?php echo CHtml::encode($data->transmission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fuel_type')); ?>:</b>
	<?php echo CHtml::encode($data->fuel_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('power')); ?>:</b>
	<?php echo CHtml::encode($data->power); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drivetrain')); ?>:</b>
	<?php echo CHtml::encode($data->drivetrain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>