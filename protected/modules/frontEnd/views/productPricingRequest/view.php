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
            <td>Nama Produk</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'product_name')); ?></td>
            <td>Quantity</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'quantity')); ?></td>
        </tr>
        <tr>
            <td>Car Make</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'vehicleCarMake.name')); ?></td>
            <td>Car Model</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'vehicleCarModel.name')); ?></td>
        </tr>
        <tr>
            <td>Merk</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'brand.name')); ?></td>
            <td>Sub Brand</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'subBrand.name')); ?></td>
        </tr>
        <tr>
            <td>Sub Brand Series</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'subBrandSeries.name')); ?></td>
            <td>Kategori</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'productMasterCategory.name')); ?></td>
        </tr>
        <tr>
            <td>Sub Master Kategori</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'productSubMasterCategory.name')); ?></td>
            <td>Sub Kategori</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'productSubCategory.name')); ?></td>
        </tr>
        <tr>
            <td>Produksi Tahun</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'production_year')); ?></td>
            <td>Harga</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'recommended_price')); ?></td>
        </tr>
        <tr>
            <td>Tanggal Request</td>
            <td>
                <?php echo CHtml::encode(CHtml::value($model, 'request_date')); ?>
                <?php echo CHtml::encode(CHtml::value($model, 'request_time')); ?>
            </td>
            <td>Tanggal Reply</td>
            <td>
                <?php echo CHtml::encode(CHtml::value($model, 'reply_date')); ?>
                <?php echo CHtml::encode(CHtml::value($model, 'reply_time')); ?>
            </td>
        </tr>
        <tr>
            <td>Requested User</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'userIdRequest.username')); ?></td>
            <td>Replied User</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'userIdReply.username')); ?></td>
        </tr>
        <tr>
            <td>Branch Request</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'branchIdRequest.name')); ?></td>
            <td>Branch Reply</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'branchIdReply.name')); ?></td>
        </tr>
        <tr>
            <td>Note</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'request_note')); ?></td>
            <td>Note</td>
            <td><?php echo CHtml::encode(CHtml::value($model, 'reply_note')); ?></td>
        </tr>
    </tbody>
</table>

<hr />

<div style="text-align: center">
    <h2>Uploaded Image</h2>
    <?php echo CHtml::image(Yii::app()->baseUrl . '/images/product_pricing_request/' . $model->id . '.' . $model->extension, "image", array("width" => "30%")); ?>  
</div>