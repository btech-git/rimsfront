<?php
    $this->pageTitle=Yii::app()->name;
?>
<div id="maincontent">
    <?php echo CHtml::beginForm(); ?>
        <div class="row d-print-none">
            <div class="col d-flex justify-content-start">
                <h3>Welcome to RAPERIND</h3>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="d-gap">
                    <?php echo CHtml::link('<i class="bi-plus"></i> Kendaraan', array("/master/vehicle/create"), array('class' => 'btn btn-success btn-sm')); ?>
                    <?php echo CHtml::link('<i class="bi-plus"></i> Customer', array("/master/customer/create"), array('class' => 'btn btn-success btn-sm')); ?>
                </div>
            </div>
        </div>

        <hr />
            
	<div class="clearfix page-action">
            <?php $this->widget('zii.widgets.jui.CJuiTabs', array(
                'tabs' => array(
                    'Kendaraan' => array(
                        'content' => $this->renderPartial('_viewVehicle', array(
                            'vehicleDataProvider' => $vehicleDataProvider, 
                            'vehicle' => $vehicle, 
                        ), true),
                    ),
                    'Customer' => array(
                        'content' => $this->renderPartial('_viewCustomer', array(
                            'customer' => $customer,
                            'customerDataProvider' => $customerDataProvider,
                        ), true),
                    ),
                    'Produk' => array(
                        'content' => $this->renderPartial('_viewProduct', array(
                            'productDataProvider' => $productDataProvider, 
                            'product' => $product, 
                            'branches' => $branches,
                            'endDate' => $endDate,
                        ), true),
                    ),
                    'Jasa' => array(
                        'content' => $this->renderPartial('_viewService', array(
                            'service' => $service, 
                            'serviceDataProvider' => $serviceDataProvider, 
                        ), true),
                    ),
                ),
                // additional javascript options for the tabs plugin
                'options' => array(
                    'collapsible' => true,
                ),
                // set id for this widgets
                'id' => 'view_tab',
            )); ?>
	</div>
    <?php echo CHtml::endForm(); ?>
</div>