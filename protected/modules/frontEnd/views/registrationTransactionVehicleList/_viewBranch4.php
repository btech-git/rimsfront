<?php echo CHtml::beginForm(); ?>
    <div class="row">
        <h2>Data Kendaraan</h2>
        <div class="col">
            <div class="my-2 row">
            <label class="col col-form-label">Tanggal</label>
                <div class="col">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'StartDate4',
                        'value' => $startDate4,
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-select',
                            'style'=>'margin-bottom:0px;',
                            'placeholder'=>'Date From',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTransactionBranch4DataTable'),
                                'update' => '#registration_transaction_branch_4_data_container',
                            )),
                        ),
                    )); ?>
                </div>
                <div class="col">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'EndDate4',
                        'value' => $endDate4,
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-select',
                            'style'=>'margin-bottom:0px;',
                            'placeholder'=>'Date To',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTransactionBranch4DataTable'),
                                'update' => '#registration_transaction_branch_4_data_container',
                            )),
                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <?php echo CHtml::submitButton('Hapus', array('name' => 'ResetFilter', 'class' => 'btn btn-danger'));  ?>
    </div>

    <hr />

    <div id="registration_transaction_branch_4_data_container">
        <?php $this->renderPartial('_branch4DataTable', array(
            'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
        )); ?>
    </div>
<?php echo CHtml::endForm(); ?>