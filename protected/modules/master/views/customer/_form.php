<div>
    <?php echo CHtml::beginForm(array(), 'POST'); ?>
    
    <div class="form">
        <?php echo CHtml::errorSummary($model); ?>

        <fieldset class="border border-secondary rounded mb-3 p-3">
            <legend class="float-none w-auto text-dark px-1">FORM CUSTOMER</legend>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'name', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "name", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'name'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'email', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "email", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'email'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'customer_type', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'customer_type', array(
                        'Company' => 'Company', 
                        'Individual' => 'Individual',
                    ), array(
                        'prompt' => '[--Select Type--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'customer_type'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'phone', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "phone", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'phone'); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'flat_rate', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "flat_rate", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'flat_rate'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'mobile_phone', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "mobile_phone", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'mobile_phone'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php $range = range(10, 100, 5); ?>
                    <?php echo CHtml::activeLabelEx($model, 'tenor', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'tenor', array_combine($range, $range), array(
                        'prompt' => '[--Select Tenor--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'tenor'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'fax', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "fax", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'fax'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'birthdate', array('class' => 'form-label')); ?>
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => "birthdate",
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'changeMonth' => true,
                            'changeYear' => true,
                        ),
                        'htmlOptions' => array(
                            'readonly' => true,
                            'class' => 'form-control readonly-form-input',
                        ),
                    )); ?>
                    <?php echo CHtml::error($model, 'birthdate'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'zipcode', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "zipcode", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'zipcode'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'default_payment_type', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'default_payment_type', array(
                        '1' => 'Cash, Credit, Debit',
                        '2' => 'Down Payment',
                        '3' => 'Terms of Payment',
                    ), array(
                        'prompt' => '[--Select Payment Type--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'default_payment_type'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'city_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'city_id', CHtml::listData(City::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select City--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'city_id'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'status', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'status', array(
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                    ), array(
                        'prompt' => '[--Select Status--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'status'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'province_id', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'province_id', CHtml::listData(Province::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                        'prompt' => '[--Select Propinsi--]',
                        'class' => 'form-control',
                    )); ?>
                    <?php echo CHtml::error($model, 'province_id'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'note', array('class' => 'form-label', 'label' => 'Catatan')); ?>
                    <?php echo CHtml::activeTextArea($model,'note',array('class' => 'form-control')); ?>
                    <?php echo CHtml::error($model, 'note'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'address', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextArea($model, "address", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'address'); ?>
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