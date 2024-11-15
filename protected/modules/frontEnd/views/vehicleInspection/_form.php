<div class="clearfix page-action">
    <?php echo CHtml::link('<span class="fa fa-th-list"></span>Manage', Yii::app()->baseUrl . '/frontEnd/vehicleInspection/admin', array('class' => 'button cbutton right', 'visible' => Yii::app()->user->checkAccess("frontEnd.vehicleInspection.admin"))) ?>
    <h1>
        <?php if ($vehicleInspection->header->isNewRecord) {
            echo "New Vehicle Inspection";
        } else {
            echo "Update Vehicle Inspection";
        } ?>
    </h1>

    <!-- begin FORM -->
    <div class="form">
        <?php echo CHtml::beginForm(); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo CHtml::errorSummary($vehicleInspection->header); ?>
        <?php echo CHtml::errorSummary($vehicleInspection->vehicleInspectionDetails); ?>

        <div class="row">
            <div class="small-12 medium-6 columns">
                <?php echo CHtml::activeHiddenField($vehicleInspection->header, 'vehicle_id'); ?>
                <?php $vehicle = Vehicle::model()->findByPk($vehicleInspection->header->vehicle_id); ?>
                <p><?php echo CHtml::encode(CHtml::value($vehicle, 'customer.name')) . ' | ' . CHtml::encode(CHtml::value($vehicle, 'plate_number')) . ' | ' . CHtml::encode(CHtml::value($vehicle, 'frame_number')); ?></p>

                <div class="field">
                    <div class="small-4 columns">
                        <label class="prefix"><?php echo CHtml::activeLabelEx($vehicleInspection->header, 'inspection_id'); ?></label>
                    </div>
                    <div class="small-8 columns">
                        <?php echo CHtml::activeDropDownList($vehicleInspection->header, 'inspection_id', CHtml::listData(Inspection::model()->findAll(array('order' => 'name')), 'id', 'name'), array(
                            'prompt' => '[--Select Inspection--]',
                            'onChange' => 'jQuery.ajax({
                                type: "POST",
                                url: "' . CController::createUrl('ajaxHtmlAddVehicleInspectionDetail', array('id' => $vehicleInspection->header->id,)) . '&inspectionId="+jQuery(this).val(),
                                data: jQuery("form").serialize(),
                                success: function(data){
                                    console.log(data);
                                    jQuery("#vehicleReport").html(data);
                                },
                            });'
                        )); ?>
                        <?php echo CHtml::error($vehicleInspection->header, 'inspection_id'); ?>
                    </div>
                </div>

                <div class="field">
                    <div class="small-4 columns">
                        <label class="prefix"><?php echo CHtml::activeLabelEx($vehicleInspection->header, 'inspection_date'); ?></label>
                    </div>
                    <div class="small-8 columns">
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $vehicleInspection->header,
                            'attribute' => 'inspection_date',
                            'name' => 'inspection_date',
                            // additional javascript options for the date picker plugin
                            'options' => array(
                                'showAnim' => 'slide',
                                'dateFormat' => 'yy-mm-dd',
                            )
                        )); ?>
                        <?php echo CHtml::error($vehicleInspection->header, 'inspection_date'); ?>
                    </div>
                </div>

                <div class="field">
                    <div class="small-4 columns">
                        <label class="prefix"><?php echo CHtml::activeLabelEx($vehicleInspection->header, 'work_order_number'); ?></label>
                    </div>
                    <div class="small-8 columns">
                        <?php echo CHtml::activeTextField($vehicleInspection->header, 'work_order_number', array('readonly' => true)); ?>
                        <?php echo CHtml::error($vehicleInspection->header, 'work_order_number'); ?>
                    </div>
                </div>

                <div class="field">
                    <div class="small-4 columns">
                        <label class="prefix"><?php echo CHtml::activeLabelEx($vehicleInspection->header, 'status'); ?></label>
                    </div>
                    <div class="small-8 columns">
                        <?php echo CHtml::activeDropDownList($vehicleInspection->header, 'status', array('Active' => 'Active', 'Not Active' => 'Not Active')); ?>
                        <?php echo CHtml::error($vehicleInspection->header, 'status'); ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <h2>Vehicle Report</h2>
        <div class="grid-view" id="vehicleReport" >
            <?php $this->renderPartial('_detailVehicleInspectionDetail', array('vehicleInspection' => $vehicleInspection)); ?>
            <div class="clearfix"></div><div style="display:none" class="keys"></div>
        </div>

        <div class="row">
            <div class="small-12 medium-6 columns">
                <div class="field">
                    <div class="small-4 columns">
                        <label class="prefix"><?php echo CHtml::activeLabelEx($vehicleInspection->header, 'service_advisor_id'); ?></label>
                    </div>
                    <div class="small-8 columns">
                        <?php echo CHtml::activeDropDownList($vehicleInspection->header, 'service_advisor_id', CHtml::listData(Users::model()->findAll(), 'id', 'username')); ?>
                        <?php echo CHtml::error($vehicleInspection->header, 'service_advisor_id'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="field buttons text-center">
            <?php echo CHtml::submitButton($vehicleInspection->header->isNewRecord ? 'Create' : 'Save', array('class' => 'button cbutton')); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
    </div>
</div><!-- form -->