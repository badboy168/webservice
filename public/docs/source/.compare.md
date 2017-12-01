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

#general
<!-- START_b2892eb191cd19c0a6f1aae56ba43db4 -->
## Display a listing of the resource.

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
[
    "index"
]
```

### HTTP Request
`GET api/v1/user`

`HEAD api/v1/user`


<!-- END_b2892eb191cd19c0a6f1aae56ba43db4 -->

<!-- START_b77cc60ec781668eff0888aa705fd258 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET "http://127.0.0.1:9010/api/v1/user/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user/create",
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
`GET api/v1/user/create`

`HEAD api/v1/user/create`


<!-- END_b77cc60ec781668eff0888aa705fd258 -->

<!-- START_96b8840d06e94c53a87e83e9edfb44eb -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://127.0.0.1:9010/api/v1/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/user`


<!-- END_96b8840d06e94c53a87e83e9edfb44eb -->

<!-- START_eda2b3d78b052ccb36bffab3b344d72a -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://127.0.0.1:9010/api/v1/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user/{user}",
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
`GET api/v1/user/{user}`

`HEAD api/v1/user/{user}`


<!-- END_eda2b3d78b052ccb36bffab3b344d72a -->

<!-- START_f5dcd1a863721e6fed25439283ccab97 -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl -X GET "http://127.0.0.1:9010/api/v1/user/{user}/edit" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user/{user}/edit",
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
`GET api/v1/user/{user}/edit`

`HEAD api/v1/user/{user}/edit`


<!-- END_f5dcd1a863721e6fed25439283ccab97 -->

<!-- START_1006d782d67bb58039bde349972eb2f0 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://127.0.0.1:9010/api/v1/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user/{user}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/user/{user}`

`PATCH api/v1/user/{user}`


<!-- END_1006d782d67bb58039bde349972eb2f0 -->

<!-- START_a5d7655acadc1b6c97d48e68f1e87be9 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://127.0.0.1:9010/api/v1/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://127.0.0.1:9010/api/v1/user/{user}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/user/{user}`


<!-- END_a5d7655acadc1b6c97d48e68f1e87be9 -->

