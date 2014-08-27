<?php if(!function_exists('tpl_function_json')){ require(CORE_DIR.'/admin/smartyplugin/function.json.php'); } if(!function_exists('tpl_block_area')){ require(CORE_DIR.'/admin/smartyplugin/block.area.php'); } if(!function_exists('tpl_function_toinput')){ require(CORE_DIR.'/admin/smartyplugin/function.toinput.php'); }  $this->with_nav=false;$this->_vars['_finder'] = array ( '_name' => '754807', 'var' => 'window.finderGroup[\'754807\']', 'allowImport' => false, 'allowExport' => false, 'deleteAble' => true, 'noRecycle' => true, 'hasTag' => NULL, 'finder_action_tpl' => 'sale/activity/finder_action.html', 'controller' => 'sale/activity', 'model' => 'trading/promotionActivity', 'listViews' => array ( 'finder/list.html' => array ( 'name' => '列表', 'icon' => 'images/bundle/view_text.gif', ), ), 'searchOptions' => array ( ), 'filterUnable' => true, 'currentSearchKey' => NULL, 'viewsfilters' => array ( ), 'views' => array ( ), );$this->_vars['_finder']['params'] = $this->filter;$this->_vars['_finder']['filterInit'] = $this->filterInit;$this->_vars['_finder']['viewParams'] = $this->_vars['_finder']['viewsfilters'][$this->_vars['_finder']['views'][$_GET['view']+0]];?> <script>

 finderDestory();
var finderOption=<?php echo tpl_function_json(array('from' => $this->_vars['_finder']), $this);?>;

<?php echo $this->_vars['_finder']['var']; ?> = new Finder("<?php echo $this->_vars['_finder']['_name']; ?>",finderOption);

<?php if( $this->_vars['_finder']['hasTag'] ){ ?>
	(function(){
		var options={'finderTag':$('finder-tag'),'url':"index.php?ctl="+finderOption['controller']};
		var tags=new Tags_opt(options);
	})();
<?php } ?>

