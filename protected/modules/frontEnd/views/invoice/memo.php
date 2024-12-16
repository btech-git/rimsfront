<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo2.css');
Yii::app()->clientScript->registerCss('memo', '
    @page {
        size:auto;
        margin: 5px 0px 0px 0px;
    }
    @media print {
        div.memo { page-break-after: always }
    }
    .hcolumn1 { width: 50% }
    .hcolumn2 { width: 50% }

    .hcolumn1header { width: 35% }
    .hcolumn1value { width: 65% }
    .hcolumn2header { width: 35% }
    .hcolumn2value { width: 65% }

    .sig1 { width: 25% }
    .sig2 { width: 50% }
    .sig3 { width: 25% }
    
    .memo-title
    {
        margin-left:35%;
        font-size:9px;
    }
');
?>

<?php $groupSize = 2; ?>
<?php $itemCount = count($model->invoiceDetails); ?>
<?php $numberOfPages = intval($itemCount / $groupSize) + ($itemCount % $groupSize > 0 ? 1 : 0); ?>
<?php for ($n = 0; $n < $numberOfPages; $n++): ?>
    <div class="memo">
        <div class="note" style="visibility: hidden">
            <div class="table full">
                <div class="cell col">
                    <div class="table full">
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="cell col">
                    <div class="table full">
                        <div class="row">
                            <div class="cell label" style="color: blue; font-size: 14px">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div class="cell col">
                    <div class="table full">
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="cell label">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="header">
                <h1 class="title">&nbsp;</h1>
            </div>
        </div>

        <div class="note" style="visibility: <?php echo $n == 0 ? 'visible' : 'hidden'; ?>">
            <div class="table full">
                <div class="cell col">
                    <div class="table full">
                        <div class="row">
                            <div class="cell label" style="min-width: 60px">Invoice #</div>
                            <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'invoice_number')); ?></div>
                        </div>
                        <div class="row">
                            <div class="cell label">Tanggal</div>
                            <div class="cell value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($model, 'invoice_date'))); ?></div>
                        </div>
                        <div class="row">
                            <div class="cell label" style="min-width: 60px">Kendaraan</div>
                            <div class="cell value">
                                <?php echo CHtml::encode(CHtml::value($model, 'vehicle.carMake.name')); ?> -
                                <?php echo CHtml::encode(CHtml::value($model, 'vehicle.carModel.name')); ?> -
                                <?php echo CHtml::encode(CHtml::value($model, 'vehicle.carSubModel.name')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell col">
                    <div class="table full">
                        <div class="row">
                            <div class="cell label">Jatuh Tempo</div>
                            <div class="cell value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($model, 'due_date'))); ?></div>
                        </div>
                        <div class="row">
                            <div class="cell label">Customer</div>
                            <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'customer.name')); ?></div>
                        </div>
                        <div class="row">
                            <div class="cell label" style="min-width: 130px">Asuransi</div>
                            <div class="cell value" style="min-width: 100px"><?php echo CHtml::encode(CHtml::value($model, 'insuranceCompany.name')); ?></div>
                        </div>
                        <div class="row">
                            <div class="cell label">No Pol</div>
                            <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'vehicle.plate_number')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br /><br /><br /><br /><br />

        <table class="detail">
            <thead>
                <tr>
                    <th class="center" style="width: 5%">No.</th>
                    <th class="center">Deskripsi</th>
                    <th class="center" style="width: 10%">Quantity</th>
                    <th class="center" style="width: 15%">Unit Price</th>
                    <th class="center" style="width: 15%">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < $groupSize; $i++): ?>
                    <?php $index = $n * $groupSize + $i ?>
                    <?php if (!isset($model->invoiceDetails[$index])): ?>
                        <?php break; ?>
                    <?php endif; ?>
                    <?php $detail = $model->invoiceDetails[$index]; ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $index + 1; ?></td>
                        <td>
                            <?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?>
                            <?php echo CHtml::encode(CHtml::value($detail, 'service.name')); ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if (empty($detail->service_id)): ?>
                                <?php echo CHtml::encode(CHtml::value($detail, "quantity")); ?>
                            <?php else: ?>
                                <?php echo 1; ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, "unit_price"))); ?></td>
                        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, "total_price"))); ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
            <?php if ($n === $numberOfPages - 1): ?>
                <tfoot>
                    <tr>
                        <td style="text-align: right; font-weight: bold" colspan="4">Sub Total</td>
                        <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'subtotal')), 2); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold" colspan="4">Ppn</td>
                        <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'ppn_total')), 2); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right; font-weight: bold" colspan="4">Grand Total</td>
                        <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'total_price')), 2); ?></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
<?php endfor; ?>
