<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.111
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


    public function actionIndex(){
    
        phpinfo();
    }

    public function actionSetCache()
    {
        for($i=0;$i<1000;$i++){

            if(Yii::app()->cache->set($i,md5($i))){

                $array[] = md5($i);

            }


        }
        echo count($array);
        echo '<hr/>';
        print_r($array);
        exit;
        $this->render('index');
    }

    public function actiongetCache()
	{
        for($i=0;$i<1000;$i++){
        
        
            $cache = Yii::app()->cache->get($i);
            if(!empty($cache)){
            
                $array[] =Yii::app()->cache->get($i);
            }
        
        }
        echo count($array);
        echo '<hr/>';
        print_r($array);
        exit;
	}

    public function actionSetSession()
    {
        for($i=0;$i<10000;$i++){
            
            Yii::app()->session[$i] = md5($i);
            $array[] = $i;

        }
        echo count($array);
        echo '<hr/>';
        print_r($array);
    }


    public function actionGetSession()
	{
        $array = array();
        for($i=0;$i<10000;$i++){
            
            $session = Yii::app()->session[$i];
            if(!empty($session)){
            
                $array[] =$session;
            }
        
        }
        echo count($array);
        echo '<hr/>';
        print_r($array);
	}



    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
    }
    // DO : 下载文件                                                       
    public function actionDownFile(){

        $file = Yii::app()->request->getParam('file');
        if(!empty($file)){

            // DO : 截取文件名和文件地址
            $fileName = substr($file,strrpos($file,'/',0)+1);
            $filePath = $_SERVER['DOCUMENT_ROOT'].$file;

            if(!file_exists($filePath)){
                echo "下载图片不存在";
                exit;
            }
            
            header ("Content-type: image/png");
            // 下面需要另存文件的时候需要使用
            header('Content-Disposition: attachment; filename='.$fileName);
            // 让Xsendfile发送文件
            header('X-Accel-Redirect: ' . $file);

            return true;
        }else{
            echo
                'URL地址错误';
            exit;
        }
    }

    public function actionTest(){
        echo 'test';
    }

    public function actionTestRedis(){
        
        // DO : 安装了PHP redis 扩展实现方式
        $redis=new Redis(); 
        $redis->connect('127.0.0.1',6379);
        $redis->set('test', 'Hello World111');
        echo $redis->get('test');
    }

    public function actionTestR(){

        // DO : 基于Rediscache 无需php redis 扩展
        print_R(Yii::app()->redisCache->set('key2', 'aaaaaaaaa'));
        //$data = Yii::app()->redisCache->get('key1');
        //echo $data;
    }

    public function actionTestSmarty(){

        $smarty = Yii::app()->smarty; 
        $smarty->assign('test','测试');
        $smarty->display('create.tpl');
        /*
        $path = Yii::getPathOfAlias('application');//获得protected文件夹的绝对路径
        include ($path.DIRECTORY_SEPARATOR.'Smarty'.DIRECTORY_SEPARATOR.'libs/Smarty.class.php');//smarty所在路径
        $smarty = new Smarty();
        $smarty->template_dir = $path.DIRECTORY_SEPARATOR.'Smarty/template'.DIRECTORY_SEPARATOR;
        $smarty->assign('test', '测试');
        $smarty->display('create.html');
         */

    }
    public function actionTestInitDB(){

        $sql = 'select * from users where id = 2 ';
        $pay = Yii::app()->db->createCommand($sql)->queryRow();
        // $pay = Account::model()->findByPk(3840);
        print_R($pay);exit;
    }

    public function actionPrototype(){
    
        // DO : 原型模式
        Yii::import('ext.prototype.*');
        $obj = new ConcretePrototype('浅拷贝');
        $cloneObj = $obj->shallowCopy();

        echo $obj->getName();
        echo $cloneObj->getName();

        echo '<hr/>';
        
        $obj = new ConcretePrototype('深拷贝');
        $cloneObj = $obj->deepCopy();

        echo $obj->getName();
        echo $cloneObj->getName();
    }

    public function actionFacade(){
    
        // DO : 外观模式
        Yii::import('ext.facade.*');
        $facade = new Facade();
        $facade->facade1();
        echo '<hr />';
        $facade->facade2();
    }
    
    public function actionDecorator(){
    
    	// DO : 外观模式
    	Yii::import('ext.decorator.*');
    	$coffee = new Coffee();
    	$coffee = new Milk($coffee);
    	$coffee = new Suger($coffee);
    	echo $coffee->cost();
    }

    /**
     *  桥接模式
     */
    public function actionBridge(){
    
    	Yii::import('ext.bridge.*');
        $nokia = new PhoneBrandNokia();
        $nokia->setPhoneSoft(new PhoneGame('诺基亚'));
        $nokia->run();
        echo '<br />';
        $nokia->setPhoneSoft(new PhoneList('诺基亚'));
        $nokia->run();
        echo '<br />';
 
        $apple = new PhoneBrandApple();
        $apple->setPhoneSoft(new PhoneGame('苹果'));
        $apple->run();
        echo '<br />';
        $apple->setPhoneSoft(new PhoneList('苹果'));
        $apple->run();
        echo '<br />';
 
    }
    /**
     * 观察者模式
     */
    public function actionObserver(){
    
    	Yii::import('ext.observer.*');
        $login = new Login();
        //添加安全观察者  
        $login->attach(new SecurityMonitor( $login ));
        
        //添加正确登录观察者  
        $login->attach(new GeneralLogger( $login ));
        
        //添加用户名观察者  
        $login->attach(new UserMonitor( $login ));

        $login->handleLogin();
    }

    /**
     *模版方法
     */
    public function actionTemplate(){
    
    	Yii::import('ext.template.*');
        $templateC = new TemplateChild;
        $templateC->getTemplate();
    }

    /**
     *命令模式
     */
    public function actionCommand(){
    
        Yii::import('ext.command.*');
        $receiver = new Receiver('睡觉');
        $command = new ConcreteCommand($receiver);
        $invoker = new Invoker($command);
        $invoker->action();
    
    }

    /**
     *宏命令模式
     */
    public function actionMacroCommand(){
    
        Yii::import('ext.command.*');
        //接收者  
        $receiver = new Receiver('liyh');

        //具体的命令
        $copyCommand = new CopyCommand( $receiver );
        $pasteCommand = new PasteCommand( $receiver );

        //添加到宏命令
        $demoMacroCommand = new DemoMacroCommand();
        $demoMacroCommand->add( $copyCommand );
        $demoMacroCommand->add( $pasteCommand );

        //移除复制命令对象
        //$demoMacroCommand->remove( $copyCommand );

        //请求者
        $invoker = new Invoker( $demoMacroCommand );
        $invoker->action();
    }

    /**
     *状态模式
     */
    public function actionState(){

        Yii::import('ext.state.*');
        $objContext = new Context(new StateB()); 
        $objContext->request(); 
        $objContext->request(); 
        $objContext->request(); 
        $objContext->request(); 
        $objContext->request();

    }

    /**
     *职责链模式
     */
    public function actionChain(){
    
        Yii::import('ext.chain.*');
        $chainZero = new ChainZero();
        $chainEven = new ChainEven();
        $chainOdd = new ChainOdd();
        $chainZero->setChain($chainEven);
        $chainEven->setChain($chainOdd);
        foreach(array(2,3,4,5,0) as $num) 
        { 
            $chainZero->handleRequest($num); 
        }
    }

    /**
     *解释器模式
     */
    public function actionExpression(){
    
        Yii::import('ext.expression.*');
        $obj = new Interpreter(); 
        $obj->execute("12345abc");
    }
    
    /**
     * 中介者模式
     */
    public function actionMediator(){
    	
        Yii::import('ext.mediator.*');
    	$objMediator = new ConcreteMediator();
    	$objCA = new ColleagueA($objMediator);
    	$objCB = new ColleagueB($objMediator);
    	$objMediator->set($objCA,$objCB);
    	$objCA->send("去吃饭");
    	$objCB->send("不去");
     	$objCA->send("那回家");
    	$objCB->send("不回");
    	 
    }
    
    /**
     *访问者模式 
     */
    public function actionVisitor(){
        
        Yii::import('ext.visitor.*');
    	$objOS = new ObjectStructure();
    	$objOS->attach(new ConcreteElementA());
    	$objOS->attach(new ConcreteElementB());
    	$objCV1 = new ConcreteVisitor1();
    	$objCV2 = new ConcreteVisitor2();
        $objOS->accept($objCV1);
    	$objOS->accept($objCV2);
    	
    }
}
