<div>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-pricing-request-form',
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
                    <?php echo CHtml::activeLabelEx($model, 'quantity', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "quantity", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'quantity'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Tahun Produksi', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeTextField($model, "production_year", array('class' => 'form-control',)); ?>
                    <?php echo CHtml::error($model,'production_year'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Car Make', array('class' => 'form-label')); ?> 
                    <?php echo CHtml::activeDropDownlist($model, 'vehicle_car_make_id', CHtml::listData(VehicleCarMake::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Car Make--"
                    )); ?>
                    <?php echo CHtml::error($model, 'vehicle_car_make_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Model', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'vehicle_car_model_id', CHtml::listData(VehicleCarModel::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Car Model--"
                    )); ?>
                    <?php echo CHtml::error($model, 'vehicle_car_model_id'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Merk', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'brand_id', CHtml::listData(Brand::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Merk--"
                    )); ?>
                    <?php echo CHtml::error($model,'brand_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Sub Brand', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'sub_brand_id', CHtml::listData(SubBrand::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Sub Brand--"
                    )); ?>
                    <?php echo CHtml::error($model,'sub_brand_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Sub Brand Series', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'sub_brand_series_id', CHtml::listData(SubBrandSeries::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Sub Brand Series--"
                    )); ?>
                    <?php echo CHtml::error($model,'sub_brand_series_id'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Kategori', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'product_master_category_id', CHtml::listData(ProductMasterCategory::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Kategori--"
                    )); ?>
                    <?php echo CHtml::error($model,'product_master_category_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Sub Master Category', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'product_sub_master_category_id', CHtml::listData(ProductSubMasterCategory::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Sub Master Category--"
                    )); ?>
                    <?php echo CHtml::error($model,'product_sub_master_category_id'); ?>
                </div>
                <div class="col">
                    <?php echo CHtml::activeLabelEx($model, 'Sub Kategori', array('class' => 'form-label')); ?>
                    <?php echo CHtml::activeDropDownlist($model, 'product_sub_category_id', CHtml::listData(ProductSubCategory::model()->findAll(array('order' => 'name ASC')), "id", "name"), array(
                        'class' => 'form-control', 
                        "empty" => "--Select Sub Category--"
                    )); ?>
                    <?php echo CHtml::error($model,'product_sub_category_id'); ?>
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