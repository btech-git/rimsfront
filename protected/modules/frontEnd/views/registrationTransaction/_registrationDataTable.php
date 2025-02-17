<div style="text-align: right">
    <?php echo ReportHelper::summaryText($dataProvider); ?>
</div>

<div class="table-responsive">
    <?php echo CHtml::beginForm(); ?>
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr class="table-primary">
                <th style="min-width: 200px">Transaction #</th>
                <th style="min-width: 150px">Tanggal</th>
                <th style="min-width: 250px">Customer</th>
                <th style="min-width: 150px">Plat #</th>
                <th style="min-width: 250px">Mobil Tipe</th>
                <th style="min-width: 100px">GR/BR</th>
                <th style="min-width: 150px">Asuransi</th>
                <th style="min-width: 150px">WO #</th>
                <th style="min-width: 150px">SO #</th>
                <th style="min-width: 150px">Invoice</th>
                <th style="min-width: 150px">Problem</th>
                <th style="min-width: 150px">Sales</th>
                <th style="min-width: 100px">Status</th>
                <th style="min-width: 90px"></th>
            </tr>
            <tr class="table-light">
                <th>
                    <?php echo CHtml::activeTextField($model, 'transaction_number', array(
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
                    <?php echo CHtml::activeDropDownList($model, 'repair_type', array(
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
                <th>
                    <?php echo CHtml::activeDropDownlist($model, 'insurance_company_id', CHtml::listData(InsuranceCompany::model()->findAll(), "id", "name"), array(
                        'class' => 'form-control',
                        "empty" => "--Pilih Asuransi--"
                    )); ?>
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>
                    <?php echo CHtml::activeDropDownlist($model, 'employee_id_sales_person', CHtml::listData(Employee::model()->findAllByAttributes(array(
                        "position_id" => 2,
                    )), "id", "name"), array(
                        'class' => 'form-control',
                        "empty" => "--Salesman--"
                    )); ?>
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->data as $data): ?>
                <tr>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'transaction_number')); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMM yyyy", CHtml::value($data, 'transaction_date'))); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'customer.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'vehicle.plate_number')); ?></td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carMake.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carModel.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($data, 'vehicle.carSubModel.name')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'repair_type')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'insuranceCompany.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'work_order_number')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'sale_order_number')); ?></td>
                    <td>
                        <?php $invoiceHeader = InvoiceHeader::model()->findByAttributes(array(), array(
                            'condition' => "status NOT LIKE '%CANCEL%' AND t.registration_transaction_id = :registration_transaction_id",
                            'params' => array(':registration_transaction_id' => $data->id),
                        )); ?>
                        <?php echo CHtml::encode(CHtml::value($invoiceHeader, 'invoice_number')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'problem')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'employeeIdSalesPerson.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($data, 'status')); ?></td>
                    <td>
                        <?php echo CHtml::link('<i class="bi-search"></i>', array("view", "id" => $data->id), array('class' => 'btn btn-info btn-sm')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo CHtml::endForm(); ?>
</div>

<div class="text-end">
    <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
        'pages' => $dataProvider->pagination,
    )); ?>
</div>