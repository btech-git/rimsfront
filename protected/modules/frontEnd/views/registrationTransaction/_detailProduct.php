<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th style="width: 15%">Code</th>
                <th>Product</th>
                <th style="width: 5%">Quantity</th>
                <th style="width: 15%">Harga Satuan</th>
                <th style="width: 15%">Total</th>
                <th style="width: 5%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrationTransaction->productDetails as $i => $productDetail): ?>
                <?php $productInfo = Product::model()->findByPk($productDetail->product_id); ?>
                <?php echo CHtml::errorSummary($productDetail); ?>
                <tr>
                    <td>
                        <?php echo CHtml::activeHiddenField($productDetail, "[$i]product_id"); ?>
                        <?php echo CHtml::activeHiddenField($productDetail, "[$i]sale_estimation_product_detail_id"); ?>
                        <?php echo CHtml::encode(CHtml::value($productDetail, "product.manufacturer_code")); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode(CHtml::value($productDetail, "product.name")); ?>
                    </td>
                    <td>
                        <?php echo CHtml::activeTextField($productDetail, "[$i]quantity", array(
                            'class' => 'form-control',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'POST',
                                'dataType' => 'JSON',
                                'url' => CController::createUrl('ajaxJsonTotalProduct', array('id' => $registrationTransaction->header->id, 'index' => $i)),
                                'success' => 'function(data) {
                                    $("#total_price_product_' . $i . '").html(data.totalPriceProduct);
                                    $("#total_quantity_product").html(data.totalQuantityProduct);
                                    $("#sub_total_product").html(data.subTotalProduct);
                                    $("#sub_total_transaction").html(data.subTotalTransaction);
                                    $("#tax_total_transaction").html(data.taxTotalTransaction);
                                    $("#grand_total_transaction").html(data.grandTotalTransaction);
                                }',
                            )),
                        ));
                        ?>
                    </td>
                    <td>
                        <?php echo CHtml::activeTextField($productDetail, "[$i]sale_price", array(
                            'onchange' => CHtml::ajax(array(
                                'type' => 'POST',
                                'dataType' => 'JSON',
                                'url' => CController::createUrl('ajaxJsonTotalProduct', array('id' => $registrationTransaction->header->id, 'index' => $i)),
                                'success' => 'function(data) {
                                    $("#total_price_product_' . $i . '").html(data.totalPriceProduct);
                                    $("#total_quantity_product").html(data.totalQuantityProduct);
                                    $("#sub_total_product").html(data.subTotalProduct);
                                    $("#sub_total_transaction").html(data.subTotalTransaction);
                                    $("#tax_total_transaction").html(data.taxTotalTransaction);
                                    $("#grand_total_transaction").html(data.grandTotalTransaction);
                                }',
                            )),
                            'class' => "form-control",
                        )); ?>
                    </td>
                    <td class="text-end">
                        <?php echo CHtml::activeHiddenField($productDetail, "[$i]total_price", array('readonly' => true,)); ?>
                        <span id="total_price_product_<?php echo $i; ?>">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($productDetail, 'total_price'))); ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($registrationTransaction->header->isNewRecord): ?>
                            <?php echo CHtml::button('X', array(
                                'class' => "btn btn-outline-dark",
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveProductDetail', array('id' => $registrationTransaction->header->id, 'index' => $i)),
                                    'update' => '#detail-product',
                                )),
                            )); ?>
                        <?php else: ?>
                            <?php echo CHtml::button('X', array(
                                'class' => "btn btn-danger",
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveProductDetail', array('id' => $registrationTransaction->header->id, 'index' => $i)),
                                    'update' => '#detail-product',
                                )),
                            )); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        Kategori: <?php echo CHtml::encode(CHtml::value($productInfo, "masterSubCategoryCode")); ?> ||
                        Brand: <?php echo CHtml::encode(CHtml::value($productInfo, "brand.name")); ?> ||
                        Sub Brand: <?php echo CHtml::encode(CHtml::value($productInfo, "subBrand.name")); ?> ||
                        Sub Brand Series: <?php echo CHtml::encode(CHtml::value($productInfo, "subBrandSeries.name")); ?> 
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end fw-bold" colspan="2">Total Quantity</td>
                <td class="text-end fw-bold">
                    <span id="total_quantity_product">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format("#,##0", CHtml::value($registrationTransaction->header,'total_product'))); ?>                                                
                    </span>
                </td>
                <td class="text-end fw-bold">Total Produk</td>
                <td class="text-end fw-bold">
                    <span id="sub_total_product">
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format("#,##0", CHtml::value($registrationTransaction->header, 'subtotal_product'))); ?>                                                
                    </span>
                </td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
