<?php if(!function_exists('tpl_input_region')){ require(CORE_DIR.'/include_v5/smartyplugins/input.region.php'); } $CURRENCY = &$this->system->loadModel('system/cur'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> <html lang="en"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <title>快递单打印--<?php echo $this->_vars['orderInfo']['ship_name']; ?></title> <link rel="stylesheet" href="css/admin.css" type="text/css" media="screen, projection"> <script type="text/javascript" src="js/package/tools.js"></script> <script type="text/javascript" src="js/package/component.js"></script> </head> <body> <div class="print-title"><span style="color:#d0d0d0">|</span>&nbsp;&nbsp;&nbsp;&nbsp;<Strong>快递单打印</Strong>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#d0d0d0">|</span></div> <form id="dly_printer_form" action="index.php?ctl=order/delivery_printer&act=do_print" method="post"> <input type="hidden" name="order[order_id]" value="<?php echo $this->_vars['orderInfo']['order_id']; ?>" /> <input type="hidden" name="order[order_count]" value="<?php echo $this->_vars['orderInfo']['itemnum']; ?>" /> <input type="hidden" name="order[ship_time]" value="<?php echo $this->_vars['orderInfo']['ship_time']; ?>" /> <input type="hidden" name="order[order_price]" value="<?php echo $CURRENCY->changer($this->_vars['orderInfo']['total_amount']); ?>" /> <input type="hidden" name="order[order_weight]" value="<?php echo $this->_vars['orderInfo']['weight']; ?>" /> <input type="hidden" name="order[member_id]" value="<?php echo $this->_vars['orderInfo']['member_id']; ?>" /> <input type="hidden" name="order[order_print_id]" value="<?php echo $this->_vars['orderInfo']['print_id']; ?>" /> <div class="tableform" id="x-order_tableform"> <table cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td> <h4>收货地址信息</h4> </td> </tr> </tbody></table> <div class="division"> <table cellspacing="0" cellpadding="0" border="0" width="100%" > <tbody><tr> <th>姓名：</th> <td colspan="3"><input size="10" style="width:80px;" value="<?php echo $this->_vars['orderInfo']['ship_name']; ?>" class="item itemrow _x_ipt" name="order[ship_name]" autocomplete="off"/></td> <td rowspan="5" style="vertical-align:middle;"> <center><div class="division" style="width:150px;"> <table border="0" cellpadding="0" cellspacing="0"> <tr> <td style="text-align:left; color:#aaaaaa;">您也可以将编辑过的收货地址更新至订单</td> </tr> <tr> <td style="height:40px;"><button id="btn_save_addr">保存订单地址</button></td> </tr> </table></div></center></td> </tr> <tr> <th>省区：</th> <td><?php echo tpl_input_region(array('name' => "order[ship_area]",'value' => $this->_vars['orderInfo']['ship_area']), $this);?></td> <th>邮编：</th> <td><input style="width:90px;" size="6" class="item itemrow _x_ipt" name="order[ship_zip]" value="<?php echo $this->_vars['orderInfo']['ship_zip']; ?>" autocomplete="off"/></td> </tr> <tr> <th>地址：</th> <td colspan="3"><input size="50" style="width:400px;" class="item itemrow _x_ipt" name="order[ship_addr]" value="<?php echo $this->_vars['orderInfo']['ship_addr']; ?>" autocomplete="off"/></td> </tr> <tr> <th>手机：</th> <td><input size="36" style="width:145px;" class="item itemrow _x_ipt" value="<?php echo $this->_vars['orderInfo']['ship_mobile']; ?>" name="order[ship_mobile]" autocomplete="off"/></td> <th>电话：</th> <td><input size="36" style="width:145px;" class="item itemrow _x_ipt" value="<?php echo $this->_vars['orderInfo']['ship_tel']; ?>" name="order[ship_tel]" autocomplete="off"/></td> </tr> <tr> <th>备注：</th> <td colspan="3"><input size="50" style="width:400px;" class="item itemrow _x_ipt" name="order[order_memo]" value="<?php echo $this->_vars['orderInfo']['memo']; ?>" autocomplete="off"/></td> </tr> </tbody></table> </div> <h4>发货地址信息</h4> <span style=" padding-left:10px;">发货点选择:<select name="dly_center" id="dly_center_select"> <?php foreach ((array)$this->_vars['dly_centers'] as $this->_vars['item']){  if( $this->_vars['item']['dly_center_id'] == $this->_vars['default_dc'] ){ ?>selected="selected"<?php } ?>><?php echo $this->_vars['item']['name'];  if( $this->_vars['item']['dly_center_id'] == $this->_vars['default_dc'] ){ ?>selected="selected"<?php } ?>><?php echo $this->_vars['item']['name'];  if( $this->_vars['item']['dly_center_id'] == $this->_vars['default_dc'] ){ ?>selected="selected"<?php } ?>><?php echo $this->_vars['item']['name'];  if( $this->_vars['item']['dly_center_id'] == $this->_vars['default_dc'] ){ ?>selected="selected"<?php } ?>><?php echo $this->_vars['item']['name']; ?><option value="<?php echo $this->_vars['item']['dly_center_id']; ?>" <?php if( $this->_vars['item']['dly_center_id'] == $this->_vars['default_dc'] ){ ?>selected="selected"<?php } ?>><?php echo $this->_vars['item']['name']; ?></option> <?php } ?> </select></span> <div class="division" id="dly_center_row"> <?php $_tpl_tpl_vars = $this->_vars; echo $this->_fetch_compile_include("order/dly_center.html", array()); $this->_vars = $_tpl_tpl_vars; unset($_tpl_tpl_vars); ?> </div> </div> <div > <input type="hidden" name="dly_tmpl_id" id="dly_tmpl_id" /> <table align="center" class="table-action"> <tr> <td> <?php foreach ((array)$this->_vars['printers'] as $this->_vars['item']){ ?> <b class="submitBtn" style="margin-left:3px"><input type="button" value="<?php echo $this->_vars['item']['prt_tmpl_title']; ?>" onClick="$('dly_tmpl_id').value='<?php echo $this->_vars['item']['prt_tmpl_id']; ?>';$('dly_printer_form').submit()" /></b> <?php } ?> </td> </tr> </tbody></table> </div> </form> <script>
Element.implement({
  getParentMatch:function(m){
         if(!m)return this.getParent();
         var e=this;
         do{
         e=e.getParent();
         }
         while(e.getTag()!='body'&&!!m(e))
         return e;
      }

});
function selectArea(sel,path,depth){
    var sel=$(sel);
    if(!sel)return;
    var sel_value=sel.value;
    var sel_panel=sel.getParent();
    var selNext=sel.getNext();
    var areaPanel= sel.getParentMatch(function(e){
           return !e.getAttribute('package');
        });
    var setHidden=function(sel){
        var rst=[];
        var sel_break = true;
        var sels=$ES('select',areaPanel);
        sels.each(function(s){
          if(s.getValue()!= '_NULL_' && sel_break){
              rst.push($(s.options[s.selectedIndex]).get('text'));
          }else{
            sel_break = false;
          }
        });
        if(sel.value != '_NULL_'){
            $E('input',areaPanel).value = areaPanel.get('package')+':'+rst.join('/')+':'+sel.value;
        }else{
            $E('input',areaPanel).value =function(sel){
                          var s=sels.indexOf(sel)-1;
                          if(s>=0){
                             return areaPanel.get('package')+':'+rst.join('/')+':'+sels[s].value;
                          }
                          return '';
            }(sel);
        }
        
    };
    if(sel_value=='_NULL_'&&selNext&& 
            (selNext.getTag()=='span' && selNext.hasClass('x-areaSelect'))){
        sel.nextSibling.empty();
        setHidden(sel);
    }else{
        
        /*nextDepth*/
        if($(sel.options[sel.selectedIndex]).get('has_c')){
          new Request({
                onSuccess:function(response){
                    if(selNext && 
                        (selNext.getTag()=='span'&& selNext.hasClass('x-region-child'))){
                        var e = selNext;
                    }else{
                        var e = new Element('span',{'class':'x-region-child'}).inject(sel_panel);
                    }
                    e.set('html',response);
                    setHidden(sel);
                }
            }).get('index.php?ctl=default&act=sel_region&p[0]='+path+'&p[1]='+depth);
        }else{
            sel.getAllNext().remove();
            setHidden(sel);
        }
    }
}
window.addEvent('domready',function(){
    $('dly_center_select').addEvent('change',function(e){
        var dly_center_id =this.getValue();
        new Request.HTML({url:'index.php?ctl=order/delivery_centers&act=instance&p[0]='+dly_center_id,update:$('dly_center_row')}).get();
    });
    $('btn_save_addr').addEvent('click',function(e){
        new Event(e).stop();
        new Request({url:'index.php?ctl=order/order&act=save_addr&p[0]=<?php echo $this->_vars['orderInfo']['order_id']; ?>',method:'post',data:$('x-order_tableform'),onSuccess:function(r){
            if(r=='ok'){
                alert('保存成功!');
            }else{
                alert(r);
            }
        }}).post();
    });
});
window.addEvent('load',function(){
    window.focus();
});
</script> </body> </html>