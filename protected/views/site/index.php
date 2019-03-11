<?php
/**
 * @var $this SiteController
 */
?>
<div class="row">
    <div class="col-lg-12 col-12 col-sm-12">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <?= CHtml::textField('query', '', ['class' => 'form-control', 'placeholder' => 'search', 'id' => 'contact-search-input']) ?>
        </div>
    </div>
</div>

<div class="row" id="results-container">
    <div class="col-lg-12 col-12 col-sm-12">
        <table class="table table-sm ">
            <thead>
            <tr>
                <th class="d-sm-none d-md-none d-none d-lg-table-cell">#</th>
                <th>name</th>
                <th class="d-sm-none d-md-none d-none d-lg-table-cell">username</th>
                <th class="d-sm-none d-md-none d-none d-lg-table-cell">email</th>
                <th>phone</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

