<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBackend */

$this->title = '添加新用户';
$this->params['breadcrumbs'][] = ['label' => 'User Backends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-signup">

<div class="site-signup">
	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'from-signup']); ?>
		    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
		    <div class="form-group">
		        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    </div>
		    <?php ActiveForm::end(); ?>

		</div>
	</div>
</div>

</div>
