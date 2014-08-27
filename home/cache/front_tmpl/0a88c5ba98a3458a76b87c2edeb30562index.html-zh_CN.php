<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_modifier_escape')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.escape.php'); } if(!function_exists('tpl_modifier_number')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.number.php'); } if(!function_exists('tpl_modifier_userdate')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.userdate.php'); } if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } if(!function_exists('tpl_function_goodsmenu')){ require(CORE_DIR.'/include_v5/smartyplugins/function.goodsmenu.php'); } if(!function_exists('tpl_modifier_cut')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.cut.php'); } if(!function_exists('tpl_modifier_cdate')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.cdate.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } if(!function_exists('tpl_input_textarea')){ require(CORE_DIR.'/include_v5/smartyplugins/input.textarea.php'); } if(!function_exists('tpl_input_checkbox')){ require(CORE_DIR.'/include_v5/smartyplugins/input.checkbox.php'); } if(!function_exists('tpl_modifier_replace')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.replace.php'); } $CURRENCY = &$this->system->loadModel('system/cur'); ?><script>
  /*商品详细通用函数*/

   var priceControl={
              base:<?php echo $CURRENCY->changer($this->_vars['goods']['price'],null,true); ?>,
              _format:<?php echo ((isset($this->_vars['money_format']) && ''!==$this->_vars['money_format'])?$this->_vars['money_format']:'false'); ?>,
              format:function(num){
                var part;
                if(!num)return;
                var num = num.toFloat();
                    num = num.round(this._format.decimals)+'';
                    var p =num.indexOf('.');
                    if(p<0){
                        p = num.length;
                        part = '';
                    }else{
                        part = num.substr(p+1);
                    }
                    while(part.length<this._format.decimals){
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
                    if(!part){
                        this._format.dec_point='';
                    }
                    return (this._format.sign||"")+c.join(this._format.thousands_sep)+this._format.dec_point+part;
            }
       };

    String.implement({
      toFormElements:function(){
            if(!this.contains('=')&&!this.contains('&'))return new Element('input',{type:'hidden'});
            var elements=[];
            var queryStringHash=this.split('&');
            $A(queryStringHash).each(function(item){
                if(item.contains('=')){
                    item=$A(item.split('='));
                    elements.push(new Element('input',{type:'hidden',name:item[0],value:item[1]}));
                }else{
                  elements.push(new Element('input',{type:'hidden',name:item}));
                }
            });
            return new Elements(elements);
            }
    });
    Number.implement({
           interzone:function(min,max){
                 var _v=this.toFloat();
                 if(!_v)_v=0;
                 return _v>=min&&_v<=max;
             }
          });
   var keyCodeFix=[48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,8,9,46,37,39];


</script> <div class="GoodsInfoWrap"> <div id="goods-viewer"> <table width="100%"> <tr> <td valign="top" align="center"> <div class='goodspic'> <?php echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'."product/goodspics.html")?('user:'.$this->theme.'/'."product/goodspics.html"):('shop:'."product/goodspics.html"), array());?> </div> </td> <td width="60%" valign="top"> <form class="goods-action" action="<?php echo tpl_function_link(array('ctl' => cart,'act' => addGoodsToCart), $this);?>" gnotify="<?php echo tpl_function_link(array('ctl' => product,'act' => gnotify), $this);?>" method="post"<?php if( $this->_vars['goods']['setting']['buytarget']==2 ){ ?> target="_blank_cart"<?php }elseif( $this->_vars['goods']['setting']['buytarget']==3 ){ ?> target="_dialog_minicart"<?php } ?>> <h1 class="goodsname"><?php echo tpl_modifier_escape($this->_vars['goods']['name'],"html"); ?></h1> <?php if( $this->_vars['goods']['brief'] ){ ?> <p class="brief"><?php echo $this->_vars['goods']['brief']; ?></p> <?php } ?> <ul class="goodsprops clearfix"> <?php if( $this->_vars['goods']['bn'] && $this->_vars['goodsBnShow'] ){ ?><li><span>商品编号：</span><?php echo $this->_vars['goods']['bn']; ?></li><?php }  if( $this->_vars['goods']['weight'] && $this->_vars['goods']['weight'] != 0.000 ){ ?><li><span>商品重量：</span><span id="goodsWeight"><?php if( $this->_vars['goods']['weight'] ){  echo $this->_vars['goods']['weight'];  }else{  echo $this->_vars['goods']['weight']['0']['bn'];  } ?></span> 克(g)</li><?php }  if( $this->_vars['goods']['product_bn'] or $this->_vars['goods']['products']['0']['bn'] ){ ?><li><span>货　　号：</span><span id="goodsBn"><?php if( $this->_vars['goods']['product_bn'] ){  echo $this->_vars['goods']['product_bn'];  }else{  echo $this->_vars['goods']['products']['0']['bn'];  } ?></span></li><?php }  if( $this->_vars['goods']['brand_name'] ){ ?><li><span>品　　牌：</span><?php if( $this->_vars['goodsproplink'] ){ ?><a href="<?php echo $this->_plugins['function']['selector'][0]->_selector(array('type' => 'b','key' => $this->_vars['goods']['brand_id']), $this);?>" target="_blank"><?php echo $this->_vars['goods']['brand_name']; ?></a><?php }else{  echo $this->_vars['goods']['brand_name'];  } ?></li><?php }  if( $this->_vars['goods']['unit'] ){ ?><li><span>计量单位：</span><?php echo $this->_vars['goods']['unit']; ?></li><?php }  if( $this->_vars['goods']['setting']['score'] && $this->_vars['goods']['score'] ){ ?><li><span>所得积分：</span><span id="goodsScore"><?php echo $this->_vars['goods']['score']; ?></span><?php }  if( $this->_vars['trading']['score'] && $this->_vars['trading']['score'] <>$this->_vars['goods']['score'] ){ ?><li>特价积分：<?php echo $this->_vars['trading']['score']; ?></li><?php }  if( $this->_vars['goodspropposition']<>2 ){  if( $this->_vars['goods']['prototype']['setting']['use_props'] == 1 ){  foreach ((array)$this->_vars['goods']['prototype']['ordernum'] as $this->_vars['key'] => $this->_vars['propord']){  if( $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['show'] ){  $this->_vars["pkey"]="p_{$this->_vars['propord']}";  $this->_vars["pcol"]=$this->_vars['goods'][$this->_vars['pkey']];  if( trim($this->_vars['pcol']) !== '' ){ ?> <li> <span><?php echo $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['name']; ?>：</span> <?php if( $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['type'] == 'select' ){  if( $this->_vars['goodsproplink'] ){ ?><a href="<?php echo $this->_plugins['function']['selector'][0]->_selector(array('type' => $this->_vars['goods']['type_id'],'key' => $this->_vars['propord'],'value' => $this->_vars['pcol']), $this);?>" target="_blank"><?php echo $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['options'][$this->_vars['pcol']]; ?></a><?php }else{  echo $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['options'][$this->_vars['pcol']];  }  }else{  echo $this->_vars['pcol'];  } ?> </li> <?php }  }  }  }  } ?> </ul> <ul class='goods-price list'> <?php if( $this->_vars['goods']['setting']['mktprice'] ){ ?> <li> <span>市场价：</span><i class="mktprice1"> <?php if( $this->_vars['goods']['minmktprice'] && $this->_vars['goods']['maxmktprice'] ){  if( $this->_vars['goods']['minmktprice'] != $this->_vars['goods']['maxmktprice'] ){  echo $CURRENCY->changer($this->_vars['goods']['minmktprice']); ?>-<?php echo $CURRENCY->changer($this->_vars['goods']['maxmktprice']);  }else{  echo $CURRENCY->changer($this->_vars['goods']['minmktprice']);  }  }else{  echo $CURRENCY->changer($this->_vars['goods']['mktprice']);  } ?> </i> </span> </li> <?php } ?> <li> <span>销售价：</span> <span class="price1"> <?php if( $this->_vars['goods']['minprice'] && $this->_vars['goods']['maxprice'] ){  if( $this->_vars['goods']['minprice'] != $this->_vars['goods']['maxprice'] ){  echo $CURRENCY->changer($this->_vars['goods']['minprice']); ?>-<?php echo $CURRENCY->changer($this->_vars['goods']['maxprice']);  }else{  echo $CURRENCY->changer($this->_vars['goods']['minprice']);  }  }else{  echo $CURRENCY->changer($this->_vars['goods']['price']);  } ?> </span> </li> <?php if( $this->_vars['goods']['mktprice'] > $this->_vars['goods']['price'] && $this->_vars['goods']['setting']['mktprice'] && $this->_vars['goods']['setting']['saveprice'] > 0 ){ ?> <li><span class="discount"><?php if( $this->_vars['goods']['setting']['saveprice'] == 1 ){ ?>节省： <?php if( $this->_vars['goods']['minprice'] && $this->_vars['goods']['maxprice'] ){  if( $this->_vars['goods']['minprice'] != $this->_vars['goods']['maxprice'] ){  echo $CURRENCY->changer($this->_vars['goods']['jiesheng_min']); ?>-<?php echo $CURRENCY->changer($this->_vars['goods']['jiesheng_max']);  }else{  echo $CURRENCY->changer($this->_vars['goods']['jiesheng_min']);  }  }else{  echo $CURRENCY->changer($this->_vars['goods']['mktprice']-$this->_vars['goods']['price']);  }  }elseif( $this->_vars['goods']['setting']['saveprice'] == 2 ){ ?>优惠： <?php if( $this->_vars['goods']['youhui_min'] && $this->_vars['goods']['youhui_max'] ){  if( $this->_vars['goods']['youhui_min'] != $this->_vars['goods']['youhui_max'] ){  echo tpl_modifier_number($this->_vars['goods']['youhui_min'],'2'); ?>%-<?php echo tpl_modifier_number($this->_vars['goods']['youhui_max'],'2'); ?>% <?php }else{  echo tpl_modifier_number($this->_vars['goods']['price']/$this->_vars['goods']['mktprice']*100,'2'); ?>% <?php }  }else{  echo tpl_modifier_number($this->_vars['goods']['price']/$this->_vars['goods']['mktprice']*100,'2'); ?>% <?php }  }elseif( $this->_vars['goods']['setting']['saveprice'] == 3 ){  echo $this->_vars['goods']['price_qujian']; ?> 折 <?php } ?></span> </li> <?php }  if( $this->_vars['mLevel'] ){ ?> <li class='mprice' <?php if( $this->_vars['goods']['FlatSpec'] or $this->_vars['goods']['SelSpec'] ){ ?> style="display:none" <?php } ?>> <span>会员价:</span> <ul> <?php $this->_env_vars['foreach'][mlv]=array('total'=>count($this->_vars['mLevel']),'iteration'=>0);foreach ((array)$this->_vars['mLevel'] as $this->_vars['lItem']){ $this->_env_vars['foreach'][mlv]['first'] = ($this->_env_vars['foreach'][mlv]['iteration']==0); $this->_env_vars['foreach'][mlv]['iteration']++; $this->_env_vars['foreach'][mlv]['last'] = ($this->_env_vars['foreach'][mlv]['iteration']==$this->_env_vars['foreach'][mlv]['total']); ?> <li> <span><?php echo $this->_vars['lItem']['name']; ?>:</span> <span class='mlvprice lv-<?php echo $this->_vars['lItem']['member_lv_id']; ?>' mlv='<?php echo $this->_vars['lItem']['member_lv_id']; ?>'><?php echo $CURRENCY->changer($this->_vars['goods']['mprice'][$this->_vars['lItem']['member_lv_id']]); ?></span> </li> <?php } unset($this->_env_vars['foreach'][mlv]); ?> </ul> </li> <?php } ?> </ul> <?php if( count($this->_vars['promotions'])>0 ){ ?> <ul class="boxBlue list"> <?php foreach ((array)$this->_vars['promotions'] as $this->_vars['key'] => $this->_vars['promotion']){ ?> <li><strong class="fontcolorRed"><?php echo $this->_vars['promotion']['pmt_describe']; ?></strong><span class="font11px fontcolorBlack"><?php echo tpl_modifier_userdate($this->_vars['promotion']['pmt_time_begin']); ?> ~ <?php echo tpl_modifier_userdate($this->_vars['promotion']['pmt_time_end']); ?></span></li> <?php } ?> </ul> <?php }  if( $this->_vars['goods']['marketable'] == 'false' ){ ?> <div class="hight-offline"> <div class="hightbox"> <div class="btnBar clearfix"> <div class="floatLeft" style="font-weight:bold; padding-top:15px;">此商品已下架</div> <div class="floatRight"> <ul> <li <?php if( $this->_vars['login']!="nologin" ){ ?>star="<?php echo $this->_vars['goods']['goods_id']; ?>"<?php } ?> class="star-off" title=<?php echo tpl_modifier_escape($this->_vars['goods']['name'],"html"); ?>> <?php if( $this->_vars['login']=="nologin" ){ ?> <a href="<?php echo tpl_function_link(array('ctl' => "passport",'act' => "login"), $this);?>" class="btn-fav">收藏此商品</a> <?php }else{ ?> <a href="#" rel="nofollow" onclick="return false;" class="btn-fav">收藏此商品</a> <?php } ?> </li> <!-- <li><a href="#" class="btn-send">发送给好友</a></li> --> </ul> </div> </div> </div> </div> <?php }else{ ?> <div class='hightline'> <div class='hightbox'> <?php if( $this->_vars['goods']['FlatSpec'] or $this->_vars['goods']['SelSpec'] ){ ?> <div id="goods-spec" class='goods-spec' > <table width='100%'> <tr> <td width='80%'> <h4 class='spec-tip'><em> <?php if( $this->_vars['SelectSpecValue']['selected'] ){ ?> 您选择了： <?php }else{ ?> 请选择： <?php } ?> </em> <span><?php echo $this->_vars['SelectSpecValue']['value']; ?></span> </h4> </td> <td align='right' width='20%'> <div id='view-products-list'><a href='javascript:void(0)' onclick="new Event(event).stop();$('goods-products-list').fireEvent('pop')">规格列表&raquo;&raquo;</a></div></td> </tr> </table> <input type='hidden' name='goods[product_id]' value='<?php echo $this->_vars['goods']['product_id']; ?>' disabled='true'/> <?php if( $this->_vars['goods']['FlatSpec'] ){ ?> <table width='100%'> <?php foreach ((array)$this->_vars['goods']['FlatSpec'] as $this->_vars['key'] => $this->_vars['goodsFlatSpecDesc']){ ?> <tr class='spec-item specItem'> <td style="width:10%; white-space:nowrap;padding-right:10px;vertical-align:middle;"><span><em><?php echo $this->_vars['goodsFlatSpecDesc']['name']; ?></em>：</span></td> <td> <ul> <?php foreach ((array)$this->_vars['goods']['FlatSpec'][$this->_vars['key']]['value'] as $this->_vars['skey'] => $this->_vars['subDesc']){  if( $this->_vars['subDesc']['display']=="block" ){ ?> <li> <a href="<?php echo tpl_function_link(array('ctl' => product,'act' => index,'arg0' => $this->_vars['goods']['goods_id'],'arg1' => $this->_vars['subDesc']['spec_goods_images']), $this);?>" specvid="<?php echo $this->_vars['skey']; ?>" specid="<?php echo $this->_vars['key']; ?>" > <?php if( $this->_vars['subDesc']['spec_type']=='text' ){ ?> <span><nobr><?php echo $this->_vars['subDesc']['spec_value']; ?></nobr></span> <?php }else{ ?> <img src="<?php echo tpl_modifier_storager($this->_vars['subDesc']['spec_image']); ?>" alt="<?php echo $this->_vars['subDesc']['spec_value']; ?>" title="<?php echo $this->_vars['subDesc']['spec_value']; ?>" width="<?php echo $this->_vars['specimagewidth']; ?>" height="<?php echo $this->_vars['specimageheight']; ?>"> <?php } ?> <i title='点击取消选择'>&nbsp;</i> </a> </li> <?php }  } ?> </ul> </td> </tr> <?php } ?> </table> <?php }  if( $this->_vars['goods']['SelSpec'] ){ ?> <div class='spec-item'> <ul class='clearfix'> <?php foreach ((array)$this->_vars['goods']['SelSpec'] as $this->_vars['selKey'] => $this->_vars['goodsSelSpecDesc']){  foreach ((array)$this->_vars['goods']['SelSpec'][$this->_vars['selKey']]['value'] as $this->_vars['sSelKey'] => $this->_vars['subDesc']){  if( $this->_vars['subDesc']['selected'] ){  $this->_vars['selectValue']=$this->_vars['subDesc']['spec_value'];  }  } ?> <li class="handle <?php if( $this->_vars['selectValue'] ){ ?>selected<?php } ?>"><em><?php echo $this->_vars['goodsSelSpecDesc']['name']; ?></em>： <span><?php if( trim($this->_vars['selectValue']) == '' ){  $this->_vars[selectValue]=null;  }  echo ((isset($this->_vars['selectValue']) && ''!==$this->_vars['selectValue'])?$this->_vars['selectValue']:'请选择'); ?></span> <?php $this->_vars["selectValue"]=' '; ?> </li> <?php }  foreach ((array)$this->_vars['goods']['SelSpec'] as $this->_vars['selKey'] => $this->_vars['goodsSelSpecDesc']){ ?> <li class="content specItem"> <ul> <?php foreach ((array)$this->_vars['goods']['SelSpec'][$this->_vars['selKey']]['value'] as $this->_vars['sSelKey'] => $this->_vars['subDesc']){  if( $this->_vars['subDesc']['display']=="block" ){ ?> <li> <a href="<?php echo tpl_function_link(array('ctl' => product,'act' => index,'arg0' => $this->_vars['goods']['goods_id'],'arg1' => $this->_vars['subDesc']['spec_goods_images']), $this);?>" specvid="<?php echo $this->_vars['sSelKey']; ?>" specid="<?php echo $this->_vars['selKey']; ?>"> <?php if( $this->_vars['subDesc']['spec_type']=='text' ){ ?> <span><?php echo $this->_vars['subDesc']['spec_value']; ?></span> <?php }else{ ?> <img src="<?php echo tpl_modifier_storager($this->_vars['subDesc']['spec_image']); ?>" style='border:1px #ccc solid' alt="<?php echo $this->_vars['subDesc']['spec_value']; ?>" title="<?php echo $this->_vars['subDesc']['spec_value']; ?>" width="<?php echo $this->_vars['specimagewidth']; ?>" height="<?php echo $this->_vars['specimageheight']; ?>"> <?php } ?> <i title='点击取消选择'>&nbsp;</i> </a> </li> <?php }  } ?> </ul> </li> <?php } ?> </ul> </div> <?php } ?> </div> <?php } ?> <div class='buyinfo'> <table width='auto'> <tr> <td><span>购买数量：</span></td> <td><div class="Numinput"> <input type="text" name="goods[num]" size="5" value=1 /> <span class="numadjust increase"></span> <span class="numadjust decrease"></span> </div> </td> <td><span <?php if( !$this->_vars['showStorage'] ){ ?>style='display:none;'<?php } ?>>&nbsp;&nbsp;(库存<span class='store'><?php if( $this->_vars['goods']['store'] >= 9999 or $this->_vars['goods']['store'] == null or $this->_vars['goods']['store'] === '' ){ ?>9999+<?php }else{  echo $this->_vars['goods']['store'] - $this->_vars['goods']['product_freez'];  } ?></span>)</span></td> </tr> </table> </div> <input type="hidden" name="goods[goods_id]" value="<?php echo $this->_vars['goods']['goods_id']; ?>" /> <input type="hidden" name="goods[pmt_id]" value="<?php echo $this->_vars['goods']['pmt_id']; ?>" /> <div class="btnBar clearfix" <?php if( count($this->_vars['goods']['products'])>0 ){ ?>style="visibility:hidden"<?php } ?>> <div class="floatLeft"> <?php if( count($this->_vars['goods']['products'])>0 ){  if( $this->system->getConf('system.goods.fastbuy') ){ ?> <input class="actbtn btn-fastbuy" value="立即购买" type="button" /> <?php } ?> <input class="actbtn btn-buy" value="加入购物车" type="submit" /> <input class="actbtn btn-notify" value="缺货登记" type="submit" style="display: none;" /> <?php }else{  if( $this->_vars['goods']['store']-$this->_vars['goods']['freez']>0 or $this->_vars['goods']['store']=='' ){  if( $this->system->getConf('system.goods.fastbuy') ){ ?> <input class="actbtn btn-fastbuy" value="立即购买" type="button" /> <?php } ?> <input class="actbtn btn-buy" value="加入购物车" type="submit" /> <?php }else{ ?> <input class="actbtn btn-notify" value="缺货登记" type="submit" /> <?php }  } ?> </div> <div class="floatRight"> <ul> <li <?php if( $this->_vars['login']!="nologin" ){ ?>star="<?php echo $this->_vars['goods']['goods_id']; ?>"<?php } ?> class="star-off" title=<?php echo tpl_modifier_escape($this->_vars['goods']['name'],"html"); ?>> <?php if( $this->_vars['login']=="nologin" ){ ?> <a href="<?php echo tpl_function_link(array('ctl' => "passport",'act' => "login"), $this);?>" class="btn-fav">收藏此商品</a> <?php }else{ ?> <a href="#" rel="nofollow" onclick="return false;" class="btn-fav">收藏此商品</a> <?php } ?> </li> <!-- <li><a href="#" class="btn-send">发送给好友</a></li> --> </ul> </div> </div> </div> </div> <?php }  if( $this->_vars['goods']['adjunct'] && count($this->_vars['goods']['adjunct'])>0 ){ ?> <div id='goods-adjunct' class='hightline'> <div class='hightbox'> <?php foreach ((array)$this->_vars['goods']['adjunct'] as $this->_vars['adj_key'] => $this->_vars['adj']){ ?> <div class="choose"> <div class="adjtitle"><?php echo $this->_vars['adj']['name']; ?><em><?php if( $this->_vars['adj']['min_num'] or $this->_vars['adj']['max_num'] ){ ?>可选 <?php if( $this->_vars['adj']['min_num'] == $this->_vars['adj']['max_num'] ){  echo $this->_vars['adj']['min_num'];  }else{  echo ((isset($this->_vars['adj']['min_num']) && ''!==$this->_vars['adj']['min_num'])?$this->_vars['adj']['min_num']:0); ?>-<?php echo $this->_vars['adj']['max_num'];  } ?> 件<?php } ?></em><span adj="<?php echo $this->_vars['adj']['name']; ?>"></span></div> <table width="100%" cellpadding="0" cellspacing="0"> <tbody class="goods-adjunct-row" adjkey="<?php echo $this->_vars['adj_key']; ?>" adjname="<?php echo $this->_vars['adj']['name']; ?>" min_num="<?php echo ((isset($this->_vars['adj']['min_num']) && ''!==$this->_vars['adj']['min_num'])?$this->_vars['adj']['min_num']:0); ?>" max_num="<?php echo ((isset($this->_vars['adj']['max_num']) && ''!==$this->_vars['adj']['max_num'])?$this->_vars['adj']['max_num']:-1); ?>" > <?php $this->_env_vars['foreach'][adjitems]=array('total'=>count($this->_vars['adj']['items']),'iteration'=>0);foreach ((array)$this->_vars['adj']['items'] as $this->_vars['key'] => $this->_vars['items']){ $this->_env_vars['foreach'][adjitems]['first'] = ($this->_env_vars['foreach'][adjitems]['iteration']==0); $this->_env_vars['foreach'][adjitems]['iteration']++; $this->_env_vars['foreach'][adjitems]['last'] = ($this->_env_vars['foreach'][adjitems]['iteration']==$this->_env_vars['foreach'][adjitems]['total']); ?> <tr price="<?php echo $CURRENCY->changer($this->_vars['items']['adjprice'],null,true); ?>" product="<?php echo $this->_vars['items']['goods_id']; ?>" <?php if( $this->_env_vars['foreach']['adjitems']['last'] ){ ?>class="last"<?php } ?>> <td width="5%" valign="top"> <input type="checkbox" name='check_<?php echo $this->_vars['items']['product_id']; ?>' value="<?php echo $CURRENCY->changer($this->_vars['items']['adjprice'],null,true); ?>" product="<?php echo $this->_vars['items']['goods_id']; ?>"/> </td> <td width="55%"> <div class="adjpc"> <a<?php if( $this->_vars['items']['marketable'] == 'true' && $this->_vars['items']['disabled'] == 'false' ){ ?> href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['items']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['items']['name']; ?>"<?php } ?>> <?php echo $this->_vars['items']['name'];  if( $this->_vars['items']['pdt_desc'] ){ ?>[<?php echo $this->_vars['items']['pdt_desc']; ?>]<?php } ?></a> </div> <?php if( $this->_vars['items']['price'] != $this->_vars['items']['adjprice'] ){ ?> <div class="mktprice">原价格：<i><?php echo $CURRENCY->changer($this->_vars['items']['price']); ?></i></div> <?php } ?> <span class="memberprice">配件价格：<i><?php echo $CURRENCY->changer($this->_vars['items']['adjprice']); ?></i></span> </td> <td>数量：<input size="2" maxlength='10' type="text" autocomplete='off' value="<?php if( $this->_vars['adj']['min_num'] == 0 ){ ?>1<?php }else{  echo ((isset($this->_vars['adj']['min_num']) && ''!==$this->_vars['adj']['min_num'])?$this->_vars['adj']['min_num']:1);  } ?>" name='count_check_<?php echo $this->_vars['items']['product_id']; ?>' /></td> <td<?php if( $this->_vars['items']['marketable'] == 'false' or $this->_vars['items']['disabled'] == 'true' ){ ?> style="display:none"<?php } ?>><a title="您可以单把独这个商品加入购物车" buy="<?php echo $this->_vars['items']['goods_id']; ?>" product="<?php echo $this->_vars['items']['product_id']; ?>" type="g" href="<?php echo tpl_function_link(array('ctl' => "cart",'act' => "addGoodsToCart",'arg0' => $this->_vars['items']['goods_id'],'arg1' => $this->_vars['items']['product_id']), $this);?>" <?php if( $this->_vars['goods']['setting']['buytarget']==2 ){ ?> target="_blank_cart"<?php }elseif( $this->_vars['goods']['setting']['buytarget']==3 ){ ?> target="_dialog_minicart"<?php } ?> class="addtocart" rel="nofollow"><img src="statics/transparent.gif" alt="您可以单把独这个商品加入购物车" style="width:61px;height:22px;background-image:url(statics/icons.gif);background-repeat:no-repeat;background-position:0 -99px;" /></a></td> <td> <input type='hidden' name='goods[adjunct][<?php echo $this->_vars['adj_key']; ?>][<?php echo $this->_vars['items']['product_id']; ?>]' value='' disabled='true'/> </td> </tr> <?php } unset($this->_env_vars['foreach'][adjitems]); ?> </tbody> </table> </div> <?php } ?> <strong>配件总价:</strong><span class='price'></span> </div> </div> <?php } ?> </form> </td> </tr> </table> <?php if( $this->system->getConf('system.goods.fastbuy') ){ ?> <form id='fastbuy-form' action='<?php echo tpl_function_link(array('ctl' => "cart",'act' => "checkout"), $this);?>' extra='fastbuy' method='post' style='display:none;'></form> <?php }  if( count($this->_vars['goods']['products'])>0 ){ ?> <div id='goods-products-list' class='goods-products-list'> <div class='goods-products-list-box'> <table width="100%" cellpadding="3" cellspacing="0" class="liststyle"> <?php foreach ((array)$this->_vars['specShowItems'] as $this->_vars['spec']){ ?> <col class='ColColorBlue'></col> <?php } ?> <col></col> <col></col> <col></col> <thead> <tr> <?php foreach ((array)$this->_vars['specShowItems'] as $this->_vars['key'] => $this->_vars['spec']){ ?> <th><?php echo $this->_vars['spec']; ?></th> <?php } ?> <th>货号</th> <th>价格</th> <?php if( $this->system->getConf('site.show_storage')=="true" ){ ?><th>库存</th><?php } ?> </tr> </thead> <tbody> <?php foreach ((array)$this->_vars['goods']['products'] as $this->_vars['item']){ ?> <tr productId="<?php echo $this->_vars['item']['product_id']; ?>" <?php if( $this->_vars['item']['store']!==null && $this->_vars['item']['store'] !=='' && ($this->_vars['item']['store'] - $this->_vars['item']['freez'] <= 0) ){ ?>class='nostore' title='此货品缺货'<?php } ?>> <?php foreach ((array)$this->_vars['item']['props']['spec'] as $this->_vars['key'] => $this->_vars['value']){ ?> <td><?php echo $this->_vars['value']; ?></td> <?php } ?> <td class="ident"><?php echo $this->_vars['item']['bn']; ?></td> <td class="price"><?php echo $CURRENCY->changer($this->_vars['item']['price']); ?></td> <?php if( $this->system->getConf('site.show_storage')=="true" ){ ?><td class="store"><?php if( $this->_vars['item']['store']!==null && $this->_vars['item']['store'] !=='' && ($this->_vars['item']['store'] - $this->_vars['item']['freez'] <= 0) ){ ?>缺货<?php }else{  echo $this->_vars['item']['store'];  } ?></td><?php } ?> </tr> <?php } ?> </tbody> </table> </div> </div> <?php } ?> <div style="clear:both"></div> <?php if( count($this->_vars['package'])>0 ){ ?> <div class="goodspackagewrap clearfix"> <div class="active"><span>捆绑销售</span></div> </div> <div class="GoodsPackageWrap"> <?php $this->_env_vars['foreach'][packageitems]=array('total'=>count($this->_vars['package']),'iteration'=>0);foreach ((array)$this->_vars['package'] as $this->_vars['key'] => $this->_vars['package']){ $this->_env_vars['foreach'][packageitems]['first'] = ($this->_env_vars['foreach'][packageitems]['iteration']==0); $this->_env_vars['foreach'][packageitems]['iteration']++; $this->_env_vars['foreach'][packageitems]['last'] = ($this->_env_vars['foreach'][packageitems]['iteration']==$this->_env_vars['foreach'][packageitems]['total']); ?> <div class="items <?php if( $this->_env_vars['foreach']['packageitems']['last'] ){ ?>last<?php } ?>"> <div class="itemwrap"> <table cellpadding="0" cellspacing="0"> <tr valign="top"> <?php $this->_env_vars['foreach'][packagetd]=array('total'=>count($this->_vars['package']['items']),'iteration'=>0);foreach ((array)$this->_vars['package']['items'] as $this->_vars['items']){ $this->_env_vars['foreach'][packagetd]['first'] = ($this->_env_vars['foreach'][packagetd]['iteration']==0); $this->_env_vars['foreach'][packagetd]['iteration']++; $this->_env_vars['foreach'][packagetd]['last'] = ($this->_env_vars['foreach'][packagetd]['iteration']==$this->_env_vars['foreach'][packagetd]['total']); ?> <td> <dl> <dt class="goodpic"> <a<?php if( $this->_vars['items']['marketable'] == 'true' && $this->_vars['items']['disabled'] == 'false' && $this->_vars['items']['goods_id'] != $this->_vars['goods']['goods_id'] ){ ?> href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['items']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['items']['name']; ?>"<?php } ?>> <img src="<?php echo tpl_modifier_storager(((isset($this->_vars['items']['thumbnail_pic']) && ''!==$this->_vars['items']['thumbnail_pic'])?$this->_vars['items']['thumbnail_pic']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" alt="<?php echo $this->_vars['items']['name']; ?>"/></a> </dt> <dd><a<?php if( $this->_vars['items']['marketable'] == 'true' && $this->_vars['items']['disabled'] == 'false' && $this->_vars['items']['goods_id'] != $this->_vars['goods']['goods_id'] ){ ?> href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['items']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['items']['name']; ?>"<?php } ?>><?php echo $this->_vars['items']['name']; ?></a><div class="fontcolorOrange">×<?php echo $this->_vars['items']['pkgnum']; ?></div>价格:<span class="fontcolorBlack fontbold"><?php echo $CURRENCY->changer($this->_vars['items']['price']); ?></span></dd> </dl> </td> <?php if( !$this->_env_vars['foreach']['packagetd']['last'] ){ ?><td class="plus">+</td><?php }  } unset($this->_env_vars['foreach'][packagetd]); ?> </tr> </table> </div> <ul class="priceinfo"> <li> <h3> <?php echo $this->_vars['package']['name'];  if( $this->_vars['package']['intro'] ){ ?> <span class="desc"><?php echo $this->_vars['package']['intro']; ?></span> <?php } ?> </h3></li> <li class="mktprice1">原价：<?php echo $CURRENCY->changer($this->_vars['package']['mktprice']); ?></li> <li class="price1">捆绑价：<?php echo $CURRENCY->changer($this->_vars['package']['price']); ?></li> <li class="huered"><?php if( $this->_vars['package']['mktprice'] > $this->_vars['package']['price'] && $this->_vars['goods']['setting']['mktprice'] && $this->_vars['goods']['setting']['saveprice'] > 0 ){  if( $this->_vars['goods']['setting']['saveprice'] == 1 ){ ?>节省：<?php echo $CURRENCY->changer($this->_vars['package']['mktprice']-$this->_vars['package']['price']);  }elseif( $this->_vars['goods']['setting']['saveprice'] == 2 ){ ?>优惠：<?php echo tpl_modifier_number($this->_vars['package']['price']/$this->_vars['package']['mktprice']*100,'2'); ?>%<?php }elseif( $this->_vars['goods']['setting']['saveprice'] == 3 ){  echo tpl_modifier_number($this->_vars['package']['price']/$this->_vars['package']['mktprice']*10,'3'); ?>折<?php }  } ?> </li> <li><a rel="nofollow" href="<?php echo tpl_function_link(array('ctl' => "cart",'act' => "addPkgToCart",'arg0' => $this->_vars['package']['goods_id'],'arg1' => 1), $this);?>"<?php if( $this->_vars['goods']['setting']['buytarget'] == 2 ){ ?> target="_blank_cart"<?php }elseif( $this->_vars['goods']['setting']['buytarget'] == 3 ){ ?> target="_dialog_minicart"<?php } ?>><img class="buy" src="statics/transparent.gif" alt="购买" style="width:61px;height:22px;background-image:url(statics/icons.gif);background-repeat:no-repeat;background-position:0 -147px;" /></a></li> </ul> <div class="clear"></div> </div> <?php } unset($this->_env_vars['foreach'][packageitems]); ?> </div> <?php } ?> <div class="goods-detail-tab clearfix"> </div> <div class="clear"></div> <?php foreach ((array)$this->_vars['addons'] as $this->_vars['tmpl']){  echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'.$this->_vars['tmpl'])?('user:'.$this->theme.'/'.$this->_vars['tmpl']):('shop:'.$this->_vars['tmpl']), array()); }  if( $this->_vars['goods']['intro'] ){ ?> <div class="section pdtdetail" tab="商品详情"> <div class="goodsprop_ultra clearfix"> <?php if( $this->_vars['goodspropposition']<>1 ){  foreach ((array)$this->_vars['goods']['prototype']['ordernum'] as $this->_vars['key'] => $this->_vars['propord']){  if( $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['show'] ){  $this->_vars["pkey"]="p_{$this->_vars['propord']}";  $this->_vars["pcol"]=$this->_vars['goods'][$this->_vars['pkey']];  if( trim($this->_vars['pcol']) !== '' ){ ?> <div class="span-4"> <span><?php echo $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['name']; ?>：</span> <?php if( $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['type'] == 'select' ){  if( $this->_vars['goodsproplink'] ){ ?><a href="<?php echo $this->_plugins['function']['selector'][0]->_selector(array('type' => $this->_vars['goods']['type_id'],'key' => $this->_vars['propord'],'value' => $this->_vars['pcol']), $this);?>" target="_blank"><?php echo $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['options'][$this->_vars['pcol']]; ?></a><?php }else{  echo $this->_vars['goods']['prototype']['props'][$this->_vars['propord']]['options'][$this->_vars['pcol']];  }  }else{  echo $this->_vars['pcol'];  } ?> </div> <?php }  }  }  } ?> </div> <div class="body indent uarea-output" id="goods-intro"> <?php echo $this->_vars['goods']['intro']; ?> </div> </div> <?php }  if( count($this->_vars['goods']['params'])>0 && $this->_vars['goods']['params'] ){ ?> <div class="section pdtdetail" tab="详细参数" > <h2>详细参数</h2> <div class="body" id="goods-params"> <table width="100%" cellpadding="0" cellspacing="0" class="liststyle data"> <col class="span-4 ColColorGray fontcolorBlack"></col> <?php foreach ((array)$this->_vars['goods']['params'] as $this->_vars['group'] => $this->_vars['params']){ ?> <tr><td colspan="2" class="colspan ColColorGraydark"><?php echo $this->_vars['group']; ?><span class="gname"></span></td></tr> <?php foreach ((array)$this->_vars['params'] as $this->_vars['key'] => $this->_vars['value']){  if( $this->_vars['value'] != '' ){ ?> <tr><th><?php echo $this->_vars['key']; ?></th><td><?php echo ((isset($this->_vars['value']) && ''!==$this->_vars['value'])?$this->_vars['value']:'-'); ?></td></tr> <?php }  }  } ?> </table> </div> </div> <?php }  if( $this->_vars['goods']['link_count'] > 0 ){ ?> <div class="section pdtdetail" tab="相关商品"> <h2>相关商品</h2> <div class="body" id="goods-rels"> <div class="GoodsSearchWrap"> <table width="100%" border="0" cellpadding="0" cellspacing="6"> <tr valign="top"> <?php $this->_env_vars['foreach'][goods]=array('total'=>count($this->_vars['goods']['link']),'iteration'=>0);foreach ((array)$this->_vars['goods']['link'] as $this->_vars['linklist']){ $this->_env_vars['foreach'][goods]['first'] = ($this->_env_vars['foreach'][goods]['iteration']==0); $this->_env_vars['foreach'][goods]['iteration']++; $this->_env_vars['foreach'][goods]['last'] = ($this->_env_vars['foreach'][goods]['iteration']==$this->_env_vars['foreach'][goods]['total']); ?> <td product="<?php echo $this->_vars['linklist']['goods_id']; ?>" width="25%"> <div class="items-gallery"> <div class="goodpic" style='<?php if( $this->system->getConf('site.thumbnail_pic_width') !=0 && $this->system->getConf('site.thumbnail_pic_height') !=0 ){ ?>height:<?php echo $this->system->getConf('site.thumbnail_pic_height'); ?>px;<?php } ?>'> <a href='<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['linklist']['goods_id']), $this);?>' style='<?php if( $this->system->getConf('site.thumbnail_pic_width') !=0 && $this->system->getConf('site.thumbnail_pic_width') !=0 ){ ?> width:<?php echo $this->system->getConf('site.thumbnail_pic_width'); ?>px;height:<?php echo $this->system->getConf('site.thumbnail_pic_height'); ?>px;<?php } ?>;'> <img src="<?php echo tpl_modifier_storager(((isset($this->_vars['linklist']['thumbnail_pic']) && ''!==$this->_vars['linklist']['thumbnail_pic'])?$this->_vars['linklist']['thumbnail_pic']:$this->system->getConf('site.default_thumbnail_pic'))); ?>"/> </a></div> <div class="goodinfo"> <table width="100%" border="0" cellpadding="0" cellspacing="0"> <tr> <td colspan="2"><h6 style="text-align:center"><a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['linklist']['goods_id']), $this);?>" title="<?php echo $this->_vars['linklist']['name']; ?>"><?php echo $this->_vars['linklist']['name']; ?></a></h6></td> </tr> <tr> <td colspan="2"><ul> <li><span class="price1"><?php echo $CURRENCY->changer($this->_vars['linklist']['price']); ?></span></li> </ul></td> </tr> <tr> <td> <?php if( $this->_vars['goods']['setting']['mktprice'] ){ ?> <span class="mktprice1"><?php echo $CURRENCY->changer($this->_vars['linklist']['mktprice']); ?></span> <?php } ?> </td> <td><ul class="button"> <li><a class="viewpic" href="<?php echo tpl_function_link(array('ctl' => product,'act' => viewpic,'arg0' => $this->_vars['linklist']['goods_id'],'arg1' => def), $this);?>" target="_blank">查看图片</a></li> <?php $this->_vars["dddd"]="333";  echo tpl_function_goodsmenu(array('product' => $this->_vars['linklist'],'setting' => $this->_vars['setting'],'login' => $this->_vars['login']), $this);?> <li class="btncmp"> <a href="javascript:void(0)" onclick="gcompare.add({gid:'<?php echo $this->_vars['product']['goods_id']; ?>',gname:'<?php echo tpl_modifier_escape($this->_vars['product']['name'],'quotes'); ?>',gtype:'<?php echo $this->_vars['product']['type_id']; ?>'});" class="btncmp" title="商品对比"> 商品对比 </a> </li> </ul></td> </tr> </table> </div> </div> </td> <?php if( !($this->_env_vars['foreach']['goods']['iteration']%4) ){ ?> </tr> <?php if( !$this->_env_vars['foreach']['goods']['last'] ){ ?> <tr valign="top"> <?php }  }elseif( $this->_env_vars['foreach']['goods']['last'] ){ ?> <td colspan="<?php echo (4 - ($this->_env_vars['foreach']['goods']['iteration']%4));?>">&nbsp;</td> </tr> <?php }  } unset($this->_env_vars['foreach'][goods]); ?> </table> </div> </div> </div> <?php }  if( $this->_vars['sellLog']['display']['switch'] && count($this->_vars['sellLogList']['data']) >0 && $this->_vars['sellLog']['display']['limit']<= count($this->_vars['sellLogList']['data']) ){ ?> <div class="section pdtdetail" tab="销售记录"> <div class="commentTabLeft floatLeft"><strong>销售记录</strong></div> <div class="floatLeft commentTabRight"></div> <div style="clear:both;"></div> <div class="body"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="liststyle"> <col class="span-5"> <col class="span-3"> <col > <col class="span-3"> <thead> <tr> <th>买家</th> <th>购买价</th> <th>购买数量</th> <th>购买时间</th> </tr> </thead> <tbody> <?php foreach ((array)$this->_vars['sellLogList']['data'] as $this->_vars['key'] => $this->_vars['sellLogListData']){ ?> <tr> <td><?php echo tpl_modifier_cut($this->_vars['sellLogListData']['name'],3,''); ?>***</td> <td><?php echo $this->_vars['sellLogListData']['price']; ?></td> <td><?php echo $this->_vars['sellLogListData']['number'];  if( $this->_vars['sellLogListData']['pdt_desc'] ){ ?><span class="fontcolorGray">( <?php echo $this->_vars['sellLogListData']['pdt_desc']; ?> )</span><?php } ?></td> <td><?php echo tpl_modifier_userdate($this->_vars['sellLogListData']['createtime']); ?></td> </tr> <?php } ?> </tbody> </table> <div class="tips">截至今日， 累计成交<span class="font14px fontbold fontcolorOrange"><?php echo $this->_vars['sellLogList']['total']; ?></span>笔<?php if( $this->_vars['sellLogList']['total'] > count($this->_vars['sellLogList']['data']) ){ ?><a href="<?php echo tpl_function_link(array('ctl' => product,'act' => selllog,'arg0' => $this->_vars['goods']['goods_id']), $this);?>" target="_blank">，查看更多...</a><?php } ?></div> </div> </div> <?php }  if( $this->_vars['comment']['switch']['ask'] == 'on' or $this->_vars['comment']['switch']['discuss'] == 'on' ){ ?> <script>
    var checkFormReqs =function(e){
           e    = new Event(e);
       var _form= $(e.target);

       var reqs = $$(_form.getElements('input[type=text]'),_form.getElements('textarea'));
        
        
       if(reqs.some(function(req){
            if(!req.get('required')&&!req.get('vtype').contains('required'))return;
            if(req.getValue().trim()==''){
                       req.focus();
                       MessageBox.error('请完善表单必填项<sup>*</sup>');
                       return true;
            }

              return false;


       })){

           e.stop();

       }

    };
</script> <?php }  if( $this->_vars['comment']['switch']['ask'] == 'on' ){  if( $this->_vars['comment']['power']['ask'] !='null' && $this->_vars['comment']['member_lv'] < 0 ){ ?> <div class="section pdtdetail" tab="购买咨询(<em><?php echo ((isset($this->_vars['comment']['askCount']) && ''!==$this->_vars['comment']['askCount'])?$this->_vars['comment']['askCount']:'0'); ?></em>)"> <div class=""><strong>购买咨询</strong><span><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "ask"), $this);?>">（已有<?php echo ((isset($this->_vars['comment']['askCount']) && ''!==$this->_vars['comment']['askCount'])?$this->_vars['comment']['askCount']:'0'); ?>条咨询）</a></span></div> <div class="FormWrap" style="background:#f6f6f6; margin-top:0px;"> <?php if( count($this->_vars['comment']['list']['ask']) == 0 ){ ?> <div class="boxBlue division"> <?php echo $this->_vars['comment']['null_notice']['ask']; ?> </div> <?php }else{ ?> <div class=" Comments" id="goods-comment"> <?php $this->_env_vars['foreach'][asklist]=array('total'=>count($this->_vars['comment']['list']['ask']),'iteration'=>0);foreach ((array)$this->_vars['comment']['list']['ask'] as $this->_vars['comlist']){ $this->_env_vars['foreach'][asklist]['first'] = ($this->_env_vars['foreach'][asklist]['iteration']==0); $this->_env_vars['foreach'][asklist]['iteration']++; $this->_env_vars['foreach'][asklist]['last'] = ($this->_env_vars['foreach'][asklist]['iteration']==$this->_env_vars['foreach'][asklist]['total']); ?> <div class="division boxBlue clearfix" style="margin-bottom:0px;"> <div class=" floatLeft commentMain"> <div class="floatLeft commentAsk">提问</div> <span class="author fontcolorOrange"><?php echo $this->_vars['comlist']['author']; ?><!--<?php if( $this->_vars['comlist']['levelname']!="" ){ ?> [<?php echo $this->_vars['comlist']['levelname']; ?>]<?php } ?> --></span> 说： <span class="timpstamp font10px fontcolorGray"><?php echo tpl_modifier_cdate($this->_vars['comlist']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo tpl_modifier_escape($this->_vars['comlist']['comment'],'html'); ?></div> </div> </div> <div class="commentReply"> <?php foreach ((array)$this->_vars['comlist']['items'] as $this->_vars['items']){ ?> <div class="division item " style=" margin:0px;" > <div class="floatLeft commentReply-admin">回答</div> <span class="author fontcolorOrange"><?php echo $this->_vars['items']['author']; ?><!--<?php if( $this->_vars['items']['levelname']!="" ){ ?> [<?php echo $this->_vars['items']['levelname']; ?>]<?php } ?> --></span>&nbsp;&nbsp;回复： <span class="timpstamp font10px fontcolorGray"><?php echo tpl_modifier_cdate($this->_vars['items']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo $this->_vars['items']['comment']; ?></div> </div> <?php } ?> </div> <?php } unset($this->_env_vars['foreach'][asklist]); ?> </div> <div class="textright"><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "ask"), $this);?>">查看所有咨询&gt;&gt;</a></div> <?php } ?> </div> <div class="boxBrown division"> <a href="<?php echo tpl_function_link(array('ctl' => passport,'act' => login), $this);?>"><image src="statics/btn-ask.gif" /></a> </div> </div> <?php }else{ ?> <div class="section pdtdetail" tab="购买咨询(<em><?php echo ((isset($this->_vars['comment']['askCount']) && ''!==$this->_vars['comment']['askCount'])?$this->_vars['comment']['askCount']:'0'); ?></em>)"> <div class="commentTabLeft floatLeft"><strong>购买咨询</strong><span><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "ask"), $this);?>">（已有<?php echo ((isset($this->_vars['comment']['askCount']) && ''!==$this->_vars['comment']['askCount'])?$this->_vars['comment']['askCount']:'0'); ?>条咨询）</a></span></div> <div class="floatLeft commentTabRight"></div> <div style="clear:both;"></div> <div class="FormWrap" style="background:#f6f6f6; margin-top:0px;"> <?php if( count($this->_vars['comment']['list']['ask']) == 0 ){ ?> <div class="boxBlue division"> <?php echo $this->_vars['comment']['null_notice']['ask']; ?> </div> <?php }else{ ?> <div class=" Comments" id="goods-comment"> <?php $this->_env_vars['foreach'][asklist]=array('total'=>count($this->_vars['comment']['list']['ask']),'iteration'=>0);foreach ((array)$this->_vars['comment']['list']['ask'] as $this->_vars['comlist']){ $this->_env_vars['foreach'][asklist]['first'] = ($this->_env_vars['foreach'][asklist]['iteration']==0); $this->_env_vars['foreach'][asklist]['iteration']++; $this->_env_vars['foreach'][asklist]['last'] = ($this->_env_vars['foreach'][asklist]['iteration']==$this->_env_vars['foreach'][asklist]['total']); ?> <div class="division boxBlue clearfix" style="margin-bottom:0px;"> <div class=" floatLeft commentMain"> <div class="floatLeft commentAsk">提问</div> <span class="author fontcolorOrange"><?php echo $this->_vars['comlist']['author']; ?><!--<?php if( $this->_vars['comlist']['levelname']!="" ){ ?> [<?php echo $this->_vars['comlist']['levelname']; ?>]<?php } ?> --></span> 说： <span class="timpstamp font10px fontcolorGray"><?php echo tpl_modifier_cdate($this->_vars['comlist']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo tpl_modifier_escape($this->_vars['comlist']['comment'],'html'); ?></div> </div> <div class="floatRight"><a class="floatRight lnk " href='<?php echo tpl_function_link(array('ctl' => "comment",'act' => "reply",'arg0' => $this->_vars['comlist']['comment_id'],'arg1' => "ask"), $this);?>'>回复此评论</a></div> </div> <div class="commentReply"> <?php foreach ((array)$this->_vars['comlist']['items'] as $this->_vars['items']){ ?> <div class="division item " style=" margin:0px;" > <div class="floatLeft commentReply-admin">回答</div> <span class="author fontcolorOrange"><?php echo $this->_vars['items']['author']; ?><!--<?php if( $this->_vars['items']['levelname']!="" ){ ?> [<?php echo $this->_vars['items']['levelname']; ?>]<?php } ?> --></span>&nbsp;&nbsp;回复： <span class="timpstamp font10px fontcolorGray"><?php echo tpl_modifier_cdate($this->_vars['items']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo $this->_vars['items']['comment']; ?></div> </div> <?php } ?> </div> <?php } unset($this->_env_vars['foreach'][asklist]); ?> </div> <div class="textright"><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "ask"), $this);?>">查看所有咨询&gt;&gt;</a></div> <?php } ?> <form class="addcomment" method="post" action='<?php echo tpl_function_link(array('ctl' => "comment",'act' => "toComment",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "ask"), $this);?>' onsubmit='checkFormReqs(event);'> <h4>发表咨询</h4> <div class='title'>标题：<?php echo tpl_input_default(array('type' => "text",'class' => "inputstyle blur",'required' => "true",'size' => 50,'name' => "title",'value' => "[咨询]".$this->_vars['goods']['name']), $this);?></div> <div class="division"> <table border="0" width="100%" cellpadding="0" cellspacing="0" class="forform"> <tr> <th><em>*</em>咨询内容：</th> <td><?php echo tpl_input_textarea(array('class' => "inputstyle",'vtype' => "required",'rows' => "5",'name' => "comment",'style' => "width:80%;"), $this);?></td> </tr> <tr> <tr> <th>联系方式：</th> <td><?php echo tpl_input_default(array('type' => "text",'class' => "inputstyle",'size' => 20,'name' => "contact"), $this);?><span class="infotips">(可以是电话、email、qq等)</span></td> </tr> <?php if( $this->_vars['askshow'] == "on" ){ ?> <th><em>*</em>验证码：</th> <td><?php echo tpl_input_default(array('type' => "text",'required' => "true",'size' => "4",'maxlength' => "4",'name' => "askverifyCode"), $this);?>&nbsp;<img src="<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode",'arg0' => "ask"), $this);?>" border="1" id="askimgVerifyCode"/><a href="javascript:changeimg('askimgVerifyCode','ask')">&nbsp;看不清楚?换个图片</a></td> </tr> <?php } ?> <tr> <td></td> <td><input type="submit" value="提交咨询"></td> </tr> </table> </div> </form> </div> </div> <?php }  }  if( $this->_vars['comment']['switch']['discuss'] == 'on' ){  if( $this->_vars['comment']['power']['discuss'] !='null' && $this->_vars['comment']['member_lv'] < 0 ){ ?> <div class="section pdtdetail" tab="商品评论 (<em><?php echo ((isset($this->_vars['comment']['discussCount']) && ''!==$this->_vars['comment']['discussCount'])?$this->_vars['comment']['discussCount']:'0'); ?></em>)"> <div class=""><strong>商品评论</strong><span><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "discuss"), $this);?>">（已有<em><?php echo ((isset($this->_vars['comment']['discussCount']) && ''!==$this->_vars['comment']['discussCount'])?$this->_vars['comment']['discussCount']:'0'); ?></em>条评论）</a></span></div> <div class="FormWrap" style="background:#f6f6f6; margin-top:0px;"> <?php if( count($this->_vars['comment']['list']['discuss']) == 0 ){ ?> <div class="boxBrown division"> <?php echo $this->_vars['comment']['null_notice']['discuss']; ?> </div> <?php }else{ ?> <div class=" Comments" id="goods-comment"> <?php $this->_env_vars['foreach'][discusslist]=array('total'=>count($this->_vars['comment']['list']['discuss']),'iteration'=>0);foreach ((array)$this->_vars['comment']['list']['discuss'] as $this->_vars['comlist']){ $this->_env_vars['foreach'][discusslist]['first'] = ($this->_env_vars['foreach'][discusslist]['iteration']==0); $this->_env_vars['foreach'][discusslist]['iteration']++; $this->_env_vars['foreach'][discusslist]['last'] = ($this->_env_vars['foreach'][discusslist]['iteration']==$this->_env_vars['foreach'][discusslist]['total']); ?> <div class="division boxBlue clearfix" style="margin-bottom:0px;"> <div class=" floatLeft commentMain"> <div class="floatLeft commentAsk">提问</div> <span class="author fontcolorOrange"><?php echo $this->_vars['comlist']['author']; ?><!--<?php if( $this->_vars['comlist']['levelname']!="" ){ ?> [<?php echo $this->_vars['comlist']['levelname']; ?>]<?php } ?> --></span>说： <span class="timpstamp font10px fontcolorGray replies prepend-1"><?php echo tpl_modifier_cdate($this->_vars['comlist']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo tpl_modifier_escape($this->_vars['comlist']['comment'],'html'); ?></div> </div> </div> <div class="commentReply"> <?php foreach ((array)$this->_vars['comlist']['items'] as $this->_vars['items']){ ?> <div class="division item " style=" margin:0px;" > <div class="floatLeft commentReply-admin">回复</div> <span class="author fontcolorOrange"><?php echo $this->_vars['items']['author']; ?><!--<?php if( $this->_vars['items']['levelname']!="" ){ ?> [<?php echo $this->_vars['items']['levelname']; ?>]<?php } ?> --></span>&nbsp;&nbsp;回复： <span class="timpstamp font10px fontcolorGray replies prepend-1"><?php echo tpl_modifier_cdate($this->_vars['items']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo $this->_vars['items']['comment']; ?></div> </div> <?php } ?> </div> <?php } unset($this->_env_vars['foreach'][discusslist]); ?> </div> <div class="textright"><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "discuss"), $this);?>">查看所有评论&gt;&gt;</a></div> <?php } ?> </div> <div class="boxBrown division"> <a href="<?php echo tpl_function_link(array('ctl' => passport,'act' => login), $this);?>"><image src="statics/btn-discuss.gif" /></a> </div> </div> <?php }else{ ?> <div class="section pdtdetail" tab="商品评论 (<em><?php echo ((isset($this->_vars['comment']['discussCount']) && ''!==$this->_vars['comment']['discussCount'])?$this->_vars['comment']['discussCount']:'0'); ?></em>)"> <div class="commentTabLeft floatLeft"><strong>商品评论</strong><span><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "discuss"), $this);?>">（已有<em><?php echo ((isset($this->_vars['comment']['discussCount']) && ''!==$this->_vars['comment']['discussCount'])?$this->_vars['comment']['discussCount']:'0'); ?></em>条评论）</a></span></div> <div class="commentTabRight floatLeft"></div> <div style="clear:both;"></div> <div class="FormWrap" style="background:#f6f6f6; margin-top:0px;"> <?php if( count($this->_vars['comment']['list']['discuss']) == 0 ){ ?> <div class="boxBrown division"> <?php echo $this->_vars['comment']['null_notice']['discuss']; ?> </div> <?php }else{ ?> <div class=" Comments" id="goods-comment"> <?php $this->_env_vars['foreach'][discusslist]=array('total'=>count($this->_vars['comment']['list']['discuss']),'iteration'=>0);foreach ((array)$this->_vars['comment']['list']['discuss'] as $this->_vars['comlist']){ $this->_env_vars['foreach'][discusslist]['first'] = ($this->_env_vars['foreach'][discusslist]['iteration']==0); $this->_env_vars['foreach'][discusslist]['iteration']++; $this->_env_vars['foreach'][discusslist]['last'] = ($this->_env_vars['foreach'][discusslist]['iteration']==$this->_env_vars['foreach'][discusslist]['total']); ?> <div class="division boxBlue clearfix" style="margin-bottom:0px;"> <div class=" floatLeft commentMain"> <div class="floatLeft commentAsk">提问</div> <span class="author fontcolorOrange"><?php echo $this->_vars['comlist']['author']; ?><!--<?php if( $this->_vars['comlist']['levelname']!="" ){ ?> [<?php echo $this->_vars['comlist']['levelname']; ?>]<?php } ?> --></span>说： <span class="timpstamp font10px fontcolorGray replies prepend-1"><?php echo tpl_modifier_cdate($this->_vars['comlist']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo tpl_modifier_escape($this->_vars['comlist']['comment'],'html'); ?></div> </div> <div class="floatRight"><a class="floatRight lnk " href='<?php echo tpl_function_link(array('ctl' => "comment",'act' => "reply",'arg0' => $this->_vars['comlist']['comment_id'],'arg1' => "discuss"), $this);?>'>回复此评论</a></div> </div> <div class="commentReply"> <?php foreach ((array)$this->_vars['comlist']['items'] as $this->_vars['items']){ ?> <div class="division item " style=" margin:0px;" > <div class="floatLeft commentReply-admin">回复</div> <span class="author fontcolorOrange"><?php echo $this->_vars['items']['author']; ?><!--<?php if( $this->_vars['items']['levelname']!="" ){ ?> [<?php echo $this->_vars['items']['levelname']; ?>]<?php } ?> --></span>&nbsp;&nbsp;回复： <span class="timpstamp font10px fontcolorGray replies prepend-1"><?php echo tpl_modifier_cdate($this->_vars['items']['time'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo $this->_vars['items']['comment']; ?></div> </div> <?php } ?> </div> <?php } unset($this->_env_vars['foreach'][discusslist]); ?> </div> <div class="textright"><a href="<?php echo tpl_function_link(array('ctl' => "comment",'act' => "commentlist",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "discuss"), $this);?>">查看所有评论&gt;&gt;</a></div> <?php } ?> <form class="addcomment" method="post" action='<?php echo tpl_function_link(array('ctl' => "comment",'act' => "toComment",'arg0' => $this->_vars['goods']['goods_id'],'arg1' => "discuss"), $this);?>' onsubmit='checkFormReqs(event);'> <h4>发表评论</h4> <div class='title'>标题：<?php echo tpl_input_default(array('type' => "text",'class' => "inputstyle blur",'required' => "true",'size' => 50,'name' => "title",'value' => "[评论]".$this->_vars['goods']['name']), $this);?></div> <div class="division"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="forform"> <tr> <th><em>*</em>评论内容：</th> <td><?php echo tpl_input_textarea(array('class' => "x-input inputstyle",'vtype' => "required",'rows' => "5",'name' => "comment",'style' => "width:80%;"), $this);?></td> </tr> <tr> <th>联系方式：</th> <td><?php echo tpl_input_default(array('type' => "text",'class' => "inputstyle",'size' => 20,'name' => "contact"), $this);?><span class="infotips">(可以是电话、email、qq等).</span></td> </tr> <?php if( $this->_vars['discussshow'] == "on" ){ ?> <tr> <th><em>*</em>验证码：</th> <td><?php echo tpl_input_default(array('type' => "text",'required' => "true",'size' => "4",'maxlength' => "4",'name' => "discussverifyCode"), $this);?>&nbsp;<img src="<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode",'arg0' => "discuss"), $this);?>" border="1" id="discussimgVerifyCode"/><a href="javascript:changeimg('discussimgVerifyCode','discuss')">&nbsp;看不清楚?换个图片</a> </td> </tr> <?php } ?> <tr> <td></td> <td><input type="submit" value="提交评论"></td> </tr> </table> </div> </form> </div> </div> <?php }  }  if( count($this->_vars['gift'])>0 ){ ?> <div class="section pdtdetail" tab="赠品"> <h2>赠品</h2> <div class="body" id="goods-gift"> <div class="GoodsSearchWrap"> <?php foreach ((array)$this->_vars['gift'] as $this->_vars['key'] => $this->_vars['gift']){ ?> <div class="items-list" product="<?php echo $this->_vars['gift']['gift_id']; ?>"> <div class="goodpic"> <?php echo tpl_input_checkbox(array('name' => "g[]",'value' => $this->_vars['gift']['goods_id']), $this);?> <a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['gift']['goods_id']), $this);?>" title="<?php echo $this->_vars['gift']['name']; ?>" style='<?php if( $this->system->getConf('site.thumbnail_pic_width') !=0 && $this->system->getConf('site.thumbnail_pic_width') !=0 ){ ?> width:<?php echo $this->system->getConf('site.thumbnail_pic_height'); ?>px;height:<?php echo $this->system->getConf('site.thumbnail_pic_height'); ?>px;<?php } ?> overflow:hidden;text-align:center;vertical-align: middle;margin:0px auto; line-height:<?php echo $this->system->getConf('site.small_pic_height'); ?>px;'> <img src="<?php echo substr($this->_vars['goods']['image_default'],0,strpos($this->_vars['goods']['image_default'],'|')); ?>" alt="<?php echo $this->_vars['gift']['name']; ?>"/></a></div> <div class="goodinfo"> <h6><a href="<?php echo tpl_function_link(array('ctl' => "gift",'act' => "index",'arg0' => $this->_vars['gift']['gift_id']), $this);?>" title="<?php echo $this->_vars['gift']['name']; ?>"><?php echo $this->_vars['gift']['name']; ?></a></h6> <ul> <li class="intro"><?php echo $this->_vars['gift']['intro']; ?></li> <li><?php echo $this->_vars['gift']['describe']; ?></li> </ul> </div> <div class="clear"></div> </div> <?php } ?> </div> </div> </div> <?php }  if( count($this->_vars['coupon'])>0 ){ ?> <div class="section pdtdetail" tab="可得优惠券"> <h2>可得优惠券</h2> <div class="body" id="goods-coupon"> <ul style="padding:5px 20px;"> <?php foreach ((array)$this->_vars['coupon'] as $this->_vars['key'] => $this->_vars['coupon']){ ?> <li><?php echo $this->_vars['coupon']['cpns_name']; ?></li> <?php } ?> </ul> </div> </div> <?php } ?> </div> </div> <script>
    
    $$('.addcomment .title input').addEvents({
         'focus':function(){this.removeClass('blur');},
         'blur':function(){this.addClass('blur');}
    });

