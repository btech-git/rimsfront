<div style="text-align: right">
    <?php echo ReportHelper::summaryText($registrationTransactionVehicleList->dataProviderBranch1); ?>
</div>

<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr class="table-primary">
                <th class="text-center" style="min-width: 150px">Plat #</th>
                <th class="text-center" style="min-width: 200px">Kendaraan</th>
                <th class="text-center" style="min-width: 100px">Warna</th>
                <th class="text-center" style="min-width: 100px">KM</th>
                <th class="text-center" style="min-width: 200px">Customer</th>
                <th class="text-center" style="min-width: 100px">Registration #</th>
                <th class="text-center" style="min-width: 150px">Tanggal</th>
                <th class="text-center" style="min-width: 100px">WO #</th>
                <th class="text-center" style="min-width: 100px">SL #</th>
                <th class="text-center" style="min-width: 100px">Invoice #</th>
                <th class="text-center" style="min-width: 100px">Payment #</th>
                <th class="text-center" style="min-width: 200px">Status</th>
                <th class="text-center" style="min-width: 200px">Lokasi</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($registrationTransactionVehicleList->dataProviderBranch1->data as $registrationTransaction): ?>
                <tr>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.plate_number')); ?></td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.carMake.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.carModel.name')); ?> -
                        <?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.carSubModel.name')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.color.name')); ?></td>
                    <td class="text-end">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($registrationTransaction, 'vehicle_mileage'))); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'customer.name')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'transaction_number')); ?></td>
                    <td>
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMM yyyy", CHtml::value($registrationTransaction, 'transaction_date'))); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'work_order_number')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'sales_order_number')); ?></td>
                    <td>
                        <?php $invoiceHeader = InvoiceHeader::model()->findByAttributes(array('registration_transaction_id' => $registrationTransaction->id)); ?>
                        <?php echo CHtml::encode(CHtml::value($invoiceHeader, 'invoice_number')); ?>
                    </td>
                    <td>
                        <?php $paymentInDetail = PaymentInDetail::model()->findByAttributes(array('invoice_header_id' => $invoiceHeader->id)); ?>
                        <?php echo CHtml::encode(CHtml::value($paymentInDetail, 'paymentIn.payment_number')); ?>
                    </td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'status')); ?></td>
                    <td><?php echo CHtml::encode(CHtml::value($registrationTransaction, 'vehicle.status_location')); ?></td>
                    <td>
                        <?php echo CHtml::link('update', array("updateLocation", "id" => $registrationTransaction->id, "vehicleId" => $registrationTransaction->vehicle_id), array('class' => 'btn btn-warning btn-sm')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end" id="registration-transaction-branch-1-data-pager">
        <?php $this->widget('system.web.widgets.pagers.CLinkPager', array(
            'pages' => $registrationTransactionVehicleList->dataProviderBranch1->pagination,
        )); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#registration-transaction-branch-1-data-pager ul.yiiPager > li > a').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                dataType: "HTML",
                url: "<?php echo CController::createUrl('ajaxHtmlUpdateRegistrationTransactionBranch1DataTable'); ?>&page_branch_1=" + $(this).attr('href').match(/[?&]page_branch_1=([0-9]+)/)[1],
                data: $("form").serialize(),
                success: function(data) {
                    $("#registration_transaction_branch_1_data_container").html(data);
                }
            });
        });
    });
</script>