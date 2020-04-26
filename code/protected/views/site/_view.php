<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file')); ?>:</b>
	<?php echo CHtml::encode($data->file); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('line_num')); ?>:</b>
	<?php echo CHtml::encode($data->line_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('line_uid')); ?>:</b>
	<?php echo CHtml::encode($data->line_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parsed_at')); ?>:</b>
	<?php echo CHtml::encode($data->parsed_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_ip')); ?>:</b>
	<?php echo CHtml::encode($data->remote_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('local_ip')); ?>:</b>
	<?php echo CHtml::encode($data->local_ip); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('res_size')); ?>:</b>
	<?php echo CHtml::encode($data->res_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_size_clf')); ?>:</b>
	<?php echo CHtml::encode($data->res_size_clf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cookie')); ?>:</b>
	<?php echo CHtml::encode($data->cookie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_time_ms')); ?>:</b>
	<?php echo CHtml::encode($data->req_time_ms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('env_var')); ?>:</b>
	<?php echo CHtml::encode($data->env_var); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('filename')); ?>:</b>
	<?php echo CHtml::encode($data->filename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_host')); ?>:</b>
	<?php echo CHtml::encode($data->remote_host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_protocol')); ?>:</b>
	<?php echo CHtml::encode($data->req_protocol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_header')); ?>:</b>
	<?php echo CHtml::encode($data->req_header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ka_requests_num')); ?>:</b>
	<?php echo CHtml::encode($data->ka_requests_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_logname')); ?>:</b>
	<?php echo CHtml::encode($data->remote_logname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('method')); ?>:</b>
	<?php echo CHtml::encode($data->method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_note')); ?>:</b>
	<?php echo CHtml::encode($data->module_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_header')); ?>:</b>
	<?php echo CHtml::encode($data->res_header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('server_port_canonical')); ?>:</b>
	<?php echo CHtml::encode($data->server_port_canonical); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('port')); ?>:</b>
	<?php echo CHtml::encode($data->port); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('child_id')); ?>:</b>
	<?php echo CHtml::encode($data->child_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('child_id_formatted')); ?>:</b>
	<?php echo CHtml::encode($data->child_id_formatted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('query_string')); ?>:</b>
	<?php echo CHtml::encode($data->query_string); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_first_line')); ?>:</b>
	<?php echo CHtml::encode($data->req_first_line); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_handler')); ?>:</b>
	<?php echo CHtml::encode($data->res_handler); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_orig')); ?>:</b>
	<?php echo CHtml::encode($data->status_orig); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_last')); ?>:</b>
	<?php echo CHtml::encode($data->status_last); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_formatted')); ?>:</b>
	<?php echo CHtml::encode($data->time_formatted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serve_req_time')); ?>:</b>
	<?php echo CHtml::encode($data->serve_req_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serve_req_time_in_units')); ?>:</b>
	<?php echo CHtml::encode($data->serve_req_time_in_units); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_user')); ?>:</b>
	<?php echo CHtml::encode($data->remote_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('server_name')); ?>:</b>
	<?php echo CHtml::encode($data->server_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('server_name_ucn')); ?>:</b>
	<?php echo CHtml::encode($data->server_name_ucn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('connection_status')); ?>:</b>
	<?php echo CHtml::encode($data->connection_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('received_bytes')); ?>:</b>
	<?php echo CHtml::encode($data->received_bytes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sended_bytes')); ?>:</b>
	<?php echo CHtml::encode($data->sended_bytes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('req_trailer_line')); ?>:</b>
	<?php echo CHtml::encode($data->req_trailer_line); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('res_trailer_line')); ?>:</b>
	<?php echo CHtml::encode($data->res_trailer_line); ?>
	<br />

	*/ ?>

</div>