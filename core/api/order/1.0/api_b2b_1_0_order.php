<?php
include_once(CORE_DIR.'/api/shop_api_object.php');
class api_b2b_1_0_order extends shop_api_object {

    var $error = array('not_active'=>'订单状态未激活',
                   'not_pay'=>'订单未支付',
                   'already_full_refund'=>'订单已全额退款',
                   'already_pay'=>'订单已支付',
                   'go_process'=>'订单支付中',
                   'already_part_refund'=>'订单已部分退款',
                   'no_full_pay'=>'订单未完成支付',
                   'already_shipping'=>'订单已配送',
                   'not_shipping'=>'订单未配送',
                   'must_not_shipping'=>'订单必须未配送',
                   'must_not_pay'=>'订单必须未支付',
                   'is_dead'=>'此订单是死单',
                   'must_not_pending'=>'订单必须是暂停发货'
                   
        
    );
    var $app_error=array(
            'payment is out of order amount'=>array('no'=>'b_goods_001','debug'=>'','level'=>'warning','info'=>'支付金额已经超过订单总金额','desc'=>'','debug'=>''),
            'can not find the goods'=>array('no'=>'b_goods_001','debug'=>'','level'=>'warning','info'=>'订单没有对应的商品项','desc'=>'','debug'=>''),
            'can not find the goods'=>array('no'=>'b_goods_001','debug'=>'','level'=>'warning','info'=>'订单ID不能为空','desc'=>'','debug'=>''),
            'can not find the goods'=>array('no'=>'b_goods_001','debug'=>'','level'=>'warning','info'=>'经销商ID不能为空','desc'=>'','debug'=>''),
            'can not find the goods'=>array('no'=>'b_goods_001','debug'=>'','level'=>'warning','info'=>'经销商订单ID不能为空','desc'=>'','debug'=>''),
            'can not find the goods'=>array('no'=>'b_goods_001','debug'=>'','level'=>'warning','info'=>'如果要开票,必须要交税','desc'=>'','debug'=>'')
    );
    function getColumns(){
        $columns=array(
         
        );
        return $columns;
    }
    
    /**
     * 设置订单失效
     *
     * @param array $data 
     *
     * @return 设置订单失效
     */
    function set_dead_order($data){
        $order_id = $data['order_id'];
        $this->verify_order_valid($order_id,$local_new_version_order,'*');//验证订单有效性
        $this->checkOrderStatus('cancel',$local_new_version_order);//检查订单状态
        $this->verify_order_item_valid($order_id,$local_order_item_list);//验证订单订单商品的有效性
        $obj_product = $this->load_api_instance('search_product_by_bn','1.0');
        
        //解冻上次订单商品库存
        foreach($local_order_item_list as $k=>$local_order_item){
            $obj_product->update_product_store($local_order_item['bn'],$local_order_item['nums'],'unfreeze');
        }
        
         //通知平台
        $objPlatform = $this->system->loadModel('system/platform');
        if($objPlatform->tell_platform('invalid_order',array('id'=>$order_id))=== false){
            $this->api_response('fail','data fail',$result,$objPlatform->getErrorInfo());
        }
        
        $this->db->exec('update sdb_orders set status="dead" where version_id=0 and order_id='.$order_id);
        $this->api_response('true',false,$result);
    }
    
    /**
     * 设置取消暂停发货
     *
     * @param array $data 
     *
     * @return 设置取消订单失效
     */
    function set_cancel_stop_shipping($data){
        $order_id = $data['order_id'];
        $this->verify_order_valid($order_id,$order,'*');//验证订单有效性
        $this->checkOrderStatus('cancel_stop_shipping',$order);//检查订单状态
        
        //通知平台
        $objPlatform = $this->system->loadModel('system/platform');
        if($objPlatform->tell_platform('cancel_stop_shipping',array('id'=>$order_id))=== false){
            $this->api_response('fail','data fail',$result,$objPlatform->getErrorInfo());
        }
        
        $this->db->exec('update sdb_orders set status="active" where  version_id=0 and order_id='.$order_id);
        $this->api_response('true',false,$result);
    }
    
