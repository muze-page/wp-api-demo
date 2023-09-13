<?php
//后端代码
// 检查请求方法是否为 GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 获取当前时间
    $current_time = date('Y-m-d H:i:s');

    // 构建响应数据
    $response = [
        'message' => '你好，' . $current_time,
    ];

    // 将响应数据转换为 JSON 格式
    $json_response = json_encode($response);

    // 设置响应头部为 JSON，并允许跨域请求
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: http://localhost:10004'); // 请根据实际情况修改来源

    // 发送响应数据
    echo $json_response;
} else {
    // 返回错误响应
    $response = [
        'error' => '无效的请求方法',
    ];

    // 将响应数据转换为 JSON 格式
    $json_response = json_encode($response);

    // 设置响应头部为 JSON，并允许跨域请求
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: http://localhost:10004'); // 请根据实际情况修改来源

    // 发送响应数据
    echo $json_response;
}
