<?php echo CHtml::beginForm(); ?>
    <div class="row">
        <h2>Data Kendaraan</h2>
        <div class="col">
            <div class="my-2 row">
            <label class="col col-form-label">Tanggal</label>
                <div class="col">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'StartDate2',
                        'value' => $startDate2,
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-select',
                            'style'=>'margin-bottom:0px;',
                            'placeholder'=>'Date From',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTransactionBranch2DataTable'),
                                'update' => '#registration_transaction_branch_2_data_container',
                            )),
                        ),
                    )); ?>
                </div>
                <div class="col">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'EndDate2',
                        'value' => $endDate2,
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-select',
                            'style'=>'margin-bottom:0px;',
                            'placeholder'=>'Date To',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateRegistrationTransactionBranch2DataTable'),
                                'update' => '#registration_transaction_branch_2_data_container',
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

    <div id="registration_transaction_branch_2_data_container">
        <?php $this->renderPartial('_branch2DataTable', array(
            'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
        )); ?>
    </div>
<?php echo CHtml::endForm(); ?>