    /**
     * 设置暂停发货
     *
     * @param array $data 
     *
     * @return 设置暂停发货
     */
    function set_stop_shipping($data){
        $order_id = $data['order_id'];
        $this->verify_order_valid($order_id,$order,'*');//验证订单有效性
        $this->checkOrderStatus('stop_shipping',$order);//检查订单状态
        
        //通知平台
        $objPlatform = $this->system->loadModel('system/platform');
        if($objPlatform->tell_platform('stop_shipping',array('id'=>$order_id))=== false){
            $this->api_response('fail','data fail',$result,$objPlatform->getErrorInfo());
        }
        
        $this->db->exec('update sdb_orders set status="pending" where version_id=0 and  order_id='.$order_id);
        $this->api_response('true',false,$result);
    }
    
    /* 设置订单disable(暂时内部用)
     *
     * @param int $order_id 
     * @param enum $disable 
     * 
     * @return 设置订单disable
     */
    function set_disable($order_id,$disable){
        $this->db->exec('update sdb_orders set disabled="'.$disable.'" where version_id=0 and  order_id='.$order_id);
    }
    
    /**
     * 修改订单信息
     *
     * @param array $data 
     *
     * @return 修改订单信息
     */
    function change_order_info($data){
        $data_order = json_decode($data['order'],true);
        $arr_order_item = $data_order['items'];
        unset($data_order['items']);
        
        $order_id = $data_order['order_id'];
        $dealer_id = $data_order['dealer_id'];
        
        $this->verify_order_valid($order_id,$local_new_version_order,'*');//验证订单有效性
        $this->verify_is_dealerorder($dealer_id,$local_new_version_order);//验证此订单是否属于经销商
        $this->checkOrderStatus('change_order',$local_new_version_order);//检查订单状态
        $this->verify_order_item_valid($order_id,$local_order_item_list);//验证订单订单商品的有效性
        $obj_member = $this->load_api_instance('verify_member_valid','1.0');    
        $obj_member->verify_member_valid($dealer_id,$member);//根据经销商ID验证会员记录有效性
        $obj_product = $this->load_api_instance('search_product_by_bn','1.0');
      
        
        //下单引发库存变化
        //$objGoodsStatus = $this->system->loadModel('trading/goodsstatus');
        //$op_goods_id = $objGoodsStatus->getGoodsIdByOrders($order_id);
        //$objGoodsStatus->batchEditStart($op_goods_id,array('updateAct'=>'store'));
        
        //解冻上次订单商品库存
       // $unfreeze_order_item = array();
        foreach($local_order_item_list as $k=>$local_order_item){
            $obj_product->update_product_store($local_order_item['bn'],$local_order_item['nums'],'unfreeze');
            //$unfreeze_order_item[$local_order_item['product_id']] = $local_order_item['nums'];
        }
        
        //当订单货品明细列表为空时 触发 平台 disable订单api
        if(count($arr_order_item)<=0){
            $this->set_disable($order_id,'true');
            $this->api_response('true',false,$result);
        }
        
        $obj_product->filter_product_invalid($member,$arr_order_item,$filter_order_item);//过滤订单符合条件的商品
    
        $arr_order_item = $filter_order_item;//过滤完毕    
        
       
        //$amountExceptPay = $this->amountExceptPay($local_new_version_order);//计算总价，不包括支付费用
        //$amountIncludePay = $local_new_version_order['total_amount'] - $amountExceptPay;//计算总价的支付费用
        $old_pay = $local_new_version_order['cost_payment'];//上次的支付费用
    
        if(isset($data_order['is_tax'])){//如果远程要存在加税，就按远程走
            $local_new_version_order['is_tax'] = $data_order['is_tax'];
        }
        
        if(isset($data_order['is_protect'])){//如果远程要存在保价，就按远程走
            $local_new_version_order['is_protect'] = $data_order['is_protect'];
        }
        
        if(isset($data_order['tax_company'])){//如果远程要存在发票，就按远程走
            $local_new_version_order['tax_company'] = $data_order['tax_company'];
        }
        
        $local_new_version_order = $this->organize_order_data($local_new_version_order,$arr_order_item);//组织订单数据
        
         //修改订单,加上原有支付费，重新计算总价
        $local_new_version_order['total_amount'] = $local_new_version_order['total_amount'] + $old_pay;
        $new_paymoney = $local_new_version_order['total_amount'];    
        
        //此订单商店所收到的支付金额
        $local_paymoney = $local_new_version_order['payed'];
        
        //订单不是未支付,才会发生退钱补钱
        if($local_new_version_order['pay_status'] != 0){
            $a_update_order = array();
            if($new_paymoney<$local_paymoney){//退钱,创建退款单,部分退款
                $refund_money = $local_paymoney - $new_paymoney;//应退金额
                $local_new_version_order['refund_money'] = $refund_money;
                $obj_refund = $this->load_api_instance('refund','1.0');
                $a_update_order = $obj_refund->refund($local_new_version_order,$local_paymoney,$this);    
                $a_update_order['process_money'] = $refund_money;
                unset($local_new_version_order['refund_money']);  
                $a_update_order['pay_status'] = 1;//退款意味已支付          
            }elseif($new_paymoney>$local_paymoney){//补钱，设置订单状态,部分付款
                $local_new_version_order['full_money'] = $new_paymoney - $local_paymoney;
                $a_update_order = $this->fill_section($local_new_version_order);
                $a_update_order['process_money'] = $local_paymoney - $new_paymoney;
                unset($local_new_version_order['full_money']);            
            }else{
                $a_update_order['pay_status'] = 1;//退款意味已支付         
            }
            
            if(count($a_update_order)>0){//状态修改后与上一个订单版本进行合并,为新订单做准备
               $local_new_version_order = array_merge($local_new_version_order,$a_update_order);
            }  
        }
        
        $data_order = $local_new_version_order;
        $data_order_item = $arr_order_item;       
        
         //过滤商品带引号
        $obj_tools = $this->load_api_instance('get_http','1.0');
        $data_order = $obj_tools->addslashes_array($data_order);
        $data_order_item = $obj_tools->addslashes_array($data_order_item);
        
        $this->create_order($data_order,$insert_order);
        $this->create_order_item($order_id,$data_order_item,$insert_order_item);
        
        //$objGoodsStatus->batchEditEnd(); //下单引发库存变化
        
        $this->addLog($order_id,'远程订单修改',null, null , '订单修改');
         
        //$insert_order_item['effect_time'] = $insert_order_item['effect_time'] - time();
        
        $insert_order['items'] = $insert_order_item;
        $insert_order['effect_time'] = $insert_order['effect_time'] - $insert_order['createtime'];
        $insert_order['process_money'] = isset($insert_order['process_money']) ? $insert_order['process_money'] : 0; 
        
        $insert_order = $obj_tools->stripslashes_array($insert_order);//去斜杠
         
        $insert_order = $this->filter_order_output($insert_order);
        $result['data_info'] = $insert_order;
        $this->api_response('true',false,$result);
    }
    
