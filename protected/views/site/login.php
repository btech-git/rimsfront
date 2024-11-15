<div class="container">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card border-secondary text-bg-light">
            <div class="card-body">
                <div class="text-center">
                    <img src="<?php echo Yii::app()->baseUrl . '/images/logo.jpg' ?>" width="250px" />
                </div>
                <br />
                <h5 class="card-title text-center text-primary mb-4">USER LOGIN</h5>
                <?php echo CHtml::beginForm(); ?>
                    <div class="input-group mb-3">
                        <div class="input-group-text bg-white">
                            <i class="bi-person-fill"></i>
                        </div>
                        <?php echo CHtml::activeTextField($model, 'username', array('autofocus' => 'autofocus', 'class' => 'form-control border-start-0', 'placeholder' => 'Username')); ?>
                        <?php echo CHtml::error($model, 'username', array('class' => 'invalid-feedback d-block')); ?>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text bg-white">
                            <i class="bi-lock-fill"></i>
                        </div>
                        <?php echo CHtml::activePasswordField($model, 'password', array('class' => 'form-control border-start-0', 'placeholder' => 'Password')) ?>
                        <?php echo CHtml::error($model, 'password', array('class' => 'invalid-feedback d-block')); ?>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text bg-white">
                            <i class="bi-building-fill"></i>
                        </div>
                        <?php echo CHtml::activeDropDownList($model, 'branchId', CHtml::listData(Branch::model()->findAllByAttributes(array('status' => 'Active')), 'id', 'name'), array(
                            'class' => 'form-control border-start-0', 
                            'empty' => '-- Select Branch --'
                        )); ?>
                        <?php echo CHtml::error($model, 'branchId', array('class' => 'invalid-feedback d-block')); ?>
                    </div>
                    <div class="d-grid">
                        <?php echo CHtml::submitButton("Login", array('class' => 'btn btn-primary btn-sm')); ?>
                    </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>