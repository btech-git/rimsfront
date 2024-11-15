<?php $vehicles = Vehicle::model()->findAllByAttributes(array('customer_id'=>$model->id), array('order' => 't.id DESC', 'limit' => 30)); ?>
<?php if (count($vehicles) > 0): ?>
    <div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th>Plat #</th>
                    <th>Car Model</th>
                    <th>Color</th>
                    <th>Year</th>
                    <th>Power CC</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $i => $vehicle): ?>
                    <tr>
                        <td><?php echo CHtml::encode(CHtml::value($vehicle, 'plate_number')); ?></td>
                        <td>
                            <?php echo CHtml::encode(CHtml::value($vehicle, 'carMake.name')); ?> -
                            <?php echo CHtml::encode(CHtml::value($vehicle, 'carModel.name')); ?> -
                            <?php echo CHtml::encode(CHtml::value($vehicle, 'carSubModel.name')); ?>
                        </td>
                        <td><?php echo CHtml::encode(CHtml::value($vehicle, 'colors.name')); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($vehicle, 'year')); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($vehicle, 'power')); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($vehicle, 'notes')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <?php echo "NO VEHICLE LIST"; ?>
<?php endif; ?>