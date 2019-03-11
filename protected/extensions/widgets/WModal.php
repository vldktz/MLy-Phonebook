<?php

/**
 * Class WModal PHP wrapper for bootstrap4 modal
 * additional use and info can be found here: https://getbootstrap.com/docs/4.0/components/modal/
 */
class WModal extends CWidget
{
    public $title = null;
    public $items = [];
    public $htmlOptions = [];
    private $elemId = null;
    public $menuId = '';
    public $footer = null;

    public function init()
    {
        if (empty($this->htmlOptions['id']))
            $this->htmlOptions['id'] = $this->getId() . "_" . time();

        $id = $this->htmlOptions['id'];
        $this->elemId = $id;

        if (isset($this->htmlOptions['width']))
            $width = $this->htmlOptions['width'];
        else
            $width = '500px';

        //start of the modal//
        $str = <<<MDL
<div class="modal fade" tabindex="-1" role="dialog" id="{$this->elemId}">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:{$width}">
    <div class="modal-content">
      <div class="modal-header" style="position: relative">
        <h5 class="modal-title">{$this->title}</h5>
      </div>
      <div class="modal-body">
MDL;
        echo $str;
    }


    public function run()
    {
        //end of modal
        if ($this->footer === null) {
            $str = <<<MDL
</div>
     
    </div>
  </div>
</div>
MDL;
            echo $str;
        } else {
            $str = <<<MDL
</div>
      <div class="modal-footer" >
         
            {$this->footer}
          
      </div>
    </div>
  </div>
</div>
MDL;
            echo $str;
        }
    }
}