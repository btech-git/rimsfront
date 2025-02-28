<div style="text-align: right">
    <?php echo ReportHelper::summaryText($registrationTransactionDataProvider); ?>
</div>

<div>
    <?php echo CHtml::beginForm(); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="table-primary">
                <th style="min-width: 200px">
                    Transaction #
                </th>
                <th style="min-width: 150px">
                    Tanggal
                </th>
                <th style="min-width: 350px">
                    Customer
                </th>
                <th style="min-width: 150px" >
                    Plat #
                </th>
                <th style="min-width: 250px">
                    Mobil Tipe
                </th>
                <th style="min-width: 100px">
                    GR/BR
                </th>
                <th style="min-width: 250px">
                    Asuransi
                </th>
                <th style="min-width: 250px">
                    Sales
                </th>
                <th style="min-width: 90px"></th>
            </tr>
            <tr class="table-light">
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
                    <?php echo CHtml::activeDropDownList($registrationTransaction, 'repair_type', array(
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
                    <?php echo CHtml::activeDropDownlist($registrationTransaction, 'insurance_company_id', CHtml::listData(InsuranceCompany::model()->findAll(), "id", "name"), array(
                        'class' => 'form-control',
                        "empty" => "--Pilih Asuransi--",
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTable'),
                            'update' => '#registration_data_container',
                        )),
                    )); ?>
                </th>
                <th>
                    <?php echo CHtml::activeDropDownlist($registrationTransaction, 'employee_id_sales_person', CHtml::listData(Employee::model()->findAllByAttributes(array(
                        "position_id" => 2,
                    )), "id", "name"), array(
                        'class' => 'form-control',
                        "empty" => "--Salesman--",
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTable'),
                            'update' => '#registration_data_container',
                        )),
                    )); ?>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrationTransactionDataProvider->data as $data): ?>
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
                    <td><?php echo CHtml::encode(CHtml::value($data, 'employeeIdSalesPerson.name')); ?></td>
                    <td>
                        <?php echo CHtml::link('<i class="bi-plus"></i> Add', array("create", "registrationId" => $data->id), array('class' => 'btn btn-success btn-sm')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end">
        <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
            'pages' => $registrationTransactionDataProvider->pagination,
        )); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
    <br /> 
</div>