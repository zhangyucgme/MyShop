<?php if(!function_exists('tpl_modifier_paddingleft')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.paddingleft.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?><form action="index.php?ctl=content/sitemaps&act=save&p[0]=<?php echo $this->_vars['node']['node_id']; ?>" method="post" class="tableform"> <input type="hidden" name="node_type" value="<?php echo $this->_vars['node']['node_type']; ?>"> <input type="hidden" name="old_title" value="<?php echo $this->_vars['node']['title']; ?>"> <div class="division"> <table> <tr> <th>路径</th> <td> <select style="width:250px" name="p_node_id" <?php if( $this->_vars['node']['node_type'] == 'custompage' ){ ?>disabled=true<?php } ?>> <option value="0">根目录</option> <?php foreach ((array)$this->_vars['list'] as $this->_vars['item']){ ?> <option <?php if( $this->_vars['item']['node_id'] == $this->_vars['node']['p_node_id'] ){ ?>selected="selected"<?php } ?> value="<?php echo $this->_vars['item']['node_id']; ?>" ><?php echo tpl_modifier_paddingleft($this->_vars['item']['title'],$this->_vars['item']['depth']*4+4,'&nbsp;'); ?></option> <?php } ?> </select> </td> </tr> <tr> <th>名称</th> <td><?php echo tpl_input_default(array('type' => "text",'value' => $this->_vars['node']['title'],'name' => "title"), $this);?></td> </tr> <tr> <th>显示在菜单上</th> <td><input type="checkbox" name="display" value="1" <?php if( $this->_vars['node']['hidden'] != "true" ){ ?>checked="checked"<?php } ?>></td> </tr> <?php if( $this->_vars['node']['node_type'] == 'custompage' ){ ?> <tr> <th>是否新开窗口打开</th> <td><input type="checkbox" name="item_id" value="1" <?php if( $this->_vars['node']['item_id'] == 1 ){ ?>checked="checked"<?php } ?>></td> </tr> <?php } ?> </TABLE> </div> <div class="table-action"> <button type="submit" id="newNodeBtn" class="btn"><span><span>保存栏目信息</span></span></button> </div> </form>