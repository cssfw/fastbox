<?php

session_start();

include './function.php';

//获取链接
$web = $_GET['www'];

$pass = getpass('./admin');

//网站信息获取

$webmain = './admin/'.$pass.'/';

$indexmain = fget('./main','index.main');

$webmain = fget($webmain,'web.main');

$themecard = fget('./theme','card.box');

$pagedir = './admin/'.$pass.'/pages';

//获取网站名

$str = $webmain;

$pattern = "/<web:网站名>(.*?)<\/web:网站名>/s";

preg_match($pattern, $str, $matches);

$webname = $matches[1];



//获取描述

$pattern = "/<web:网站描述>(.*?)<\/web:网站描述>/s";

preg_match($pattern, $str, $matches);

$webds = $matches[1];



//获取管理员

$pattern = "/<web:网站管理员>(.*?)<\/web:网站管理员>/s";

preg_match($pattern, $str, $matches);

$webadmin = $matches[1];



//获取联系方式

$pattern = "/<web:联系>(.*?)<\/web:联系>/s";

preg_match($pattern, $str, $matches);

$webtalk = $matches[1];



//获取logo

$pattern = "/<web:logo>(.*?)<\/web:logo>/s";

preg_match($pattern, $str, $matches);

$weblogo = $matches[1];





//获取管理员入口

$str = $webmain;

$pattern = "/<web:管理入口>(.*?)<\/web:管理入口>/s";

preg_match($pattern, $str, $matches);

$admin_part = $matches[1];




//获取管理员账号

$str = $webmain;

$pattern = "/<web:管理账号>(.*?)<\/web:管理账号>/s";

preg_match($pattern, $str, $matches);

$admin_name = $matches[1];




//获取管理员密码

$str = $webmain;

$pattern = "/<web:管理密码>(.*?)<\/web:管理密码>/s";

preg_match($pattern, $str, $matches);

$admin_pass = $matches[1];


//组装页面

$webmain = fget('./theme','index.box');

$webmain = str_replace('<web:主页>', $webmain, $indexmain);


//获取文章

                  // 获取目录下所有文件名称及后缀，并存储到数组中
                        $dir = $pagedir; // 拼接目录路径
                        $files = array_diff(scandir($dir), array('..', '.')); // 获取目录中的文件，去除无关的.和..
                        $fileArray = array(); // 存储文件名数组
                        foreach ($files as $file) {
                            $fileArray[] = pathinfo($file, PATHINFO_FILENAME); // 获取文件名（不带后缀）
                        }
                        
                        $tocard = ""; // 初始化 $tocard 变量
                        $N = 1; // 设置 N 的初始值为 1
                        
                        // 循环运行的内容
                        foreach ($fileArray as $fileName) {
                            // 读取文件内容
                            $fileContent = file_get_contents($dir . '/' . $fileName . '.page');
                        
                            // 读取 <page:封面> 的内容并赋值给 $pageimg
                            preg_match('/<page:封面>(.*?)<\/page:封面>/s', $fileContent, $matchesTitle);
                            $pageimg = $matchesTitle[1];
                        
                            // 读取 <page:标题> 的内容并赋值给 $pagetitle
                            preg_match('/<page:标题>(.*?)<\/page:标题>/s', $fileContent, $matchesTitle);
                            $pagetitle = $matchesTitle[1];
                        
                            // 读取 <page:时间> 的内容并赋值给 $pagetime
                            preg_match('/<page:时间>(.*?)<\/page:时间>/s', $fileContent, $matchesTime);
                            $pagetime = $matchesTime[1];
                        
                            // 将文件名称赋值给 $pagelink
                            $pagelink = $fileName;
                        
                            // 读取 $themecard 的内容并复制给 $carda
                            $carda = $themecard;
                        
                            // 替换 $carda 中的 [tag:标题]、[tag:时间]、[tag:链接]
                            $carda = str_replace('[tag:标题]', $pagetitle, $carda);
                            $carda = str_replace('[tag:时间]', $pagetime, $carda);
                            $carda = str_replace('[tag:链接]', './page/'.$pagelink, $carda);
                            $carda = str_replace('[tag:封面]', $pageimg, $carda);
                        
                            // 将 $carda 内容连接到 $tocard 的末尾
                            $tocard .= $carda;
                        
                            // N 自增
                            $N++;
                        }
                        