</script> <?php if( $this->_vars['goods']['marketable'] != 'false' ){ ?> <script>




 var buycoutText=$E('#goods-viewer .buyinfo input[type=text]').addEvent('keydown',function(e){
             if($A(keyCodeFix).include(e.code).length>25){
               e.stop();
              }
         });
    var getStore=function(){

    return $E('#goods-viewer .buyinfo .store').get('text').toInt()

    };

         buycoutText.addEvent('keyup',function(e){

            if(getStore()<this.value)this.value=getStore();
            if(!this.value||this.value.toInt()<1)this.value=1;
         });
         /*购买数量调节*/
         $$('#goods-viewer .buyinfo .numadjust').addEvent('click',function(e){
              var countText=$E('#goods-viewer .buyinfo input[name^=goods[num]');
              if(this.hasClass('increase')){
                 countText.set('value',(countText.value.toInt()+1).limit(1,getStore()));
              }else{
                 countText.set('value',(countText.value.toInt()-1).limit(1,getStore()));
              }
              this.blur();
         });

         $$('#goods-viewer .buyinfo .numadjust').addEvents({
             'mousedown':function(){
                this.addClass('active');
             },
             'mouseup':function(){
               this.removeClass('active');
             }
         });










/*hightline*/
$$('#goods-viewer .hightline').addEvents({
   mouseenter:function(){

        this.addClass('hightline-enter');

   },
   mouseleave:function(){

        this.removeClass('hightline-enter');

   }

});


</script> <?php if( ($this->_vars['goods']['FlatSpec'] or $this->_vars['goods']['SelSpec']) && count($this->_vars['goods']['products'])>0 ){ ?> <script>
      /*=规格选择联动=
      *(c) shopex.cn
      * 2009-2
      */

 void function(){

          var buyBtn=$empty;
          var notifyBtn=$empty;
          var setbuyBtnTip=$empty;
          var popAloneSpec=$empty;

         window.addEvent('domready',function(){

              buyBtn=$E('#goods-viewer .btn-buy').store('tip:text','');
              notifyBtn=$E('#goods-viewer .btn-notify').store('tip:text','对不起,您当前选择的商品缺货.');

             new Tips(buyBtn,{showDelay:0,hideDelay:0,className:'cantbuy',

                     onShow:function(tip){
                        if(!this.textElement||!$E('.tip-text',tip)||!$E('.tip-text',tip).getText()){
                            buyBtn.setStyle('cursor','pointer');
                            return tip.setStyle('visibility','hidden');
                        }else{
                            buyBtn.setStyle('cursor','not-allowed');
                        }
                        tip.setStyle('visibility','visible');
                     }
              });
              new Tips(notifyBtn,{className:'cantbuy',showDelay:0,hideDelay:0});

               buyBtn.addEvent('click',function(e){
                   e.stop();
                   this.blur();
                   if(this.retrieve('tip:text'))return false;

                   this.form.submit();

               });
               notifyBtn.addEvent('click',function(e){
                      e.stop();
                      this.blur();
                      new Element('form',{method:'post','action':$(this.form).get('gnotify')}).adopt(
                         this.form.toQueryString().toFormElements()
                      ).inject(document.body).submit();
                });
              notifyBtn.addEvents({
                  'onhide':function(){
                       if($(this).getPrevious('.btn-fastbuy'))
                      $(this).getPrevious('.btn-fastbuy').setStyle('visibility','visible');
                  }
              });

                /*快速购买*/
              var fastbuyBtn = $E('#goods-viewer .btn-fastbuy');
              if(fastbuyBtn){
                      fastbuyBtn.store('tip:text','').addEvent('click',function(e){
                           e.stop();
                           this.blur();
                           if(this.retrieve('tip:text'))return false;
                           var form = $('fastbuy-form');
                           form.empty().adopt($(this.form).toQueryString().toFormElements());
                           form.adopt(new Element('input', {name:'isfastbuy',value:1,type:'hidden'}));
                           if(!form.retrieve('events',{})['submit'])return form.submit();
                           form.fireEvent('submit',e);

                       });

                      new Tips(fastbuyBtn,{showDelay:0,hideDelay:0,className:'cantbuy',
                                 onShow:function(tip){
                                    if(!this.textElement||!$E('.tip-text',tip)||!$E('.tip-text',tip).getText()){
                                        fastbuyBtn.setStyle('cursor','pointer');
                                        return tip.setStyle('visibility','hidden');
                                    }else{
                                        fastbuyBtn.setStyle('cursor','not-allowed');
                                    }
                                    tip.setStyle('visibility','visible');
                                 }
                          });
                  }





               setbuyBtnTip=function(){
                    var spec_item_nocheck=[];
                    $ES('#goods-spec .spec-item em').each(function(em){

                        if(!em.hasClass('check'))spec_item_nocheck.include(em.getText());

                    });
                    
                     if(spec_item_nocheck.length>0){
                        $$(buyBtn,fastbuyBtn).store('tip:text','请选择：'+spec_item_nocheck.join(','));

                     }else{
                        $$(buyBtn,fastbuyBtn).store('tip:text','');
                     }
                     return arguments.callee;
                 }();


             popAloneSpec=function(){
                var specs = $$('#goods-spec tr.spec-item','#goods-spec div.spec-item .content');
                    specs.each(function(si){
                          var specs=si.getElements('a[specid]');
                          if(!specs.length){return $E('#goods-viewer .hightbox').empty().set('html','<b>该商品的所有规格货品已下架</b>').addClass('note')}
                          if(specs.length>1)return false;

                          if(specs[0].hasClass('selected')||specs[0].hasClass('lock'))return false;

                          specs[0].fireEvent('click');

                });


               return arguments.callee;

             }();
                 if(btnBar = $E('#goods-viewer .btnBar')){
                    btnBar.setStyle('visibility','visible');
                 }
         });


          var getSpecText=function(el){
             if($E('img',el))
             return $E('img',el).alt||$E('img',el).title;
             return $E('span',el).get('text');
          };

          var specItems=$ES('#goods-spec .spec-item em');
          var referencePoint={
          bn:$('goodsBn'),
          weight:$('goodsWeight'),
                  marketPrice:$E('#goods-viewer .mktprice1'),
                  price:$E('#goods-viewer .price1'),
                  discount:$E('#goods-viewer .discount'),
                  store:$E('#goods-viewer .buyinfo .store'),
                  specTip:$E('#goods-spec .spec-tip'),
                  update:function(v,html){
                     return referencePoint[v]?referencePoint[v].setHTML(html):false;
                  }
          };
          var RPSV=$H(referencePoint).getValues();
          RPSV.each(function(el){
               if(el&&$type(el)=='element')
               el.retrieve('defaultInnerHTML',el.get('html'));
          });

          var referencePointDef=function(){
                RPSV.each(function(el){
                   if(el&&$type(el)=='element')
                   el.setHTML(el.retrieve('defaultInnerHTML'));
               });
               if($E('#goods-viewer .mprice'))$E('#goods-viewer .mprice').hide();
               updatepic();
               buyBtn.show();
               notifyBtn.hide();

          };




          var PRODUCT_HASH=new Hash(<?php echo $this->_vars['goods']['product2spec']; ?>);
          var PRODUCT_SPECV_ARR=[];
              PRODUCT_HASH.each(function(v){
                   PRODUCT_SPECV_ARR.push(v['spec_private_value_id']);
              });
        
          var SPEC_HASH=new Hash(<?php echo $this->_vars['goods']['spec2product']; ?>);
          
         

          /* var updatepicRequest=new Request.HTML({url:'<?php echo tpl_function_link(array('ctl' => product,'act' => goodspics), $this);?>',
                                                 update:$E('#goods-viewer .goodspic'),
                                                 autoCancel:true,
                                                 onRequest:function(){
                                                  }
                                                });
         相册联动*/
          var updatepic=function(vids){
              
              if(!vids)return $$('.goods-detail-pic-thumbnail td[img_id]').each(Element.show);
              vids = vids.split(',');
   
              var pointer = false;
              $$('.goods-detail-pic-thumbnail td[img_id]').each(function(i){
                        
                        if(vids.contains(i.get('img_id'))){
                            i.style.display = '';
                            if(!pointer){
                               i.getElement('a').fireEvent('click',{stop:$empty});
                               pointer = true;
                            }
                        }else{
                            
                            i.style.display = 'none';
                            
                        }
              });
              
          
               /* if(!vids)vids='';
               var pud=$E('#goods-viewer .goodspic').retrieve('picsupdatedelay');
               var put=$E('#goods-viewer .goodspic').retrieve('picsupdatetemp','');
               $clear(pud);
               if(put==vids)return;
               $E('#goods-viewer .goodspic').store('picsupdatedelay',
                  (function(){
                  updatepicRequest.post({gimages:vids,goodsId:$E('#goods-viewer input[name^=goods[goods_id]').get('value')});
                  $E('#goods-viewer .goodspic').store('picsupdatetemp',vids);
                  }).delay(800)
               );*/
          };


          /*其他联动*/

          var updateReference=function(specSelected,specvidarr){

                var fix=(specvidarr.length==specItems.length);
                setbuyBtnTip();
                var productIntersection=[];

                /*当前已选择规格的商品交集*/
                 var specTip=[];
                 var picsId=[];
                if(specSelected){
                    specSelected.each(function(s){
                         productIntersection.combine(SPEC_HASH[s.get('specvid')]['product_id']);

                         specTip.include("<font color=red>\""+getSpecText(s)+"\"</font>");
                         picsId.combine(SPEC_HASH[s.get('specvid')]['images']);
                    });
                }

                if(!productIntersection||!productIntersection.length)return referencePointDef();


                var price=[];
                productIntersection.each(function(pid){
                    var product=PRODUCT_HASH[pid];
                    /*if(storeCount.toInt()>9999){
                      storeCount='9999+';
                    }else{
                      storeCount=storeCount.toInt()+product['store'].toInt();
                    }*/

                    price.include(product['price']).clean();

                });

                /*相册联动*/
                picsId = picsId.clean();
                if(picsId.length){
                    updatepic(picsId.join(','));
                }
                /*库存联动
                referencePoint.update('store',storeCount.toInt()>9999?'9999+':storeCount);*/

                /*价格联动*/
                if(price.length>1){
                      price.sort(function(p1,p2){
                         p1=p1.toInt();
                         p2=p2.toInt();
                         if(p1>p2)return 1;
                         if(p1==p2)return 0;
                         return -1;
                      }); 
  if(price[0])
                      referencePoint.update('price',priceControl.format(price[0])+'-'+priceControl.format(price[price.length-1]));
                }else{
                     referencePoint.update('price',priceControl.format(price[0]));
                }

                /*规格选择提示联动*/
                referencePoint.update('specTip','<em>您已选择：</em><span>'+specTip.join("、")+'</span>');


                var product_hiddenInput=$E('#goods-spec input[name^=goods[product_id]').set('disabled',!fix);
                var mprice=$E('#goods-viewer .mprice');


               /*定位到货品*/
                if(fix){
                     var fixProductID=null;
                     PRODUCT_HASH.each(function(v,k){
                          if($A(v['spec_private_value_id']).combine(specvidarr).length==specvidarr.length){
                             fixProductID=k;
                          }
                     });
            
                     if(fixProductID){
                 var fixProduct=PRODUCT_HASH[fixProductID];
                     referencePoint.update('weight',fixProduct['weight']);
                     referencePoint.update('bn',fixProduct['bn']);
                     referencePoint.update('store',fixProduct['store']||0);
 !fixProduct['price']?referencePoint.update('price',priceControl.format('0')):
                     referencePoint.update('price',priceControl.format(fixProduct['price']));
                     product_hiddenInput.set('value',fixProductID);

                    

                      /*优惠联动*/

                      if(referencePoint['discount']&&referencePoint['marketPrice']){
                          var dcType={
                                     T1:'节省',
                                     T2:'优惠',
                                     T3:'折'
                                    };
                          var _discount=referencePoint['discount'];
                          var _discountValue=_discount.get('text');
                          var fdt=priceControl._format.sign;

                          var _priceValue = fixProduct['price'];

                          var _priceMarketValue = fixProduct['mktprice'];

                          var _priceDiff=_priceMarketValue-_priceValue;
 
                          if(_priceDiff>0){
                              if(_discountValue.test(dcType.T2,'i')){
                                referencePoint.update('discount','优惠：'+(_priceDiff/_priceMarketValue*100).toFixed(1)+'%');
                              }else if(_discountValue.test(dcType.T3,'i')){
                                referencePoint.update('discount',((1 - _priceDiff/_priceMarketValue)*10).toFixed(1)+'折');
                              }else{
                                referencePoint.update('discount','节省：'+priceControl.format(_priceDiff));
                              }
                          }
                          else{
                                referencePoint.update('discount','');
                          }
                      }

                     /*库存联动*/
                     if(referencePoint['store']&&(referencePoint['store'].getText().toInt()<1)){

                           buyBtn.hide();
                           notifyBtn.setStyle('display','inline');
                           notifyBtn.getPrevious('.btn-fastbuy')?notifyBtn.getPrevious('.btn-fastbuy').setStyle('visibility','hidden'):$empty();
                           return;
                      }

                     if(buynum=$E('#goods-viewer .buyinfo input[type=text]')){
                        buynum.fireEvent('keyup');
                     }

                      /*会员价联动*/
                      if(mprice){
                          mprice.getElements('.mlvprice').each(function(lvp){
                              lvp.set('text',priceControl.format(fixProduct['mprice'][lvp.get('mlv')]));
                          });
                          mprice.show();
                      }


                      
                   }

                }else{
                   if(mprice)
                   mprice.hide();
                }

                   buyBtn.show();
                   notifyBtn.hide();



          };


		  var _store=$E('.buyinfo .store').getText();
          var specSelections=$$('#goods-spec .spec-item a[specvid]');
              specSelections.addEvent('click',function(e){
                     e?e.stop():e;
                     this.blur();
                     var specid=this.get('specid');
                     var specvid=this.get('specvid');
                     var prt=this.getParent('li.content')||this.getParent('ul');

                     if(this.hasClass('lock'))return; 
                     if(this.hasClass('selected')){                     
                           this.removeClass('selected');
                           if(prt.hasClass('content')){
                                 var handle=prt.retrieve('handle');
                                 $E('span',handle).set('text','请选择').removeClass('select');
                                 handle.removeClass('curr');
                                 prt.removeClass('content-curr');
                           }
                           var n=$$('#goods-spec .specItem a.selected').length;
                           if(n<1){
                               specSelections.each(function(s){s.removeClass('lock');});
							   $E('.buyinfo .store').set('text',_store);
                           }else{   
                               var spec=$$('#goods-spec .specItem a.selected')[0];
                               specvid=spec.get('specvid');
                               specid=spec.get('specid');
                               specSelectedCall(specvid,specid,this);
                           }
                            return;
                     }
                     if(this.getParent('ul').getElement('a.selected')){
                         specSelections.each(function(s){   
                             s.removeClass('lock');
                         });
                     }
                     var tempsel=prt.retrieve('ts',this);
                     if(tempsel!=this){tempsel.removeClass('selected')}
                     prt.store('ts',this.addClass('selected'));

                          if(prt.hasClass('content')){
                                 var handle=prt.retrieve('handle');
                                 $E('span',handle).set('text',getSpecText(this)).addClass('select');
                                 handle.removeClass('curr');
                                 prt.removeClass('content-curr');
                           }


                      specSelectedCall(specvid,specid,this);

                      if(e&&e.fireFromProductsList)return;
                      popAloneSpec();
              });



        void function(){
           /*下拉方式的规格选择*/
          var specHandles=$$('#goods-spec .spec-item .handle');
          var specContents=$$('#goods-spec .spec-item .content');

          var tempSlipIndex=0;
          var tempCurrentIndex=-1;

              specHandles.each(function(handle,index){
                 var content=specContents[index];
                 var contentPadding=content.getPadding();
                     content.store('handle',handle);
                     handle.addEvent('click',function(e){
                          if(tempCurrentIndex>=0&&tempCurrentIndex!=index){
                              specHandles[tempCurrentIndex].removeClass('curr');
                              specContents[tempCurrentIndex].removeClass('content-curr');
                           }
                           tempCurrentIndex=index;
                           this.toggleClass('curr');
                           content.toggleClass('content-curr');
                           content.setStyles({'top':this.getCis().bottom-4,
                                              'left':specHandles[0].getPosition().x-3,
                                              'width':this.getParent('.goods-spec').getSize().x-(contentPadding.x+contentPadding.y+14)
                           });
                     });
                 });
             }();
          /*规格点击时call此函数*/
         
          var specSelectedCall=function(specvid,specid,spec){
               var selectedHS=new Hash();   
               var specSelected=$$('#goods-spec .spec-item a.selected');
               var specItems=$$('#goods-spec .specItem');
                
               specItems.each(function(item){
                   if(el=item.getElement('a.selected')){
                      var key=specExtend.suffix(el.get('specvid')); 
                      selectedHS.set(key,el.get('specvid'));
                   }   
               });
                    
               selectedHS=specExtend.sort(selectedHS);  

               var em=(spec.getParent('li.content')&&spec.getParent('li.content').retrieve('handle')
                       ||spec.getParent('.spec-item')).getElement('em');
                em[spec.hasClass('selected')?'addClass':'removeClass']('check');    
                var specs=specExtend.init(selectedHS,specvid);              
        
               specSelections.each(function(s){             
                    specs.indexOf(s.get('specvid'))>-1?s.removeClass('lock'):s.addClass('lock');
                });             
                
                updateReference(specSelected,selectedHS.getValues());
            };  
    
        var specExtend={
            sort:function(selectedHS){
                var sortItem=selectedHS.getKeys().sort();
                    var hs=new Hash();
                    sortItem.each(function(arr){
                        hs.set(arr,selectedHS.get(arr));
                }); 
                return hs;
            },
            suffix:function(specvid){
                var specsub;
                PRODUCT_SPECV_ARR.each(function(item){
                    item.each(function(s,i){
                        if(s==specvid){specsub=i;return;}
                    });
                });
                return specsub;
            },
            to_match:function(regExp){
                var to_string=[];
                PRODUCT_SPECV_ARR.each(function(item){
                    to_string.include(":"+item.join(':')+":");
                }); 
                var specSeleted=[]; 
                to_string.each(function(arr,key){
                    if(regExp.test(arr)){specSeleted.include(arr);}         
                }); 
                return specSeleted; 
            },
            to_arr:function(str){
                var spec_arr=[];    
                str.each(function(item){
                    var tmparr=item.split(":"); 
                    tmparr.pop();tmparr.shift();    
                    spec_arr.include(tmparr);                       
                });
                return spec_arr;
            },
            merge:function(arr){
                var spec_arr=[];            
                arr[0].each(function(e,i){
                    var sarr=[];
                    arr.each(function(el){
                        sarr.include(el[i]);
                    });
                    spec_arr.push(sarr);
                });             
                return spec_arr;
            },
            collect:function(prearr,arr,hs,key,state){
                var inarr=[];
                var hskeys=hs.getKeys();
                prearr.each(function(el,index){
                    var barr=[],jarr=[];
                    if(key!=index&&hskeys.contains(index.toString())&&hskeys.length!=prearr.length&&!state){                
                        barr.combine(prearr[index]);
                        barr.combine(arr[index]);
                        inarr.include(barr);
                    }else{              
                        arr[index].each(function(item){
                            if(el.contains(item)){
                                jarr.include(item);
                            }
                        }); 
                        inarr.include(jarr);
                    }
                });
                inarr[key]=prearr[key];
                return inarr;
            },
            findCall:function(regexp){
                var inSelected=specExtend.to_match(regexp);             
                var tmparr=specExtend.to_arr(inSelected);               
                return specExtend.merge(tmparr);
            },
            to_find:function(selectedHS,specvid){
                var subReg=":"+selectedHS.getValues().join(":(\\d+:)*")+":";    
                var tpReg = new RegExp(""+subReg.split("(:\\d+:)*")+"");
                var keys=selectedHS.keyOf(specvid);         
                var filterArr=[];                       
                var chs=$H(selectedHS);
            
                if(selectedHS.getKeys().length>2){
                    chs.erase(keys);
                    chs.each(function(item,key){
                        var tmphs=$H(chs);
                        tmphs.each(function(value,i){
                            if(key==i){ 
                                tmphs.erase(i);
                                tmphs.set(keys,specvid);
                            }
                        });
                        var hs=specExtend.sort(tmphs);
                        filterArr.push(hs.getValues());
                    });                 
                    var sbReg="";                   
                    filterArr.each(function(item,key){
                        var reg=item.join(":(\\d+:)*");
                        sbReg+=":"+reg+":|";            
                    });
                    sbReg=new RegExp(""+sbReg.substr(0,sbReg.length-1)+"");     
                    if(chs){                        
                        var loop=arguments.callee;
                        var preStore=loop(chs,chs.getValues()[0]);                      
                    }                   
                    var sbSpec=specExtend.findCall(sbReg);
                    var sbCollect=specExtend.collect(preStore,sbSpec,selectedHS,keys,true);
                }else{              
                    filterArr=selectedHS.getValues();
                    var sbReg=new RegExp(""+filterArr.join("|")+"");
                    var sbCollect=specExtend.findCall(sbReg);                   
                }                   
                var tpCollect=specExtend.findCall(tpReg);   
                var specs=specExtend.collect(sbCollect,tpCollect,selectedHS,keys);
                if(selectedHS.getKeys().length==PRODUCT_SPECV_ARR[0].length)specs=sbCollect;                
                return specs;
            },
            init:function(selectedHS,specvid){          
                if(selectedHS.getKeys().length>1){              
                    var specItems=specExtend.to_find(selectedHS,specvid);           
                    var specArr=specItems.flatten();    
                }else{
                    var regExp = new RegExp(":"+specvid+":");
                    var specSelected=specExtend.to_match(regExp);
                    var specItems=specExtend.to_arr(specSelected);                 
                    var specArr=[];         
                    specItems.each(function(item){specArr.combine(item);}); 
                    var items;
                    $$('#goods-spec .specItem').map(function(item,index){
                        if(item.getElements('a').get('specvid').contains(specvid))items=item;
                    });
                    items=items.getElements('a').get('specvid');
                    specArr.combine(items);         
                }
                return specArr; 
            }
        };  

          var fixProductHidden = $E('#goods-spec input[name^=goods[product_id]');
          var gpList=$('goods-products-list').addEvents({
                 pop:function(){
                  this.setStyles({
                      width:$E('#goods-viewer .hightline').getSize().x,
                      top:$E('#goods-viewer .hightline').getPosition().y,
                      left:$E('#goods-viewer .hightline').getPosition().x,
                      display:'block'
                  });
                  if(this.getSize().y>300){

                     this.setStyles({
                        height:300,
                        'overflow-y':'auto'
                     });
                  }
                  this.getElements('tbody tr').each(function(tr){
                       var fixProductId = fixProductHidden.disabled?false:fixProductHidden.value;
                       if(tr.get('productid') == fixProductId){
                           tr.addClass('selected');
                       }else{
                           tr.removeClass('selected');
                       }
                  });

                  $(document.body).addEvent('click',function(e){

                         this.fireEvent('unvisible');
                         $(document.body).removeEvent('click',arguments.callee);

                  }.bind(this));

                },
                unvisible:function(){
                     this.setStyles({
                      top:-20000,
                      display:'none'
                    });
                }
          });

          gpList.getElements('tbody tr').addEvents({

              mouseenter:function(){
                  this.addClass('mouseover');
              },
              mouseleave:function(){
                  this.removeClass('mouseover');
                  this.fireEvent('mouseup');
              },
              mousedown:function(){
                  this.addClass('mousedown');
              },
              mouseup:function(){
                  this.removeClass('mousedown');
              },
              click:function(){
                   this.fireEvent('ischecked');

              },
              ischecked:function(){
                  var productId = this.get('productId');
                  var productMap = PRODUCT_HASH[productId];
                  var specIDarr = productMap['spec_private_value_id'];
                  $$('#goods-spec .spec-item a.selected').fireEvent('click');
                  specIDarr.each(function(s){
                         var specEl=$E('#goods-spec .spec-item a[specvid='+s+']');
                         if(!specEl)return;
                         specEl.fireEvent('click',{stop:$empty,fireFromProductsList:true});
                  });

              }

          });




      }();
 </script> <?php }elseif( $this->_vars['goods']['store']==='0' ){ ?> <script>
     /*无规格商品到货通知 show*/
      window.addEvent('domready',function(){

            var notifyBtn=$E('#goods-viewer .btn-notify').store('tip:text','您当前要购买的商品暂时缺货,点击进入缺货登记页.');
            new Tips(notifyBtn,{className:'cantbuy',showDelay:0,hideDelay:0});
            notifyBtn.show();
            notifyBtn.addEvent('click',function(e){
                      e.stop();
                      this.blur();
                      this.form.action=this.form.get('gnotify');
                      this.form.submit();
                });
      });
     </script> <?php }else{ ?> <script>
     window.addEvent('domready',function(){
                        /*快速购买*/
              var fastbuyBtn = $E('#goods-viewer .btn-fastbuy');
              if(fastbuyBtn){
                      fastbuyBtn.addEvent('click',function(e){

                           e.stop();
                           this.blur();
                            var form = $('fastbuy-form');
                           form.empty().adopt($(this.form).toQueryString().toFormElements());
                           form.adopt(new Element('input', {name:'isfastbuy',value:1,type:'hidden'}));
                           if(!form.retrieve('events',{})['submit'])return form.submit();
                           form.fireEvent('submit',e);
                       });
                  }

      });
     </script> <?php }  }  if( $this->_vars['goods']['adjunct'] && count($this->_vars['goods']['adjunct'])>0 ){ ?> <script>
     /*配件JS*/
    void function(){

     var updateAdjunctPrice=function(){
           var adjunctPrice=0;

           var selected=$$('#goods-adjunct tr').filter(function(tr,index){

                       return tr.getElement('input[type=checkbox]').checked;

           });
           selected.each(function(s,i){
               adjunctPrice+=s.get('price').toFloat()*s.getElement('input[type=hidden]').value.toFloat();
           });
           var price=isNaN(adjunctPrice)?0:adjunctPrice;
           $E('#goods-adjunct .price').set('text',priceControl.format(price));


      };



        var adjunctCheckbox=$ES('#goods-adjunct input[type=checkbox]');
        var adjunctText=$ES('#goods-adjunct input[type=text]');


        adjunctCheckbox.addEvent('click',function(e){
              var  prt=this.getParent('tr');
              var  min_num=prt.getParent('tbody').get('min_num').toInt();
              if(isNaN(min_num)||min_num<1)min_num=1;

              var _hidden=prt.getElement('input[type=hidden]').set('disabled',!this.checked);

              this.checked?prt.setStyle('background','#e9e9e9'):prt.setStyle('background','#fff');

              var _text=prt.getElement('input[type=text]');

              if(!_text.value||_text.value<min_num){

                _hidden.value=_text.value=min_num;
              }else{
                _hidden.value=_text.value;
              }
              updateAdjunctPrice();

        });

        adjunctText.addEvent('keydown',function(e){
          if($A(keyCodeFix).include(e.code).length>25)
           e.stop();
        });
        adjunctText.addEvent('keyup',function(e){
              var  prt=this.getParent('tr');
              var min_num=prt.getParent('tbody').get('min_num').toInt();
              var max_num=prt.getParent('tbody').get('max_num').toInt();
              var _hidden=prt.getElement('input[type=hidden]');
              if(isNaN(min_num)||min_num<0){
                 min_num=0;
              };
              if(isNaN(max_num)||max_num<0){
                 max_num=Number.MAX_VALUE;
              };
              if(this.value){
                _hidden.value=this.value=this.value.toInt().limit(min_num,max_num);
              }
              updateAdjunctPrice();
        });



    }();

  </script> <?php } ?> <script>
