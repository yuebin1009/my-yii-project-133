<?php
/**
 *workerman 
 */

// 引入客户端文件
require_once '/var/www/html/workerman/applications/ThriftRpc/Clients/ThriftClient.php';
use ThriftClient\ThriftClient;
class WorkController extends Controller{


    public function actionSay(){

        // 传入配置，一般在某统一入口文件中调用一次该配置接口即可
        ThriftClient::config(array(
            'HelloWorld' => array(
                'addresses' => array(
                    '192.168.112.131:9090',
                ),
                'thrift_protocol' => 'TBinaryProtocol',//不配置默认是TBinaryProtocol，对应服务端HelloWorld.conf配置中的thrift_protocol
                'thrift_transport' => 'TBufferedTransport',//不配置默认是TBufferedTransport，对应服务端HelloWorld.conf配置中的thrift_transport
            ),
            'UserInfo' => array(
                'addresses' => array(
                    '127.0.0.1:9393'
                ),
            ),
        )
    );
        // =========  以上在WEB入口文件中调用一次即可  ===========


        // =========  以下是开发过程中的调用示例  ==========

        // 初始化一个HelloWorld的实例
        $client = ThriftClient::instance('HelloWorld');

        // --------同步调用实例----------
        for($i=0;$i<1;$i++){
            var_export($client->sayHello("TOM"));
        }
        /* 
        // 异步调用 之 发送请求给服务端（注意：异步发送请求格式统一为 asend_XXX($arg),既在原有方法名前面增加'asend_'前缀）
        $client->asend_sayHello("JERRY");
        $client->asend_sayHello("KID");

        // 这里是其它业务逻辑

        // 异步调用 之 接收服务端的回应（注意：异步接收请求格式统一为 arecv_XXX($arg),既在原有方法名前面增加'arecv_'前缀）
        var_export($client->arecv_sayHello("KID"));
        var_export($client->arecv_sayHello("JERRY"));
         */
    }

    public function actionMyApp($data){

        // \n 处理请求边界
        //$data = $data."\n";
        
        $data = '{"module":"user","action":"getInfo"}';
        
        
        /*
        // int + json
        // 请求的包体
        // 整个请求数据长度，首部4字节+包体
        $total_len = 8 + pack('N', strlen($data));
        $data = $total_len . $data;
         */
        
        //首部固定10个字节长度用来保存整个数据包长        
        $data = $this->str($data);
        
        $socket = stream_socket_client("tcp://127.0.0.1:55555", $errno, $errstr, 30);
        fwrite($socket, $data);
        $response_data = fread($socket, 65535); 
        print_R($response_data);
        echo '<hr />';
  
    }

    public function str($data){

        $dataA = '00000000'.$data; 
        $dataLen = strlen($dataA);
        $len = strlen($dataLen);
        $j = 8-$len;
        $a = '';
        for($i=0; $i<$j;$i++){
        
           $a .= '0'; 
            
        }
        return $a . $dataLen . $data;
    }

    public function actionSend(){

        $data = '{"module":"user","action":"getInfo"}';
        $data = $this->str($data);
        $socket = stream_socket_client("tcp://192.168.112.131:55555");
        fwrite($socket, $data);
        $response_data = fread($socket, 65535); 
        print_R($response_data);
        echo '<hr />';
        exit; 

        $send_data = $this->str($data);
        $service_port = 55555;   
        $address ="192.168.112.131"; 
        $commonProtocol = getprotobyname("tcp");
        $socket = socket_create(AF_INET, SOCK_STREAM, $commonProtocol);
        
        $result = socket_connect($socket, $address, $service_port);
        if(!socket_write($socket, $send_data, strlen($send_data)))   
        {  
            echo "-1";
        } 
        else  
        {
            echo socket_read($socket,1024);
        }
    
    }

    public function actionSendGate(){

        
        $socket = stream_socket_client("tcp://192.168.112.131:8480");
        //fwrite($socket, $data);
        $response_data = fread($socket, 65535); 
        print_R($response_data);
        
        $form = '';
        $form .='<form action="sendPost" method="get">';
        $form .='<input type="text" name="message">';
        $form .='<input type="submit" value="提交">';
        $form .='</form>';
        echo $form;
        echo '<hr />';
        exit; 
    }

    public function actionSendPost($message){

        
        $data = $message."\n";;
        $socket = stream_socket_client("tcp://192.168.112.131:8480");
        fwrite($socket, $data);
        $response_data = fread($socket, 65535); 
        print_R($response_data);

        $form = '';
        $form .='<form action="sendPost" method="post">';
        $form .='<input type="text" name="message">';
        $form .='<input type="submit" value="提交">';
        $form .='</form>';
        echo $form;

    
    }

    public function actionTestPack(){

        // 请求的包体
        $data = '{"module1111":"user","action":"getInfo"}';
        // 整个请求数据长度，首部4字节+包体
        
        $data_len = strlen($data);
        echo '数据长度='.$data_len.'<hr />'; 
         
        // 第一种方式
        $total_len = 4 + $data_len; 
        $package = pack('N',$total_len).$data;
        $package = substr($package,0,4); 
        echo '*********第一种方式**********<br/>';
        echo '总计长度='.$total_len.'<br />'; 
        echo '传输数据='.$package.'<br />'; 
   
        $unpack_data = unpack('Ntotal_len', $package);
        
        echo '数据反解='.print_R($unpack_data,true);
        echo '<hr />';
       
        
        // 第二种方式
        $total_len = pack('N',$data_len+4);
        $package = $total_len.$data;
        $package = substr($package,0,8); 
  
        echo '*********第二种方式**********<br/>';
        echo '总计长度='.$total_len.'<br />'; 
        echo '传输数据='.$package.'<br />'; 
  
        $unpack_data = unpack('Ntotal_len', $package);
        
        echo '数据反解='.print_R($unpack_data,true);
        echo '<hr />';


          /* 
        
        $total_len = pack('N',strlen($data)+4);
        echo $total_len;
        echo '<hr />';
        
        $package = $total_len . $data;
        
        echo $package;
        echo '<hr />';
        
        $unpack_data = unpack('Ntotal_len', $package);
        print_R($unpack_data); 
        */
    }
    /**
     *聊天室WebSocket
     */
    public function actionChat(){
    
        $this->renderPartial('chat'); 
    }
}
