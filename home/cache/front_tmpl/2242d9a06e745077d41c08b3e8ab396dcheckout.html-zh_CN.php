<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } if(!function_exists('tpl_function_javascript')){ require(CORE_DIR.'/include_v5/smartyplugins/function.javascript.php'); } $CURRENCY = &$this->system->loadModel('system/cur'); ?><div class="CartWrap" id="log"> <div class="CartNav clearfix"> <div class="floatLeft"> <img src="statics/cartnav-step3.gif" alt="购物流程--确认订单填写购物信息" /> </div> <div class="floatRight"><img src="statics/cartnav-cart.gif" /></div> </div> <form method="post" action='<?php echo tpl_function_link(array('ctl' => "order",'act' => "create"), $this);?>' id="order-create" extra="subOrder" > <?php if( $_POST['isfastbuy'] ){ ?> <input type='hidden' name='isfastbuy' value=1 /> <?php } ?> <div style="display:none"><?php echo tpl_input_default(array('type' => "checkForm"), $this);?></div> <?php echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'."cart/checkout_base.html")?('user:'.$this->theme.'/'."cart/checkout_base.html"):('shop:'."cart/checkout_base.html"), array());?> <div class="FormWrap"> <?php if( $this->_vars['trading']['products'] ){ ?> <h3>购买的商品</h3> <div class="division"> <table width="100%" cellpadding="0" cellspacing="0" class="liststyle"> <col class="span-auto"></col> <col class="span-auto textleft"></col> <col class="span-2"></col> <col class="span-2"></col> <col class="span-2"></col> <col class="span-1"></col> <col class="span-2 ColColorOrange"></col> <thead> <tr> <th>图片</th> <th class="product">商品名称</th> <th class="price">积分</th> <th class="price">销售价格</th> <th class="number">优惠价格</th> <th class="number">数量</th> <th class="price">小计</th> </tr> </thead> <tbody> <?php foreach ((array)$this->_vars['trading']['products'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr> <td> <div class='product-list-img' isrc="<?php echo tpl_modifier_storager(((isset($this->_vars['item']['thumbnail_pic']) && ''!==$this->_vars['item']['thumbnail_pic'])?$this->_vars['item']['thumbnail_pic']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" ghref='<?php echo tpl_function_link(array('ctl' => product,'act' => "index",'arg0' => $this->_vars['item']['goods_id']), $this);?>' style='width:50px;height:50px;'> <img src='statics/loading.gif'/> </div> </td> <td class="product;" style="text-align:left;"><?php echo $this->_vars['item']['name'];  echo $this->_vars['item']['addon']['adjname'];  if( $this->_vars['item']['_pmt']['describe'] ){ ?><div class="ht1"><?php echo $this->_vars['item']['_pmt']['describe']; ?></div><?php } ?> <input type="hidden" name="cart[g][cart][<?php echo $this->_vars['item']['key']; ?>]" value="<?php echo $this->_vars['item']['nums']; ?>" /> <input type="hidden" name="cart[g][pmt][<?php echo $this->_vars['item']['goods_id']; ?>]" value="<?php echo $this->_vars['item']['pmt_id']; ?>" /></td> <td class="price"><?php echo intval($this->_vars['item']['_pmt']['score']); ?></td> <td class="price"><?php echo $CURRENCY->changer($this->_vars['item']['sale_price']); ?></td> <td class="cost"><?php echo $CURRENCY->changer($this->_vars['item']['_pmt']['price']); ?></td> <td class="number"><?php echo $this->_vars['item']['nums'];  if( !is_null($this->_vars['item']['store']) && $this->_vars['item']['nums'] > $this->_vars['item']['store'] ){ ?><h3 class="t">(提示:需要备货)</h3><?php } ?></td> <td class="cost"><?php echo $CURRENCY->changer($this->_vars['item']['_pmt']['amount']); ?></td> </tr> <?php } ?> </tbody> </table> </div> <?php }  if( $this->_vars['trading']['gift_e'] ){ ?> <h3>赠品</h3> <div class="division"> <table width="100%" cellpadding="3" cellspacing="0" class="liststyle"> <col class="span-auto"></col> <col class="span-2"></col> <col class="span-2"></col> <col class="span-1"></col> <col class="span-2 ColColorOrange"></col> <thead> <tr> <th>赠品名称</th> <th>所需积分</th> <th>限制购买数量</th> <th>数量</th> <th>小计</th> </tr> </thead> <tbody> <?php foreach ((array)$this->_vars['trading']['gift_e'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr> <td><?php echo $this->_vars['item']['name']; ?></td> <td><?php echo $this->_vars['item']['point']; ?></td> <td ><?php if( $this->_vars['item']['limit_num']=='0' ){ ?>不限制<?php }else{  echo $this->_vars['item']['limit_num'];  } ?></td> <td><?php echo $this->_vars['item']['nums']; ?></td> <td><?php echo $this->_vars['item']['amount']; ?></td> </tr> <?php } ?> </tbody> </table> </div> <?php }  if( $this->_vars['trading']['package'] ){ ?> <h3>捆绑商品</h3> <div class="division"> <table width="100%" cellpadding="3" cellspacing="0" class="liststyle"> <col class="span-auto"></col> <col class="span-2"></col> <col class="span-1"></col> <col class="span-2 ColColorOrange"></col> <thead> <tr> <th class="product" width="53%">捆绑名称</th> <th class="price" width="12%">优惠价格</th> <th class="number" width="4%">数量</th> <th class="price" width="9%">小计</th> </tr> </thead> <tbody> <?php foreach ((array)$this->_vars['trading']['package'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr> <td class="product"><?php echo $this->_vars['item']['name'];  echo $this->_vars['item']['addon']['adjname']; ?></td> <td class="price"><?php echo $CURRENCY->changer($this->_vars['item']['price']); ?></td> <td class="number"><?php echo $this->_vars['item']['nums']; ?></td> <td class="cost"><?php echo $CURRENCY->changer($this->_vars['item']['amount']); ?></td> </tr> <?php } ?> </tbody> </table> </div> <?php } ?> </div> <div id="amountInfo"> <?php echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'."cart/checkout_total.html")?('user:'.$this->theme.'/'."cart/checkout_total.html"):('shop:'."cart/checkout_total.html"), array());?> </div> <div class="CartBtn clearfix"> <input type="hidden" name="fromCart" value="true" /> <div class="span-auto"><input class="actbtn btn-return-checkout" onClick="window.location='<?php echo tpl_function_link(array('ctl' => cart,'act' => index), $this);?>';" type="button" value="返回购物车" /></div> <div class="span-auto floatRight last"><input class="actbtn btn-confirm" id="order_ct_dgc" type="submit" value="确认无误，下订单" /></div> </div> </form> </div> <?php echo tpl_function_javascript(array('file' => 'formplus.js'), $this);?> <script>
/*下单*/
void function(){

    Order =new Object();
    
    $extend(Order,{
        paymentChange:function(){
         
          this.updateTotal();
        },
        setShippingFromArea:function(lastselect){
           if(!lastselect)throw new Error('非法的地区信息.');
           var _value = lastselect.value;
           var _isfastbuy = '<?php echo $_POST['isfastbuy']; ?>';
            new Request.HTML({url:Shop.url.shipping,update:'shipping',onRequest:function(){
                  $('shipping').set('text','正在根据地区信息获得配送方式...');
               }}).post({area:_value, isfastbuy:_isfastbuy});
        },
        setCurrency:function(){
           
            new Request.HTML({update:$('payment'),onComplete:this.updatePayment.bind(this)}).post(Shop.url.payment,$H({
               'cur':$('payment-cur').getValue(),
               'payment':$E('#payment th input[checked]')?$E('#payment th input[checked]').value:null,
               'd_pay':$E('#shipping th input[checked]')?$E('#shipping th input[checked]').get('has_cod'):null
            }));      
        },
        updatePayment:function(){
      
             if(this.synTotalHash.d_pay&&this.synTotalHash.d_pay>0){
                    $('_normal_payment').hide();
                    $('_pay_cod').show().getElement('input[type=radio]').checked=true;
                }else{
                    $('_normal_payment').show();
                    $('_pay_cod').hide().getElement('input[type=radio]').checked=false;
                }
              
        },
        shippingChange:function(target,evt){
           this.clearProtect(target);
           this.updateTotal({onRequest:this.updatePayment.bind(this)});
        },
        clearProtect:function(target){
           if(tmpEl=$('shipping').retrieve('tmp_protect')){
                   if(tmpEl!=target){
                    tmpEl.removeProperty('protect');                
                     $E('input[name^=delivery[is_protect]',tmpEl.getParent('tr')).checked=false;
                }
           }     
           if(tmpEl!=target&&target.get('protect'))$('shipping').store('tmp_protect',target);    
        }, 
        shippingMerge:function(target,mg,checked,evt){
           if(!checked){
               $H(mg).getKeys().each(target.erase.bind(target));
           }else{
               $(target).set(mg);
               $(target).checked=true;
           }
           this.shippingChange($(target));
        },
        updateTotal:function(options){
            options = options||{};
            
            this.synTotalHash = (this.synTotalHash||{});
            
            var _shipping = $E('#shipping th input[checked]');
            var _payment  = $E('#payment th input[checked]');
            var _coin     = $('payment-cur');
            var _tax      = $('is_tax');
            if(_shipping){
                $extend(this.synTotalHash,{
                    shipping_id:_shipping.value,
                    is_protect:_shipping.get('protect')?'true':'false',
                    d_pay:_shipping.get('has_cod')
                });
            }
            if(_payment){
                 $extend(this.synTotalHash,{
                    payment:_payment.value
                });
            }
            if($E('#order-create input[name=isfastbuy]')){
                 $extend(this.synTotalHash,{
                    isfastbuy:1
                });
            }
             $extend(this.synTotalHash,{
                cur:_coin.getValue(),
                is_tax:(_tax&&_tax.checked)?'true':'false',
                area:$E('input[name^=delivery[ship_area]')?$E('input[name^=delivery[ship_area]').getValue():null
            });
            
            new Request.HTML($extend({update:$('amountInfo')},options)).post(Shop.url.total,$H(this.synTotalHash));
        
        }
    
    });
    
}();

