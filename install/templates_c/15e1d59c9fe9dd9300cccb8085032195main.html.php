<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="robots" content="index,follow,noarchive" /> <meta name="googlebot" content="noarchive" /> <title>ShopEx 安装向导</title> <link rel="shortcut icon" href="../favicon.gif" type="image/gif" /> <link href="images/png.css" rel="stylesheet" type="text/css" /> <link href="images/install.css" rel="stylesheet" type="text/css" /> <style media="screen" type="text/css"> <!-- html{ margin:0; padding:0;} --> body{ font-family:Georgia; font-size:12px; background:#c3ccd3 url(images/install-bodybg.gif) repeat-x; text-align:center; margin:0; padding:0; overflow:hidden; overflow-y:auto; } .success{ color:#090; } #install_progress{ position: absolute; top: 0px; left: 0px; width:100%; } #install_progress{ z-index: 65535; padding:20px; text-align:left; color:#333; overflow:hidden; padding-top:70px; background:transparent url(images/install-logo.png) no-repeat 0 0; } #now_installing{ padding-left:30px; background:url(images/ajax-loader.gif) no-repeat left center; text-align:left; font-weight:bold; } </style> </head> <script type='text/javascript'>  
   var XHR=(function(){
       
       var _xhr=false;
       
       try{
          _xhr=new ActiveXObject('MSXML2.XMLHTTP');
          
       }catch(e){
           _xhr=new XMLHttpRequest();
           
       }
       
       return _xhr
       
   })();
   
   var _$,$;
    _$=$=function(id){
       return  document.getElementById(id);
   } ;
</script> <body> <div class="main" id='main'> <h1 class="png title"></h1> <div class="content"> <?php $_tpl_tpl_vars = $this->_vars; echo $this->_fetch_compile_include($this->_vars['PAGE'], array()); $this->_vars = $_tpl_tpl_vars; unset($_tpl_tpl_vars); ?> </div> <p id="footer" style="clear:both"><a href="http://www.shopex.cn/">ShopEx - The future of shopping. </a><br /><b>版本：<?php echo $this->_vars['version']['app']; ?>.<?php echo $this->_vars['version']['rev']; ?></b></p> </div> <div id="install_progress" style='display:none'> <div id="now_installing">正在安装数据库...</div> <div id="install_info"></div> </div> </body> </html> 