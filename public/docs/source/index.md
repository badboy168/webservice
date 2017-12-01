---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://127.0.0.1:9010/docs/collection.json)
<!-- END_INFO -->

#客户端用户接口

所有的用户接口基本Res
User: mark
Date: 17/12/1
Time: 下午12:13
<!-- START_b2892eb191cd19c0a6f1aae56ba43db4 -->
## 获取用户列表

分页

> Example request:

```bash
curl -X GET "http://127.0.0.1:9010/api/v1/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/user`

`HEAD api/v1/user`


<!-- END_b2892eb191cd19c0a6f1aae56ba43db4 -->

<!-- START_02d045549b2678d1fc27a32573e1b9df -->
## 用户注册

> Example request:

```bash
curl -X POST "http://127.0.0.1:9010/api/v1/user/store" \
-H "Accept: application/json" \
    -d "title"="et" \
    -d "body"="et" \
    -d "type"="bar" \
    -d "thumbnail"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user/store",
    "method": "POST",
    "data": {
        "title": "et",
        "body": "et",
        "type": "bar",
        "thumbnail": "et"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/user/store`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Maximum: `255`
    body | string |  required  | 
    type | string |  optional  | `foo` or `bar`
    thumbnail | image |  optional  | Required if `type` is `foo` Must be an image (jpeg, png, bmp, gif, or svg)

<!-- END_02d045549b2678d1fc27a32573e1b9df -->

