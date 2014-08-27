<?php if(!function_exists('tpl_input_region')){ require(CORE_DIR.'/include_v5/smartyplugins/input.region.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?><table widtd="100%" border="0" cellpadding="0" cellspacing="0" class="liststyle data"> <col class="span-3" /> <col class="span-9" /> <col class="span-auto" /> <tbody> <tr> <td><em style="color:red">*</em>收货地区：</td> <td colspan=2> <span id="checkout-select-area"><?php echo tpl_input_region(array('id' => "shipping-area",'class' => "inputstyle",'name' => "delivery[ship_area]",'required' => "true",'value' => $this->_vars['trading']['receiver']['area']), $this);?></span> </td> </tr> <tr> <td><em style="color:red">*</em>收货地址：</td> <td> <input type='hidden' name='delivery[ship_addr_area]' value='' id='selected-area-hidden'/> <span id='selected-area' class='fontcolorGray' title='系统将拼接地区选择结果到收获地址'>[地区]</span> <?php echo tpl_input_default(array('class' => "inputstyle",'name' => "delivery[ship_addr]",'id' => "addr",'vtype' => "required",'value' => $this->_vars['trading']['receiver']['addr'],'size' => "30"), $this);?> </td> <td> 邮编： <?php echo tpl_input_default(array('class' => "inputstyle span-2",'name' => "delivery[ship_zip]",'size' => "30",'id' => "zip",'type' => "text",'value' => $this->_vars['trading']['receiver']['zip']), $this);?> </td> </tr> <tr> <td><em style="color:red">*</em>收货人姓名：</td> <td colspan=2><?php echo tpl_input_default(array('class' => "inputstyle",'name' => "delivery[ship_name]",'id' => "name",'size' => "30",'required' => "true",'type' => "text",'value' => $this->_vars['trading']['receiver']['name']), $this);?></td> </tr> <?php if( !$this->_vars['trading']['member_id'] ){ ?> <tr> <td><em style="color:red">*</em>Email：</td> <td colspan=2><?php echo tpl_input_default(array('name' => "delivery[ship_email]",'class' => "inputstyle",'id' => "ship_email",'size' => "30",'required' => "true",'type' => "text",'vtype' => "email",'value' => $this->_vars['trading']['receiver']['email']), $this);?></td> </tr> <?php } ?> <tr> <td> <em style="color:red">*</em>手机： </td> <td colspan=2> <?php echo tpl_input_default(array('class' => "inputstyle",'name' => "delivery[ship_mobile]",'size' => "30",'type' => "text",'id' => "mobile",'value' => $this->_vars['trading']['receiver']['mobile']), $this);?> </td> </tr> <tr> <td> <em style="color:#ccc">*</em>固定电话： </td> <td colspan=2> <?php echo tpl_input_default(array('class' => "inputstyle",'name' => "delivery[ship_tel]",'size' => "30",'type' => "text",'id' => "tel",'value' => $this->_vars['trading']['receiver']['tel']), $this);?> </td> </tr> <?php if( $this->_vars['trading']['member_id'] ){ ?> <tr class="recsave"> <td>是否保存地址：</td> <td colspan=2><label><input name="delivery[is_save]" type="checkbox" checked="checked" value=1>保存本次收货地址</label></td> </tr> <?php } ?> </tbody> </table> <?php echo $this->_vars['selectArea']; ?> <script>
window.addEvent('domready',function(e){
	$E('#checkout-select-area input[name^=delivery[]').store('onselect',function(sel){

        if($E('option[has_c]',sel)){
            $('shipping').set('html','<div class="valierror clearfix">请选择收货地区</div>');   
            $('selected-area').set('text','[地区]').removeClass('fontcolorBlack').addClass('fontcolorGray');
        }

    });

    $E('#checkout-select-area input[name^=delivery[]').store('lastsel',function(lastselect){
        var areaSels=$ES("#checkout-select-area select");
        var areaSelPrt=areaSels[0].getParent('*[package=mainland]');
        var selected=[];
        areaSels.each(function(s){
           var text = s[s.selectedIndex].text.trim().clean();
           if(['北京','天津','上海','重庆'].indexOf(text)>-1)return;
           selected.push(text);
        });
        var selectedV = selected.join('');
        $('selected-area').setText(selectedV).removeClass('fontcolorGray').addClass('fontcolorBlack');
        $('selected-area-hidden').value =  selectedV;
        $('addr').set('value',$('addr').value.replace(selectedV,''));
        Order.setShippingFromArea(lastselect);
    });
    var areaSels=$ES("#checkout-select-area select");
    var lastSel=areaSels[areaSels.length-1];
	if( lastSel.get('value') != '' && lastSel.get('value') != '_NULL_' )
    
	 lastSel.onchange(lastSel,lastSel.value,(areaSels.lengtd-1));  


});
   
</script>