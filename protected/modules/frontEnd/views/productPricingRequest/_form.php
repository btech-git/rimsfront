<div>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'employee-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
    )); ?>

    <div class="form">
        <?php echo CHtml::errorSummary($model); ?>

        <fieldset class="border border-secondary rounded mb-3 p-3">
            <legend class="float-none w-auto text-dark px-1">FORM PERMINTAAN HARGA</legend>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'product_name', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "product_name", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'product_name'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'quantity', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "quantity", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'quantity'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'request_note', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextArea($model, "request_note", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'request_note'); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <?php echo CHtml::label('New Image: ', FALSE); ?>
                    <?php echo CHtml::fileField('file'); ?>
                    <?php echo CHtml::error($model, 'file'); ?>
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
    
    <?php $this->endWidget(); ?>

</div>