    /**
     * 生成订单接口
     *
     * @param array $data 
     *
     * @return 生成订单接口
     */
    function generate_order_record($data){
        $order = json_decode($data['order'],true);
        $order_id = $order['order_id'];
        $dealer_id = $order['dealer_id'];
        $dealer_order_id = $order['dealer_order_id'];
        
        if(empty($order_id)){
           $this->api_response('fail','data fail',$result,'订单ID不能为空');
        }
        
        if(empty($dealer_id)){
           $this->api_response('fail','data fail',$result,'经销商ID不能为空');
        }
        
        if(empty($dealer_order_id)){
           $this->api_response('fail','data fail',$result,'经销商订单ID不能为空');
        }
         
        $this->verify_order_exist($order_id);
        $obj_member = $this->load_api_instance('verify_member_valid','1.0');
        $obj_member->verify_member_valid($dealer_id,$member);
       // $obj_payment_cfg = $this->load_api_instance('search_payment_cfg_list','1.0');
       // $obj_payment_cfg->verify_payment_cfg_valid($order['payment']);
        
        $arr_order_item = $order['items'];
        unset($order['items']);
        
        $obj_product = $this->load_api_instance('search_product_by_bn','1.0');
        $obj_product->filter_product_invalid($member,$arr_order_item,$filter_order_item);
        
        $arr_order_item = $filter_order_item;//过滤完毕
       
        $order = $this->organize_order_data($order,$arr_order_item);//组织订单数据
        
        $order['use_registerinfo'] = 'true';
        $order['member_id'] = $member['member_id'];
        
        //下单引发库存变化
        /*$objGoodsStatus = $this->system->loadModel('trading/goodsstatus');
        $op_goods_id = array();
        foreach($arr_order_item as $order_item){
            $op_goods_id[] = $order_item['goods_id'];
        }
        $objGoodsStatus->batchEditStart($op_goods_id,array('updateAct'=>'store'));*/
        
        //过滤商品带引号
        $obj_tools = $this->load_api_instance('get_http','1.0');
        $order = $obj_tools->addslashes_array($order);
        
        $this->create_order($order,$insert_order);
        $this->create_order_item($order['order_id'],$arr_order_item,$insert_order_item);
        
        //$objGoodsStatus->batchEditEnd(); //下单引发库存变化
        
        $this->addLog($order_id,'远程订单创建',null, null , '订单创建');
        
        $insert_order['items'] = $insert_order_item;
        $insert_order['effect_time'] = $insert_order['effect_time'] - $insert_order['createtime'];
        
        $insert_order = $obj_tools->stripslashes_array($insert_order);//去斜杠
         
        $insert_order = $this->filter_order_output($insert_order);
        $result['data_info'] = $insert_order;
        $this->api_response('true',false,$result);
    }    
    
