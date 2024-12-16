<table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <th>Nama</th>
            <td><?php echo CHtml::encode(CHtml::value($customer, 'name')); ?></td>
            <th>Kendaraan</th>
            <td>
                <?php echo CHtml::encode(CHtml::value($vehicleData, 'carMake.name')); ?> -
                <?php echo CHtml::encode(CHtml::value($vehicleData, 'carModel.name')); ?> -
                <?php echo CHtml::encode(CHtml::value($vehicleData, 'carSubModel.name')); ?>
            </td>
        </tr>
        <tr>
            <th>Perusahaan/Individual</th>
            <td><?php echo CHtml::encode(CHtml::value($customer, 'customer_type')); ?></td>
            <th>No Pol</th>
            <td><?php echo CHtml::encode(CHtml::value($vehicleData, 'plate_number')); ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?php echo CHtml::encode(CHtml::value($customer, 'address')); ?></td>
            <th>Mesin #</th>
            <td><?php echo CHtml::encode(CHtml::value($vehicleData, 'machine_number')); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo CHtml::encode(CHtml::value($customer, 'email')); ?></td>
            <th>Rangka #</th>
            <td><?php echo CHtml::encode(CHtml::value($vehicleData, 'frame_number')); ?></td>
        </tr>
        <tr>
            <th>Rate</th>
            <td><?php echo CHtml::encode(CHtml::value($customer, 'flat_rate')); ?></td>
            <th>Warna</th>
            <td>
                <?php $color = Colors::model()->findByPk($vehicleData->color_id); ?>
                <?php echo CHtml::encode(CHtml::value($color, 'name')); ?>
            </td>
        </tr>
        <tr>
            <th>Birth Date</th>
            <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy H:mm:s", CHtml::value($customer, 'birthdate'))); ?></td>
            <th>Tahun</th>
            <td><?php echo CHtml::encode(CHtml::value($vehicleData, 'year')); ?></td>
        </tr>
    </tbody>
</table>