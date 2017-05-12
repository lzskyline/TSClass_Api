# TSClass 接口文档 - 学生端

## 目录

1.  <a href="#login">登入</a>

***

**1.<span id="login">登入</span>**

###### 接口功能

> 使用用户名密码登入系统

###### URL

> [/student.php/Index/login]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | ≤15字符
> pass | 是 | string | 通用密码安全限制

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | strInt | 用户id
> info | string | 提示信息
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/login]()
> 
> 参数： user=test& pass=123456


``` javascript
{"data":"1","info":"\u767b\u9646\u6210\u529f!","status":1}
```