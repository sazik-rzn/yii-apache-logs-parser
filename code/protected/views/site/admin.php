<?php
$this->breadcrumbs=array(
	'Logs'=>array('index'),
	'Manage',
);

$this->menu=array(
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('log-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Logs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done. To combine operators use delimiter <b>{AND}</b>
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'file',
		//'line_num',
		//'line_uid',
		//'parsed_at',
		'remote_ip',
		'local_ip',
		//'res_size',
		//'res_size_clf',
		//'cookie',
		//'req_time_ms',
		//'env_var',
		//'filename',
		'remote_host',
		'req_protocol',
		//'req_header',
		//'ka_requests_num',
		//'remote_logname',
		'method',
		//'module_note',
		//'res_header',
		//'server_port_canonical',
		'port',
		//'child_id',
		//'child_id_formatted',
		//'query_string',
		//'req_first_line',
		//'res_handler',
		//'status_orig',
		'status_last',
		'time:datetime',
		//'time_formatted',
		//'serve_req_time',
		//'serve_req_time_in_units',
		//'remote_user',
		'url',
		'server_name',
		//'server_name_ucn',
		//'connection_status',
		//'received_bytes',
		//'sended_bytes',
		//'req_trailer_line',
		//'res_trailer_line',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
