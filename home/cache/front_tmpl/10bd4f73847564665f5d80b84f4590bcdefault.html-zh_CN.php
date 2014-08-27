<div id="ord_<?php echo $this->_vars['widgets_id']; ?>" class="TransportList" style='overflow:hidden;height:40px'> <ul> <?php $this->_env_vars['foreach'][outer]=array('total'=>count($this->_vars['data']),'iteration'=>0);foreach ((array)$this->_vars['data'] as $this->_vars['key'] => $this->_vars['contact']){ $this->_env_vars['foreach'][outer]['first'] = ($this->_env_vars['foreach'][outer]['iteration']==0); $this->_env_vars['foreach'][outer]['iteration']++; $this->_env_vars['foreach'][outer]['last'] = ($this->_env_vars['foreach'][outer]['iteration']==$this->_env_vars['foreach'][outer]['total']); ?> <li> <?php if( $this->_vars['setting']['smallPic']==6 ){  if( $this->_vars['setting']['picaddress'] ){ ?> <img src="<?php echo $this->_vars['setting']['picaddress']; ?>" /> <?php }  }elseif( $this->_vars['setting']['smallPic'] ){ ?> <img src="<?php echo $this->_vars['setting']['smallPic'];?>" path="icons" /> <?php } ?> 订单<span class="TransportListId"><?php echo $this->_vars['data'][$this->_vars['key']]['order_id']; ?></span>所购物品 <!--经通过<span class="TransportListShipname"><?php echo $this->_vars['data'][$this->_vars['key']]['ship_name']; ?></span> -->已通过<span class="TransportListId"><?php echo $this->_vars['data'][$this->_vars['key']]['transport']; ?></span>发出， 请注意查收.发货单号:<span class="TransportListId"><?php echo $this->_vars['data'][$this->_vars['key']]['delivery_id']; ?></span> </li> <?php } unset($this->_env_vars['foreach'][outer]); ?> </ul> </div> <script>
(function(){
   if(window.roll_effect)return;
   window.roll_effect = new Class({
    options:{
       viewheight:130,
       speed:2000,
       childTag:'li'
    },
    initialize: function(src,options){
        options=options||{};
        if(options.speed)options.speed=options.speed.limit(this.options.speed,5000);
        if(options.viewheight)options.viewheight=options.viewheight.limit(40,700);
        options=$extend(this.options,options);
        var _this=this;
        this.el=$(src);
        if(!this.el)return;
        this.el.effect('height').start(options.viewheight).chain(function(){
           var sz=_this.el.getSize();
           if(sz.y>=sz.scrollSize.y)return;
           <?php if( $this->_vars['setting']['suspend']=='on' ){ ?>
           _this.el.addEvents({
               'mouseenter':function(){
                  _this.stop();
               },
               'mouseleave':function(){
                  _this.begin();
               }
            });
            <?php } ?>
            _this.scEffect=new Fx.Scroll(_this.el,{duration:options.speed});
            _this.begin();
        });
    },
    stop:function(){
      this.pause=true;
    },
    begin:function(){
      this.pause=false;
      this.ref=this.start()
    },
    start:function(){
       if(this.pause)return;
      var _this=this;
      var first=$E(this.options.childTag,this.el);
      if(!first)return;
      var h=$E(this.options.childTag,this.el).getSize().y;
      this.scEffect.start(0,h).chain(function(){
        first.injectBottom(first.getParent());
        this.set(0,0);
        fn.call(_this);
      });
      var fn= arguments.callee;
    }
  }); 

})();

</script> <script>
  window.addEvent('domready', function(){
   new roll_effect('ord_<?php echo $this->_vars['widgets_id']; ?>',{viewheight:<?php echo ((isset($this->_vars['setting']['height']) && ''!==$this->_vars['setting']['height'])?$this->_vars['setting']['height']:126); ?>,speed:<?php echo ((isset($this->_vars['setting']['roll_speed']) && ''!==$this->_vars['setting']['roll_speed'])?$this->_vars['setting']['roll_speed']:20); ?>00});
  });
</script>