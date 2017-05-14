# TSClass 接口文档 - 学生端

## 目录

1.  <a href="#login">登入</a>
2.  <a href="#register">注册</a>
2.  <a href="#getCourseList">获取课程列表</a>

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
> data | int | 用户id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/login]()
> 
> 参数： user=test& pass=123456


``` javascript
{"data":1,"info":"\u767b\u9646\u6210\u529f!","status":1}
```

**2.<span id="register">注册</span>**

###### 接口功能

> 注册学生账号以用于登录系统

###### URL

> [/student.php/Index/register]()

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
> data | int | 课程id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/register]()
> 
> 参数： user=test& pass=123456


``` javascript
{"data":2,"info":"\u6ce8\u518c\u6210\u529f!","status":1}
```
**3.<span id="getCourseList">课程列表</span>**

###### 接口功能

> 获取当前学生已选择的选课列表

###### URL

> [/student.php/Index/getCourseList]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 无

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Array | 课程列表
> id | data | 课程id
> title | data | 课程名
> description | data | 课程介绍
> image | data | 教师姓名
> username | data | 课程封面图url
> info | string | 课程名
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getCourseList]()
> 
> 参数： 无


``` javascript
{"data":[{"id":"1","title":"JAVA\u8bfe\u7a0b\u8bbe\u8ba1","description":"\u63cf\u8ff0\u63cf\u8ff0,\u4e0d\u53ef\u63cf\u8ff0","image":"1.jpg","username":"teacher"}],"info":"\u8bfe\u7a0b\u5217\u8868","status":1}
```