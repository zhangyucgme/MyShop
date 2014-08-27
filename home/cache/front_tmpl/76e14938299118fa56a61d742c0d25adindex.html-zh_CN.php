<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } $CURRENCY = &$this->system->loadModel('system/cur');  if( count($this->_vars['trading']['products'])>0 or count($this->_vars['trading']['package'])>0 or count($this->_vars['trading']['gift_e'])>0 ){ ?> <div class="CartWrap" id="cart-index"> <div class="CartNav clearfix"><div class="floatLeft"><img src="statics/cartnav-step1.gif" alt="购物流程--查看购物车" /></div><div class="floatRight"><img src="statics/cartnav-cart.gif" /></div></div> <?php if( count($this->_vars['trading']['products'])>0 or count($this->_vars['trading']['package'])>0 or count($this->_vars['trading']['gift_e'])>0 ){ ?> <div class="section" id="cart-items"> <form id="form-cart" action="<?php echo tpl_function_link(array('ctl' => "cart",'act' => "checkout"), $this);?>" method="post" extra="cart"> <div class="FormWrap" id="cartItems"> <?php if( count($this->_vars['trading']['products']) > 0 ){ ?> <h3>已放入购物车的商品:</h3> {buy_product} <div id="goodsbody" class="division"> <table width="100%" cellpadding="3" cellspacing="0" class="liststyle"> <col class="span-2 "></col> <col class="span-auto"></col> <col class="span-2"></col> <col class="span-2"></col> <col class="span-2"></col> <col class="span-2"></col> <col class="span-2 ColColorOrange"></col> <col class="span-2"></col> <thead> <tr> <th>图片</th> <th>商品名称</th> <th>商品积分</th> <th>销售价格</th> <th>优惠价格</th> <th>数量</th> <th>小计</th> <th>删除</th> </tr> </thead> <tbody > <?php foreach ((array)$this->_vars['trading']['products'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr number="<?php echo $this->_vars['item']['nums']; ?>" urlupdate="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'updateCart','arg0' => g,'arg1' => $this->_vars['item']['link_key']), $this);?>" urlremove="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'removeCart','arg0' => g), $this);?>" price="<?php echo $CURRENCY->changer($this->_vars['item']['_pmt']['price'],'',true,false); ?>" > <td> <div class='cart-product-img' isrc="<?php echo tpl_modifier_storager(((isset($this->_vars['item']['thumbnail_pic']) && ''!==$this->_vars['item']['thumbnail_pic'])?$this->_vars['item']['thumbnail_pic']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" ghref='<?php echo tpl_function_link(array('ctl' => product,'act' => "index",'arg0' => $this->_vars['item']['goods_id']), $this);?>' style='width:50px;height:50px;'> <img src='statics/loading.gif'/> </div> </td> <td style='text-align:left'><a href='<?php echo tpl_function_link(array('ctl' => product,'act' => "index",'arg0' => $this->_vars['item']['goods_id']), $this);?>' target='_blank'><?php echo $this->_vars['item']['name'];  if( $this->_vars['item']['spec'] ){ ?> (<?php echo $this->_vars['item']['spec']; ?>)<?php }  echo $this->_vars['item']['addon']['adjname'];  if( $this->_vars['item']['_pmt']['describe'] ){ ?><div class="ht1"><?php echo $this->_vars['item']['_pmt']['describe']; ?></div><?php } ?></a></td> <td><?php echo intval($this->_vars['item']['_pmt']['score']); ?></td> <td class=" mktprice1"><?php echo $CURRENCY->changer($this->_vars['item']['sale_price']); ?></td> <td><?php echo $CURRENCY->changer($this->_vars['item']['_pmt']['price']); ?></td> <td> <div class="Numinput"> <input type="text" class="_x_ipt textcenter" value="<?php echo $this->_vars['item']['nums']; ?>" onchange="Cart.ItemNumUpdate(this,this.value,event);" size="3" name="cartNum[g][<?php echo $this->_vars['item']['key']; ?>]" /> <span class="numadjust increase" onclick="Cart.ItemNumUpdate($(this).getPrevious('input'),1,event);"></span> <span class="numadjust decrease" onclick="Cart.ItemNumUpdate($(this).getPrevious('input'),-1,event);"></span> </div><?php if( !is_null($this->_vars['item']['store']) && $this->_vars['item']['store'] < $this->_vars['alert_num'] ){ ?>(提示:商品缺货)<?php } ?></td> <td class="itemTotal fontcolorRed"><?php echo $CURRENCY->changer($this->_vars['item']['_pmt']['amount']); ?></td> <td><span class="lnk quiet fontcolorRed" onclick='Cart.removeItem(this,event);'><img src="statics/transparent.gif" alt="删除" style="width:13px;height:13px;background-image:url(statics/bundle.gif);background-repeat:no-repeat;background-position:0 -27px;" /></span></td> </tr> <?php } ?> </tbody> </table> </div> <?php }  if( $this->_vars['trading']['gift_e'] ){ ?> <h3>赠品</h3> <div id="giftbody" class="division" > <table width="100%" cellpadding="0" cellspacing="0" class="liststyle" > <col class="span-2"></col> <col></col> <col class="span-2"></col> <col class="span-2 "></col> <col class="span-1"></col> <col class="span-2 ColColorOrange"></col> <col class="span-2"></col> <thead> <tr> <th>图片</th> <th>赠品名称</th> <th>所需积分</th> <th>限购数量</th> <th>数量</th> <th>小计</th> <th>删除</th> </tr> </thead> <tbody > <?php foreach ((array)$this->_vars['trading']['gift_e'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr number="<?php echo $this->_vars['item']['nums']; ?>" urlupdate="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'updateCart','arg0' => f,'arg1' => $this->_vars['item']['gift_id']), $this);?>" urlremove="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'removeCart','arg0' => f), $this);?>" point="<?php echo $CURRENCY->changer($this->_vars['item']['point'],'',true,false); ?>"> <td><a href="<?php echo tpl_function_link(array('ctl' => gift,'act' => 'index','arg0' => $this->_vars['item']['gift_id']), $this);?>" target='_blank' style='margin:0;padding:0;text-decoration:none;'><img src="<?php echo tpl_modifier_storager(((isset($this->_vars['item']['thumbnail_pic']) && ''!==$this->_vars['item']['thumbnail_pic'])?$this->_vars['item']['thumbnail_pic']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" <?php if( $this->system->getConf('site.thumbnail_pic_width') >0 && $this->system->getConf('site.thumbnail_pic_height') >0 ){ ?>width="<?php echo $this->system->getConf('site.thumbnail_pic_width'); ?>" height="<?php echo $this->system->getConf('site.thumbnail_pic_height'); ?>"<?php } ?> /></a></td> <td style='text-align:left'><a href="<?php echo tpl_function_link(array('ctl' => gift,'act' => 'index','arg0' => $this->_vars['item']['gift_id']), $this);?>" target='_blank'><?php echo $this->_vars['item']['name']; ?></a></td> <td><?php echo $this->_vars['item']['point']; ?></td> <td><?php if( $this->_vars['item']['limit_num']=='0' ){ ?>不限制<?php }else{  echo $this->_vars['item']['limit_num'];  } ?></td> <td><div class="Numinput"><input type="text" class="_x_ipt textcenter" onchange="Cart.ItemNumUpdate(this,this.value,event);" value=<?php echo $this->_vars['item']['nums']; ?> size="3" name="cartNum[f][<?php echo $this->_vars['item']['gift_id']; ?>]" > <span class="numadjust increase" onclick="Cart.ItemNumUpdate($(this).getPrevious('input'),1,event);"></span> <span class="numadjust decrease" onclick="Cart.ItemNumUpdate($(this).getPrevious('input'),-1,event);"></span> </div></td> <td class="itemTotal"><?php echo $this->_vars['item']['amount']; ?></td> <td><span class="lnk quiet" onclick='Cart.removeItem(this,event);'><img src="statics/transparent.gif" alt="删除" style="width:13px;height:13px;background-image:url(statics/bundle.gif);background-repeat:no-repeat;background-position:0 -27px;" /></span></td> </tr> <?php } ?> </tbody> </table> </div> <?php }  if( $this->_vars['trading']['package'] ){ ?> <h3>捆绑商品</h3> <div id="pkgbody" class="division"> <table width="100%" cellpadding="0" cellspacing="0" class="liststyle"> <col class="span-2"></col> <col style="width:auto;"></col> <col class="span-2 "></col> <col class="span-1"></col> <col class="span-2 ColColorOrange"></col> <col class="span-2"></col> <thead> <tr> <th>货号</th> <th>捆绑名称</th> <th>优惠价格</th> <th>数量</th> <th>小计</th> <th>删除</th> </tr> </thead> <tbody> <?php foreach ((array)$this->_vars['trading']['package'] as $this->_vars['key'] => $this->_vars['item']){ ?> <tr number="<?php echo $this->_vars['item']['nums']; ?>" urlupdate="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'updateCart','arg0' => p,'arg1' => $this->_vars['item']['goods_id']), $this);?>" urlremove="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'removeCart','arg0' => p), $this);?>" price="<?php echo $CURRENCY->changer($this->_vars['item']['price'],'',true,false); ?>"> <td><?php echo $this->_vars['item']['bn']; ?></td> <td style='text-align:left'><a href='<?php echo tpl_function_link(array('ctl' => package,'act' => "index"), $this);?>' target='_blank'><?php echo $this->_vars['item']['name'];  echo $this->_vars['item']['addon']['adjname']; ?></a></td> <td><?php echo $CURRENCY->changer($this->_vars['item']['price']); ?></td> <td><div class="Numinput"><input type="text" class="_x_ipt textcenter" onchange="Cart.ItemNumUpdate(this,this.value,event);" value=<?php echo $this->_vars['item']['nums']; ?> size="3" name="cartNum[p][<?php echo $this->_vars['item']['goods_id']; ?>]" > <span class="numadjust increase" onclick="Cart.ItemNumUpdate($(this).getPrevious('input'),1,event);"></span> <span class="numadjust decrease" onclick="Cart.ItemNumUpdate($(this).getPrevious('input'),-1,event);"></span> </div></td> <td class="itemTotal"><?php echo $CURRENCY->changer($this->_vars['item']['amount']); ?></td> <td><span class="lnk quiet" onclick='Cart.removeItem(this,event);'><img src="statics/transparent.gif" alt="删除" style="width:13px;height:13px;background-image:url(statics/bundle.gif);background-repeat:no-repeat;background-position:0 -27px;" /></span></td> </tr> <?php } ?> </tbody> </table> </div> <?php } ?> <div class='span-auto' style='width:45%'> <div id='cart-coupon'> <?php if( count($this->_vars['trading']['coupon_u'])>0 ){ ?> <div class="promotion">使用的优惠券：<?php foreach ((array)$this->_vars['trading']['coupon_u'] as $this->_vars['key'] => $this->_vars['item']){ ?><strong><?php echo $this->_vars['key']; ?></strong><?php } ?><a href="<?php echo tpl_function_link(array('ctl' => cart,'act' => 'removeCoupon'), $this);?>" class="lnk" style="margin:0 0 0 20px;">取消优惠券</a></div> <?php }else{ ?> 对以上商品使用优惠券：</{t}><?php echo tpl_input_default(array('type' => "text",'name' => "coupon",'id' => "-s-ipt-coupon",'size' => "30",'value' => "请输入优惠券号码",'onclick' => "this.value=(this.value=='请输入优惠券号码')?'':this.value"), $this);?> <input id='cart-coupon-submitBtn' type="button" value="确定" /> <script>
                      $('cart-coupon-submitBtn').addEvent('click',function(e){
                          e.stop();
                          new Element('form',{method:'post',action:'<?php echo tpl_function_link(array('ctl' => "cart",'act' => "applycoupon"), $this);?>'}).adopt($('cart-coupon').clone()).inject(document.body).submit();
                      });
                  </script> <?php } ?> </div> </div> <div class="floatRight" style='width:45%'> <div id="cartTotal"> <?php echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'."cart/cart_total.html")?('user:'.$this->theme.'/'."cart/cart_total.html"):('shop:'."cart/cart_total.html"), array());?> </div> </div> <div class="clear"></div> </div> <div class="CartBtn clearfix" style="margin-bottom:5px;"> <div class="span-auto"><a href="./" class="actbtn btn-return" >&laquo;继续购物</a></div> <div class="span-auto"><a id="clearCart" class="actbtn btn-clearcat" href="javascript:Cart.empty('<?php echo tpl_function_link(array('ctl' => cart,'act' => 'removeCart','arg0' => all), $this);?>');">清空购物车</a></div> <div class="span-auto floatRight"><input class="actbtn btn-next" type="submit" value="下单结算&raquo;" /></div> </div> </form> </div> <?php } ?> <div id="cart-none-msg" style='<?php if( count($this->_vars['trading']['products'])>0 or count($this->_vars['trading']['package'])>0 or count($this->_vars['trading']['gift_e'])>0 ){ ?>display:none;<?php } ?>'> <br/> <br/> <div class='success' >您已清空了购物车.</div> <h3>现在您可以:</h3> <ul class='list'> <li><a href='./'>返回网站首页</a></li> <li><a href='javascript:opener=null;window.close();'>关闭此页面</a></li> </ul> </div> </div> <script>
/*
*CartJs update :2009-9-8 11:33:20
*
*@author litie[aita]shopex.cn
*
*------------------------/


/*购物车小图mouseenter效果*/
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
  
   $ES('#cart-index .cart-product-img').each(function(i){
  
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
         
/*购物车处理*/
void function(){
    
    var cartForm = $('form-cart');
    var cartTotalPanel = $('cartTotal');
    
    Cart=new Object();
    Cart.utility={
        keyCodeFix:[48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,8,9,46,37,39],
        moneyFormat:{
            rule:<?php echo ((isset($this->_vars['currency']) && ''!==$this->_vars['currency'])?$this->_vars['currency']:'null'); ?>,/*evaluate form PHP Smarty*/
            format:function(num){
                var rule = this.rule;
                num = num.toFloat();
                num = num.round(rule.decimals)+'';
                var p =num.indexOf('.');
                if(p<0){
                    p = num.length;
                    part = '';
                }else{
                    part = num.substr(p+1);
                }
                    while(part.length<rule.decimals){
                        part+='0';
                    }
                var c=[];
                while(p>0){
                    if(p>2){
                        c.unshift(num.substr(p-=3,3));
                    }else{
                        c.unshift(num.substr(0,p));
                        break;
                    }
                }
                return rule.sign+c.join(rule.thousands_sep)+rule.dec_point+part;
            }
        }
    };
    
    
    $extend(Cart,{
         removeItem:function(handle,evt){
             evt = new Event(evt).stop();
             if(!confirm('确认删除？'))return;
             var item = $(handle).getParent('tr');
             var remoteURL = item.get('urlremove');
             item.getFormElements().set('disabled',true);
             this.updateTotal(remoteURL,{
             onRequest:function(){
                 item.getFirst().set({'html':'正在删除...'});
                 item.setStyles({'background':'#FBE3E4','opacity':1})
             },
             onComplete:function(){
                 new Fx.Style(item,'opacity').start(0).chain(function(){
                 
                       this.element.remove();
                       /*购物车删除操作到极限时,刷新购物车页*/
                       if(!$$('#cartItems tr[urlremove]').length){location.reload();}
                 
                 });
             }});
         },
         ItemNumUpdate:function(numInput,num,evt){
              var forUpNum = numInput.value.toInt();
              if(new Event(evt).target!=numInput){
                 forUpNum = (isNaN(forUpNum)?1:forUpNum)+num;
              }
              numInput.value = forUpNum.limit(1,Number.MAX_VALUE);
              this.updateItem(numInput,numInput.getParent('tr'));
         },
         updateItem:function(input,item){
             item.retrieve('request',{cancel:$empty}).cancel();
             item.store('request',new Request({data:cartForm,onSuccess:function(res){
                    if(res.contains('totalprice')){
                        var iptValue = input.value;
                        item.setAttribute('number',iptValue);
                        cartTotalPanel.set('html',res);
                        
                         /*todo*/
                        if($$('#cart-total-item tr').length){
                            $('cart-total-item').setStyle('display','');
                        }
                       
                        if(price=item.get('price')){
                            item.getElement('.itemTotal').set('html', Cart.utility.moneyFormat.format(price.toFloat()*iptValue));
                        }
                        if(point=item.get('point')){
                           item.getElement('.itemTotal').set('html', point.toFloat()*iptValue);
                        }
                    }else{
                      input.focus();
                      input.value = item.get('number');
                      MessageBox.error(res);
                    }
             
             }}).post(item.get('urlupdate')));
         },
         updateTotal:function(remoteURL,options){
            options = options||{};
            new Request.HTML($extend({update:cartTotalPanel,url:remoteURL,data:cartForm},options)).post();
         },
         empty:function(remoteURL){
            if(!confirm('确认清空购物车？'))return;
            
            new Request({
                
                onRequest:function(){
                   MessageBox.success('清空购物车成功,正在准备刷新本页');
                },
                onComplete:function(){
                  
                    location.href=location.href;
                    
                    
                }
            
            }).post(remoteURL);
         }
    });
  
    /*购物数量输入控制*/
    $$('#form-cart input[name^=cartNum[]').addEvent('keydown',function(e){
    
     if(!Cart.utility.keyCodeFix.contains(e.code)){
        
         e.stop();
     }
     
    
    });
    /*数量调节按钮样式*/
   $$('#form-cart .numadjust').addEvents({
             'mousedown':function(){
                this.addClass('active');
             },
             'mouseup':function(){
               this.removeClass('active');
             }
         });
    
}();       
         
</script> <?php }else{ ?> <div id="cart-none-msg"> <div class='note' style='border-width:1px;'> <h3> 购物车目前没有加入任何商品!</h3> <ul class='list'> <li><a href='./'>继续挑选商品»»</a></li> <li><a href='javascript:opener=null;window.close();'>关闭此页面</a></li> </ul> </div> </div> <?php } ?> 