/*设置浏览过的商品*/
withBroswerStore(function(broswerStore){
  broswerStore.get('history',function(history){
  history=JSON.decode(history);
  if(!history||$type(history)!=='array')history=[];
   if(history.length==40){history.pop()};
   var newhis={'goodsId':<?php echo $this->_vars['goods']['goods_id']; ?>,
               'goodsName':'<?php echo tpl_modifier_replace($this->_vars['goods']['name'],"'","\'"); ?>',
               'goodsImg':'<?php echo tpl_modifier_storager($this->_vars['images']['gimages'][$this->_vars['goods']['image_default']]['small']); ?>',
               'viewTime':$time()
              };
   if(!history.some(function(i,index){


   if(i['goodsId']==newhis['goodsId']){
         history.erase(i);
         history.include(newhis)
         return true;
   }
      return false;

   })){
       history.include(newhis);
   }
   broswerStore.set('history',history);

  });
});


window.addEvent('domready', function(){


/*Tab的处理*/
try{
var viewTabsContainer=$E('#goods-viewer .goods-detail-tab');
var viewTabs=[];
var viewSections=$$('#goods-viewer .section');

viewSections.each(function(se){
  var t=new Element('div',{'class':'goodsDetailTab'}).set('html','<span>'+se.get('tab')+'</span>');
  viewTabs.push(t);

});

viewTabsContainer.adopt(viewTabs);

new ItemAgg(viewTabs,viewSections,{activeName:'active',
                                     onActive:function(tab,item){
                                                  var anotherItems=$$($A(this.items).remove(item));

                                                  if(tab.getElement('span').get('text')=='商品详情'){
                                                     anotherItems.show();
                                                  }else{
                                                     anotherItems.hide();
                                                  }
                                   }});
}catch(e){}

});