$webmain = str_replace('[part:文章]', $tocard, $webmain);





$webmain = str_replace('[tag:网站名]', $webname, $webmain);

$webmain = str_replace('[tag:描述]', $webds, $webmain);

$webmain = str_replace('[tag:管理员]', $webadmin, $webmain);

$webmain = str_replace('[tag:联系]', $webtalk, $webmain);

$webmain = str_replace('[tag:logo]', $weblogo, $webmain);




if ($web =="/") {


echo $webmain;




}


//定义了一个后台登录页面


elseif ($web == $admin_part) {


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


if ($_POST['user'] == $admin_name and $_POST['pass'] == $admin_pass) {

echo '<i class="mdui-icon material-icons">done</i>登录成功!<div class="mdui-progress fixed-up-right">
  <div class="mdui-progress-indeterminate"></div>
</div><meta http-equiv="refresh" content="1.5;url=/main">';

$_SESSION['log'] = 1;


exit;


}
else {

echo "登录失败!";
exit;
}




}

$webmain = fget('./main','admin_login.main');

$webmain = str_replace('[LOGINPART]', $admin_part, $webmain);


echo $webmain;


}

//定义了一个后台主页面

elseif ($web == '/main' and $_SESSION['log'] == 1) {


$webmain = fget('./main','admin.main');

echo $webmain;


}

//定义了一个简单的API,用于获取目录结构,并且只在登陆状态下可以运行

elseif ($web == '/api-get-page' and $_SESSION['log'] == 1) {



// 定义要扫描的文件夹路径
$directory = './admin/'.$pass;

// 获取目录下的所有文件和文件夹
$files = scandir($directory);

// 遍历文件和文件夹
foreach ($files as $file) {
    // 排除当前目录（.）和父目录（..）
    if ($file != '.' && $file != '..') {
        // 获取文件类型：1为文件夹，0为文件
        $fileType = is_dir($directory . '/' . $file) ? 1 : 0;
        // 输出文件或文件夹的名称和类型
        echo $file . " " . $fileType . "<br>";
    }
}





}
else {

$text = $web;

$count = substr_count($text, "/");

if ($count == 2) {
$delimiter = "/";  // 请将"/"替换为你实际的分割符

$a = explode($delimiter, $text)[1];
$b = explode($delimiter, $text)[2];

if ($a == "page" and @file_get_contents($pagedir.'/'.$b.'.page')) {

$pagetext = file_get_contents($pagedir.'/'.$b.'.page');


//获取标题

$pattern = "/<page:标题>(.*?)<\/page:标题>/s";

preg_match($pattern, $pagetext, $matches);

$texttitle = $matches[1];

//获取封面

$pattern = "/<page:封面>(.*?)<\/page:封面>/s";

preg_match($pattern, $pagetext, $matches);

$textimg = $matches[1];

//获取时间

$pattern = "/<page:时间>(.*?)<\/page:时间>/s";

preg_match($pattern, $pagetext, $matches);

$texttime = $matches[1];

//获取正文

$pattern = "/<page:正文>(.*?)<\/page:正文>/s";

preg_match($pattern, $pagetext, $matches);

$textpage = $matches[1];

$webmain = file_get_contents("./theme/text.box");


$webmain = str_replace('[tag:网站名]', $webname, $webmain);

$webmain = str_replace('[tag:描述]', $webds, $webmain);

$webmain = str_replace('[tag:管理员]', $webadmin, $webmain);

$webmain = str_replace('[tag:联系]', $webtalk, $webmain);

$webmain = str_replace('[tag:logo]', $weblogo, $webmain);

$webmain = str_replace('[tag:标题]', $texttitle, $webmain);

$webmain = str_replace('[tag:时间]', $texttime, $webmain);

$webmain = str_replace('[tag:封面]', $textimg, $webmain);

$webmain = str_replace('[tag:正文]', $textpage, $webmain);




echo $webmain;

}
else {
echo file_get_contents("./theme/404.box");

}


}
elseif ($count != 2) {

echo file_get_contents("./theme/404.box");

}





}



?>
