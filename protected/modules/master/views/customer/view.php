<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->name,
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Show Customer #<?php echo CHtml::encode(CHtml::value($model, 'id')); ?></h4>
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
                <th>Nama</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'name')); ?></td>
                <th>Alamat</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'address')); ?></td>
            </tr>
            <tr>
                <th>Propinsi</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'province.name')); ?></td>
                <th>Kota</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'city.name')); ?></td>
            </tr>
            <tr>
                <th>Kode Pos</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'zipcode')); ?></td>
                <th>HP #</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'mobile_phone')); ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'phone')); ?></td>
                <th>Fax</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'fax')); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'email')); ?></td>
                <th>Type</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer_type')); ?></td>
            </tr>
            <tr>
                <th>Payment Type</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'default_payment_type')); ?></td>
                <th>Tenor (hari)</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'tenor')); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'status')); ?></td>
                <th>Tanggal Lahir</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'birthdate')); ?></td>
            </tr>
            <tr>
                <th>Flat Rate</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'flat_rate')); ?></td>
                <th>COA Piutang</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'coa.name')); ?></td>
            </tr>
            <tr>
                <th>Tanggal Input</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'date_created')); ?></td>
                <th>Tanggal Approval</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'date_approval')); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'is_approved')); ?></td>
                <th>Diinput oleh</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'user.username')); ?></td>
            </tr>
            <tr>
                <th>Note</th>
                <td colspan="3"><?php echo CHtml::encode(CHtml::value($model, 'note')); ?></td>
            </tr>
        </tbody>
    </table>
<?php echo CHtml::endForm(); ?>

<fieldset class="border border-secondary rounded mb-3 p-3">
    <legend class="float-none w-auto text-dark px-1">Vehicle List</legend>
    <div class="row">
        <div class="col">
            <?php $this->renderPartial('_infoVehicle', array(
                'model' => $model,
            )); ?>  
        </div>
    </div>
</fieldset>

<fieldset class="border border-secondary rounded mb-3 p-3">
    <legend class="float-none w-auto text-dark px-1">History Data Transaksi</legend>
    <div class="row">
        <div class="col">
            <?php $this->renderPartial('_infoHistory', array(
                'model' => $model,
            )); ?>  
        </div>
    </div>
</fieldset>