<?php
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\BeerNames;
use yii\helpers\ArrayHelper;
use app\assets\BeerAsset;

BeerAsset::register($this);
// Without model and implementing a multiple select
echo '<label class="control-label">Beers</label>';
?>
<?php $form = ActiveForm::begin(['id' => 'beer-form']); ?>
    <?= $form->field($model, 'name')->widget(Select2::className(), [
        'data' => ArrayHelper::map(\app\models\BeerNames::find()->orderBy('name')->all(), 'name', 'name'),
        'model' => $model,
        'id' => 'beers',
        'showToggleAll' => false,
        'options' => [
            'placeholder' => 'Select Beers ...',
            'multiple' => true,

        ],
        'pluginOptions' => [
            'allowClear' => true,
            //'tags' => true,
        ],
    ]); ?>
<div class="form-group">
     <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'beer-button']) ?>
</div>

<?php ActiveForm::end(); ?>
<p class="lead">Top Ten Recommended Beers</p>

<section class="results">
    <figure class="visualization row">
        <div class="col-sm-6 col-1"></div>
        <div class="col-sm-6 col-2"></div>
    </figure>
</section>
