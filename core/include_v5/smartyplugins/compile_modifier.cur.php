<?php
function tpl_compile_modifier_cur($attrs,&$compile) {
    //todo ��Ҫ�����һ���Ҳ����
    if(!strpos($attrs,',') || false!==strpos($attrs,',')){
        $compile->_head_stack['$CURRENCY = &$this->system->loadModel(\'system/cur\')']=1;
        return $attrs = '$CURRENCY->changer('.$attrs.')';
    }
}
?>