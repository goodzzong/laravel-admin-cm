<?php

namespace App\Admin\Extensions\action;

use Encore\Admin\Admin;

class CheckRow
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-check-row').on('click', function () {

    // Your code.
    // alert($(this).data('id'));
  
  var divID = '#grid-check-' + $(this).data('id');
  var customerId = $(this).data('id');
  
  fLoadData(divID,'/admin/customer/detail/'+customerId);    
});

function fLoadData(divID,strUrl){
 
    $.ajax({
        type: "get",
        url: strUrl,
        data: "",
        success: function(resultText){
            $(divID).html(resultText);
        },
        error: function() {
            //alert("호출에 실패했습니다.");
        }
    });
}


SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        // return "<a class='btn btn-xs btn-success fa fa-check grid-check-row' data-id='{$this->id}'></a>";
//        <button class='btn btn-default btn-sm grid-check-row' data-id='{$this->id}' data-key=\"{$this->id}\" d data-toggle=\"modal\" data-target=\"#grid-modal-position-{$this->id}\" >detail</button>
        return "
<a href='javascript:;'>
 <i class='glyphicon glyphicon-new-window grid-check-row' data-id='{$this->id}' data-key=\"{
        $this->id}\" d data-toggle=\"modal\" data-target=\"#grid-modal-position-{$this->id}\"> </i>
</a>
<div class=\"modal\" id=\"grid-modal-position-{$this->id}\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
  <div class=\"modal-dialog modal-lg\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
          <span aria-hidden=\"true\">×</span></button>
        <h4 class=\"modal-title\">상세내용</h4>
      </div>
        <div class=\"modal-body\">
          <div id=\"grid-check-{$this->id}\" style=\"height:450px;\"></div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

";
    }

    public function __toString()
    {
        return $this->render();
    }
}