</script> <?php if( count($this->_vars['_finder']['views'])>0 && $_GET['act']!="recycleIndex" ){  $this->_tag_stack[] = array('tpl_block_area', array('inject' => ".mainHead")); tpl_block_area(array('inject' => ".mainHead"), null, $this); ob_start(); ?> <div class="finder-tab"> <?php $this->_env_vars['foreach'][finderTtab]=array('total'=>count($this->_vars['_finder']['views']),'iteration'=>0);foreach ((array)$this->_vars['_finder']['views'] as $this->_vars['key'] => $this->_vars['name']){ $this->_env_vars['foreach'][finderTtab]['first'] = ($this->_env_vars['foreach'][finderTtab]['iteration']==0); $this->_env_vars['foreach'][finderTtab]['iteration']++; $this->_env_vars['foreach'][finderTtab]['last'] = ($this->_env_vars['foreach'][finderTtab]['iteration']==$this->_env_vars['foreach'][finderTtab]['total']);  if( $this->_vars['key'] == $_GET['view'] ){ ?> <div class="tab cur <?php if( $this->_env_vars['foreach']['finderTtab']['first'] ){ ?>nobl<?php }elseif( $this->_env_vars['foreach']['finderTtab']['iteration'] == 4 ){ ?>nobr<?php } ?>"><span><?php echo $this->_vars['name']; ?></span></div> <?php }else{ ?> <div class="tab <?php if( $this->_env_vars['foreach']['finderTtab']['first'] ){ ?>nobl<?php }elseif( $this->_env_vars['foreach']['finderTtab']['last'] ){ ?>nobr<?php } ?>"><span><a href="index.php?ctl=<?php echo $this->_vars['_finder']['controller']; ?>&view=<?php echo $this->_vars['key']; ?>"><?php echo $this->_vars['name']; ?></a></span></div> <?php }  } unset($this->_env_vars['foreach'][finderTtab]); ?> </div> <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_content = tpl_block_area($this->_tag_stack[count($this->_tag_stack) - 1][1], $_block_content, $this); echo $_block_content; array_pop($this->_tag_stack); $_block_content='';  }  $this->_tag_stack[] = array('tpl_block_area', array('inject' => ".mainHead")); tpl_block_area(array('inject' => ".mainHead"), null, $this); ob_start(); ?> <div class="finder-action" id="finder-action-<?php echo $this->_vars['_finder']['_name']; ?>"> <div class="finder-action-inner clearfix"> <?php if( $_GET['act']=="recycleIndex" ){ ?> <a type="link" wrapimg="true" href="<?php echo "index.php?ctl={$_GET['ctl']}&act=index";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:24px;height:24px;background-position:0 -340px;" /></i>返回列表</span></span></a> <button type="button" wrapimg="true" confirm="确定从回收站中还原选中项" submit="<?php echo "index.php?ctl={$this->_vars['_finder']['controller']}&act=active";?>" target="<?php echo "refresh::{onSuccess:{$this->_vars['_finder']['var']}.unselectAll.bind({$this->_vars['_finder']['var']})}";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:22px;height:24px;background-position:0 -781px;" /></i>还原</span></span></button> <button type="button" wrapimg="true" confirm="确定彻底删除选中项?删除后将不可恢复" submit="<?php echo "index.php?ctl={$this->_vars['_finder']['controller']}&act=delete";?>" target="<?php echo "refresh::{onSuccess:{$this->_vars['_finder']['var']}.unselectAll.bind({$this->_vars['_finder']['var']})}";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:17px;height:24px;background-position:0 -757px;" /></i>彻底删除</span></span></button> <?php if( !$this->_vars['_finder']['filterUnable'] ){ ?> <button wrapimg="true" onclick="<?php echo "window.finderDialog = new Dialog('index.php?ctl=editor&act=filter&object={$this->_vars['_finder']['model']}&id={$this->_vars['_finder']['_name']}',{title:'筛选'})";?>" type="button" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:26px;height:24px;background-position:0 -460px;" /></i>筛选</span></span></button> <?php }  }else{  if( $this->_vars['_finder']['searchOptions'] ){ ?> <form class="finder-search" id="finder-search-<?php echo $this->_vars['_finder']['_name']; ?>" current_key="<?php echo key($this->_vars['_finder']['searchOptions']); ?>"> <div class="finder-search-inner"> <input class="imgbundle finder-search-btn" src="images/transparent.gif" type="image" tag="input" style="width:19px;height:17px;background-position:0 -668px;" /> <span class="finder-search-select" dropmenu="finder-keywords-<?php echo $this->_vars['_finder']['_name']; ?>"><label><?php echo current($this->_vars['_finder']['searchOptions']); ?></label><img src="images/transparent.gif" class="imgbundle" style="width:7px;height:5px;background-position:0 -48px;" /></span><input class="finder-search-input" type="text" search="true" autocomplete="off" size="20" maxlength="40" /> </div> </form> <div id="finder-keywords-<?php echo $this->_vars['_finder']['_name']; ?>" class="x-drop-menu" style="width:auto;"> <ul class="group"> <?php foreach ((array)$this->_vars['_finder']['searchOptions'] as $this->_vars['key'] => $this->_vars['item']){ ?> <li class="item" value="<?php echo $this->_vars['key']; ?>" onclick="$('finder-search-<?php echo $this->_vars['_finder']['_name']; ?>').set('current_key','<?php echo $this->_vars['key']; ?>').getElement('label').innerHTML='<?php echo $this->_vars['item']; ?>'"><?php echo $this->_vars['item']; ?></li> <?php } ?> </ul> </div> <?php }  if( $this->_vars['_finder']['hasTag'] ){ ?> <div id="finder-tag" class="x-drop-menu tag-editor"> <ul class="tag-editor-group"></ul> <div class="tag-editor-btns"> <span class="sysiconBtnNoIcon btn-create-tag"><span>新建</span></span> <span class="sysiconBtnNoIcon btn-apply"><span>应用</span></span> <span class=" btn-tag-manage"><a href="index.php?ctl=<?php echo $_GET['ctl']; ?>&act=tagmgr">编辑器...</a></span> </div> <div class="dialogTag" style="display:none"> <p>请输入一个新的标签名称：</p> <input type="text" maxlength="20" class="tag-editor-value"/> <div style="margin:20px 10px 0;float:right"><span class="sysiconBtnNoIcon btnSmt">确定</span> <span class="sysiconBtnNoIcon btnCancel">取消</span></div> </div> <ul class="theme_tag" style="display:none"> <li class="selected_none"><img src="images/transparent.gif" class="imgbundle" style="width:9px;height:9px;background-position:0 -2276px;" /></li> <li class="selected_part"><img src="images/transparent.gif" class="imgbundle" style="width:9px;height:9px;background-position:0 -2285px;" /></li> <li class="selected_all"><img src="images/transparent.gif" class="imgbundle" style="width:9px;height:9px;background-position:0 -2267px;" /></li> </ul> </div> <?php }  if( $this->_vars['_finder']['finder_action_tpl'] ){  $_tpl_tpl_vars = $this->_vars; echo $this->_fetch_compile_include($this->_vars['_finder']['finder_action_tpl'], array()); $this->_vars = $_tpl_tpl_vars; unset($_tpl_tpl_vars);  } ?> <button type="button" wrapimg="true" onclick="<?php echo "{$this->_vars['_finder']['var']}.refresh()";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:22px;height:24px;background-position:0 -644px;" /></i>刷新</span></span></button> <?php if( $this->_vars['_finder']['deleteAble'] ){  if( !$this->_vars['_finder']['noRecycle'] ){ ?> <button type="button" wrapimg="true" target="<?php echo "refresh::{onSuccess:{$this->_vars['_finder']['var']}.unselectAll.bind({$this->_vars['_finder']['var']})}";?>" confirm="确定删除选中项？删除后可进入回收站恢复" only_id="true" submit="<?php echo "index.php?ctl={$this->_vars['_finder']['controller']}&act=recycle";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:17px;height:24px;background-position:0 -757px;" /></i>删除</span></span></button> <a type="link" wrapimg="true" href="<?php echo "index.php?ctl={$_GET['ctl']}&act=recycleIndex";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:17px;height:24px;background-position:0 -805px;" /></i>回收站</span></span></a> <?php }else{ ?> <button type="button" wrapimg="true" target="<?php echo "refresh::{onSuccess:{$this->_vars['_finder']['var']}.unselectAll.bind({$this->_vars['_finder']['var']})}";?>" confirm="确定删除选中项？删除后无法恢复" only_id="true" submit="<?php echo "index.php?ctl={$this->_vars['_finder']['controller']}&act=delete";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:17px;height:24px;background-position:0 -757px;" /></i>删除</span></span></button> <?php }  }  if( $this->_vars['_finder']['hasTag'] ){ ?> <button type="button" wrapimg="true" dropmenu_opts="<?php echo "relative:{$this->_vars['_finder']['var']}.action";?>" dropmenu="finder-tag" id=x_btn_finder-tag class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:18px;height:24px;background-position:0 -709px;" /></i>标签<img src="images/transparent.gif" class="drop-handle" /></span></span></button><script>new DropMenu("x_btn_finder-tag",{<?php echo "relative:{$this->_vars['_finder']['var']}.action";?>});</script> <?php }  if( $this->_vars['_finder']['allowExport'] ){ ?> <button type="button" wrapimg="true" only_id="true" submit="<?php echo "index.php?ctl={$_GET['ctl']}&act=export";?>" target="dialog::{height:200,width:280}" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:25px;height:24px;background-position:0 -484px;" /></i>导出</span></span></button> <?php }  if( $this->_vars['_finder']['allowImport'] ){ ?> <button type="button" wrapimg="true" onclick="<?php echo "W.page('index.php?ctl={$_GET['ctl']}&act=import')";?>" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:25px;height:24px;background-position:0 -484px;" /></i>导入</span></span></button> <?php }  if( !$this->_vars['_finder']['filterUnable'] ){ ?> <button wrapimg="true" onclick="<?php echo "window.finderDialog = new Dialog('index.php?ctl=editor&act=filter&object={$this->_vars['_finder']['model']}&id={$this->_vars['_finder']['_name']}',{title:'筛选'})";?>" type="button" class="btn"><span><span><i class="finder-icon"><img src="images/transparent.gif" class="imgbundle icon" style="width:26px;height:24px;background-position:0 -460px;" /></i>筛选</span></span></button> <?php }  if( count($this->_vars['_finder']['listViews'])>1 ){  foreach ((array)$this->_vars['_finder']['listViews'] as $this->_vars['key'] => $this->_vars['tpl']){ ?> <button class="btn" type="button" onclick="<?php echo $this->_vars['_finder']['var']; ?>.request({method:'post',data:{lister:'<?php echo $this->_vars['key']; ?>'}})"><span><span><i class="finder-icon"><img src="<?php echo $this->_vars['tpl']['icon'];?>" class="imgbundle" style="background-image: none;" /></i><?php echo $this->_vars['tpl']['name']; ?></span></span></button> <?php }  }  } ?> </div> </div> <form id="finder-form-<?php echo $this->_vars['_finder']['_name']; ?>" action='index.php?ctl=<?php echo $_GET['ctl']; ?>&act=<?php echo $_GET['act']; ?>&view=<?php echo $_GET['view']; ?>' method='post'> <div class="finder-filter clearfix" style='display:none;'> <strong>当前过滤条件(<span class="lnk" onclick="<?php echo $this->_vars['_finder']['var']; ?>.filter.reset().change()">清除</span>)</strong> <ul class='finder-filter-info'> <li class="ffitpl"><span>root</span><img src="images/transparent.gif" class="imgbundle remove" style="width:16px;height:16px;background-position:0 -428px;" /></li> </ul> </div> <input name="_finder[select]" value="<?php echo $this->_vars['_finder']['select']; ?>" type="hidden" /> <input name="_finder[_name]" value="<?php echo $this->_vars['_finder']['_name']; ?>" type="hidden" /> <input name="_finder[in_pager]" value="1" type="hidden" /> <?php echo tpl_function_toinput(array('from' => $this->_vars['_finder']['viewParams']), $this); echo tpl_function_toinput(array('from' => $this->_vars['_finder']['params']), $this);?> </form> <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_content = tpl_block_area($this->_tag_stack[count($this->_tag_stack) - 1][1], $_block_content, $this); echo $_block_content; array_pop($this->_tag_stack); $_block_content='';  $_tpl_tpl_vars = $this->_vars; echo $this->_fetch_compile_include("finder/lister.html#{$_GET['ctl']}", array()); $this->_vars = $_tpl_tpl_vars; unset($_tpl_tpl_vars);  $this->_tag_stack[] = array('tpl_block_area', array('inject' => ".mainFoot")); tpl_block_area(array('inject' => ".mainFoot"), null, $this); ob_start(); ?> <div id="finder-detail-<?php echo $this->_vars['_finder']['_name']; ?>" class="finder-detail" finder="<?php echo $this->_vars['_finder']['var']; ?>"> <div class='finder-detail-content' container='true'> </div> </div> <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_content = tpl_block_area($this->_tag_stack[count($this->_tag_stack) - 1][1], $_block_content, $this); echo $_block_content; array_pop($this->_tag_stack); $_block_content=''; ?> 