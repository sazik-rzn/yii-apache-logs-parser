<?php
$this->breadcrumbs = array(
    'Logs'
);

$this->menu = array(
);
?>



<h1>Manage Logs</h1>

<ul class="nav nav-tabs" id="searchSettings">
    <li class="active"><a href="#filter">Filter</a></li>
    <li><a href="#group">Group</a></li>
    <li><a href="#order">Order</a></li>
</ul>

<div class="tab-content span12">
    <div class="tab-pane active" id="filter">

        <div class="input-prepend">
            <span class="add-on">Field</span>
            <select class="span2 filter-field">
                <?php foreach (\Log::model()->searchebleFields() as $field) { ?>
                    <option value="<?= $field ?>"><?= \Log::model()->getAttributeLabel($field) ?></option>
                <?php } ?>
            </select>
            <span class="add-on">Condition</span>
            <select class="span2 filter-condition">
                <option selected value="">Like</option>
                <option selected value="=">Equals</option>
                <option value=">">More then</option>
                <option value=">=">More then or equals</option>                
                <option value="<">Less then</option>
                <option value="<=">Less then or equals</option>                
                <option value="<>">Not equals</option>
                <option value="range">Range</option>
            </select>
            <span class="add-on">Value</span>
            <input type="text" class="span3 filter-value">
            <span class="add-on filter-range" style="display: none;"> to Value</span>
            <input type="text" style="display: none;" class="span3 filter-range filter-value-range">
            <button class="btn filter-add">
                Add
            </button>
        </div>
    </div>
    <div class="tab-pane" id="group">
        <div class="input-prepend">
            <span class="add-on">Field</span>
            <select class="span2 search-group">
                <?php foreach (\Log::model()->searchebleFields() as $field) { ?>
                    <option value="<?= $field ?>"><?= \Log::model()->getAttributeLabel($field) ?></option>
                <?php } ?>
            </select>
            <button class="btn group-add">
                Add
            </button>
        </div>
    </div>
    <div class="tab-pane" id="order">
        <div class="input-prepend">
            <span class="add-on">Field</span>
            <select class="span2 search-sort">
                <?php foreach (\Log::model()->searchebleFields() as $field) { ?>
                    <option value="<?= $field ?>"><?= \Log::model()->getAttributeLabel($field) ?></option>
                <?php } ?>
            </select>
            <span class="add-on">Order type</span>
            <select class="span2 search-sort-type">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
            <button class="btn order-add">
                Add
            </button>
        </div>
    </div>
</div>
<div class="search-conditions"></div>
<button class="btn btn-success search-submit">Search</button>

<div class="search-container">
    <?php $this->renderPartial('list', ['provider' => $provider]); ?>
</div>
<script src="/js/search.js"></script>
<script>
    Search.init('<?= \Yii::app()->createUrl('site/data') ?>');    
</script>