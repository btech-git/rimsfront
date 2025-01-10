<div style="text-align: right">
    <?php echo ReportHelper::summaryText($dataProvider); ?>
</div>

<div class="table-responsive">
    <?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="table-primary">
                <th style="min-width: 200px">
                    Invoice #
                </th>
                <th style="min-width: 150px">
                    Tanggal
                </th>
                <th style="min-width: 150px" >
                    Jatuh Tempo
                </th>
                <th style="min-width: 250px">
                    Customer
                </th>
                <th style="min-width: 150px" >
                    Plat #
                </th>
                <th style="min-width: 250px">
                    Mobil Tipe
                </th>
                <th style="min-width: 150px">
                    Asuransi
                </th>
                <th style="min-width: 100px">
                    Status
                </th>
                <th style="min-width: 90px"></th>
            </tr>
            <tr class="table-light">
                <th>
                    <?php echo CHtml::activeTextField($model, 'invoice_number', array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateInvoiceTable'),
                            'update' => '#invoice_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
                <th></th>
                <th>
                    <?php echo CHtml::textField('CustomerName', $customerName, array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateInvoiceTable'),
                            'update' => '#invoice_data_container',
                        )),
                    )); ?>
                </th>
                <th>
                    <?php echo CHtml::textField('PlateNumber', $plateNumber, array(
                        'class' => 'form-control',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateInvoiceTable'),
                            'update' => '#invoice_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
                <th>
                    <?php echo CHtml::activeDropDownlist($model, 'insurance_company_id', CHtml::listData(InsuranceCompany::model()->findAll(), "id", "name"), array(
                        'class' => 'form-control',
                        "empty" => "--Pilih Asuransi--",
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateInvoiceTable'),
                            'update' => '#invoice_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->data as $data): ?>
                <tr id="sale_estimation_data_container">
                    <td><?php echo CHtml::encode(CHtml::value($data, 'invoice_number')); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($data, 'invoice_date'))); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($data, 'due_date'))); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'customer.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'vehicle.plate_number')); ?></td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carMake.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carModel.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carSubModel.name')); ?>
                    </td>
                    <td class="text-end"><?php echo CHtml::encode(CHtml::value($data, 'insuranceCompany.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'status')); ?></td>
                    <td>
                        <?php echo CHtml::link('<i class="bi-search"></i>', array("view", "id" => $data->id), array('class' => 'btn btn-info btn-sm')); ?>
                        <?php //echo CHtml::link('<i class="bi-pencil"></i>', array("update", "id" => $data->id), array('class' => 'btn btn-warning btn-sm')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end">
        <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
            'pages' => $dataProvider->pagination,
        )); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>