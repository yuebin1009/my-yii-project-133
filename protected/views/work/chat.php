<html>
<body onload="init()">
<h4>WebSocket</h4>
<select name="type" id="type">
<option value="login">登陆</option>
<option value="say">聊天</option>
</select>
用户名:<input type="text" name="login_name" id="login_name">
<input type="button" value="发送" onclick="send()">
<br />
接收人:<input type="text" name="to_uid" id="to_uid">
接收内容:<input type="text" name="content" id="content">
<input type="button" value="说话" onclick="sendUid()">
</body>
</html>
<script src="http://cdn.socket.io/stable/socket.io.js"></script>
<script>
var ws, name, user_list={};
function init() {
   // 创建websocket
	ws = new WebSocket("ws://"+document.domain+":7272");
  // 当socket连接打开时，输入用户名
  ws.onopen = function() {
	  show_prompt();
	  if(!name) {
		  return ws.close();
	  }
	  ws.send(JSON.stringify({"type":"login","name":name}));
  };
  // 当有消息时根据消息类型显示不同信息
  ws.onmessage = function(e) {
	  console.log(e.data);
    var data = JSON.parse(e.data);
    switch(data['type']){
          // 展示用户列表
          case 'user_list':
        	  //{"type":"user_list","user_list":[{"uid":xxx,"name":"xxx"},{"uid":xxx,"name":"xxx"}]}
        	  flush_user_list(data);
        	  break;
          // 登录
          case 'login':
              //{"type":"login","uid":xxx,"name":"xxx","time":"xxx"}
        	  add_user_list(data['uid'], data['name']);
              say(data['uid'], 'all',  data['name']+' 加入了聊天室', data['time']);
              break;
          // 发言
          case 'say':
        	  //{"type":"say","from_uid":xxx,"to_uid":"all/uid","content":"xxx","time":"xxx"}
        	  say(data['from_uid'], data['to_uid'], data['content'], data['time']);
        	  break;
         // 用户退出 
          case 'logout':
        	  //{"type":"logout","uid":xxx,"time":"xxx"}
     		 say(data['uid'], 'all', user_list['_'+data['uid']]+' 退出了', data['time']);
     		 del_user_list(data['uid']);
    }
  };
  ws.onclose = function() {
	  console.log("服务端关闭了连接");
  };
  ws.onerror = function() {
	  console.log("出现错误");
  };
}

//输入姓名
function show_prompt(){  
    name = prompt('输入你的名字：', '');
    if(!name){  
        alert('姓名输入为空，请重新输入！');  
        show_prompt();
    }
    //name = name.replace(/\"/g,'\\"');
}
</script>
/*
var socket;
self.setInterval("clock()",1000);
function init(){

    socket = new WebSocket('ws://192.168.112.131:7272');

    // 打开连接
    socket.onopen = function(event){
        
        console.log('onopen')
    }
    socket.onmessage = function(event){

        //console.dir(event);
    }
}

function sendUid(){

    var type = document.getElementById('type');
    var type_value = type.value;
    var to_uid = document.getElementById('to_uid').value;
    var content = document.getElementById('content').value;
    var json  = new Object;
    json.type = type_value;
    json.to_uid = to_uid;
    json.content = content;
    str  = JSON.stringify(json);
    
    // DO : 发送信息socket
    socket.send(str);
}

function send(){

    var type = document.getElementById('type');
    var type_value = type.value;
    var login_name = document.getElementById('login_name').value;
    var json  = new Object;
    json.type = type_value;
    json.name = login_name;
    str  = JSON.stringify(json);
    
    // DO : 发送信息socket
    socket.send(str);
}
/*
var socket1 = new io.Socket('192.168.112.131',{ 
      port: 7272 
}); 
socket1.connect();
socket1.on('connect',function() { 
      console.log('Client has connected to the server!'); 
});
 */
