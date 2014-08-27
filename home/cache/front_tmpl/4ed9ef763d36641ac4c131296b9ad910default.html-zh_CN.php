<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } ?><div class="GoodsBrowsed" id="box_<?php echo $this->_vars['widgets_id']; ?>" > </div> <script>
withBroswerStore(function(broswerStore){
var box=$('box_<?php echo $this->_vars['widgets_id']; ?>');;
broswerStore.get('history',function(v){
v=JSON.decode(v);
if(!v||!v.length)return;
      var html='';
      var template = '<div class="clearfix">';
          template+='<div class="span-2 goodpic">';
          template+= '<a href="<?php echo tpl_function_link(array('ctl' => 'product','act' => 'index','arg0' => '{goodsId}'), $this);?>" target="_blank" title="{goodsName}" inner_img="{goodsImg}" gid="{goodsId}">';
          template+= '</a>';
          template+= '</div><div class="prepend-2 goodsName">';
          template+= '<div class="view-time">{viewTime}</div>';
          template+='<a href="<?php echo tpl_function_link(array('ctl' => 'product','act' => 'index','arg0' => '{goodsId}'), $this);?>" target="_blank" title="{goodsName}">{goodsName}</a></div></div><hr/>';
      
      var max=Math.min(v.length,<?php echo ((isset($this->_vars['setting']['max']) && ''!==$this->_vars['setting']['max'])?$this->_vars['setting']['max']:3); ?>);
      if(v.length>1)
      v.reverse();
      
      v.each(function(goods,index){
      var vt = ($time() - goods['viewTime']);
          vt = Math.round(vt/(60*1000))+'分钟前浏览过:';
      if(vt.toInt()>=60){
        vt = Math.round(vt.toInt()/60)+'小时前浏览过:';
        if(vt.toInt()>23){
           vt = Math.round(vt.toInt()/24)+'天前浏览过:';
           if(vt.toInt()>3){
             vt = new Date(goods['viewTime']).toLocaleString()+'浏览过:';
           }
        } 
       };
       if(!!!vt.toInt()){vt='刚才浏览了:'}
       goods['viewTime'] = vt;
       if(index<max)
       html += template.substitute(goods);
      });
      
      $('box_<?php echo $this->_vars['widgets_id']; ?>').set('html',html);
      
    $ES('.goodpic',box).each(function(i){
          var imga=$E('a',i);
          var imgsrc=imga.get('inner_img');
          if(!imgsrc){
            imgsrc = "<?php echo $this->_vars['data']['default_thumbnail_pic']; ?>";
          }
          imga.setText('loading...');
       new Asset.image(imgsrc,{onload:function(){
                var img=$(this);
                if(img.$e)return;
                img.zoomImg(70,70);
                img.inject(imga.empty());
                img.$e=true;
            },onerror:function(){
            
                imga.setText('update...');
                var gid = imga.get('gid');
                 new Request.JSON({method:'get',url:"<?php echo tpl_function_link(array('ctl' => 'product','act' => 'picsJson'), $this);?>",onComplete:function(data){
                     new Asset.image(data[0]['thumbnail_pic'],{onload:function(){
                        var img=$(this);
                        if(img.$e)return;
                        img.zoomImg(70,70);
                        img.inject(imga.empty());
                        img.$e=true;
                      },onerror:function(){
                         imga.remove();
                      }});
                      
                      v.map(function(goods,index){
                           if(index<max&&goods['goodsId']==gid){
                                return goods['goodsImg']='';
                           }else{
                                return goods['goodsImg']=data[0]['thumbnail_pic'];
                           }
                      });
                    broswerStore.set('history',v);
                 }}).get($H({'gids':gid}));
                
            
            }
        });          
      });

});


});
</script> <div class="textright"> <a class="lnk clearAll" onclick="if(broswerStore){broswerStore.remove('history');$('box_<?php echo $this->_vars['widgets_id']; ?>').empty()}">清除列表</a> | <a class="lnk viewAll" href="<?php echo tpl_function_link(array('ctl' => "tools",'act' => "history"), $this);?>">查看所有</a><span>&nbsp;&nbsp;</span> </div> 