    /**
     * 生成订单时，根据传递的参数生成订单数据
     * @param array $aOrder 
     * 
     * @return array
     */
    function organize_order_data($aOrder,$aOrderItem){
        if(!empty($aOrder['tax_company']) && 'true' != $aOrder['is_tax']){
           $this->api_response('fail','data fail',$result,'如果要开票,必须要交税');
        }
        
        $effect_time = $this->system->getConf('system.order_invalid_time') * 60 * 60;
        $aOrder['effect_time'] = $effect_time;
        
        $weight = 0;//重量
        $tostr = '';//商品描述
        $itemnum = 0;//数量
        $cost_item = 0;//商品总价
        foreach($aOrderItem as $order_item){
            $weight += $order_item['amount_weight'];
            $tostr += $order_item['name'].'('.$order_item['nums'].'),';
            $itemnum += $order_item['nums'];
            $cost_item += $order_item['amount'];
        }
        
        if(!empty($tostr)){
            $tostr = substr($tostr,0,strlen($tostr)-1);
        }
        
        $aOrder['weight'] = $weight;
        $aOrder['tostr'] = $tostr;
        $aOrder['itemnum'] = $itemnum;
        $aOrder['cost_item'] = $cost_item;
        $aOrder['total_amount'] = $cost_item;
        
        $obj_payments = $this->load_api_instance('search_payments_by_order','1.0');
        
        //商品税费用计算
        if($aOrder['is_tax'] == 'true' && $this->system->getConf('site.trigger_tax')){
            $aOrder['cost_tax'] = $cost_item * $this->system->getConf('site.tax_ratio');
            $aOrder['cost_tax'] = $obj_payments->formatNumber($aOrder['cost_tax']);
            $aOrder['total_amount'] += $aOrder['cost_tax'];
        }    
        
        $shipping_area = explode(':',$aOrder['ship_area']);
        $aOrder['area'] = $shipping_area[2];
        $obj_delivery = $this->load_api_instance('getDlTypeByArea','1.0');
        $rows = $obj_delivery->getDlTypeByArea($aOrder['area'],$weight,$aOrder['shipping_id']);
        
        //运费计算
        //if($aOrder['exemptFreight'] == 1){    //[exemptFreight] => 1免运费
          //  $aOrder['cost_freight']=0;
        //}else{
            $aOrder['cost_freight'] = $obj_payments->formatNumber($obj_delivery->cal_fee($rows[0]['expressions'],$weight,$cost_item,$rows[0]['price']));
       // }
        $aOrder['shipping'] = $rows[0]['dt_name'];
        $aOrder['cost_freight'] = is_null($aOrder['cost_freight'])?0:$aOrder['cost_freight'];
        $aOrder['total_amount'] += $aOrder['cost_freight'];
    
        //保价费用计算
        if($aOrder['is_protect'] == 'true'){
            $aOrder['cost_protect'] = $obj_payments->formatNumber(max($cost_item*$rows[0]['protect_rate'],$rows[0]['minprice']));
        }else{
            $aOrder['cost_protect']=0;
        }
        $aOrder['total_amount'] += $aOrder['cost_protect'];
         
        //汇率费用计算
        //$currency = $obj_payments->getcur($aOrder['currency']);
        $currency = $this->getDefault();
        $aOrder['currency'] = $currency['cur_code'];
        $aOrder['cur_rate'] = ($currency['cur_rate']>0 ? $currency['cur_rate']:1);
      
        //实际货币所需付款计算
        $aOrder['final_amount'] = $aOrder['total_amount'] * $aOrder['cur_rate'];
        $aOrder['final_amount'] = $obj_payments->formatNumber($aOrder['final_amount']);
      
        //是远程订单
        $aOrder['is_remote'] = 'true';
      
        return $aOrder;
    }
    