/*验证码刷新*/
function changeimg(id,type){
    $(id).set('src','<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode",'arg0' => "'+type+'"), $this);?>#'+$time());
};

</script> <script>
void function(){
/*橱窗放大镜
  author:litie[A]shopex.cn
  [c]  ShopEx
  last update : 2009年9月25日14:51:20
*/
    (new Image()).src = '<?php echo $this->_vars['base_url']; ?>statics/loading.gif';
    var getAmongPos = function(size,to){
                 var elpSize = $(to).getSize();
                 return {
                    'top':Math.abs((elpSize.y/2).toInt()-(size.height/2).toInt()+to.getPosition().y+elpSize.scroll.y),
                    'left':Math.abs((elpSize.x/2).toInt()-(size.width/2).toInt()+to.getPosition().x+elpSize.scroll.x)
                 };
            };
   
   $$('#goods-rels .zoom a').addEvent('click',function(e){
            e.stop();
            if(this.retrieve('active'))return;
            var _this = this;
            _this.store('active',true);
            var tpic = this.getParent('.items-gallery').getElement('.goodpic img');
            var bpic_src = this.get('pic');
           
            var loading = new Element('div',{
                 styles:{'background':'#fff url(<?php echo $this->_vars['base_url']; ?>statics/loading.gif) no-repeat 50% 50%',
                         'width':40,
                         'height':40,
                         'border':'1px #e9e9e9 solid',
                         'opacity':.5}}).inject(document.body).amongTo(tpic);
            
            new Asset.image(bpic_src,{onload:function(img){
                  
                  loading.remove();
                  var winsize = window.getSize();
                  var imgSize = $(img).zoomImg(winsize.x,winsize.y,1);
                  var fxv = $extend(getAmongPos(imgSize,window),imgSize);
                  var imgFx = new Fx.Morph(img,{link:'cancel'});
                  img.setStyles($extend(tpic.getCis(),{opacity:0.5})).inject(document.body).addClass('img-zoom').addEvent('click',function(){
                      imgFx.start(tpic.getCis()).chain(function(){this.element.remove();_this.store('active',false);});
                  });
                  imgFx.start($extend(fxv,{opacity:1}));
                  document.addEvent('click',function(){
                       
                       img.fireEvent('click');
                       document.removeEvent('click',arguments.callee);
                  
                  });
            
            },onerror:function(){
                _this.store('active',false);
                loading.remove();
            }});
            
   
   });
   
   
   }();
</script>