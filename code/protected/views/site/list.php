<?php
$this->widget('bootstrap.widgets.TBListView', array(
    'id' => 'log-grid',
    'dataProvider' => $provider,
    'itemView'=>'_bigItem',
));
?>
