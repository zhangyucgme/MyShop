<form id='SelectPromotionRuleForm' method='post' action='index.php?ctl=sale/promotion&act=doSelectPromotionRule' class="tableform"> <div class="division"> <table border="0" cellspacing="0" cellpadding="0" > <?php foreach ((array)$this->_vars['scheme']['list'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr> <th style="width:10px;"><input type='radio' id="pmts_id_<?php echo $this->_vars['key']; ?>" name='pmts_id' value='<?php echo $this->_vars['key']; ?>' <?php if( $this->_vars['key']==$this->_vars['scheme']['pmts_id'] ){ ?>checked='checked'<?php } ?>></th> <td><label for="pmts_id_<?php echo $this->_vars['key']; ?>"><?php echo $this->_vars['item']['name']; ?></label></td> </tr> <?php } ?> </table> <div class="table-action"> <button type="submit" class="btn"><span><span>下一步</span></span></button> <button type="button" class="btn"><span><span>取消</span></span></button> </div> </form> <script>
	$ES('.btn[type=button]','#SelectPromotionRuleForm').addEvent('click',function(e){	
		if($E('body[id=shopadmin]')){
			W.page('index.php?ctl=sale/activity&act=index');
		}else{
			window.close();
		}	
	})
</script> 