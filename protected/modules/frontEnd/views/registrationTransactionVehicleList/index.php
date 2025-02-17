<div>
    <?php $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
            'R-1' => array(
                'content' => $this->renderPartial('_viewBranch1', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate1' => $startDate1,
                    'endDate1' => $endDate1,
                ), true),
            ),
            'R-4' => array(
                'content' => $this->renderPartial('_viewBranch2', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate2' => $startDate2,
                    'endDate2' => $endDate2,
                ), true),
            ),
            'R-5' => array(
                'content' => $this->renderPartial('_viewBranch3', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate3' => $startDate3,
                    'endDate3' => $endDate3,
                ), true),
            ),
            'R-6' => array(
                'content' => $this->renderPartial('_viewBranch4', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate4' => $startDate4,
                    'endDate4' => $endDate4,
                ), true),
            ),
            'R-8' => array(
                'content' => $this->renderPartial('_viewBranch5', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate5' => $startDate5,
                    'endDate5' => $endDate5
                ), true),
            ),
            'R-2' => array(
                'content' => $this->renderPartial('_viewBranch6', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate6' => $startDate6,
                    'endDate6' => $endDate6,
                ), true),
            ),
            'RAD-1' => array(
                'content' => $this->renderPartial('_viewBranch7', array(
                    'registrationTransactionVehicleList' => $registrationTransactionVehicleList,
                    'startDate7' => $startDate7,
                    'endDate7' => $endDate7,
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