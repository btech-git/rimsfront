<?php
$this->breadcrumbs=array(
	'Permintaan Harga'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Permintaan Harga', 'url'=>array('index')),
	array('label'=>'Manage Permintaan Harga', 'url'=>array('admin')),
);
?>

<h2>Create Permintaan Harga</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>