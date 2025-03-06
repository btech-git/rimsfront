<?php echo CHtml::beginForm(); ?>
    <div class="row d-print-none">
        <div class="col d-flex justify-content-start">
            <h4>Data Permintaan Harga</h4>
        </div>
        <div class="col d-flex justify-content-end">
            <div class="d-gap">
                <?php echo CHtml::link('Add', array("create"), array('class' => 'btn btn-success btn-sm')); ?>
            </div>
        </div>
    </div>

    <hr />

    <div id="customer_data_container">
        <div style="text-align: right">
            <?php echo ReportHelper::summaryText($dataProvider); ?>
        </div>

        <div class="table-responsive" id="vehicle-data-grid">
            <table class="table table-sm table-bordered table-hover" id="vehicle-data-table">
                <thead>
                    <tr class="table-primary">
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">Produk</th>
                        <th style="text-align: center">Tanggal</th>
                        <th style="text-align: center">Quantity</th>
                        <th style="text-align: center">User Request</th>
                        <th style="text-align: center">Note Request</th>
                        <th style="text-align: center">Branch Request</th>
                        <th style="text-align: center">Tanggal Reply</th>
                        <th style="text-align: center">Recommended Price</th>
                        <th style="text-align: center">User Reply</th>
                        <th style="text-align: center">Note Reply</th>
                        <th style="text-align: center">Branch Reply</th>
                        <th style="width: 8%"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($dataProvider->data as $model): ?>
                        <tr>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'id')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'product_name')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'request_date')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'quantity')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'userIdRequest.username')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'request_note')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'branchIdRequest.code')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'reply_date')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'recommended_price')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'userIdReply.username')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'reply_note')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($model, 'branchIdReply.code')); ?></td>
                            <td>
                                <?php echo CHtml::link('<i class="bi-search"></i>', array("view", "id" => $model->id), array('class' => 'btn btn-info btn-sm')); ?>
                                <?php echo CHtml::link('<i class="bi-pencil"></i>', array("update", "id" => $model->id), array('class' => 'btn btn-warning btn-sm')); ?>
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
        </div>
    </div>
<?php echo CHtml::endForm(); ?>