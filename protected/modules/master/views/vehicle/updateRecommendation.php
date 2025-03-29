<?php
$this->breadcrumbs = array(
    'Vehicle' => array('admin'),
    $model->id,
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Show Vehicle #<?php echo CHtml::encode(CHtml::value($model, 'id')); ?></h4>
    </div>
</div>

<hr />
<div>
<?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Mesin #</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'machine_number')); ?></td>
                <th>Plat #</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'vehicle.plate_number')); ?></td>
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
                <th>Customer</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.name')); ?></td>
                <th>Warna</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'colors.name')); ?></td>
            </tr>
            <tr>
                <th>Customer Type</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'customer.customer_type')); ?></td>
                <th>Tahun</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'year')); ?></td>
            </tr>
            <tr>
                <th>Asuransi</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'insuranceCompany.name')); ?></td>
                <th>Chasis</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'chasis_code')); ?></td>
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
                <th>Lokasi</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'status_location')); ?></td>
                <th>Note</th>
                <td><?php echo CHtml::encode(CHtml::value($model, 'notes')); ?></td>
            </tr>
        </tbody>
    </table>

    <hr />

    <table class="table table-bordered table-responsive">
        <tbody>
            <tr>
                <td>Kondisi Awal</td>
                <td>Rekomendasi Awal</td>
            </tr>
            <tr>
                <td><?php echo CHtml::encode(CHtml::value($conditionRecommendation, 'initial_condition')); ?></td>
                <td><?php echo CHtml::encode(CHtml::value($conditionRecommendation, 'initial_recommendation')); ?></td>
            </tr>
            <tr>
                <td>Kondisi Akhir</td>
                <td>Rekomendasi Akhir</td>
            </tr>
            <tr>
                <td><?php echo CHtml::textArea('FinalCondition', $finalCondition, array('class' => 'form-control',)); ?></td>
                <td><?php echo CHtml::textArea('FinalRecommendation', $finalRecommendation, array('class' => 'form-control',)); ?></td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td><?php echo CHtml::activeTextArea($conditionRecommendation,'note', array('class' => 'form-control',)); ?></td>
            </tr>
        </tbody>
    </table>
    
    <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn btn-success')); ?>
    <?php echo IdempotentManager::generate(); ?>
</div>