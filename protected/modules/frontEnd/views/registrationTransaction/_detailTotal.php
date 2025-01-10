<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th class="text-end fw-bold">Sub Total</th>
                <th class="text-end fw-bold" style="width: 15%">
                    <span id="sub_total_transaction">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format("#,##0", CHtml::value($registrationTransaction->header, 'subtotal'))); ?>                                                
                    </span>
                </th>
            </tr> 
            <tr>
                <th class="text-end fw-bold">Total Diskon</th>
                <th class="text-end fw-bold" style="width: 15%">
                    <span id="total_discount">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format("#,##0", CHtml::value($registrationTransaction->header, 'totalDiscount'))); ?>                                                
                    </span>
                </th>
            </tr> 
            <tr>
                <th class="text-end fw-bold">
                    Ppn
                    <?php echo CHtml::activeDropDownList($registrationTransaction->header, 'tax_percentage', array(
                        0 => 'Non PPn',
                        11 => 11,
                    ), array(
                        'onchange' => CHtml::ajax(array(
                            'type' => 'POST',
                            'dataType' => 'JSON',
                            'url' => CController::createUrl('ajaxJsonGrandTotal', array('id' => $registrationTransaction->header->id)),
                            'success' => 'function(data) {
                                $("#tax_total_transaction").html(data.taxTotalTransaction);
                                $("#grand_total_transaction").html(data.grandTotalTransaction);
                            }',
                        )),
                    )); ?>
                </th>
                <th class="text-end fw-bold">
                    <span id="tax_total_transaction">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format("#,##0", CHtml::value($registrationTransaction->header, 'ppn_price'))); ?>                                                
                    </span>
                </th>
            </tr>
            <tr>
                <th class="text-end fw-bold">Grand Total</th>
                <th class="text-end fw-bold">
                    <span id="grand_total_transaction">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format("#,##0", CHtml::value($registrationTransaction->header,'grand_total'))); ?>                                                
                    </span>
                </th>
            </tr>
        </thead>
    </table>
</div>
