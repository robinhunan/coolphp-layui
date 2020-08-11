<?php
/**
*  管理系统首页
* @author:
*/
class c_index{

	function clearCache(){
		msg::json(1);
	}

	function index(){
		$manager = new manager();
		$info = $manager->getLoginInfo();
		include APP_PATH.("view/index/index.php");
	}

	function initMenu(){
		echo '{
  "homeInfo": {
    "title": "首页",
    "href": "about:blank"
  },
  "logoInfo": {
    "title": "后台管理系统",
    "image": "/favicon.ico",
    "href": ""
  },
  "menuInfo": [
    {
      "title": "常用功能",
      "icon": "fa fa-address-book",
      "href": "",
      "target": "_self",
      "child": [
        {
          "title": "用户管理",
          "href": "",
          "icon": "fa fa-home",
          "target": "_self",
          "child": [
            {
              "title": "用户",
              "href": "?c=app1_user",
              "icon": "fa fa-user",
              "target": "_self"
            },
			{
              "title": "管理员",
              "href": "?c=manager",
              "icon": "fa fa-user",
              "target": "_self"
            }
          ]
        },
        {
          "title": "其它功能",
          "href": "",
          "icon": "fa fa-snowflake-o",
          "target": "",
          "child": [
            {
              "title": "代码生成",
              "href": "../tools",
              "icon": "fa fa-shield",
              "target": "_self"
            }
          ]
        }
      ]
    },
    {
      "title": "其它管理",
      "icon": "fa fa-slideshare",
      "href": "",
      "target": "_self",
      "child": [
        {
          "title": "多级菜单",
          "href": "",
          "icon": "fa fa-meetup",
          "target": "",
          "child": [
            {
              "title": "按钮1",
              "href": "page/button.html?v=1",
              "icon": "fa fa-calendar",
              "target": "_self",
              "child": [
                {
                  "title": "按钮2",
                  "href": "page/button.html?v=2",
                  "icon": "fa fa-snowflake-o",
                  "target": "_self",
                  "child": [
                    {
                      "title": "按钮3",
                      "href": "page/button.html?v=3",
                      "icon": "fa fa-snowflake-o",
                      "target": "_self"
                    },
                    {
                      "title": "表单4",
                      "href": "page/form.html?v=1",
                      "icon": "fa fa-calendar",
                      "target": "_self"
                    }
                  ]
                }
              ]
            }
          ]
        },
        {
          "title": "失效菜单",
          "href": "page/error.html",
          "icon": "fa fa-superpowers",
          "target": "_self"
        }
      ]
    }
  ]
}';
	}

}