void function(){

var _warning=function(msg,go){
    
    alert(msg);
    go.show();
   <?php if( $this->_vars['trading']['admindo'] ){ ?>
     $('main').scrollTo(0,(go||$('order-create')).getPosition().y-50);
   <?php }else{ ?>
     window.scrollTo(0,(go||$('order-create')).getPosition().y-50);
   <?php } ?>
};


if(!extra_validator['subOrder']){
  extra_validator['subOrder'] ={
    'checkForm':['',function(f,i){
        
        var addr_num = 0;
        var checkTag = false;
        $$('input[name^=delivery[addr_id]','receiver').each(function(item){
            addr_num++;
            if(item.checked){
                checkTag = true;
            }
        });
        if(checkTag==false && addr_num>0){
            _warning('请选择收货地址！',$('checkout-recaddr'));
            return false;
        }
        
        $ES('select', 'checkout-select-area').each(function(item){
            if(!item.getValue()){
                _warning('请重新选择收货地区！',$('checkout-recaddr'));
                $('checkout-recaddr').style.display='block';
                item.focus();
                return false;
            }
        });
        if($('checkout-recaddr').getElement('input[name^=delivery[ship_tel]').getProperty('value').trim() == '' && $('checkout-recaddr').getElement('input[name^=delivery[ship_mobile]').getProperty('value').trim() == ''){
          _warning('请填写 电话 或 手机 其中至少一种联系方式！',$('checkout-recaddr'));
          return false;
        }
        
        var checkNum = 0;
        $ES('input[name^=delivery[shipping_id]',"shipping").each(function(item){
          if(item.checked == true) checkNum++;
        });
        if(checkNum == 0){
          _warning('请选择配送方式！',$('shipping'));
          return false;
        }
        
        checkNum = 0;
        $ES('input[name^=payment[payment]',"payment").each(function(item){
          if(item.checked == true) checkNum++;
        });
        if(checkNum == 0){
          _warning('请选择支付方式！',$('payment'));
          return false;
        }
          checkNum = 0;
    if($ES('tr',"_normal_payment").some(function(el){return el.hasClass('checked');})){        
        $E('#payment .checked').getElements('input').each(function(item){
                  if(item.checked == true) checkNum++;
           });
           if(checkNum == 0){
                  _warning('请选择支付银行！',$('payment'));
                  return false;
         } 
      }
    checkNum = 0;
    if($ES('tr',"_normal_payment").some(function(el){return el.hasClass('checked');})){        
        $E('#payment .checked').getElements('input').each(function(item){
                  if(item.checked == true) checkNum++;
           });
           if(checkNum == 0){
                  _warning('请选择支付银行！',$('payment'));
                  return false;
         } 
      }
        /*checkNum = 0;
        var objf;
        $ES('input[name^=minfo[]',"misc").each(function(item){
          if(item.value == ''){
            checkNum++;
            objf = item;
          }
        });
        $ES('select[name^=minfo[]',"misc").each(function(item){
          if(item.getValue() == ''){
            checkNum++;
            objf = item;
          }
        });
        $ES('textarea[name^=minfo[]',"misc").each(function(item){
          if(item.getValue() == ''){
            checkNum++;
            objf = item;
          }
        });
        
        if(checkNum){
          _warning('订单购物信息不完整，请补充填写！');
          objf.focus();
          return false;
        }else{
          return true;
        }*/

        return true;
      }]
  };
}
}();


