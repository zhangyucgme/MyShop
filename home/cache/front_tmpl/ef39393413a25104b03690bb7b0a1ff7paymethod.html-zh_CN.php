<?php if(!function_exists('tpl_modifier_amount')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.amount.php'); } ?><table id="_pay_cod" width="100%" cellpadding="0" cellspacing="0" class="liststyle data" style="display:<?php if( $this->_vars['delivery']['has_cod'] == 1 ){ ?>block<?php }else{ ?>none<?php } ?>"> <col class="span-5 ColColorGray"></col> <col class="span-auto"></col> <tbody> <tr> <th style="text-align:left;"><input type="radio" name="payment[payment]" value="-1" paytype="offline" id="payment_bank" class="x-payMethod" <?php if( $this->_vars['order']['payment']==-1 ){ ?> checked="checked"<?php } ?> /><strong>货到付款</strong></th> <td>由我们的快递人员在将货物送到时收取货款。</td> </tr> </tbody> </table> <table width="100%" cellpadding="0" cellspacing="0" class="liststyle data" id="_normal_payment"> <col class="span-5 ColColorGray"></col> <col class="span-auto"></col> <?php foreach ((array)$this->_vars['payments'] as $this->_vars['key'] => $this->_vars['payment']){ ?> <tr> <input type="hidden" id="paytypes[<?php echo $this->_vars['payment']['id']; ?>]" value="<?php echo $this->_vars['payment']['pay_type']; ?>"> <th style="text-align:left;" > <label <?php if( $this->_vars['payment']['extend'] ){ ?>class="ExtendCon"<?php } ?>><input class="x-payMethod" type="radio" name="payment[payment]" paytype="<?php echo $this->_vars['payment']['pay_type']; ?>" value="<?php echo $this->_vars['payment']['id']; ?>"<?php if( $this->_vars['order']['payment']==$this->_vars['payment']['id'] ){ ?> checked="checked"<?php } ?> moneyamount="<?php echo $this->_vars['payment']['money']; ?>" formatmoney ="<?php echo tpl_modifier_amount($this->_vars['payment']['money']); ?>" onclick="Order.paymentChange(this)"/><?php echo $this->_vars['payment']['custom_name'];  if( $this->_vars['payment']['config']['method']=="1" or $this->_vars['payment']['config']['method']==" " ){  if( $this->_vars['payment']['fee']>0 ){ ?> (支付费率: +<?php echo $this->_vars['payment']['fee']*100; ?>%)<?php }  }else{  if( $this->_vars['payment']['config']['fee']>0 ){ ?> (支付费用: +<?php echo $this->_vars['payment']['config']['fee']; ?>)<?php }  } ?></label> </th> <td> <?php echo ((isset($this->_vars['payment']['des']) && ''!==$this->_vars['payment']['des'])?$this->_vars['payment']['des']:'&nbsp;');  if( $this->_vars['payment']['extend'] ){  foreach ((array)$this->_vars['payment']['extend'] as $this->_vars['extkey'] => $this->_vars['extvalue']){ ?> <div class="division paymentextend <?php echo $this->_vars['extvalue']['extconId']; ?> clearfix"> <hr /> <?php if( $this->_vars['extvalue']['fronttype']<>'select' ){ ?> <ul> <?php $this->_env_vars['foreach']["bank"]=array('total'=>count($this->_vars['extvalue']['value']),'iteration'=>0);foreach ((array)$this->_vars['extvalue']['value'] as $this->_vars['extskey'] => $this->_vars['extsval']){ $this->_env_vars['foreach']["bank"]['first'] = ($this->_env_vars['foreach']["bank"]['iteration']==0); $this->_env_vars['foreach']["bank"]['iteration']++; $this->_env_vars['foreach']["bank"]['last'] = ($this->_env_vars['foreach']["bank"]['iteration']==$this->_env_vars['foreach']["bank"]['total']); ?> <li style='float:left;'> <?php if( $this->_vars['extvalue']['fronttype']=="radio" ){ ?> <input <?php echo $this->_vars['extsval']['checked']; ?> type=<?php echo $this->_vars['extvalue']['fronttype']; ?> name=<?php echo $this->_vars['extvalue']['name']; ?> value=<?php echo $this->_vars['extsval']['value']; ?>> <?php if( $this->_vars['extsval']['imgurl'] ){  echo $this->_vars['extsval']['imgurl'];  }else{  echo $this->_vars['extsval']['name'];  }  }else{ ?> <input <?php echo $this->_vars['extsval']['checked']; ?> type="<?php echo $this->_vars['extvalue']['fronttype']; ?>" name="<?php echo $this->_vars['extvalue']['name']; ?>[]" value="<?php echo $this->_vars['extsval']['value']; ?>"> <?php if( $this->_vars['extsval']['imgurl'] ){  echo $this->_vars['extsval']['imgurl'];  }else{  echo $this->_vars['extsval']['name'];  }  } ?> </li> <?php } unset($this->_env_vars['foreach']["bank"]); ?> </ul> <?php }else{ ?> <select name=$extvalue.name> <?php foreach ((array)$this->_vars['extvalue']['value'] as $this->_vars['extskey'] => $this->_vars['extsval']){ ?> <option value=<?php echo $this->_vars['extsval']['value'];  if( $this->_vars['extsval']['checked'] ){ ?>selected<?php } ?>><?php echo $this->_vars['extsval']['name']; ?></option> <?php } ?> <select> <?php } ?> </div> <?php }  } ?> </td> </tr> <?php } ?> </div> </table> <script>
  

  $$('#_normal_payment th input[type=radio]').addEvent('click',function(){
        current_paytype = $('paytypes['+$E('#_normal_payment th input[checked]').value + ']');
        if($('billNo')){
            if(current_paytype && current_paytype.value.toLocaleLowerCase() == "lakala"){
                if($('billNo').getText() == ""){
                    new Request.HTML({update:'billNo'
                        
                    }).post("<?php echo $this->_vars['base_url']; ?>/index.php?action_getinfo_ctl-get_billno.html",{order_id:"<?php echo $this->_vars['order']['order_id']; ?>", payment_id:$E('#_normal_payment input[checked]').value});
                }
                $('billNo').setStyle('display','block');
            }
            else
                $('billNo').setStyle('display','none');
        }

                 var tr=this.getParent('tr');
                 var table=this.getParent('table');
                 if(table.retrieve('temcheck')){
                    table.retrieve('temcheck').removeClass('ColColorBlue selected');
                 }
                 table.store('temcheck',tr.getElements('td').addClass('ColColorBlue selected'));
           }).setStyle('cursor','pointer');
  if(_checked =$E('#_normal_payment th input[checked]')){
     _checked.fireEvent('click');
  }
  
</script> 