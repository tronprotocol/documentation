#  Tron内置http接口说明


wallet/getaccount
作用：返回一个账号的信息
demo: curl -X POST  http://127.0.0.1:8090/wallet/getaccount -d '{"address": "41E552F6487585C2B58BC2C9BB4492BC1F17132CD0"}'
参数说明：address 需要转为hexString
返回值：Account对象

