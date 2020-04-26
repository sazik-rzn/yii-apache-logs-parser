<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'file',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'line_num',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'line_uid',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'parsed_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'remote_ip',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'local_ip',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'res_size',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'res_size_clf',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cookie',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'req_time_ms',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'env_var',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'filename',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'remote_host',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'req_protocol',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'req_header',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'ka_requests_num',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'remote_logname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'method',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'module_note',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'res_header',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'server_port_canonical',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'port',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'child_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'child_id_formatted',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'query_string',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'req_first_line',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'res_handler',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'status_orig',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status_last',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'time_formatted',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'serve_req_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'serve_req_time_in_units',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'remote_user',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'server_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'server_name_ucn',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'connection_status',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'received_bytes',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sended_bytes',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'req_trailer_line',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'res_trailer_line',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
