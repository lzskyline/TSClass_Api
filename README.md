# TSClass 接口文档 - 学生端

## 目录

1.  <a href="#user-content-login">登入</a>
2.  <a href="#user-content-register">注册</a>
3.  <a href="#user-content-addCourse">添加课程</a>
4.  <a href="#user-content-getCourseList">获取课程列表</a>
5.  <a href="#user-content-getAnsweredList">获取问答列表</a>
6.  <a href="#user-content-getNoticeList">获取消息列表</a>
7.  <a href="#user-content-getChapterList">获取章节列表</a>
8.  <a href="#user-content-getCourseware">获取小节课件</a>
9.  <a href="#user-content-getHomework">获取小节作业</a>
10.  <a href="#user-content-getPunchList">获取签到记录</a>
11.  <a href="#user-content-punchCard">打卡签到</a>
12.  <a href="#user-content-postQuestion">提交问题</a>
12.  <a href="#user-content-postScore">提交成绩</a>

***

**1.<a id="login">登入</a>**

###### 接口功能

> 使用用户名和密码登入系统

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

**2.<a id ="user-content-register">注册</a>**

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

**3.<a id ="user-content-addCourse">添加课程</a>**

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
> 参数： cid=1


``` javascript
{"data":1,"info":"添加课程成功!","status":1}
```

**4.<a id ="user-content-getCourseList">获取课程列表</a>**

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
> data | Array | 列表数组
> id | data->string | 课程id
> title | data->string | 课程名
> description | data->string | 课程介绍
> image | data->string | 课程封面图url(存放路径为:基础地址/images/)
> username | data->string | 教师姓名
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getCourseList]()
> 
> 参数： 无


