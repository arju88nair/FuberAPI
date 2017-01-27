<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Fuber</a>
    </div>
    
  </div>
</nav>
<div class="container">
      <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Total Drivers</h3>
            <div class="pull-right">
              <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                <i class="glyphicon glyphicon-filter"></i>
              </span>
            </div>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
          </div>
          <table class="table table-hover" id="dev-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Registration Number</th>
                <th>Status</th>
                <th>Type</th>
                <th>Location</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($drivers as $driver):?>
                                 <tr>
                <td><?= $driver['id'] ?></td>
                <td><?= $driver['regNum'] ?></td>
                <td><?= $driver['status'] ?></td>
                <td><?= $driver['vehType'] ?></td>
                <td>(<?= $driver['lat'] ?>,<?= $driver['lon'] ?>)</td>
              </tr>
                                <?php
                                endforeach;
                                ?>
             
            </tbody>
          </table>
        </div>
      </div>
      
      </div>
    </div>
  </div>
  </div>

</body>
<script>
(function(){
    'use strict';
  var $ = jQuery;
  $.fn.extend({
    filterTable: function(){
      return this.each(function(){
        $(this).on('keyup', function(e){
          $('.filterTable_no_results').remove();
          var $this = $(this), 
                        search = $this.val().toLowerCase(), 
                        target = $this.attr('data-filters'), 
                        $target = $(target), 
                        $rows = $target.find('tbody tr');
                        
          if(search == '') {
            $rows.show(); 
          } else {
            $rows.each(function(){
              var $this = $(this);
              $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
            })
            if($target.find('tbody tr:visible').size() === 0) {
              var col_count = $target.find('tr').first().find('td').size();
              var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
              $target.find('tbody').append(no_results);
            }
          }
        });
      });
    }
  });
  $('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
  $('[data-action="filter"]').filterTable();
  
  $('.container').on('click', '.panel-heading span.filter', function(e){
    var $this = $(this), 
      $panel = $this.parents('.panel');
    
    $panel.find('.panel-body').slideToggle();
    if($this.css('display') != 'none') {
      $panel.find('.panel-body input').focus();
    }
  });
  $('[data-toggle="tooltip"]').tooltip();
})</script>
<style>.row{
        margin-top:40px;
        padding: 0 10px;
    }
    .clickable{
        cursor: pointer;   
    }

    .panel-heading div {
      margin-top: -18px;
      font-size: 15px;
    }
    .panel-heading div span{
      margin-left:5px;
    }
    .panel-body{
      display: none;
    }</style>
</html>
