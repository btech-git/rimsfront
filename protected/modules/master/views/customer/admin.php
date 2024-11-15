<?php echo CHtml::beginForm(); ?>
    <div class="row d-print-none">
        <div class="col d-flex justify-content-start">
            <h4>Data Customer</h4>
        </div>
        <div class="col d-flex justify-content-end">
            <div class="d-gap">
                <?php echo CHtml::link('Add', array("create"), array('class' => 'btn btn-success btn-sm')); ?>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col">
            <div class="my-2 row">
                <label class="col col-form-label">Nama</label>
                <div class="col">
                    <?php echo CHtml::activeTextField($customer, 'name', array(
                        'class' => 'form-select',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'GET',
                            'url' => CController::createUrl('ajaxHtmlUpdateCustomerDataTable'),
                            'update' => '#customer_data_container',
                        )),
                    )); ?>
                </div>
                <label class="col col-form-label">Type</label>
                <div class="col">
                    <?php echo CHtml::activeDropDownList($customer, 'customer_type', array(
                        'Individual' => 'Individual', 
                        'Company' => 'Company',
                    ), array(
                        'class' => 'form-select',
                        'empty' => '-- All --',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'GET',
                            'url' => CController::createUrl('ajaxHtmlUpdateCustomerDataTable'),
                            'update' => '#customer_data_container',
                        )),
                    )); ?>
                </div>
            </div>
            <div class="my-2 row">
                <label class="col col-form-label">HP #</label>
                <div class="col">
                    <?php echo CHtml::activeTextField($customer, 'mobile_phone', array(
                        'class' => 'form-select',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'GET',
                            'url' => CController::createUrl('ajaxHtmlUpdateCustomerDataTable'),
                            'update' => '#customer_data_container',
                        )),
                    )); ?>
                </div>
                <label class="col col-form-label">Email</label>
                <div class="col">
                    <?php echo CHtml::activeTextField($customer, 'email', array(
                        'class' => 'form-select',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'GET',
                            'url' => CController::createUrl('ajaxHtmlUpdateCustomerDataTable'),
                            'update' => '#customer_data_container',
                        )),
                    )); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <?php echo CHtml::submitButton('Hapus', array('name' => 'ResetFilter', 'class' => 'btn btn-danger'));  ?>
    </div>

    <hr />

    <div id="customer_data_container">
        <?php $this->renderPartial('_customerDataTable', array(
            'customerDataProvider' => $customerDataProvider,
        )); ?>
    </div>
<?php echo CHtml::endForm(); ?>