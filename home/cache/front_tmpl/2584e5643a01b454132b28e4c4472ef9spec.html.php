<?php if(!function_exists('tpl_block_help')){ require(CORE_DIR.'/admin/smartyplugin/block.help.php'); } if(!function_exists('tpl_modifier_escape')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.escape.php'); } if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?> <div class="goods-spec-cell" > <h4>规格<?php $this->_tag_stack[] = array('tpl_block_help', array('docid' => "71",'type' => "link")); tpl_block_help(array('docid' => "71",'type' => "link"), null, $this); ob_start(); ?>点击查看帮助<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_content = tpl_block_help($this->_tag_stack[count($this->_tag_stack) - 1][1], $_block_content, $this); echo $_block_content; array_pop($this->_tag_stack); $_block_content=''; ?></h4> <div class='clearfix note' style='border:none;'> <div class='span-auto'><span class="sysiconBtn addorder addproduct">添加一个货品</span></div> <div class='span-auto'><?php $this->_tag_stack[] = array('tpl_block_help', array('docid' => "80",'type' => "link-small")); tpl_block_help(array('docid' => "80",'type' => "link-small"), null, $this); ob_start(); ?>点击查看货品说明<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_content = tpl_block_help($this->_tag_stack[count($this->_tag_stack) - 1][1], $_block_content, $this); echo $_block_content; array_pop($this->_tag_stack); $_block_content=''; ?></div> <div class='span-auto'><span class="sysiconBtn edit selectspec">选择规格项</span><span class="sysiconBtn delete closespec">关闭规格</span></div> </div> <table cellspacing="0" cellpadding="0" border="0" class="gridlist"> <thead id="productNodeTitle"> <tr> <th>货号</th> <?php foreach ((array)$this->_vars['specname'] as $this->_vars['key'] => $this->_vars['snItem']){ ?> <th><?php echo tpl_modifier_escape($this->_vars['snItem']['spec_name'],'html'); ?> <input type="hidden" name="vars[<?php echo $this->_vars['key']; ?>]" value="<?php echo tpl_modifier_escape($this->_vars['snItem']['spec_name'],'html'); ?>" /> </th> <?php }  foreach ((array)$this->_vars['spec']['idataInfo'] as $this->_vars['key'] => $this->_vars['item']){ ?> <th class="idata" ><?php echo $this->_vars['item']; ?> <input type="hidden" name="idataInfo[<?php echo $this->_vars['key']; ?>]" value="<?php echo $this->_vars['item']; ?>" /></th> <?php } ?> <th >库存</th> <th >销售价</th> <th>成本价</th> <th>市场价</th> <th>重量</th> <?php if( $this->system->getConf('storeplace.display.switch') ){ ?> <th>货位</th> <?php } ?> <th>上架</th> <th>操作</th> </tr> </thead> <tbody id='productNode'> <?php foreach ((array)$this->_vars['goods']['products'] as $this->_vars['id'] => $this->_vars['pro']){ ?> <input type="hidden" name="source_bn[<?php echo $this->_vars['pro']['bn']; ?>]" value="1"/> <tr> <td><input type="hidden" name="old_bn[]" value="<?php echo $this->_vars['pro']['bn']; ?>"/><input type="text" size=15 name="bn[]" value="<?php echo $this->_vars['pro']['bn']; ?>"/></td> <?php if( $this->_vars['fromType'] == 'create' ){  foreach ((array)$this->_vars['pro']['sel_spec'] as $this->_vars['sitem']){ ?> <td><div class="select-spec-unselect goods-spec-selected" specid="<?php echo $this->_vars['sitem']['spec_id']; ?>"><?php if( $this->_vars['sitem']['spec_type'] == 'text' ){ ?><span><?php echo $this->_vars['sitem']['spec_value']; ?></span> <?php }else{  if( $this->_vars['sitem']['spec_image'] ){ ?> <center> <img width="20" height="20" src="<?php echo tpl_modifier_storager($this->_vars['sitem']['spec_image']); ?>" alt="<?php echo $this->_vars['sitem']['spec_value']; ?>" title="<?php echo $this->_vars['sitem']['spec_value']; ?>"/> </center> <?php }elseif( $this->_vars['goods']['spec_value_image'][$this->_vars['sitem']['spec_value_id']] ){ ?> <center> <img width="20" height="20" src="<?php echo tpl_modifier_storager($this->_vars['goods']['spec_value_image'][$this->_vars['sitem']['spec_value_id']]); ?>" alt="<?php echo $this->_vars['sitem']['spec_value']; ?>" title="<?php echo $this->_vars['sitem']['spec_value']; ?>"/> </center> <?php }else{ ?> <center> <img width="20" height="20" src="<?php echo tpl_modifier_storager($this->_vars['spec_default_pic']); ?>" alt="<?php echo $this->_vars['sitem']['spec_value']; ?>" title="<?php echo $this->_vars['sitem']['spec_value']; ?>"/> </center> <?php }  } ?> </div> <div class='select-spec-value' style="display:none"> <ul class='goods-spec-box' style="width:200px;"> </ul> </div> <input type="hidden" name="val[<?php echo $this->_vars['sitem']['spec_id']; ?>][]" value="<?php echo urlencode($this->_vars['sitem']['spec_value']); ?>" /> <input type="hidden" name="pSpecId[<?php echo $this->_vars['sitem']['spec_id']; ?>][]" value="<?php echo $this->_vars['sitem']['p_spec_value_id']; ?>"/> <input type="hidden" name="specVId[<?php echo $this->_vars['sitem']['spec_id']; ?>][]" value="<?php echo $this->_vars['sitem']['spec_value_id']; ?>"/></td> <?php }  }else{  foreach ((array)$this->_vars['pro']['props']['spec'] as $this->_vars['varid'] => $this->_vars['specVar']){ ?> <td><div class="select-spec-unselect goods-spec-selected" specid="<?php echo $this->_vars['varid']; ?>"> <?php $this->_vars['psid']=$this->_vars['pro']['props']['spec_private_value_id'][$this->_vars['varid']];  $this->_vars['sid']=$this->_vars['pro']['props']['spec_value_id'][$this->_vars['varid']];  if( $this->_vars['goods']['spec_desc'][$this->_vars['varid']][$this->_vars['psid']]['spec_type'] == 'text' ){ ?> <span><?php echo $this->_vars['specVar']; ?></span> <?php }else{  if( $this->_vars['goods']['spec_desc'][$this->_vars['varid']][$this->_vars['psid']]['spec_image'] ){ ?> <center> <img width="20" height="20" src="<?php echo tpl_modifier_storager($this->_vars['goods']['spec_desc'][$this->_vars['varid']][$this->_vars['psid']]['spec_image']); ?>" alt="<?php echo $this->_vars['specVar']; ?>" title="<?php echo $this->_vars['specVar']; ?>"/> </center> <?php }elseif( $this->_vars['goods']['specVdesc'][$this->_vars['varid']]['value'][$this->_vars['psid']]['spec_image'] ){ ?> <center> <img width="20" height="20" src="<?php echo tpl_modifier_storager($this->_vars['goods']['specVdesc'][$this->_vars['varid']]['value'][$this->_vars['psid']]['spec_image']); ?>" alt="<?php echo $this->_vars['specVar']; ?>" title="<?php echo $this->_vars['specVar']; ?>"/> </center> <?php }else{ ?> <center> <img width="20" height="20" src="<?php echo tpl_modifier_storager($this->_vars['spec_default_pic']); ?>" alt="<?php echo $this->_vars['specVar']; ?>" title="<?php echo $this->_vars['specVar']; ?>"/> </center> <?php }  } ?> </div> <div class='select-spec-value' style="display:none"> <ul class='goods-spec-box' style="width:200px;"> </ul> </div> <input type="hidden" name="val[<?php echo $this->_vars['varid']; ?>][]" value="<?php echo urlencode($this->_vars['specVar']); ?>" /> <input type="hidden" name="pSpecId[<?php echo $this->_vars['varid']; ?>][]" value="<?php echo $this->_vars['pro']['props']['spec_private_value_id'][$this->_vars['varid']]; ?>"/> <input type="hidden" name="specVId[<?php echo $this->_vars['varid']; ?>][]" value="<?php echo $this->_vars['pro']['props']['spec_value_id'][$this->_vars['varid']]; ?>"/></td> <?php }  }  foreach ((array)$this->_vars['spec']['idata'] as $this->_vars['ikey'] => $this->_vars['item']){ ?> <td><input type="text" name="idata[<?php echo $this->_vars['ikey']; ?>][]" value="<?php echo $this->_vars['spec']['idata'][$this->_vars['ikey']][$this->_vars['id']]; ?>" /></td> <?php } ?> <td><?php echo tpl_input_default(array('type' => "text",'value' => $this->_vars['pro']['store'],'name' => "store[]",'size' => 4,'vtype' => "number"), $this);?></td> <td><input type="text" size=8 name="price[]" value="<?php echo $this->_vars['pro']['price']; ?>"/><br> <span class='sysiconBtn edit' onclick="goodsEditor.mprice.bind(goodsEditor)(this)">会员价</span> <?php if( $this->_vars['fromType'] == 'create' ){  foreach ((array)$this->_vars['mLevels'] as $this->_vars['memlvid'] => $this->_vars['rows']){ ?> <input name="mprice[<?php echo $this->_vars['rows']['member_lv_id']; ?>][]" level="<?php echo $this->_vars['rows']['member_lv_id']; ?>" type="hidden" value="<?php echo $this->_vars['pro']['mprice'][$this->_vars['rows']['member_lv_id']]; ?>" /> <?php }  }else{  foreach ((array)$this->_vars['pro']['mprice'] as $this->_vars['memlvid'] => $this->_vars['rows']){ ?> <input name="mprice[<?php echo $this->_vars['memlvid']; ?>][]" level="<?php echo $this->_vars['memlvid']; ?>" type="hidden" value="<?php echo $this->_vars['pro']['mprice'][$this->_vars['memlvid']]; ?>" /> <?php }  } ?> </td> <td><input type="text" size=10 name="cost[]" value="<?php echo $this->_vars['pro']['cost']; ?>"/></td> <td><input type="text" size=10 name="mktprice[]" value="<?php echo $this->_vars['pro']['mktprice']; ?>"/></td> <td><input type="text" size=10 name="weight[]" value="<?php echo $this->_vars['pro']['weight']; ?>"/></td> <?php if( $this->system->getConf('storeplace.display.switch') ){ ?> <td><input type="text" size=15 name="store_place[]" value="<?php echo $this->_vars['pro']['store_place']; ?>" maxlength="80"/></td> <?php } ?> <td><input type='checkbox' class='pro-marketable-check' <?php if( $this->_vars['pro']['marketable'] != 'false' ){ ?>checked<?php } ?>/> <input type='hidden' name='marketable[]' value='<?php if( $this->_vars['pro']['marketable'] != 'false' ){ ?>true<?php }else{ ?>false<?php } ?>'/> </td> <td><input type="hidden" name="disabled[]" value=$pro.disabled > <!-- <img class="operater" alt="向上" src="../statics/icons/icon_asc.gif"/> <img class="operater" alt="向下" src="../statics/icons/icon_desc.gif"/> --> <img class="operater" alt="删除" src="../statics/icons/icon_delete.gif"/></td> </tr> <?php } ?> </tbody> </table> <div style="display:none"> <?php if( $this->_vars['goods']['spec_value_image'] ){  foreach ((array)$this->_vars['goods']['spec_value_image'] as $this->_vars['svid'] => $this->_vars['specImg']){ ?> <input type="hidden" id="spec_value_image_src_<?php echo $this->_vars['svid']; ?>" value="<?php echo $this->_vars['specImg']; ?>"/> <?php }  }else{  foreach ((array)$this->_vars['goods']['prototype']['spec'] as $this->_vars['sitem']){  foreach ((array)$this->_vars['sitem']['spec_value'] as $this->_vars['svid'] => $this->_vars['specImg']){ ?> <input type="hidden" id="spec_value_image_src_<?php echo $this->_vars['svid']; ?>" value="<?php echo tpl_modifier_storager($this->_vars['specImg']['spec_image']); ?>"/> <?php }  }  } ?> <input type="hidden" name="goods[spec_desc]" id="goods_spec_desc" value="<?php echo $this->_vars['goods']['spec_desc_str']; ?>"/> <script>
	     (function(){
		    	var specInfo =$('gEditor').retrieve('specInfo',{});
                $extend(specInfo,$H({
                        <?php $this->_env_vars['foreach'][specSd]=array('total'=>count($this->_vars['goods']['spec_desc']),'iteration'=>0);foreach ((array)$this->_vars['goods']['spec_desc'] as $this->_vars['sdId'] => $this->_vars['sdItem']){
                    $this->_env_vars['foreach'][specSd]['first'] = ($this->_env_vars['foreach'][specSd]['iteration']==0);
                    $this->_env_vars['foreach'][specSd]['iteration']++;
                    $this->_env_vars['foreach'][specSd]['last'] = ($this->_env_vars['foreach'][specSd]['iteration']==$this->_env_vars['foreach'][specSd]['total']);
?>
                            "<?php echo $this->_vars['sdId']; ?>":{
                            <?php $this->_env_vars['foreach'][specSdv]=array('total'=>count($this->_vars['sdItem']),'iteration'=>0);foreach ((array)$this->_vars['sdItem'] as $this->_vars['sdvId'] => $this->_vars['sdvItem']){
                    $this->_env_vars['foreach'][specSdv]['first'] = ($this->_env_vars['foreach'][specSdv]['iteration']==0);
                    $this->_env_vars['foreach'][specSdv]['iteration']++;
                    $this->_env_vars['foreach'][specSdv]['last'] = ($this->_env_vars['foreach'][specSdv]['iteration']==$this->_env_vars['foreach'][specSdv]['total']);
?>
                                "<?php echo $this->_vars['sdvId']; ?>":{
                                "spec_value_id" : "<?php echo $this->_vars['sdvItem']['spec_value_id']; ?>",
                                "spec_value" : "<?php echo htmlspecialchars($this->_vars['sdvItem']['spec_value']); ?>",
                                "spec_type" :"<?php echo $this->_vars['sdvItem']['spec_type']; ?>",
                                "spec_image" : "<?php echo $this->_vars['sdvItem']['spec_image']; ?>",
                                "spec_image_src" : "<?php echo tpl_modifier_storager($this->_vars['sdvItem']['spec_image']); ?>",
                                "spec_goods_images" : "<?php echo $this->_vars['sdvItem']['spec_goods_images']; ?>"
                                }<?php if( $this->_env_vars['foreach']['specSdv']['iteration'] != count($this->_vars['sdItem'])  ){ ?>,<?php }  } unset($this->_env_vars['foreach'][specSdv]); ?>
                            }<?php if( $this->_env_vars['foreach']['specSd']['iteration'] != count($this->_vars['goods']['spec_desc'])  ){ ?>,<?php }  } unset($this->_env_vars['foreach'][specSd]); ?>
                        }));
                        $("goods_spec_desc").set("value", "<?php echo $this->_vars['goods']['spec_desc_str']; ?>" );
		 })();
	   </script> </div> </div> <script>

   void function(){
		var goods_args = null;
		<?php if( $this->_vars['goods_args'] ){ ?>
			goods_args = $H(<?php echo $this->_vars['goods_args']; ?>);
		<?php } ?>


        $$('#productNode .pro-marketable-check').removeEvents('click').addEvent('change',function(){
            var marketable = this.getNext('input[name^=marketable[]');
            marketable.set('value',this.get('checked')?'true':'false');
        });


		var checkProSpec = function(ssid, thisChecked){
			var hasPspecid = [];
			$$('#productNode tr').each(function(tr,i){
				if( thisChecked.join('-') == tr.getElements('.select-spec-unselect[specid!='+ssid+']').getNext('input[name^=pSpecId]').get('value').join('-') && !hasPspecid.contains(tr.getElement('.select-spec-unselect[specid='+ssid+']').getNext('input[name^=pSpecId]').get('value')) ){
					hasPspecid.extend( [ tr.getElement('.select-spec-unselect[specid='+ssid+']').getNext('input[name^=pSpecId]').get('value') ] );
				}
			});
			return hasPspecid;
		};

		var selectSpecValue =function(){
			var _li_text = "<li specvid={spec_value_id} specpvid={p_spec_value_id}><span>{spec_value}</span></li>";
			var _li_img = "<li specvid={spec_value_id} specpvid={p_spec_value_id}><img src='{spec_image_src}' alt='{spec_value}' width='20' height='20'/></li>";
			$$('#productNode .select-spec-unselect').removeEvents('click').addEvent('click',function(){
            
			  
             
				var selValue = this;
                var selBox=this.getNext();
				var selDom = selBox.getElement('ul');
                if($type($('productNode').retrieve('ts'))=='element'&&$('productNode').retrieve('ts')!=selBox){
                   $('productNode').retrieve('ts').hide().retrieve('sv').removeClass('goods-spec-select');
                }
                if(this.hasClass('goods-spec-select')){
                   selBox.hide();
                   this.removeClass('goods-spec-select');
                   return;
                }
				var sI = $('gEditor').retrieve('specInfo',{});
				var selSpecHtml = '';
				var ssid = this.get('specid');
				var thisChecked = this.getParent('tr').getElements('.select-spec-unselect[specid!='+ssid+']').getNext('input[name^=pSpecId]').get('value');
				var thisPspecid = this.getNext('input[name^=pSpecId]').get('value');
				var filterPspecid = checkProSpec(ssid , thisChecked);
                
				selValue.addClass('goods-spec-select');
                
				$H(sI.get(ssid)).each(function(tsi,psid){
					tsi =$H(tsi);
					tsi['p_spec_value_id'] = psid;
					if (tsi.get('spec_type') == 'text'){
						selSpecHtml += _li_text.substitute(tsi);
					}else{
						if(tsi['spec_image'] == '')
							tsi['spec_image_src'] = $('spec_value_image_src_'+tsi['spec_value_id']).get('value')?$('spec_value_image_src_'+tsi['spec_value_id']).get('value'):'<?php echo tpl_modifier_storager($this->_vars['spec_default_pic']); ?>';
						selSpecHtml += _li_img.substitute(tsi);
					}
				});
                
				selDom.set('html', selSpecHtml);
                
				selDom.getElements('li').each(function(cli){
					if( filterPspecid.contains( cli.get('specpvid') ) && cli.get('specpvid') != thisPspecid ){
						cli.addClass('noclick');
						return;
                    }
					cli.addEvent('click',function(){
						selValue.set('html',this.get('html'));
						if(selValue.getElement('img')){
							selValue.getNext('input[name^=val[]').set('value',this.getElement('img').get('alt'));
                          }else{
							selValue.getNext('input[name^=val[]').set('value',this.get('text'));
                        }
						selValue.getNext('input[name^=pSpecId[]').set('value',this.get('specpvid'));
						selValue.getNext('input[name^=specVId[]').set('value',this.get('specvid'));
						selDom.empty();
                        selBox.hide();
						selValue.removeClass('goods-spec-select');
						selValue.addClass('goods-spec-selected');
					});
				});
                var selBoxStyls={
                     'position':'absolute',
                     'left':this.getPosition().x,
                     'zIndex':65535
                };
                if(window.webkit){
                   $extend(selBoxStyls,{'top':this.getPosition().y+25});
                }
				selBox.setStyles(selBoxStyls).show().store('sv',selValue);
                $('productNode').store('ts',selBox);
                selBox.getParent('#main').addEvent('scroll',function(){
                    this.removeEvent('scroll',arguments.callee);
                    if(selBox){
                         selBox.hide();
                    }
                  });
			});
            
           document.body.addEvent('click',function(e){		   		
		 		var target=$(e.target);
				if(!$('productNode')||!$('productNode').retrieve('ts'))return;
		   		if(!target.getParent('.goods-spec-select')&&!target.getParent('.select-spec-value')){
						var selBox=$('productNode').retrieve('ts').hide();					
						selBox.retrieve('sv').removeClass('goods-spec-select');					
				}  
		   });   
		};

		var proOp =function(){
			/*规格行上下移动删除操作*/
			$$('#gEditor .goods-spec-cell .operater').removeEvents('click');
		   $$('#gEditor .goods-spec-cell .operater').setStyle('cursor','pointer').addEvent('click',function(){
				   var tr=this.getParent('tr');
				  
				   switch (this.get('alt')) {
					   case '删除':
							  if(confirm('删除后货品数据将不能恢复，确认删除本行？'))tr.remove();
							  return;
				   }
		   
		   });
		};


	/*	$$('#gEditor .goods-spec-cell *').removeEvents('click');*/
       $E('#gEditor .goods-spec-cell .selectspec').addEvent('click',function(){
            new Dialog('index.php?ctl=goods/spec&act=addCol&type_id='+$('gEditor-GType-input').getValue(),
            {title:'选择规格项',
            ajaxoptions:{data:'goods_spec_desc='+$('goods_spec_desc').value+'&ctlType=edit', method:'post'}
            });
          
       });

	$E('#gEditor .goods-spec-cell .addproduct').removeEvents('click').addEvent('click',function(e){
		e=this;
		var lastTr = $('productNode').getLast('tr');
		var last_goods_args = '';
		if( lastTr ){
			last_goods_args = lastTr.toQueryString();
		}
		var _sdata = 'spec_desc='+$('goods_spec_desc').value+(last_goods_args?'&'+last_goods_args:'')+(goods_args?'&'+goods_args.toQueryString():'');
		new XHR({data:_sdata,
        onRequest:function(){
            $('loadMask').amongTo(e).show();
        },
        onSuccess:function(re){
          $('loadMask').hide();
		  var newtr=new Element('tr');
			$('productNode').adopt(newtr);
			newtr.set('html',re);
			selectSpecValue();
			proOp();
		}}).send('index.php?ctl=goods/spec&act=addRow');


	});
	   
       proOp();
       selectSpecValue();

	<?php if( $this->_vars['needUpValue'] ){ ?>
	var sinfo = $('gEditor').retrieve('specInfo',{});
		$H(<?php echo $this->_vars['needUpValue']; ?>).each(function(pvid){
			pvid = $H(pvid);
			var tdiv = null;
			if( $E('#productNode input[value='+pvid.get('specpvid')+']') ){
				tdiv = $ES('#productNode input[value='+pvid.get('specpvid')+']').getParent('td').getElement('.select-spec-unselect');
			}
			if( tdiv != [] ){
				var t_spec_image_src = sinfo[pvid.get('specid')][pvid.get('specpvid')]['spec_image_src'];
				var t_spec_value = sinfo[pvid.get('specid')][pvid.get('specpvid')]['spec_value'];
				tdiv.each(function(t){
					if( t.getElement('img') ){
						t.getElement('img').set('src',t_spec_image_src);
						t.getElement('img').set({'alt':t_spec_value,'title':t_spec_value});
					}else{
						t.getElement('span').set('html',t_spec_value);
					}
					t.getParent('td').getElement('input[name^=val[]').set('value',t_spec_value);
				});
			}
		});
	<?php } ?>

       /*取消规格操作*/
       $E('#gEditor .goods-spec-cell .closespec').removeEvents('click').addEvent('click',function(){
           if(!confirm('关闭后现有已添加的货品数据将全部丢失，确定要关闭规格吗？'))return;
           new Request.HTML({update:'goods-spec',data:'type_id='+$('gEditor-GType-input').getValue(),
                             onRequest:function(){
                               $('loadMask').amongTo($(this.options.update)).show();
                             },
                             onComplete:function(){
                               $('loadMask').hide();
                             }
           }).post('index.php?ctl=goods/product&act=nospec');
       
       });
    
   }();
</script> 