<?php

//注册动作

add_action('wp_ajax_nopriv_get_xh_callback', 'get_xh_callback');
add_action('wp_ajax_get_xh_callback', 'get_xh_callback');

function get_xh_callback()
{
    $config = get_option('api_object_option');
    $key = $config->key;
    $url = 'https://api.topthink.com/xinhua/query';
    $data = [
        'word' => $_POST['word']
    ];
    $data = wp_json_encode($data);

    $options = [
        'body' => $data,
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'AppCode ' . $key
        ]
    ];
    // 发起请求
    $response = wp_remote_post($url, $options);

    if (!is_wp_error($response) && $response['response']['code'] === 200) {
        $content = json_decode($response['body'], true);
        wp_send_json_success($content);
    } else {
        wp_send_json_error('请求出错');
        error_log('请求出错');
    }
}


//测试用
add_action('wp_ajax_nopriv_get_test_callback', 'get_test_callback');
add_action('wp_ajax_get_test_callback', 'get_test_callback');

function get_test_callback()
{

    $url = 'https://rouse.npc.ink/wp-content/uploads/test.php';
   

    $options = [
        'body' => '',
        'headers' => [
            'Content-Type' => 'application/json',
           
        ]
    ];
    // 发起请求
    $response = wp_remote_get($url, $options);

    if (!is_wp_error($response) && $response['response']['code'] === 200) {
        $content = json_decode($response['body'], true);
        wp_send_json_success($content);
    } else {
        wp_send_json_error('请求出错');
        error_log('请求出错');
    }
}
