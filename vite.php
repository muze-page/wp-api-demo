<?php
//载入资源
//加载 CSS 和 JS 资源
add_action('admin_enqueue_scripts',  'load_admin_script');
function load_admin_script($hook)
{
    $ver = "0.1";
    $name = "apis";
    //是否是指定页面
    //if ('settings_page_api_config' != $hook) {
    //    return;
    //}

    //准备地址
    $index_css = plugin_dir_url(__FILE__) . 'vite/dist/index.css';
    $index_js = plugin_dir_url(__FILE__) . 'vite/dist/index.js';


    wp_enqueue_style($name, $index_css, array(), $ver, false);
    wp_enqueue_script($name, $index_js, array(), $ver, true);


   //$pf_api_translation_array = array(
   //    //'ajaxurl' => admin_url('admin-ajax.php'),
   //);
   //wp_localize_script($name, 'dataLocal', $pf_api_translation_array); //传给vite项目

}


//对js文件进行module接入
add_filter('script_loader_tag','refund_type_script', 10, 2);
 //对js文件进行module接入
 function refund_type_script($tag, $handle)
 {
     // 在这里判断需要添加 type 属性的 JS 文件，比如文件名包含 xxx.js
     if (strpos($tag, 'index.js') !== false) {
         // 在 script 标签中添加 type 属性
         $tag = str_replace('<script', '<script type="module"', $tag);
     }
     return $tag;
 }