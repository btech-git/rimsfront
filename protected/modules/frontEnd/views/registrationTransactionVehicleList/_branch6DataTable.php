<div style="text-align: right">
    <?php echo ReportHelper::summaryText($registrationTransactionVehicleList->dataProviderBranch6); ?>
</div>

<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr class="table-primary">
                <th style="text-align: center">Plat #</th>
                <th style="text-align: center">Kendaraan</th>
                <th style="text-align: center">Warna</th>
                <th style="text-align: center">Registration #</th>
                <th style="text-align: center">Tanggal</th>
                <th style="text-align: center">KM</th>
                <th style="text-align: center">Customer</th>
                <th style="text-align: center">Status</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($registrationTransactionVehicleList->dataProviderBranch6->data as $registrationTransaction): ?>
                <tr>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.plate_number')); ?></td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.carMake.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.carModel.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.carSubModel.name')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.color.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'transaction_number')); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMM yyyy", CHtml::value($registrationTransaction, 'transaction_date'))); ?></td>
                    <td class="text-end">
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle_mileage')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'customer.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.status_location')); ?></td>
                    <td>
                        <?php echo CHtml::link('update', array("updateLocation", "id" => $registrationTransaction->id, "vehicleId" => $registrationTransaction->vehicle_id), array('class' => 'btn btn-warning btn-sm')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end" id="registration-transaction-branch-6-data-pager">
        <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
            'pages' => $registrationTransactionVehicleList->dataProviderBranch6->pagination,
        )); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#registration-transaction-branch-6-data-pager ul.yiiPager > li > a').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                dataType: "HTML",
                url: "<?php echo CController::createUrl('ajaxHtmlUpdateRegistrationTransactionBranch6DataTable'); ?>&page_branch_6=" + $(this).attr('href').match(/[?&]page_branch_6=([0-9]+)/)[1],
                data: $("form").serialize(),
                success: function(data) {
                    $("#registration_transaction_branch_6_data_container").html(data);
                }
            });
        });
    });
</script>
