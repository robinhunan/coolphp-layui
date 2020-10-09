/** layuiAdmin.std-v1.4.0 LPPL License By https://www.layui.com/admin/ */
;layui.extend({
  setter: 'config' //配置模块
  ,admin: 'lib/admin' //核心模块
  ,view: 'lib/view' //视图渲染模块
}).define(['setter', 'admin'], function(exports){
  var setter = layui.setter
  ,element = layui.element
  ,admin = layui.admin
  ,tabsPage = admin.tabsPage
  ,view = layui.view
  
  //打开标签页
  ,openTabsPage = function(url, text){
    //遍历页签选项卡
    var matchTo
    ,tabs = $('#LAY_app_tabsheader>li')
    ,path = url.replace(/(^http(s*):)|(\?[\s\S]*$)/g, '');
    

    
    text = text || '新标签页';
    

      var iframe = admin.tabsBody(admin.tabsPage.index).find('.layadmin-iframe');
      iframe[0].contentWindow.location.href = url;
   
  }
  
  ,APP_BODY = '#LAY_app_body', FILTER_TAB_TBAS = 'layadmin-layout-tabs'
  ,$ = layui.$, $win = $(window);
  
  //初始
  if(admin.screen() < 2) admin.sideFlexible();
  
  //将模块根路径设置为 controller 目录
  layui.config({
    base: setter.base + 'modules/'
  });
  
  //扩展 lib 目录下的其它模块
  layui.each(setter.extend, function(index, item){
    var mods = {};
    mods[item] = '{/}' + setter.base + 'lib/extend/' + item;
    layui.extend(mods);
  });
  
  view().autoRender();
  
  //加载公共模块
  layui.use('common');

  //对外输出
  exports('index', {
    openTabsPage: openTabsPage
  });
});

layui.jquery(function($) {
    var load;
    $.ajaxSetup({
        beforeSend: function(xhr) {
            load = layer.load(2);
        },
        complete: function(xhr) {
            layer.close(load);
        }
    });
});
