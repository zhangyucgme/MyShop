<div id="flashcontent_<?php echo $this->_vars['widgets_id']; ?>">&nbsp;</div> <?php $this->_vars["allimg"]='';  $this->_vars["alllink"]='';  foreach ((array)$this->_vars['setting']['flash'] as $this->_vars['key'] => $this->_vars['aitem']){  if( $this->_vars['aitem']['pic'] ){  $this->_vars["allimg"]="{$this->_vars['aitem']['pic']}|{$this->_vars['allimg']}";  $this->_vars["alllink"]="{$this->_vars['aitem']['link']}|{$this->_vars['alllink']}";  }  } ?> <script>
window.addEvent('domready', function(){
  var obj = new Swiff('<?php echo $this->_plugins['function']['respath'][0]->_respath(array('type' => "widgets",'name' => "flashview"), $this);?>images/1.swf', {
    width:  <?php echo $this->_vars['setting']['width']; ?>,
    height: <?php echo ((isset($this->_vars['setting']['height']) && ''!==$this->_vars['setting']['height'])?$this->_vars['setting']['height']:350); ?>,
    container: $('flashcontent_<?php echo $this->_vars['widgets_id']; ?>'),
    events: {
      load:function() {
        alert("Flash is loaded!");
      }
    },
	vars:{
		bcastr_flie:"<?php echo $this->_vars['allimg']; ?>",
		bcastr_link:"<?php echo $this->_vars['alllink']; ?>",
		duration_color:"<?php echo ((isset($this->_vars['setting']['color']) && ''!==$this->_vars['setting']['color'])?$this->_vars['setting']['color']:'0xff0000'); ?>",
		dur_time:"<?php echo ((isset($this->_vars['setting']['duration']) && ''!==$this->_vars['setting']['duration'])?$this->_vars['setting']['duration']:2); ?>"
	}
  });
});
</script> 