     /**
     * 取大B默认币别
     *
     * @return array
     */
    function getDefault(){
        if($cur = $this->db->selectrow('select * from sdb_currency where def_cur=1')){
            return $cur;
        }else{
            return $this->db->selectrow('select * FROM sdb_currency');
        }
    }
    
    /**
     * 计算订单总价不包括支付费用
     * @param array $order 
     *
     * @return decimal
     */
    function amountExceptPay($order){
        return $order['cost_protect']+$order['cost_freight']+$order['cost_tax']+$order['cost_item']-$order['pmt_amount']-$order['discount'];
    }
    
    /**
     * 订单支付
     * @param array $order 
     * @param int $money 
     * @return 订单支付
     */
    function payed($order,$money){
       $pay_money = $order['payed'] + $money;//已支付金额        
        if($pay_money >= $order['total_amount']){//全额付款
            $pay_status = $order['pay_status'] == 2 ? 2 : 1;
        }else{//部分付款
            $pay_status = 3;
        }
        
        $a_update_order['pay_status'] = $pay_status;
        $a_update_order['payed'] = $pay_money;   
        $a_update_order['total_amount'] = $order['total_amount'];    
      
        //实际货币所需付款计算
        $obj_payments = $this->load_api_instance('search_payments_by_order','1.0');
        $a_update_order['final_amount'] = $order['total_amount'] * $order['cur_rate'];
        $a_update_order['final_amount'] = $obj_payments->formatNumber($a_update_order['final_amount']);
                 
        $this->update_order($order['order_id'],$a_update_order);
        $this->addLog($order['order_id'],'订单'.$order['order_id'].'付款'.$money,null, null , '付款');
    }
    
    /**
     * 改变订单支付方式
     * @param int $order_id 
     * @param int $payment 
     * @return 改变订单支付方式
     */
    function changeOrderPayment($order_id,$payment){
        $a_update_order['payment'] = $payment;             
        $this->update_order($order_id,$a_update_order);
    }
    
