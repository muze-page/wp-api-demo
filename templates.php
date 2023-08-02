<?php
// 注册自定义页面模板
function add_custom_page_template($templates)
{
    $templates['custom-template.php'] = '搜词模版';
    return $templates;
}
add_filter('theme_page_templates', 'add_custom_page_template');

// 指定自定义页面模板的路径
function get_custom_template($template)
{
    if (!is_singular() || !$template) {
        return $template;
    }

    $custom_template = get_post_meta(get_queried_object_id(), '_wp_page_template', true);
    if ('custom-template.php' === basename($custom_template)) {
        $template = plugin_dir_path(__FILE__) . 'templates/custom-template.php';
    }

    return $template;
}
add_filter('template_include', 'get_custom_template');