/*小图mouseenter效果*/
window.addEvent('domready',function(){

  var cart_product_img_viewer=new Element('div',{styles:{'position':'absolute','zIndex':500,'opacity':0,'border':'1px #666 solid'}}).inject(document.body);
  
  var cpiv_show=function(img,event){
       
      if(!img)return;
      cart_product_img_viewer.empty().adopt($(img).clone().removeProperties('width','height').setStyle('border','1px #fff solid')).fade(1);
      
      var size = window.getSize(), scroll = window.getScroll();
        var tip = {x: cart_product_img_viewer.offsetWidth, y: cart_product_img_viewer.offsetHeight};
        var props = {x: 'left', y: 'top'};
        for (var z in props){
            var pos = event.page[z] + 10;
            if ((pos + tip[z] - scroll[z]) > size[z]) pos = event.page[z] - 10 - tip[z];
            cart_product_img_viewer.setStyle(props[z], pos);
        }
  
  };
  
   $$('.product-list-img').each(function(i){
  
       new Asset.image(i.get('isrc'),{onload:function(img){
       if(!img)return;
           var _img=img.zoomImg(50,50);
             if(!_img)return;
           _img.setStyle('cursor','pointer').addEvents({
              'mouseenter':function(e){
                 cpiv_show(_img,e);
              },
              'mouseleave':function(e){
                cart_product_img_viewer.fade(0);
              }
           });
           i.empty().adopt(new Element('a',{href:i.get('ghref'),target:'_blank',styles:{border:0}}).adopt(_img));                 
       },onerror:function(){
            i.empty();
        
       }});
   
   });
   
   
});

window.addEvent('domready',function(){
$('order-create').removeEvents('submit').addEvent('submit', function(e){
                    if(!this.bindValidator()){
                       e.stop();
                       return false;
                    }else{
                        $('order_ct_dgc').disabled=true;
                    }
                });

});
</script> 