    /**
     * 过滤订单输出数据
     * @param array $act 
     * @param array $aOrder 
     * @return 检查订单状态
     */
    function filter_order_output($aOrder){  
        if(isset($aOrder['items']['member_id']))unset($aOrder['items']['member_id']);
        if(isset($aOrder['order_source']))unset($aOrder['order_source']);
        
        return $aOrder;
    }
    
    /**
     * 因为订单修改导致需要补款
     * @param array $act 
     * @param array $aOrder 
     * @return 检查订单状态
     */
    function fill_section($aOrder){
        $aUpdate['pay_status'] = 3;
       
        return $aUpdate;
    }
    
    /**
     * 检查订单状态
     * @param array $act 
     * @param array $aOrder 
     * @return 检查订单状态
     */
    function checkOrderStatus($act,$aOrder){    
       $error_msg = '';
        switch($act){
            case 'pay':
                if($aOrder['status'] != 'active' && $aOrder['status'] != 'pending'){
                   $error_msg = $this->get_error('not_active');
                }else if( $aOrder['pay_status'] == '1'){
                   $error_msg = $this->get_error('already_pay');
                }else if($aOrder['pay_status'] == '2'){
                   $error_msg = $this->get_error('go_process');
                }else if($aOrder['pay_status'] == '4'){
                   $error_msg = $this->get_error('already_part_refund');
                }else if($aOrder['pay_status'] == '5'){
                   $error_msg = $this->get_error('already_full_refund');
                }
            break;
            case 'refund':
                if($aOrder['status'] != 'active'&& $aOrder['status'] != 'pending' ){
                    $error_msg = $this->get_error('not_active');
                }else if($aOrder['pay_status'] == '0'){
                    $error_msg = $this->get_error('not_pay');
                }else if($aOrder['pay_status'] == '5'){
                    $error_msg = $this->get_error('already_full_refund');
                }            
            break;
            case 'stop_shipping'://不能对死单进行操作 订单必须已支付 订单必须未配送
                if($aOrder['status'] == 'dead'){
                   $error_msg = $this->get_error('is_dead');
                }else if($aOrder['pay_status'] =='1'){
                         if($aOrder['ship_status'] !='0'){
                            $error_msg = $this->get_error('must_not_shipping');
                         }     
                }else{
                   $error_msg = $this->get_error('no_full_pay');
                }
            break;
            case 'cancel_stop_shipping'://不能对死单进行操作 订单必须是暂停发货
                 if($aOrder['status'] == 'dead'){
                   $error_msg = $this->get_error('is_dead');
                 }else if($aOrder['status'] != 'pending'){
                   $error_msg = $this->get_error('must_not_pending');
                 }
            break;
            case 'change_order'://不能对死单进行操作 订单必须未配送
                
                 if($aOrder['status'] == 'dead'){
                    $error_msg = $this->get_error('is_dead');
                 }else if($aOrder['ship_status'] !='0'){
                    $error_msg = $this->get_error('must_not_shipping');
                 }
            break;
            case 'cancel':
                 if($aOrder['status'] != 'active'){
                    $error_msg = $this->get_error('not_active');
                 }else if($aOrder['pay_status'] >0){
                    $error_msg = $this->get_error('must_not_shipping');
                 }else if($aOrder['ship_status'] >0){
                    $error_msg = $this->get_error('must_not_pay');
                 }            
            break;
            case 'archive':
                 if($aOrder['status'] != 'active'){
                    $error_msg = $this->get_error('not_active');
                 }         
            break;
        }
       
        if(!empty($error_msg)){
            $this->api_response('fail','data fail',$result,$error_msg);
        }else{
            return true;
        }        
    }
    
    function get_error($key){
        return $this->error[$key];
    }
    
