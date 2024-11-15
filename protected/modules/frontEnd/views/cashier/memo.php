<?php
Yii::app()->clientScript->registerCss('memo', '
    @page {
        size:auto;
        margin: 5px 0px 0px 0px;
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

    <div class="note">
        <div class="table full">
            <div class="cell col">
                <div class="table full">
                    <div class="row">
                        <div class="cell label" style="min-width: 60px">Bank</div>
                        <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'companyBank.bank.name')); ?></div>
                    </div>
                    <div class="row">
                        <div class="cell label" style="min-width: 60px">Payment</div>
                        <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'paymentType.name')); ?></div>
                    </div>
                    <div class="row">
                        <div class="cell label">Asuransi</div>
                        <div class="cell value">
                            <?php echo CHtml::encode(CHtml::value($model, 'insuranceCompany.name')); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell col">
                <div class="table full">
                    <div class="row">
                        <div class="cell label">Plat #</div>
                        <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'vehicle.plate_number')); ?></div>
                    </div>
                    <div class="row">
                        <div class="cell label">Customer</div>
                        <div class="cell value"><?php echo CHtml::encode(CHtml::value($model, 'customer.name')); ?></div>
                    </div>
                    <div class="row">
                        <div class="cell label" style="min-width: 130px">Invoice #</div>
                        <div class="cell value" style="min-width: 100px"><?php echo CHtml::encode(CHtml::value($model, 'payment_number')); ?></div>
                    </div>
                    <div class="row">
                        <div class="cell label">Tanggal Invoice</div>
                        <div class="cell value">
                            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMM yyyy", CHtml::value($model, 'payment_date'))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br /><br /><br /><br /><br />

    <table class="detail">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Asuransi</th>
                <th>Memo</th>
                <th>Total Invoice</th>
                <th>Pph</th>
                <th>Jumlah Bayar</th>
            </tr>
        </thead>
        <?php foreach ($model->paymentInDetails as $i => $detail): ?>
            <tr class="titems">
                <td><?php echo CHTml::encode(CHtml::value($detail, 'invoiceHeader.invoice_number')); ?></td>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.customer.name')); ?></td>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.insuranceCompany.name')); ?></td>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total_invoice'))); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'tax_service_amount'))); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?></td>
            </tr>
        <?php endforeach; ?>
        <tfoot>
            <tr>
                <td style="text-align: right; font-weight: bold" colspan="6">Downpayment</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'downpayment_amount')), 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold" colspan="6">Diskon</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'discount_product_amount')), 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold" colspan="6">Beban Administrasi Bank</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'bank_administration_fee')), 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold" colspan="6">Beban Merimen</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'merimen_fee')), 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold" colspan="6">Total Payment</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'totalPayment')), 2); ?></td>
            </tr>
            <tr>
                <td style="text-align: right; font-weight: bold" colspan="6">Total Invoice</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format(CHtml::encode(CHtml::value($model, 'totalInvoice')), 2); ?></td>
            </tr>
        </tfoot>
    </table>

    <br />

    <div class="note" style="border: 1px solid; height: 40px">
        <div class="table full">
            <div class="row">
                <div class="cell label">Catatan</div>
                <div class="cell value">&nbsp;</div>
            </div>
        </div>
    </div>
</div>