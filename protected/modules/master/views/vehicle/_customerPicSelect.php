<?php echo CHtml::label('PIC', false, array('class' => 'form-label')); ?>
<?php echo CHtml::activeDropDownlist($model, 'customer_pic_id', CHtml::listData(CustomerPic::model()->findAllByAttributes(array('customer_id' => $model->customer_id), array('order' => 'name')), 'id', 'name'), array(
    'prompt' => '[--Select PIC--]',
    'class' => 'form-control',
)); ?>
<?php echo CHtml::error($model, 'customer_pic_id'); ?>