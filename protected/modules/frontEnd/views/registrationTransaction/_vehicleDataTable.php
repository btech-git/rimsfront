<div style="text-align: right">
    <?php echo ReportHelper::summaryText($vehicleDataProvider); ?>
</div>

<div class="table-responsive" id="vehicle-data-grid">
    <table class="table table-sm table-bordered table-hover" id="vehicle-data-table">
        <thead>
            <tr class="table-primary">
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Plat #</th>
                <th style="text-align: center">Kendaraan</th>
                <th style="text-align: center">Warna</th>
                <th style="text-align: center">KM</th>
                <th style="text-align: center">Customer</th>
                <th style="text-align: center">Tipe</th>
                <th style="text-align: center">Status</th>
                <th style="width: 6%"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($vehicleDataProvider->data as $vehicle): ?>
                <tr>
                    <td><?php echo CHtml::encode(CHtml::value($vehicle, 'id')); ?></td>
                    <td><?php echo CHtml::link($vehicle->plate_number, array("/master/vehicle/view", "id"=>$vehicle->id), array("target" => "_blank")); ?></td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($vehicle, 'carMake.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($vehicle, 'carModel.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($vehicle, 'carSubModel.name')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($vehicle, 'color.name')); ?></td>
                    <td class="text-end">
                        <?php $registrationTransaction = RegistrationTransaction::model()->findByAttributes(array('vehicle_id' => $vehicle->id), array('order' => 'id DESC')); ?>
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle_mileage')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($vehicle, 'customer.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($vehicle, 'customer.customer_type')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($vehicle, 'status_location')); ?></td>
                    <td><?php echo CHtml::link('<i class="bi-plus"></i> Masuk', array("entryVehicle", "vehicleId" => $vehicle->id), array('class' => 'btn btn-success btn-sm')); ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end">
        <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
            'pages' => $vehicleDataProvider->pagination,
        )); ?>
    </div>
</div>