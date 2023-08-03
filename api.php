<?php

/**
 * Plugin Name:       测试开发API接口功能
 * Plugin URI:        https://www.npc.ink
 * Description:       测试ThinkAPI 服务
 * Author:            Npcink
 * AuthorURI:         https://www.npc.ink
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       accordion
 *
 * @package           create-block
 */
//添加菜单

function api_menu()
{
    add_submenu_page(
        'options-general.php',
        'API测试',
        'API测试',
        'administrator',
        'api_config',
        'api_displays',
        '90.1', //顺序
    );
}
add_action('admin_menu', 'api_menu');

function api_displays()
{

?>
    <div class="wrap">
        <h1>API 测试</h1>
        <script src="https://unpkg.com/vue@3.3.4"></script>
        <div id="api"></div>
        <div id="apps"></div>
    </div>
<?
}

//加载JS
function load_admin_script_api()
{
    // 获取 my_object_option 的值
    $default_value = get_option('api_object_option');

    $index_js = plugin_dir_url(__FILE__) . 'main.js';
    wp_enqueue_script('api', $index_js, array(), '1.1', true);

    wp_localize_script('api', 'apiObjectOption', $default_value);
}
add_action('admin_enqueue_scripts', 'load_admin_script_api');



// 添加Ajax请求处理函数
add_action('wp_ajax_save_object_api_option_callback', 'save_object_api_option_callback');

function save_object_api_option_callback()
{
    // 获取通过 Ajax POST 请求传递的对象数据
    $object_data = $_POST['object_data'];

    // 将 JSON 字符串解析为 PHP 对象
    $object = json_decode(stripslashes($object_data));

    // 保存设置选项
    update_option('api_object_option', $object);

    // 发送成功响应
    $response = array(
        'message' => '设置选项已保存！',
        'object' => $object,
    );
    wp_send_json_success($response);
}


// 注册插件激活时的回调函数
register_activation_hook(__FILE__, 'my_plugin_activation_callback');

// 插件激活时的回调函数
function my_plugin_activation_callback()
{
    // 执行插件激活时需要的操作
    // 例如创建数据库表、初始化设置、添加默认数据等

    // 示例：创建一个选项并保存到数据库
    $my_option = array(
        'key' => '',
    );
    update_option('api_object_option', $my_option);
}

//加载接口
require_once plugin_dir_path(__FILE__) . 'interface.php';

//加载打包文件
require_once plugin_dir_path(__FILE__) . 'vite.php';

//加载页面模版
require_once plugin_dir_path(__FILE__) . 'templates.php';

//设置按钮
add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
    $links[] = '<a href="' . get_admin_url(null, 'options-general.php?page=api_config') . '">' . __('设置', 'n') . '</a>';
    return $links;
});
