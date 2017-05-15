# TSClass 接口文档 - 学生端

## 目录

1.  <a href="#login">登入</a>
2.  <a href="#register">注册</a>
3.  <a href="#addCourse">添加课程</a>
4.  <a href="#getCourseList">获取课程列表</a>
5.  <a href="#getAnsweredList">获取问答列表>/a>
6.  <a href="#getNoticeList">获取消息列表>/a>

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
{"data":1,"info":"登陆成功!","status":1}
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
{"data":2,"info":"注册成功!","status":1}
```

**3.<span id="addCourse">添加课程</span>**

###### 接口功能

> 为当前学生添加一门新的课程

###### URL

> [/student.php/Index/addCourse]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> cid | 是 | int | 课程id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 选课id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/addCourse]()
> 
> 参数： 无


``` javascript
{"data":1,"info":"添加课程成功!","status":1}
```

**4.<span id="getCourseList">获取课程列表</span>**

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
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getCourseList]()
> 
> 参数： 无


``` javascript
{"data":[{"id":"1","title":"JAVA课程设计","description":"描述描述,不可描述","image":"1.jpg","username":"teacher"}],"info":"课程列表","status":1}
```

**5.<span id="getAnsweredList">获取问答列表</span>**

###### 接口功能

> 获取与自己有关或无关、指定或全部课程的问答列表(按时间倒叙返回前20条)
> 按照问题id获取指定问答内容

###### URL

> [/student.php/Index/getAnsweredList]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> cid | 否 | int | 指定课程id(若留空则返回所有课程的问答列表)
> related | 否 | int | 是否只返回与自己有关的问答列表
> qid | 否 | int | 是否返回指定问题id的内容(若使用此字段,则另外两个字段应留空)

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Array | 课程列表
> id | data | 问题id
> question | data | 问题标题
> answer | data | 问题答复
> cid | data | 课程id
> title | data | 课程名称
> teacher | data | 老师姓名
> student | data | 学生姓名
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getAnsweredList]()
> 
> 参数： cid=1& related=1


``` javascript
{"data":[{"id":"1","question":"wenti","answer":"daan","title":"JAVA课程设计","username":"teacher"}],"info":"读取成功!","status":1}
```

**6.<span id="getNoticeList">获取消息列表</span>**

###### 接口功能

> 获取与自己有关的消息列表(按时间倒叙返回前20条)

###### URL

> [/student.php/Index/getNoticeList]()

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
> id | data | 消息id
> cid | data | 课程id
> title | data | 课程名称
> content | data | 通知内容
> teacher | data | 老师姓名
> datetime | data | 通知时间
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getNoticeList]()
> 
> 参数： 无


``` javascript
{"data":[{"id":"1","cid":"1","title":"JAVA课程设计","content":"通知通知!","teacher":"teacher","datetime":"2017-05-15 15:22:58"}],"info":"读取成功!","status":1}
```