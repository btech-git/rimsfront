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

<h1>Create Permintaan Harga</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>