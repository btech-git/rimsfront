<?php $conditionRecommendations = VehicleConditionRecommendation::model()->findAllByAttributes(array('vehicle_id'=>$model->id), array('order' => 't.id DESC', 'limit' => 50)); ?>
<?php if (count($conditionRecommendations) > 0): ?>
    <div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-info">
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Kondisi Awal</th>
                    <th>Rekomendasi Awal</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Kondisi Akhir</th>
                    <th>Rekomendasi Akhir</th>
                    <th>Catatan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($conditionRecommendations as $i => $conditionRecommendation): ?>
                    <tr>
                        <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($conditionRecommendation, 'initial_date'))); ?></td>
                        <td><?php echo $conditionRecommendation->initial_time; ?></td>
                        <td><?php echo $conditionRecommendation->initial_condition; ?></td>
                        <td><?php echo $conditionRecommendation->initial_recommendation; ?></td>
                        <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($conditionRecommendation, 'final_date'))); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($conditionRecommendation, 'final_time')); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($conditionRecommendation, 'final_condition')); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($conditionRecommendation, 'final_recommendation')); ?></td>
                        <td><?php echo CHtml::encode(CHtml::value($conditionRecommendation, 'note')); ?></td>
                        <td><?php echo CHtml::link('Update', array("updateRecommendation", "id" => $conditionRecommendation->id), array('class' => 'btn btn-warning btn-sm')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <?php echo "NO HISTORY"; ?>
    <?php endif; ?>