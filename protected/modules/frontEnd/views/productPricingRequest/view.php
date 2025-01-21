<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Permintaan Harga'=>array('index'),
	$model->id,
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Show Permintaan Harga #<?php echo CHtml::encode(CHtml::value($model, 'id')); ?></h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php echo CHtml::link('Manage', array("admin"), array('class' => 'btn btn-info btn-sm')); ?>
            <?php echo CHtml::link('Edit', array("update", 'id' => $model->id), array('class' => 'btn btn-warning btn-sm')); ?>
        </div>
    </div>
</div>

<hr />

<table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <th>Nama Produk</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'product_name')); ?></td>
            <th>Tanggal Request</th>
            <td>
                <?php echo CHtml::encode(CHtml::value($model, 'request_date')); ?>
                <?php echo CHtml::encode(CHtml::value($model, 'request_time')); ?>
            </td>
        </tr>
        <tr>
            <th>Requested User</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'userIdRequest.username')); ?></td>
            <th>Note</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'request_note')); ?></td>
        </tr>
        <tr>
            <th>Branch</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'branchIdRequest.name')); ?></td>
            <th>Quantity</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'quantity')); ?></td>
        </tr>
        <tr>
            <th>Harga</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'recommended_price')); ?></td>
            <th>Replied User</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'userIdReplyeply.username')); ?></td>
        </tr>
        <tr>
            <th>Tanggal Reply</th>
            <td>
                <?php echo CHtml::encode(CHtml::value($model, 'reply_date')); ?>
                <?php echo CHtml::encode(CHtml::value($model, 'reply_time')); ?>
            </td>
            <th>Note</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'reply_note')); ?></td>
        </tr>
        <tr>
            <th>Branch</th>
            <td><?php echo CHtml::encode(CHtml::value($model, 'branchIdReply.name')); ?></td>
        </tr>
    </tbody>
</table>

<hr />

<div style="text-align: center">
    <h2>Uploaded Image</h2>
    <?php echo CHtml::image(Yii::app()->baseUrl . '/images/product_pricing_request/' . $model->extension, "image", array("width" => "30%")); ?>  
</div>