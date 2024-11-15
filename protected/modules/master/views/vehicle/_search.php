<?php
/* @var $this VehicleController */
/* @var $model Vehicle */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plate_number'); ?>
		<?php echo $form->textField($model,'plate_number',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plate_number_prefix_id'); ?>
		<?php echo $form->textField($model,'plate_number_prefix_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plate_number_ordinal'); ?>
		<?php echo $form->textField($model,'plate_number_ordinal',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plate_number_suffix'); ?>
		<?php echo $form->textField($model,'plate_number_suffix',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'machine_number'); ?>
		<?php echo $form->textField($model,'machine_number',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frame_number'); ?>
		<?php echo $form->textField($model,'frame_number',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'car_make_id'); ?>
		<?php echo $form->textField($model,'car_make_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'car_model_id'); ?>
		<?php echo $form->textField($model,'car_model_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'car_sub_model_id'); ?>
		<?php echo $form->textField($model,'car_sub_model_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'car_sub_model_detail_id'); ?>
		<?php echo $form->textField($model,'car_sub_model_detail_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'color_id'); ?>
		<?php echo $form->textField($model,'color_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_pic_id'); ?>
		<?php echo $form->textField($model,'customer_pic_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'insurance_company_id'); ?>
		<?php echo $form->textField($model,'insurance_company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chasis_code'); ?>
		<?php echo $form->textField($model,'chasis_code',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transmission'); ?>
		<?php echo $form->textField($model,'transmission',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_type'); ?>
		<?php echo $form->textField($model,'fuel_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'power'); ?>
		<?php echo $form->textField($model,'power'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drivetrain'); ?>
		<?php echo $form->textField($model,'drivetrain',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->