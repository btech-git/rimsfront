<div>
    <?php echo CHtml::beginForm(array(), 'POST'); ?>
    
    <div class="form">
        <?php echo CHtml::errorSummary($model); ?>

        <fieldset class="border border-secondary rounded mb-3 p-3">
            <legend class="float-none w-auto text-dark px-1">FORM KENDARAAN</legend>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'plate_number', array('class' => 'form-label')); ?>
                    <div class="row">
                        <div class="col">
                            <?php echo CHtml::activeDropDownlist($model, "plate_number_prefix_id", CHtml::listData(VehiclePlateNumberPrefix::model()->findAll(array('order'=>'code')),'id','code'),  array(
                                'prompt' => '[--Select Code--]',
                                'class' => 'form-control',
                            )); ?>
                            <?php echo CHtml::error($model, 'plate_number_prefix_id'); ?>
                        </div>
                        <div class="col">
                            <?php echo CHtml::activeTextField($model, "plate_number_ordinal", array('class' => 'form-control',)); ?>
                            <?php echo CHtml::error($model, 'plate_number_ordinal'); ?>
                        </div>
                        <div class="col">
                            <?php echo CHtml::activeTextField($model, "plate_number_suffix", array('style' => 'text-transform: uppercase', 'class' => 'form-control',)); ?>
                            <?php echo CHtml::error($model, 'plate_number_suffix'); ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'year', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "year", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'year'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'customer_id', array('class' => 'form-label', 'label' => 'Customer')); ?>
                    <?php echo CHtml::activeHiddenField($model, 'customer_id'); ?>
                    <?php echo CHtml::activeTextField($model, 'customer_name', array(
                        'class' => 'form-control readonly-form-input', 
                        'readonly' => true,
                        'onclick' => '$("#customer-dialog").dialog("open"); return false;',
                        'onkeypress' => 'if (event.keyCode == 13) { $("#customer-dialog").dialog("open"); return false; }',
                        'value' => $model->customer_id != Null ? $model->customer->name : '',
                    )); ?>
                    <?php echo CHtml::error($model,'customer_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'color_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'color_id', CHtml::listData(Colors::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Color--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'color_id'); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col" id="customer_pic">
                    <?php echo CHtml::label('PIC', false, array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'customer_pic_id', CHtml::listData(CustomerPic::model()->findAll(array('condition' => 'status = "Active"', 'order' => 'name ASC')), 'id', 'name'), array(
                        'prompt' => '[--Select PIC--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'customer_pic_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'transmission', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'transmission', array(
                        'Manual' => 'Manual', 
                        'Automatic' => 'Automatic',
                    ), array(
                        'prompt' => '[--Select Transmisi--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'transmission'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'car_make_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'car_make_id', CHtml::listData(VehicleCarMake::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Car Make--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'car_make_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'frame_number', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "frame_number", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'frame_number'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'car_model_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'car_model_id', CHtml::listData(VehicleCarModel::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Car Model--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'car_model_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'machine_number', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "machine_number", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'machine_number'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'car_sub_model_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'car_sub_model_id', CHtml::listData(VehicleCarSubModel::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Car Sub Model--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'car_sub_model_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'chasis_code', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "chasis_code", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'chasis_code'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'car_sub_model_detail_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'car_sub_model_detail_id', CHtml::listData(VehicleCarSubModelDetail::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Car Sub Model Detail--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'car_sub_model_detail_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'fuel_type', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'fuel_type', array(
                        'Gasoline' => 'Gasoline', 
                        'Diesel' => 'Diesel',
                    ), array(
                        'prompt' => '[--Select Fuel--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'fuel_type'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'insurance_company_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'insurance_company_id', CHtml::listData(InsuranceCompany::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Asuransi--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'insurance_company_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'power', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "power", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'power'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'notes', array('class' => 'form-label', 'label' => 'Catatan')); ?>
                    <?php echo CHtml::activeTextArea($model,'notes',array('rows'=>3, 'cols'=>30, 'class' => 'form-control')); ?>
                    <?php echo CHtml::error($model, 'notes'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'drivetrain', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "drivetrain", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'drivetrain'); ?>
                </div>
            </div>
        </fieldset>

        <div class="d-grid">
            <div class="row">
                <div class="col text-center">
                    <?php echo CHtml::submitButton('Cancel', array('name' => 'Cancel', 'confirm' => 'Are you sure you want to cancel?', 'class'=>'btn btn-danger')); ?>
                    <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class'=>'btn btn-success')); ?>
                </div>
            </div>
            <?php echo IdempotentManager::generate(); ?>
        </div>
    </div>
    
    <?php echo CHtml::endForm(); ?>
</div>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'customer-dialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Customer',
        'autoOpen' => false,
        'width' => 'auto',
        'modal' => true,
    ),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'customer-grid',
    'dataProvider' => $customerDataProvider,
    'filter' => $customer,
    'selectionChanged' => 'js:function(id){
        $("#' . CHtml::activeId($model, 'customer_id') . '").val($.fn.yiiGridView.getSelection(id));
        $("#customer-dialog").dialog("close");
        if ($.fn.yiiGridView.getSelection(id) == "") {
            $("#' . CHtml::activeId($model, 'customer_name') . '").val("");
        } else {
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "' . CController::createUrl('ajaxJsonCustomer', array('id' => '')) . '" + $.fn.yiiGridView.getSelection(id),
                data: $("form").serialize(),
                success: function(data) {
                    $("#' . CHtml::activeId($model, 'customer_name') . '").val(data.customer_name);
                },
            });
        }
    }',
    'columns' => array(
        array(
            'name' => 'id',
            'value' => 'CHtml::encode(CHtml::value($data, "id"))',
        ),
        array(
            'name' => 'name',
            'value' => 'CHtml::encode(CHtml::value($data, "name"))',
        ),
        array(
            'name' => 'customer_type',
            'value' => 'CHtml::encode(CHtml::value($data, "customer_type"))',
        ),
        array(
            'name' => 'email',
            'value' => 'CHtml::encode(CHtml::value($data, "email"))',
        ),
        array(
            'name' => 'address',
            'value' => 'CHtml::encode(CHtml::value($data, "address"))',
        ),
    )
)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