``` javascript
{
  "data": [
    {
      "id": "1",
      "title": "JAVA课程设计",
      "description": "描述描述,不可描述",
      "image": "1.jpg",
      "teacher": "teacher"
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**5.<a id ="user-content-getAnsweredList">获取问答列表</a>**

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
> data | Array | 列表数组
> id | data->string | 问题id
> question | data->string | 问题标题
> answer | data->string | 问题答复
> cid | data->string | 课程id
> title | data->string | 课程名称
> teacher | data->string | 老师姓名
> student | data->string | 学生姓名
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getAnsweredList]()
> 
> 参数： cid=1& related=1


``` javascript
{
  "data": [
    {
      "id": "2",
      "question": "问题问题",
      "answer": "",
      "title": "JAVA课程设计",
      "cid": "1",
      "teacher": "teacher",
      "student": "student"
    },
    {
      "id": "1",
      "question": "wenti",
      "answer": "daan",
      "title": "JAVA课程设计",
      "cid": "1",
      "teacher": "teacher",
      "student": "test"
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**6.<a id ="user-content-getNoticeList">获取消息列表</a>**

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
> data | Array | 列表数组
> id | data->string | 消息id
> cid | data->string | 课程id
> title | data->string | 课程名称
> content | data->string | 通知内容
> teacher | data->string | 老师姓名
> datetime | data->string | 通知时间
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getNoticeList]()
> 
> 参数： 无


``` javascript
{
  "data": [
    {
      "id": "1",
      "cid": "1",
      "title": "JAVA课程设计",
      "content": "全部同学 通知通知!",
      "teacher": "teacher",
      "datetime": "2017-05-15 15:22:58"
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**7.<a id ="user-content-getChapterList">获取章节列表</a>**

###### 接口功能

> 获取某一课程的全部章节

###### URL

> [/student.php/Index/getChapterList]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> cid | 是 | int | 指定课程id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Array | 列表数组
> title | data->string | 章名称
> nodes | data->Array | 节点数组(递归数组,格式与data相同)
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getChapterList]()
> 
> 参数： cid=1


``` javascript
{
  "data": [
    {
      "title": "序章",
      "nodes": [
        {
          "title": "序章1小节",
          "nodes": null
        }
      ]
    },
    {
      "title": "简述",
      "nodes": null
    },
    {
      "title": "入门",
      "nodes": [
        {
          "title": "入门1小节",
          "nodes": null
        },
        {
          "title": "入门2小节",
          "nodes": null
        }
      ]
    },
    {
      "title": "精通",
      "nodes": null
    },
    {
      "title": "实战",
      "nodes": null
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**8.<a id ="user-content-getCourseware">获取小节课件</a>**

###### 接口功能

> 获取某一小节的课件地址

###### URL

> [/student.php/Index/getCourseware]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> pid | 是 | int | 指定小节id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Array | 列表数组
> id | data->string | 课件id
> title | data->string | 课件标题
> url | data->string | 课件地址
> pid | data->string | 小节id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getCourseware]()
> 
> 参数： pid=6


``` javascript
{
  "data": [
    {
      "id": "1",
      "title": "序章课件",
      "url": "http://baidu.com/",
      "pid": "6"
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**9.<a id ="user-content-getHomework">获取小节作业</a>**

###### 接口功能

> 获取某一小节的作业列表

###### URL

> [/student.php/Index/getHomework]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> pid | 是 | int | 指定小节id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Array | 列表数组
> id | data->string | 作业id
> question | data->string | 问题题目
> choice | data->string | 选项集合(换行符分割)
> answer | data->string | 正确答案(0为第1行)
> pid | data->string | 小节id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getHomework]()
> 
> 参数： pid=6


``` javascript
{
  "data": [
    {
      "id": "1",
      "question": "这个问题的正确答案是选择2,你选哪个?",
      "choices": "选择1\r\n选择2\r\n选择3\r\n选择4",
      "answer": "1",
      "pid": "6"
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**10.<a id ="user-content-getPunchList">获取签到记录</a>**

###### 接口功能

> 获取某一课程的签到记录(时间倒序)

###### URL

> [/student.php/Index/getPunchList]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> cid | 是 | int | 指定课程id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Array | 列表数组
> id | data->string | 签到id
> sid | data->string | 学生id
> cid | data->string | 课程id
> datetime | data->string | 签到时间
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/getPunchList]()
> 
> 参数： cid=1


``` javascript
{
  "data": [
    {
      "id": "3",
      "sid": "2",
      "cid": "1",
      "datetime": "2017-05-16 17:09:38"
    },
    {
      "id": "2",
      "sid": "2",
      "cid": "1",
      "datetime": "2017-05-15 16:33:39"
    },
    {
      "id": "1",
      "sid": "2",
      "cid": "1",
      "datetime": "2017-05-14 14:20:12"
    }
  ],
  "info": "读取成功!",
  "status": 1
}
```

**11.<a id ="user-content-punchCard">打卡签到</a>**

###### 接口功能

> 在课程允许签到时提交签到记录

###### URL

> [/student.php/Index/punchCard]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> cid | 是 | int | 指定课程id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 签到id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/punchCard]()
> 
> 参数： cid=1


``` javascript
{
  "data": 4,
  "info": "签到成功!",
  "status": 1
}
```

**12.<a id ="user-content-postQuestion">提交问题</a>**

###### 接口功能

> 在指定课程id下提交问题

###### URL

> [/student.php/Index/postQuestion]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> cid | 是 | int | 指定课程id
> question | 是 | string | 待提问的内容

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 问题id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/postQuestion]()
> 
> 参数： cid=1& question=问题问题


``` javascript
{
  "data": 3,
  "info": "提交成功!",
  "status": 1
}
```

**13.<a id ="user-content-postScore">提交成绩</a>**

###### 接口功能

> 提交小节作业的成绩

###### URL

> [/student.php/Index/postScore]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> pid | 是 | int | 指定小节id
> score | 是 | int | 最终成绩

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 问题id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/student.php/Index/postScore]()
> 
> 参数： pid=6& score=10


``` javascript
{
  "data": 3,
  "info": "提交成功!",
  "status": 1
}
```