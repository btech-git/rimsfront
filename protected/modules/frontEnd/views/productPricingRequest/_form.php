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
                    <?php echo CHtml::activeLabelEx($model, 'Nama Barang', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "product_name", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'product_name'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Untuk Kendaraan', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "vehicle_name", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'vehicle_name'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Merk', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "brand_name", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'brand_name'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Tahun Produksi', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "production_year", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'production_year'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Kategori', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "category_name", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'category_name'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'quantity', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "quantity", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'quantity'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Catatan', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextArea($model, "request_note", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model, 'request_note'); ?>
                </div>
            </div>
            
            <hr />
            
            <div class="row">
                <div class="col">
                    <?php echo CHtml::label('Foto Barang: ', FALSE); ?>
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