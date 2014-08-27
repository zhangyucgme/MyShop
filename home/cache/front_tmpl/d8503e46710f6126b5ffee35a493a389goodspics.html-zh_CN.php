<?php if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); }  $this->_vars["_gimages"]="gimages";  $this->_vars["_small"]="small";  $this->_vars["_big"]="big";  $this->_vars["_thumbnail"]="thumbnail"; ?> <div class="goods-detail-pic" style='<?php if( $this->system->getConf('site.small_pic_width') !=0 && $this->system->getConf('site.small_pic_height') !=0 ){ ?> width:<?php echo $this->system->getConf('site.small_pic_width'); ?>px;height:<?php echo $this->system->getConf('site.small_pic_height'); ?>px;<?php } ?>' bigpicsrc="<?php echo tpl_modifier_storager(((isset($this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_big']]) && ''!==$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_big']])?$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_big']]:$this->system->getConf('site.default_big_pic'))); ?>"> <a href="<?php echo tpl_function_link(array('ctl' => product,'act' => viewpic,'arg0' => $this->_vars['goods']['goods_id'],'arg1' => def), $this);?>" target="_blank" style='color:#fff;font-size:263px;<?php if( $this->system->getConf('site.small_pic_width') !=0 && $this->system->getConf('site.small_pic_height') !=0 ){ ?> width:<?php echo $this->system->getConf('site.small_pic_width'); ?>px;height:<?php echo $this->system->getConf('site.small_pic_height'); ?>px;font-size:<?php echo (($this->system->getConf('site.small_pic_height'))*0.875);?>px;<?php } ?>;font-family:Arial;display:table-cell; vertical-align:middle;'> <img src="<?php echo tpl_modifier_storager(((isset($this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_small']]) && ''!==$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_small']])?$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_small']]:$this->system->getConf('site.default_small_pic'))); ?>" alt="<?php echo $this->_vars['goods']['name']; ?>" style='vertical-align:middle;'/> </a> <?php if( $this->system->getConf('site.reading_glass') ){ ?> <div class='goods-pic-magnifier' style='<?php if( $this->system->getConf('site.small_pic_width') !=0 && $this->system->getConf('site.small_pic_height') !=0 ){ ?> width:<?php echo (sprintf("%.0f",($this->system->getConf('site.small_pic_width'))*(($this->system->getConf('site.reading_glass_width'))/($this->system->getConf('site.big_pic_width')))));?>px;height:<?php echo (sprintf("%.0f",($this->system->getConf('site.small_pic_height'))*(($this->system->getConf('site.reading_glass_height'))/($this->system->getConf('site.big_pic_height')))));?>px;<?php } ?>'> &nbsp; </div> <?php } ?> </div> <table class='picscroll'> <tr> <td width='5%' class='scrollarrow toleft' title='向左'>&nbsp; </td> <td width='90%'> <div class="goods-detail-pic-thumbnail pics"> <?php if( $this->_vars['images']['gimages'] ){ ?> <center> <table> <tr> <?php if( $this->_vars['imgtype'] != 'spec' ){  $this->_vars[smallImg]=$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_small']];  $this->_vars[bigImg]=$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_big']];  $this->_vars[thumbnailImg]=$this->_vars['images'][$this->_vars['_gimages']][$this->_vars['goods']['image_default']][$this->_vars['_thumbnail']]; ?> <td class='current' img_id='<?php echo $this->_vars['goods']['image_default']; ?>'> <div class='uparrow'></div> <a href="<?php echo tpl_function_link(array('ctl' => product,'act' => viewpic,'arg0' => $this->_vars['goods']['goods_id'],'arg1' => $this->_vars['goods']['image_default']), $this);?>" target="_blank" imgInfo="{small:'<?php echo tpl_modifier_storager(((isset($this->_vars['smallImg']) && ''!==$this->_vars['smallImg'])?$this->_vars['smallImg']:$this->system->getConf('site.default_small_pic'))); ?>',big:'<?php echo tpl_modifier_storager(((isset($this->_vars['bigImg']) && ''!==$this->_vars['bigImg'])?$this->_vars['bigImg']:$this->system->getConf('site.default_big_pic'))); ?>'}"> <img src="<?php echo tpl_modifier_storager(((isset($this->_vars['thumbnailImg']) && ''!==$this->_vars['thumbnailImg'])?$this->_vars['thumbnailImg']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" alt='<?php echo $this->_vars['goods']['name']; ?>' width='55' height='55'/> </a> </td> <?php }  $this->_env_vars['foreach'][gimgs]=array('total'=>count($this->_vars['images']['gimages']),'iteration'=>0);foreach ((array)$this->_vars['images']['gimages'] as $this->_vars['thumb']){ $this->_env_vars['foreach'][gimgs]['first'] = ($this->_env_vars['foreach'][gimgs]['iteration']==0); $this->_env_vars['foreach'][gimgs]['iteration']++; $this->_env_vars['foreach'][gimgs]['last'] = ($this->_env_vars['foreach'][gimgs]['iteration']==$this->_env_vars['foreach'][gimgs]['total']);  if( $this->_vars['thumb']['gimage_id'] == $this->_vars['goods']['image_default'] && $this->_vars['imgtype'] != 'spec' ){  continue;  } ?> <td img_id='<?php echo $this->_vars['thumb']['gimage_id']; ?>'> <div class='uparrow'></div> <a href="<?php echo tpl_function_link(array('ctl' => product,'act' => viewpic,'arg0' => $this->_vars['goods']['goods_id'],'arg1' => $this->_vars['thumb']['gimage_id']), $this);?>" target="_blank" imgInfo="{small:'<?php echo tpl_modifier_storager(((isset($this->_vars['thumb']['small']) && ''!==$this->_vars['thumb']['small'])?$this->_vars['thumb']['small']:$this->system->getConf('site.default_small_pic'))); ?>',big:'<?php echo tpl_modifier_storager(((isset($this->_vars['thumb']['big']) && ''!==$this->_vars['thumb']['big'])?$this->_vars['thumb']['big']:$this->system->getConf('site.default_big_pic'))); ?>'}" > <img src="<?php echo tpl_modifier_storager(((isset($this->_vars['thumb']['thumbnail']) && ''!==$this->_vars['thumb']['thumbnail'])?$this->_vars['thumb']['thumbnail']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" alt='<?php echo $this->_vars['goods']['name']; ?>' width='55' height='55'/> </a> </td> <?php } unset($this->_env_vars['foreach'][gimgs]); ?> </tr> </table> </center> <?php } ?> </div> </td> <td width='5%' class='scrollarrow toright' title='向右'>&nbsp; </td> </tr> </table> <a href="<?php echo tpl_function_link(array('ctl' => product,'act' => viewpic,'arg0' => $this->_vars['goods']['goods_id'],'arg1' => $this->_vars['goods']['image_default']), $this);?>" target="_blank" onclick='_open(this.href);return false;'> <img src="statics/transparent.gif" alt="查看大图" style="width:101px;height:26px;background-image:url(statics/icons.gif);background-repeat:no-repeat;background-position:0 -121px;" /> </a> <script>
      window.addEvent('domready',function(){

         var picThumbnailItems=$$('#goods-viewer .goods-detail-pic-thumbnail td a');              
         if(!picThumbnailItems.length)return;
         var goodsPicPanel = $E('#goods-viewer .goods-detail-pic');
         var goodsDetailPic = $E('#goods-viewer .goods-detail-pic img');
         
         
         var picscroll=$E('#goods-viewer .picscroll');
         var scrollARROW=picscroll.getElements('.scrollarrow');
         var picsContainer=$E('.pics',picscroll).scrollTo(0,0);
             picsContainer.store('selected',picThumbnailItems[0]);
        
        
         if(picsContainer.getSize().x<picsContainer.getScrollSize().x){
               scrollARROW.setStyle('visibility','visible').addEvent('click',function(){
                     var scrollArrow=this;
                     var to=eval("picsContainer.scrollLeft"+(scrollArrow.hasClass('toleft')?"-":"+")+"picsContainer.offsetWidth");
                     picsContainer.retrieve('fxscroll',new Fx.Scroll(picsContainer,{'link':'cancel'})).start(to);
               });
         };
     
        picThumbnailItems.each(function(item){
             /*预加载 中图*/             
             var _img = new Image();
             _img.src = JSON.decode(item.get('imginfo'))['small'];
             
        });
        
        picThumbnailItems.addEvents({
               
               'click':function(e){
                     e.stop();
                     this.fireEvent('selected');
               },
               'mouseenter':function(){
                    if(this.getParent('td').hasClass('current'))return;
                    var imgInfo = JSON.decode(this.get('imgInfo'));
                    goodsDetailPic.src = imgInfo['small'];
 
               },
               'mouseleave':function(){
                   if(this.getParent('td').hasClass('current'))return;
                   picsContainer.retrieve('selected').fireEvent('selected','noclick');
               
               },
               'selected':function(noclick){

                    var _td = this.getParent('td');
                    if(_td.hasClass('current')&&!noclick)return;
                    picsContainer.retrieve('selected').fireEvent('unselect');
                     _td.addClass('current');
                    var imgInfo = JSON.decode(this.get('imgInfo'));
                    goodsDetailPic.src = imgInfo['small'];
                    goodsPicPanel.set('bigpicsrc',imgInfo['big']);
                    picsContainer.store('selected',this);
               
               },
               'unselect':function(){
                     
                     this.getParent('td').removeClass('current');
               
               },'focus':function(){
                  this.blur();
               }
        });      
              
        picThumbnailItems[0].fireEvent('selected');
               
     <?php if( $this->system->getConf('site.reading_glass') ){ ?>
     /*放大镜*/
         var magnifierOptions=magnifierOptions||{
                 width:<?php echo $this->system->getConf('site.reading_glass_width'); ?>,
                 height:<?php echo $this->system->getConf('site.reading_glass_height'); ?>
              };
          
         var goodsPicMagnifier = $E('#goods-viewer .goods-pic-magnifier');
         var goodsPicMagnifierSize = goodsPicMagnifier.getSize();
         var goodsPicPanelSize = goodsPicPanel.getSize();
         
         picThumbnailItems.addEvent('selected',function(noclick){
              
              if(noclick)return;
              
              var _img = new Image();
              _img.src = JSON.decode(this.get('imginfo'))['big'];
         
         });
         
          goodsPicPanel.addEvents({
                  'mouseenter':function(){
                    var gpmViewer = this.store('gpmViewer',new Element('div',{'class':'goods-pic-magnifier-viewer',
                                                                                  styles:$extend(magnifierOptions,{
                                                                                     
                                                                                     'background-Image':'url('+goodsPicPanel.get('bigpicsrc')+')',
                                                                                     'top':$E('#goods-viewer .goodsname').getPosition().y+30,
                                                                                     'left':$E('#goods-viewer .goodsname').getPosition().x,
                                                                                     'visibility':'visible',
                                                                                     'background-position':'0 0',
                                                                                     'background-repeat':'no-repeat'
                                                                                  
                                                                                  })}).inject(document.body));
                                                                                  
                       goodsPicMagnifier.setOpacity(.3);
                  },
                  'mouseleave':function(){
                   if($type(this.retrieve('gpmViewer'))=='element'){
                       this.retrieve('gpmViewer').remove();
                     }
                     this.store('gpmViewer',false);
                     goodsPicMagnifier.setStyle('visibility','hidden');
                  
                  },
                  'mousemove':function(e){
                      
                      var mouseXY=e.page;
                      
                      var relativeXY={
                          top:(mouseXY.y-goodsPicPanel.getPosition().y),
                          left:(mouseXY.x-goodsPicPanel.getPosition().x)
                      };
                      
                      var gpmXY  = {top:0,left:0};
                      var xymap1 = {top:'y',left:'x'};
                      var xymap2 = {top:1,left:0};
                      
                      var gpmvXY =['0%','0%'];
                      
                      for(v in relativeXY){
                         gpmXY[v] = (relativeXY[v]-goodsPicMagnifierSize[xymap1[v]]/2).limit(0,goodsPicPanelSize[xymap1[v]]-goodsPicMagnifierSize[xymap1[v]]);
                         gpmvXY[xymap2[v]] = ((relativeXY[v]/goodsPicPanelSize[xymap1[v]])*100)+'%';
                         
                      }
                      goodsPicMagnifier.setStyles(gpmXY);
                     if($type(this.retrieve('gpmViewer'))=='element'){
                         this.retrieve('gpmViewer').setStyle('background-position',gpmvXY.join(' '));
                     }
                  
                  }
          
          });
              
         <?php } ?>
        
        
        });

        </script>