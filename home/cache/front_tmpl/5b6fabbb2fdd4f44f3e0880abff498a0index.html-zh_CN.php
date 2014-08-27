<?php if(!function_exists('tpl_modifier_cdate')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.cdate.php'); } if(!function_exists('tpl_modifier_escape')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.escape.php'); } if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_function_pager')){ require(CORE_DIR.'/include_v5/smartyplugins/function.pager.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } if(!function_exists('tpl_input_textarea')){ require(CORE_DIR.'/include_v5/smartyplugins/input.textarea.php'); } ?><table width='100%'> <tr> <td width='80%'><h3 style='margin:0;padding:0'>客户留言</h3></td> <td width='20%' class='textright'><a href='#dosubmit' class='lnk'>立即发布留言</a></td> </tr> </table> <hr/> <?php if( $this->_vars['msg'] ){ ?> <div id="shop-message"> <?php foreach ((array)$this->_vars['msg'] as $this->_vars['msglist']){ ?> <div class="division boxBlue clearfix mainReply" style="margin-bottom:0px;"> <div class=" floatLeft commentMain"> <div class="floatLeft commentAsk">留言</div> <span class="author fontcolorOrange"><?php echo $this->_vars['msglist']['msg_from']; ?></span>&nbsp;&nbsp;说： <span class="timpstamp font10px fontcolorGray replies"><?php echo tpl_modifier_cdate($this->_vars['msglist']['date_line'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo tpl_modifier_escape($this->_vars['msglist']['message'],'html'); ?></div> </div> </div> <div class="commentReply"> <?php foreach ((array)$this->_vars['msglist']['reply'] as $this->_vars['items']){ ?> <div class="division item " style=" margin:0px;" > <div class="floatLeft commentReply-admin">回复</div> <span class="author fontcolorOrange"><?php echo $this->_vars['items']['msg_from']; ?></span>&nbsp;&nbsp;回复： <span class="timpstamp font10px fontcolorGray replies"><?php echo tpl_modifier_cdate($this->_vars['items']['date_line'],'SDATE_STIME'); ?></span> <div style="clear:both;"></div> <div class="commentText"><?php echo tpl_modifier_escape($this->_vars['items']['message'],'html'); ?></div> </div> <?php } ?> </div> <?php } ?> </div> <?php } ?> <script>
    var checkFormReqs =function(e){
           e    = new Event(e);
       var form= $(e.target);
          
       var reqs = $$(form.getElements('input[type=text]'),form.getElements('textarea'));

       if(reqs.some(function(req){
               if(!req.get('required')&&!req.get('vtype').contains('required'))return;
            if(req.getValue().trim()==''){
                       req.focus();
                       MessageBox.error('请完善表单必填项.');
                       return true;
            }
              
              return false;
              
       
       })){
           
           e.stop();
       
       }       

    };


 <?php if( $this->_vars['msgshow'] == "on"  ){ ?>
   var changeimg = function(){
        $('imgVerifyCode').set('src','<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode"), $this);?>#'+$time());
    }
 <?php } ?>
</script> <?php echo tpl_function_pager(array('data' => $this->_vars['pager']), $this);?> <form class="addcomment division" method="post" action='<?php echo tpl_function_link(array('ctl' => "message",'act' => "sendMsgToOpt"), $this);?>' onsubmit='checkFormReqs(event);'> <h4><a name='dosubmit'>发布留言</a></h4> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="forform"> <tr> <th><em style='color:red'>*</em>标题：</th> <td><?php echo tpl_input_default(array('type' => "text",'required' => "true",'size' => 50,'name' => "subject"), $this);?></td> </tr> <tr> <th><em style='color:red'>*</em>留言内容：</th> <td><?php echo tpl_input_textarea(array('required' => "true",'rows' => "5",'name' => "message",'class' => 'inputstyle','style' => 'width:80%'), $this);?></td> </tr> <?php if( $this->_vars['nomember'] == 'on' ){ ?> <tr> <th>联系方式：</th> <td><?php echo tpl_input_default(array('type' => "text",'size' => 24,'name' => "email",'maxlength' => 255,'class' => 'inputstyle'), $this);?>(QQ、MSN、Email、电话等，此信息不会被公开)</td> </tr> <?php }  if( $this->_vars['msgshow'] == "on" ){ ?> <tr> <th><em style='color:red'>*</em>验证码：</th> <td><?php echo tpl_input_default(array('type' => "text",'required' => "true",'size' => "4",'maxlength' => "4",'name' => "verifyCode",'class' => 'inputstyle'), $this);?>&nbsp;<img src="<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode"), $this);?>" border="1" id="imgVerifyCode"/><a href="javascript:changeimg()">&nbsp;看不清楚?换个图片</a></td> </tr> <?php } ?> <tr> <th></th> <td><input type="submit" value="提交" class='btn' ></td> </tr> </table> </form> 