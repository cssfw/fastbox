<!doctype html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
  <meta name="renderer" content="webkit"/>
  <meta name="force-rendering" content="webkit"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

  <!-- MDUI CSS -->
  <link rel="stylesheet" href="/UI/css/mdui.min.css"/>  
  <link rel="stylesheet" href="./ftip.css"/>
  <!-- MDUI MORE CSS -->
  <link rel="stylesheet" href="/UI/md.css"/>
  <title>FurryBOX-数据中心-登陆🚦</title>
</head>
<body class="mdui-theme-primary-indigo">
<div id="mdui-md-load">
  <div class="mdui-progress">
    <div class="mdui-progress-indeterminate"></div>
  </div>
</div>



<div style="margin: 10px;">

<div class="row_us">
<div class="hidden">








<div class="hidden mdui-card">

  <!-- 卡片的媒体内容，可以包含图片、视频等媒体内容，以及标题、副标题 -->
  <div class="hidden mdui-card-media">
    <img src="/UI/we.png"/>

    <!-- 卡片中可以包含一个或多个菜单按钮 -->
    <div class="hidden mdui-card-menu">
      <button class="hidden mdui-btn mdui-btn-icon mdui-text-color-white">
        <i class="hidden mdui-icon material-icons">favorite</i>
      </button>
    </div>
  </div>

  <!-- 卡片的标题和副标题 -->
  <div class="hidden mdui-card-primary">
    <div class="hidden mdui-card-primary-title">FurryBOX-登陆</div>
    <div class="hidden mdui-card-primary-subtitle">请先登录账号</div>
  </div>
  <!-- 卡片的内容 -->
  <div class="hidden mdui-card-content">

  <form method="POST" action="http://222.187.239.156:2333/USER/login.php">
  
  <input class="input" placeholder="账号" type="number" name="user">
  <br><br>
  <input class="input" placeholder="密码" type="password" name="pass">
  
  
  
  <br><br>
  
  <div class="f-tip-in"></div>
  
  
  <button class="bt_bt b_blue mdui-btn mdui-ripple" type="submit" value="登陆"><i class="mdui-icon material-icons">arrow_forward</i>登陆</button></form>
  
  </div>


</div>




</div>



<!-- MDUI JavaScript -->
<script src="/UI/js/mdui.min.js"></script>


<script>
</script>


<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    var element = document.getElementById("mdui-md-load");
    element.classList.add("mdui-md-in");

    window.addEventListener("load", function() {

      element.classList.add("mdui-md-out");
      
    });
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const hiddenElements = document.querySelectorAll(".hidden");
    
    let index = 0;
    const interval = setInterval(() => {
        if (index >= hiddenElements.length) {
            clearInterval(interval);
            return;
        }
        
        const element = hiddenElements[index];
        element.classList.add("in-on");
        element.classList.remove("hidden");
        
        index++;
    }, 35);
});
</script>

<script>
// 获取页面中所有的form表单
var forms = document.getElementsByTagName('form');

// 遍历所有form表单
for (var i = 0; i < forms.length; i++) {
    var form = forms[i];
    
    // 监听form表单的提交事件
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // 阻止表单默认提交行为
        
        // 发送请求
        var formData = new FormData(form);
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // 将请求带来的结果输出
            f.tip(data, 3);
        })
        .catch(error => {
            f.tip(data, 1);
        });
    });
}

</script>





<script src="/UI/alert.js"></script>
<script src="./ftip.js"></script>

<script>
   // 等待页面加载完成后执行
window.onload = function() {
    // 延迟一秒钟后执行
    
    setTimeout(function() {
    
f.tip("页面已载入",3.5);
        Swal.fire({
            title: '<strong>提示</strong>',
            icon: 'info',
            html: '<b>在官方群内发送注册即可注册账号</b>',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> 知道了!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> 取消注册!',
            cancelButtonAriaLabel: 'Thumbs down'
        });
    }, 1000); // 设置延迟为1秒（1000毫秒）
};

</script>

</body>
</html>