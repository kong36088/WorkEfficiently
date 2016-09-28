<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['use_page_numbers'] = TRUE;
$config['num_links'] = 4;

$config['per_page'] = 20;

// 添加封装标签
$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
$config['full_tag_close'] = '</ul>';

// 自定义“当前页”链接
$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
$config['cur_tag_close'] = '</a></li>';

// 自定义“数字”链接
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

// 自定义“下一页”链接
$config['next_link'] = '下一页 »';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

// 自定义“上一页”链接
$config['prev_link'] = '« 上一页';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

// 自定义起始链接
$config['first_link'] = '首页';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

// 自定义结束链接
$config['last_link'] = '尾页';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['page_query_string'] = TRUE;
$config['query_string_segment'] = 'page';
