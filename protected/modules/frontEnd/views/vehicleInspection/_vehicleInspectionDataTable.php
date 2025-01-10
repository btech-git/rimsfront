<div style="text-align: right">
    <?php echo ReportHelper::summaryText($registrationTransactionDataProvider); ?>
</div>

<div class="table-responsive">
    <?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="table-primary">
                <th style="width: 10%">
                    Plat #
                </th>
                <th style="width: 15%">
                    Mobil Tipe
                </th>
                <th style="width: 15%">
                    Registration #
                </th>
                <th style="width: 15%" >
                    Tanggal
                </th>
                <th>
                    Customer
                </th>
                <th style="width: 5%">
                    GR/BR
                </th>
                <th style="width: 15%">
                    Inspeksi
                </th>
                <th style="width: 7%"></th>
            </tr>
            <tr class="table-light">
                <th>
                    <?php echo CHtml::textField('PlateNumber', $plateNumber, array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTable'),
                            'update' => '#registration_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
                <th>
                    <?php echo CHtml::activeTextField($registrationTransaction, 'transaction_number', array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTable'),
                            'update' => '#registration_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
                <th>
                    <?php echo CHtml::textField('CustomerName', $customerName, array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTable'),
                            'update' => '#registration_data_container',
                        )),
                    )); ?>
                </th>
                <th>
                    <?php echo CHtml::activeDropDownList($registrationTransaction, 'repair_type', array(
                        '' => '-- All --',
                        'GR' => 'GR',
                        'BR' => 'BR',
                    ), array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTable'),
                            'update' => '#registration_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrationTransactionDataProvider->data as $data): ?>
                <tr id="vehicle_inspection_data_container">
                    <td><?php echo CHtml::encode(CHtml::value($data, 'vehicle.plate_number')); ?></td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carMake.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carModel.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carSubModel.name')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'transaction_number')); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($data, 'transaction_date'))); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'customer.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'repair_type')); ?></td>
                    <td>
                        <?php $vehicleInspections = VehicleInspection::model()->findAllByAttributes(array('work_order_number' => $data->work_order_number)); ?>
                        <?php foreach ($vehicleInspections as $vehicleInspection): ?>
                            <?php echo CHtml::encode(CHtml::value($vehicleInspection, 'inspection.name')); ?>
                            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($vehicleInspection, 'inspection_date'))); ?>
                            <?php echo CHtml::encode(CHtml::value($vehicleInspection, 'status')); ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php echo CHtml::link('<i class="bi-plus"></i> Inspect', array("create", "registrationId" => $data->id), array('class' => 'btn btn-success btn-sm')); ?>
                        <?php //echo CHtml::link('<i class="bi-pencil"></i>', array("update", "id" => $data->id), array('class' => 'btn btn-warning btn-sm')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php echo CHtml::endForm(); ?>
</div>

<div class="text-end">
    <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
        'pages' => $registrationTransactionDataProvider->pagination,
    )); ?>
</div>