     /**
     * 创建订单记录
     *
     * @param array $data 
     *
     * @return 创建订单记录
     */
    function create_order($data,& $insert_order){  
        $this->update_order_version($data['order_id']);
        $this->update_order_item_version($data['order_id']);
        $this->update_delivery_version($data['order_id']);
        $this->update_payments_version($data['order_id']);
        $this->update_refunds_version($data['order_id']);
        
        $curr_time = time();
        $data['acttime'] = $curr_time;
        $data['createtime'] = $curr_time;
        $data['last_change_time'] = $curr_time;
        $data['effect_time'] += $curr_time;
        $data['version_id'] = 0;
        $aRs = $this->db->query("SELECT * FROM sdb_orders WHERE 0=1");
        $sSql = $this->db->getInsertSql($aRs,$data);
        $this->db->exec($sSql);
        
        $insert_order = $data;
    }
    
     /**
     * 创建订单商品
     *
     * @param array $data 
     *
     * @return 创建订单商品
     */
    function create_order_item($order_id,$arr_data,& $insert_order_item){
        $obj_product = $this->load_api_instance('search_product_by_bn','1.0');
        
        foreach($arr_data as $k=>$data){
             $data['version_id'] = 0;
             $data['order_id'] = $order_id;
             $aRs = $this->db->query("SELECT * FROM sdb_order_items WHERE 0=1");
             $sSql = $this->db->getInsertSql($aRs,$data);
             $obj_product->update_product_store($data['bn'],$data['nums']);
             $this->db->exec($sSql);
             $arr_data[$k] = $data;
        }
        $insert_order_item = $arr_data;
    }
    
    /**
     * 在线支付时，设置支付费用
     *
     * @param int $order_id
     * @param array $aPay支付方式
     * @param int $total_amount
     */
    function set_order_payment($order_id,$cost_payment){    
        $obj_payments = $this->load_api_instance('search_payments_by_order','2.0');
        $data['cost_payment'] = $obj_payments->formatNumber($cost_payment);
        $this->update_order($order_id,$data);
    }
    
    /**
     * 更新原订单版本
     *
     * @param int $order_id
     * 
     * @return 更新原订单版本
     */
    function update_order_version($order_id){
        $this->db->exec('update sdb_orders set version_id=version_id+1 where order_id='.$order_id.' order by version_id desc');
    }
    
    /**
     * 更新原订单发货单版本
     *
     * @param int $order_id
     * 
     * @return 更新原订单发货单版本
     */
    function update_delivery_version($order_id){
        $this->db->exec('update sdb_delivery set version_id=version_id+1 where order_id='.$order_id.' order by version_id desc');
    }
    
    /**
     * 更新原订单退款单版本
     *
     * @param int $order_id
     * 
     * @return 更新原订单退款单版本
     */
    function update_refunds_version($order_id){
        $this->db->exec('update sdb_refunds set version_id=version_id+1 where order_id='.$order_id.' order by version_id desc');
    }
    
    /**
     * 更新原订单支付单版本
     *
     * @param int $order_id
     * 
     * @return 更新原订单支付单版本
     */
    function update_payments_version($order_id){
        $this->db->exec('update sdb_payments set version_id=version_id+1 where order_id='.$order_id.' order by version_id desc');
    }
    
    /**
     * 更新原订单商品版本
     *
     * @param int $order_id
     * 
     * @return 更新原订单版本
     */
    function update_order_item_version($order_id){    
        $this->db->exec('update sdb_order_items set version_id=version_id+1 where order_id='.$order_id.' order by version_id desc');
    }
    
    /**
     * 更新订单表记录
     *
     * @param int $order_id
     * @param array $data
     * @return 更新订单表记录
     */
    function update_order($order_id,$data){    
        $rs = $this->db->exec('SELECT * FROM sdb_orders WHERE  version_id=0 and  order_id='.$order_id);
        $sql = $this->db->getUpdateSQL($rs,$data);
        $this->db->exec($sql);
    }
    
