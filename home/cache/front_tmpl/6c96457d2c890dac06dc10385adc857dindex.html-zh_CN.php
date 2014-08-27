<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_modifier_cdate')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.cdate.php'); } if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } $CURRENCY = &$this->system->loadModel('system/cur'); ?> <div class="MemberMain"> <div style="margin-right:175px;"> <div class="MemberMain-title"> <div class="title" style="float:left;" >您好，<?php if( $this->_vars['mem']['name']=='' ){  echo $this->_vars['mem']['uname'];  }else{  echo $this->_vars['mem']['name'];  if( $this->_vars['mem']['sex'] == 1 ){ ?>先生<?php }else{ ?>女士<?php }  } ?>，欢迎进入用户中心</div> <div style="float:right">您目前是[<?php echo $this->_vars['member']['levelname']; ?>]，您的积分为：<span class="point"><?php echo $this->_vars['member']['point']; ?></span>，经验值为：<span class="point"><?php echo $this->_vars['member']['experience']; ?></span></div> <div class="clear"> </div> </div> <div class="MemberMain-basicinfo"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td > <div class="info"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="left"></td> <td width="135" style="padding-left:5px;">您的帐户目前总积分：</td> <td><span class="point"><?php echo $this->_vars['wel']['pNum']; ?></span>分</td> <td width="90" ><li><a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member,'act' => pointHistory), $this);?>">查看积分历史</a></li></td> <td class="right"></td> </tr> </table> </div> </td> <td > <div class="info"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="left"></td> <td width="135" style="padding-left:5px;">您的订单交易总数量：</td> <td><span class="point"><?php echo $this->_vars['wel']['totalOrder']; ?></span>个</td> <td width="90"><li><a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member,'act' => orders), $this);?>">进入订单列表</a></li></td> <td class="right"></td> </tr> </table> </div> </td> </tr> <tr> <td> <div class="info sel"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="left"></td> <td width="135" style="padding-left:5px;">预存款余额：</td> <td><span class="point"><?php echo $CURRENCY->changer($this->_vars['wel']['aNum']); ?></span>元</td> <td width="90" style="padding:4px 5px 0 0;" align="right"><a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member,'act' => deposit), $this);?>"><img src="statics/btn_charge.gif" alt="充值" /></a></td> <td class="right"></td> </tr> </table> </div> </td> <td> <div class="info"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="left"></td> <td width="135" style="padding-left:5px;">已回复的评论与咨询：</td> <td><span class="point"><?php echo $this->_vars['wel']['commentRNum']; ?></span>个</td> <td width="90"><li><a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member,'act' => comment), $this);?>">立即查看</a></li></td> <td class="right"></td> </tr> </table> </div> </td> </tr> </table> </div> <br /><br /> <?php if( !$this->_vars['orders'] ){ ?> <div class="title">我的订单</div> <div class="noinfo">暂无订单</div> <?php }else{ ?> <div class="title">我的订单</div> <table class="memberlist" width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <th>商品名称</th> <th>订单号</th> <th>下单日期</th> <th>总金额</th> <th>订单状态</th> </tr> <?php $this->_env_vars['foreach'][orders]=array('total'=>count($this->_vars['orders']),'iteration'=>0);foreach ((array)$this->_vars['orders'] as $this->_vars['order']){ $this->_env_vars['foreach'][orders]['first'] = ($this->_env_vars['foreach'][orders]['iteration']==0); $this->_env_vars['foreach'][orders]['iteration']++; $this->_env_vars['foreach'][orders]['last'] = ($this->_env_vars['foreach'][orders]['iteration']==$this->_env_vars['foreach'][orders]['total']); ?> <tr> <td width="40%"><a class="intro" href="<?php echo tpl_function_link(array('ctl' => member,'act' => orderdetail,'arg0' => $this->_vars['order']['order_id']), $this);?>" ><?php echo $this->_vars['order']['tostr']; ?></a></td> <td><a href="<?php echo tpl_function_link(array('ctl' => member,'act' => orderdetail,'arg0' => $this->_vars['order']['order_id']), $this);?>"><?php echo $this->_vars['order']['order_id']; ?></a></td> <td><?php echo tpl_modifier_cdate($this->_vars['order']['createtime'],FDATE_STIME); ?></td> <td><?php echo $CURRENCY->changer($this->_vars['order']['final_amount'],$this->_vars['order']['currency'],false,true); ?></td> <td><span class="point"> <?php if( $this->_vars['order']['status'] == 'finish' ){ ?>已完成 <?php }elseif( $this->_vars['order']['status'] == 'dead' ){ ?>已作废 <?php }else{  if( $this->_vars['order']['pay_status']==1 ){ ?>已付款 [<?php if( $this->_vars['order']['ship_status']==1 ){ ?> 已发货 <?php }elseif( $this->_vars['order']['ship_status']==2 ){ ?> 部分发货 <?php }elseif( $this->_vars['order']['ship_status']==3 ){ ?> 部分退货 <?php }elseif( $this->_vars['order']['ship_status']==4 ){ ?> 已退货 <?php }else{ ?> 正在备货... <?php } ?>] <?php }elseif( $this->_vars['order']['pay_status']==2 ){ ?> 已付款至担保方 <?php }elseif( $this->_vars['order']['pay_status']==3 ){ ?> <a href="<?php echo tpl_function_link(array('ctl' => member,'act' => orderpay,'arg0' => $this->_vars['order']['order_id']), $this);?>" >等待补款</a> <?php if( $this->_vars['order']['ship_status']==1 ){ ?> [已发货] <?php }elseif( $this->_vars['order']['ship_status']==2 ){ ?> [部分发货] <?php }elseif( $this->_vars['order']['ship_status']==3 ){ ?> [部分退货] <?php }elseif( $this->_vars['order']['ship_status']==4 ){ ?> [已退货] <?php }  }elseif( $this->_vars['order']['pay_status']==4 ){ ?> 部分退款 [<?php if( $this->_vars['order']['ship_status']==1 ){ ?> 已发货 <?php }elseif( $this->_vars['order']['ship_status']==2 ){ ?> 部分发货 <?php }elseif( $this->_vars['order']['ship_status']==4 ){ ?> 已退货 <?php }elseif( $this->_vars['order']['ship_status']==0 ){ ?> 未发货 <?php } ?>] <?php }elseif( $this->_vars['order']['pay_status']==5 ){ ?> 已退款 [<?php if( $this->_vars['order']['ship_status']==1 ){ ?> 已发货 <?php }elseif( $this->_vars['order']['ship_status']==2 ){ ?> 部分发货 <?php }elseif( $this->_vars['order']['ship_status']==4 ){ ?> 已退货 <?php }elseif( $this->_vars['order']['ship_status']==0 ){ ?> 未发货 <?php } ?>] <?php }else{ ?> <a href="<?php echo tpl_function_link(array('ctl' => member,'act' => orderpay,'arg0' => $this->_vars['order']['order_id']), $this);?>" >等待付款</a> <?php if( $this->_vars['order']['ship_status']==1 ){ ?> [已发货] <?php }elseif( $this->_vars['order']['ship_status']==2 ){ ?> [部分发货] <?php }elseif( $this->_vars['order']['ship_status']==3 ){ ?> [部分退货] <?php }elseif( $this->_vars['order']['ship_status']==4 ){ ?> [已退货] <?php }  }  } ?> </span></td> </tr> <?php } unset($this->_env_vars['foreach'][orders]); ?> </table> <div class="more"><a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member,'act' => orders), $this);?>">更多订单>></a></div> <?php } ?> <br /> <br /> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td width="49%"> <div class="title" style="float:left;">我的收藏</div><div style="float:right; padding-top:5px;"><a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member,'act' => favorite), $this);?>">更多收藏>></a></div> <div style="clear:both;"></div> <div class="favorites"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="bg-lt"></td> <td class="bg-t"></td> <td class="bg-rt"></td> </tr> <tr> <td class="bg-lm"></td> <td class="bg-m"> <table class="favorites-list" width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <?php $this->_env_vars['foreach'][good]=array('total'=>count($this->_vars['favorite']),'iteration'=>0);foreach ((array)$this->_vars['favorite'] as $this->_vars['key'] => $this->_vars['good']){ $this->_env_vars['foreach'][good]['first'] = ($this->_env_vars['foreach'][good]['iteration']==0); $this->_env_vars['foreach'][good]['iteration']++; $this->_env_vars['foreach'][good]['last'] = ($this->_env_vars['foreach'][good]['iteration']==$this->_env_vars['foreach'][good]['total']);  if( $this->_env_vars['foreach']['good']['iteration']<=3 ){ ?> <td align="center"> <a style="display:block;<?php if( $this->system->getConf('site.thumbnail_pic_width') !=0 && $this->system->getConf('site.thumbnail_pic_height') !=0 ){ ?> width:<?php echo $this->system->getConf('site.thumbnail_pic_width'); ?>px;height:<?php echo $this->system->getConf('site.thumbnail_pic_height'); ?>px;<?php } ?>" href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['good']['goods_id']), $this);?>" title="<?php echo $this->_vars['good']['name']; ?>"><img src="<?php echo tpl_modifier_storager(((isset($this->_vars['good']['thumbnail']) && ''!==$this->_vars['good']['thumbnail'])?$this->_vars['good']['thumbnail']:$this->system->getConf('site.default_thumbnail_pic'))); ?>" alt="<?php echo $this->_vars['good']['name']; ?>"/></a> <br /> <a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['good']['goods_id']), $this);?>" title="<?php echo $this->_vars['good']['name']; ?>"><?php echo $this->_vars['good']['name']; ?></a> <br /> <span class="point"><?php echo $CURRENCY->changer($this->_vars['good']['price']); ?></span> &nbsp; </td> <?php }  } unset($this->_env_vars['foreach'][good]);  if( count($this->_vars['favorite']) < 3 ){ ?><td>&nbsp;</td><?php } ?> </tr> </table> </td> <td class="bg-rm"></td> </tr> <tr> <td class="bg-lb"></td> <td class="bg-b"></td> <td class="bg-rb"></td> </tr> </table> </div> </td> <td width="2%"></td> <td width="49%"><div class="title" >促销活动</div> <div class="activity"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="bg-lt"></td> <td class="bg-t"></td> <td class="bg-rt"></td> </tr> <tr> <td class="bg-lm"></td> <td class="bg-m"> <ul> <?php foreach ((array)$this->_vars['wel']['pa'] as $this->_vars['key']){ ?> <li><?php echo $this->_vars['key']['pmta_name']; ?>--<?php echo $this->_vars['key']['pmta_describe']; ?></li> <?php } ?> </ul> </td> <td class="bg-rm"></td> </tr> <tr> <td class="bg-lb"></td> <td class="bg-b"></td> <td class="bg-rb"></td> </tr> </table> </div> </td> </tr> </table> </div> </div> 