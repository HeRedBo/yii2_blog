<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    	// other code...
	    'helper' => [
	        'class' => 'common\components\Helper',
	        'property' => '123',
	    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 配置语言
	    'language'=>'zh-CN',
        //authManager有PhpManager和DbManager两种方式,
        //PhpManager将权限关系保存在文件里,这里使用的是DbManager方式,将权限关系保存在数据库.
        "authManager" => [
            "class" => 'yii\rbac\DbManager',
        ],
	    // 配置时区
	    //'timeZone'=>'Asia/Chongqing',
	    ],
];
