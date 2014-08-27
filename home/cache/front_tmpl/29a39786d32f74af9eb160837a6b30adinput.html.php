<?php if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?><div id="ipt_<?php echo $this->_vars['_input']['domid']; ?>" params="<?php echo htmlentities(json_encode($this->_vars['_input'])); ?>" class='clearfix'> <?php $params = array();$this->input_func_map = array ( 'time' => '/include_v5/smartyplugins/input.time.php', 'intbool' => '/include_v5/smartyplugins/input.intbool.php', 'textarea' => '/include_v5/smartyplugins/input.textarea.php', 'combox' => '/include_v5/smartyplugins/input.combox.php', 'gender' => '/include_v5/smartyplugins/input.gender.php', 'radio' => '/include_v5/smartyplugins/input.radio.php', 'tinybool' => '/include_v5/smartyplugins/input.tinybool.php', 'html' => '/include_v5/smartyplugins/input.html.php', 'color' => '/include_v5/smartyplugins/input.color.php', 'region' => '/include_v5/smartyplugins/input.region.php', 'date' => '/include_v5/smartyplugins/input.date.php', 'fontset' => '/include_v5/smartyplugins/input.fontset.php', 'money' => '/include_v5/smartyplugins/input.money.php', 'default' => '/include_v5/smartyplugins/input.default.php', 'checkbox' => '/include_v5/smartyplugins/input.checkbox.php', 'select' => '/include_v5/smartyplugins/input.select.php', 'bool' => '/include_v5/smartyplugins/input.bool.php', 'object' => '/admin/smartyplugin/input.object.php', );$params['type'] = "object:{$this->_vars['_input']['object']}";$params['id'] = "sel_{$this->_vars['_input']['domid']}";$params['filter'] = $this->_vars['_input']['filter'];$params['select'] = checkbox;if(substr($params['type'],0,7)=='object:'){ list(,$params['object'],$params['key']) = explode(':',$params['type']); $obj = str_replace('/','_',$params['object']); $func = 'tpl_input_object_'.$obj; if(!function_exists($func)){ if(isset($this->input_func_map['object_'.$obj])){ require(CORE_DIR.$this->input_func_map['object_'.$obj]); $this->_plugins['input']['object_'.$obj] = $func; }else{ $func = 'tpl_input_object'; $params['type'] = 'object'; } } }else{ $func = 'tpl_input_'.$params['type']; } if(function_exists($func)){ echo $func($params,$this); }elseif(isset($this->input_func_map[$params['type']])){ require(CORE_DIR.$this->input_func_map[$params['type']]); $this->_plugins['input'][$params['type']] = $func; echo $func($params,$this); }else{ echo tpl_input_default($params,$this); } unset($func,$params);?> <div class="gridlist rows-body"> <?php $_tpl_tpl_vars = $this->_vars; echo $this->_fetch_compile_include("finder/input-row.html", array()); $this->_vars = $_tpl_tpl_vars; unset($_tpl_tpl_vars); ?> </div> </div>