    /**
     * 更新订单商品表记录
     *
     * @param int $item_id
     * @param array $data
     * @return 更新订单表记录
     */
    function update_order_item($item_id,$data){
        $rs = $this->db->exec('SELECT * FROM sdb_order_items WHERE item_id='.$item_id);
        $sql = $this->db->getUpdateSQL($rs,$data);
        $this->db->exec($sql);
    }
    
    /**
     * 验证订单是否有效
     *
     * @param int $order_id 
     * @param array $order 
     * @param string $colums 
     *
     * @return 验证订单是否存在
     */
    function verify_order_valid($order_id,& $order,$colums='*'){
        $_order = $this->db->selectrow('select '.$colums.' from sdb_orders where order_id='.$order_id.' and version_id=0');
        if(!$_order){
           $this->api_response('fail','data fail',$result,'订单无效');
        }
        
        if(empty($_order['dealer_id'])){
           $this->api_response('fail','data fail',$result,'此订单不是经销商订单');
        }
        
        $order = $_order;
    }
    
    /**
     * 验证此订单是否属于经销商
     *
     * @param int $dealer_id 
     * @param array $order 
     *
     * @return 验证此订单是否属于经销商
     */
    function verify_is_dealerorder($dealer_id,$order){
        if($dealer_id != $order['dealer_id']){
            $this->api_response('fail','data fail',$result,'此订单不属于经销商');
        }
    }
    
    /**
     * 验证订单是否已经存在
     *
     * @param int $order_id 
     * @param array $order 
     * @param string $colums 
     *
     * @return 验证订单是否已经存在
     */
    function verify_order_exist($order_id){
        $_order = $this->db->selectrow('select order_id from sdb_orders where version_id=0 and  order_id='.$order_id);
        if($_order){
           $this->api_response('fail','data fail',$result,'订单已经存在');
        }
        
       $order = $_order;
    }
    
    /**
     * 验证订单是否是死单
     *
     * @param array $order 
     *
     * @return 验证订单是否是死单
     */
    function verify_order_dead($order){           
        if($order == 'dead'){
           $this->api_response('fail','data fail',$result,'此订单是死单,无法操作');
        }  
    }
    
    /**
     * 验证订单商品是否有效
     *
     * @param int $order_id 
     * @param array $order_item_list 
     * @param string $colums 
     *
     * @return 验证订单商品是否有效
     */
    function verify_order_item_valid($order_id,& $order_item_list,$colums='*'){
      
        $_order_item_list = $this->db->select('select '.$colums.' from sdb_order_items where version_id=0 and order_id='.$order_id);
        if(!$_order_item_list){
           $this->api_response('fail','data fail',$result,'订单没有对应的商品项');
        }
        
        $order_item_list = $_order_item_list;
    }
    
    /**
     * 验证支付金额是否大于订单总金额
     *
     * @param int $order 
     * @param int $payed 
     *
     * @return 验证支付金额是否大于订单总金额
     */
    function verify_payed_valid($order,$payed){
        $total_payed = $order['payed'] + $payed;//支付总金额
        if($total_payed > $order['total_amount']){
           $this->api_response('fail','data fail',$result,'支付金额已经超过订单总金额');
        }
       
    }
    
    /**
     * 增加订单日志
     *
     * @param int $order_id 
     * @param string $message 
     * @param int $op_id 
     * @param string $op_name 
     * @param string $behavior 
     * @param string $result 
     *
     * @return boolean
     */
    function addLog($order_id,$message,$op_id=null, $op_name=null , $behavior = '', $result = 'success'){
        if($message){
            $op_name='';
            $rs = $this->db->query('select * from sdb_order_log where 0=1');
            $sql = $this->db->getInsertSQL($rs,array(
                'order_id'=>$order_id,
                'op_id'=>$op_id,
                'op_name'=>$op_name,
                'behavior'=>$behavior,
                'result'=>$result,
                'log_text'=>addslashes($message),
                'acttime'=>time(),
                'last_change_time'=>time()
                ));
            return $this->db->exec($sql);
        }else{
            return false;
        }
    }


  
}