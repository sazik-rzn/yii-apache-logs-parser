<?php
$this->breadcrumbs=array(
	'Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Log','url'=>array('index')),
	array('label'=>'Create Log','url'=>array('create')),
	array('label'=>'Update Log','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Log','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Log','url'=>array('admin')),
);
?>

<h1>View Log #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file',
		'line_num',
		'line_uid',
		'parsed_at',
		'remote_ip',
		'local_ip',
		'res_size',
		'res_size_clf',
		'cookie',
		'req_time_ms',
		'env_var',
		'filename',
		'remote_host',
		'req_protocol',
		'req_header',
		'ka_requests_num',
		'remote_logname',
		'method',
		'module_note',
		'res_header',
		'server_port_canonical',
		'port',
		'child_id',
		'child_id_formatted',
		'query_string',
		'req_first_line',
		'res_handler',
		'status_orig',
		'status_last',
		'time',
		'time_formatted',
		'serve_req_time',
		'serve_req_time_in_units',
		'remote_user',
		'url',
		'server_name',
		'server_name_ucn',
		'connection_status',
		'received_bytes',
		'sended_bytes',
		'req_trailer_line',
		'res_trailer_line',
	),
)); ?>
