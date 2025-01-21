<?php
$this->breadcrumbs=array(
	'Permintaan Harga'=>array('index'),
	$model->product_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Permintaan Harga', 'url'=>array('index')),
	array('label'=>'Create Permintaan Harga', 'url'=>array('create')),
	array('label'=>'View Permintaan Harga', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Permintaan Harga', 'url'=>array('admin')),
);
?>

<h1>Update Permintaan Harga <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>