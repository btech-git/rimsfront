<?php
/* @var $this RegistrationTransactionController */
/* @var $data RegistrationTransaction */

$this->breadcrumbs = array(
    'Vehicle' => array('admin'),
    'Manage',
);
?>

<div class="row d-print-none">
    <div class="col d-flex justify-content-start">
        <h4>Kendaraan Keluar / Masuk Bengkel</h4>
    </div>
    <div class="col d-flex justify-content-end">
        <div class="d-gap">
            <?php //echo CHtml::link('Add', array("create"), array('class' => 'btn btn-success btn-sm')); ?>
        </div>
    </div>
</div>

<hr />
<?php echo CHtml::beginForm(); ?>
    <div class="row">
        <div class="col">
            <div class="my-2 row">
                <label class="col col-form-label">Tanggal</label>
                <div class="col">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'StartDate',
                        'value' => $startDate,
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-select',
                            'style'=>'margin-bottom:0px;',
                            'placeholder'=>'Date From',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateVehicleStatusDataTable'),
                                'update' => '#vehicle_status_data_container',
                            )) . 
                            CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateVehicleEntryDataTable'),
                                'update' => '#vehicle_entry_status_data_container',
                            )),
                        ),
                    )); ?>
                </div>
                <div class="col">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'EndDate',
                        'value' => $endDate,
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-select',
                            'style'=>'margin-bottom:0px;',
                            'placeholder'=>'Date To',
                            'onchange' => CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateVehicleStatusDataTable'),
                                'update' => '#vehicle_status_data_container',
                            )) . 
                            CHtml::ajax(array(
                                'type' => 'GET',
                                'url' => CController::createUrl('ajaxHtmlUpdateVehicleEntryDataTable'),
                                'update' => '#vehicle_entry_status_data_container',
                            )),
                        ),
                    )); ?>
                </div>
                <label class="col col-form-label">Plat #</label>
                <div class="col">
                    <?php echo CHtml::textField('PlateNumber', $plateNumber, array(
                        'class' => 'form-select',
                        'onchange' => CHtml::ajax(array(
                            'type' => 'GET',
                            'url' => CController::createUrl('ajaxHtmlUpdateVehicleEntryDataTable'),
                            'update' => '#vehicle_entry_status_data_container',
                        )),
                    )); ?>
                </div>
            </div>
        </div>
    </div>

    <br /> 

    <div class="text-center">
        <?php echo CHtml::submitButton('Hapus', array('name' => 'ResetFilter', 'class' => 'btn btn-danger'));  ?>
    </div>

    <hr />

    <div id="vehicle_entry_status_data_container">
        <?php $this->renderPartial('_vehicleEntry', array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'vehicleEntryDataprovider' => $vehicleEntryDataprovider,
        )); ?>
    </div>

    <hr />

    <div id="vehicle_status_data_container">
        <?php $this->renderPartial('_vehicleExit', array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'vehicleTransactionListSummary' => $vehicleTransactionListSummary,
        )); ?>
    </div>
<?php echo CHtml::endForm(); ?>
    