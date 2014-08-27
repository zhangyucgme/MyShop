<?php $CURRENCY = &$this->system->loadModel('system/cur');  if( $this->_vars['shippings'] ){ ?> <table width="100%" cellpadding="0" cellspacing="0" class="liststyle data"> <col class="span-5 ColColorGray"></col> <col class="span-auto textleft"></col> <tbody> <?php foreach ((array)$this->_vars['shippings'] as $this->_vars['key'] => $this->_vars['shipping']){ ?> <tr> <th style="text-align:left;"> <label style="width:auto;"> <input type="radio" name="delivery[shipping_id]" id='shipping_<?php echo $this->_vars['shipping']['dt_id']; ?>' value="<?php echo $this->_vars['shipping']['dt_id']; ?>" class="toCheck" onclick="Order.shippingChange(this,event)" has_cod="<?php echo $this->_vars['shipping']['has_cod']; ?>" /> <?php echo $this->_vars['shipping']['dt_name']; ?> </label> </th> <td> <span style="font-size:14px;" class="fontcolorRed">+<?php echo $CURRENCY->changer($this->_vars['shipping']['price']); ?></span><br /> <?php if( $this->_vars['shipping']['protect'] ){ ?> <div style="border-bottom:1px solid #ccc; padding:5px 0; margin:0 0 5px 0; color:#000;"> <input onclick="Order.shippingMerge($('shipping_<?php echo $this->_vars['shipping']['dt_id']; ?>'),{protect:'true'},this.checked,event)" type="checkbox" name="delivery[is_protect][<?php echo $this->_vars['shipping']['dt_id']; ?>]" value="1" > <strong>保价费率</strong> (商品价格的<?php echo $this->_vars['shipping']['protect_rate']*100; ?>% ，不足<?php echo $CURRENCY->changer($this->_vars['shipping']['minprice']); ?>按<?php echo $CURRENCY->changer($this->_vars['shipping']['minprice']); ?>计算)。</div> <?php }  echo $this->_vars['shipping']['detail']; ?> </td> </tr> <?php } ?> </tbody> </table> <?php }else{ ?> <div class='notice'>不支持您当前所在地区的物流配送，请直接与我们联系</div> <?php } ?> <script>
      
    window.addEvent('domready',function(){
        $ES('input.toCheck','shipping').each(function(shp){
           shp.removeEvents('click').addEvent('click',function(){
                 
                 var tr=this.getParent('tr');
                 var table=this.getParent('table');
                 if(table.retrieve('temcheck')){
                    table.retrieve('temcheck').removeClass('ColColorBlue');
                 }
                 table.store('temcheck',tr.getElements('td').addClass('ColColorBlue'));
           
           }).setStyle('cursor','pointer');
        });
    });
  </script>