<?php
/* @var $this RegistrationTransactionController */
/* @var $registrationTransaction->header RegistrationTransaction */

$this->breadcrumbs=array(
	'Registration Transactions'=>array('admin'),
	$registrationTransaction->header->id=>array('view','id'=>$registrationTransaction->header->id),
	'Update',
);
?>


<div id="maincontent">
    <?php echo $this->renderPartial('_form', array(
        'registrationTransaction' => $registrationTransaction,
        'vehicle' => $vehicle,
        'customer' => $customer,
    )); ?>
</div>
	