<?php

//面包屑

// 后台首页
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('后台首页', route('home'));
});

// 后台首页/用户管理
Breadcrumbs::register('user', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('用户管理', url('admin/user'));
});

// 后台首页/类别管理
Breadcrumbs::register('category', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('类别管理', url('admin/category'));
});

// 后台首页/文章管理
Breadcrumbs::register('article', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('文章管理', url('admin/article'));
});

// 后台首页/文章管理/添加文章
Breadcrumbs::register('articleCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('article');
    $breadcrumbs->push('添加文章', url('admin/article/create'));
});

// 后台首页/导航栏管理
Breadcrumbs::register('nav', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('导航栏管理', url('admin/nav'));
});

// 后台首页/日记管理
Breadcrumbs::register('diary', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('日记管理', url('admin/diary'));
});

// 后台首页/日记管理/添加日记
Breadcrumbs::register('diaryCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('diary');
    $breadcrumbs->push('添加日记', url('admin/diary/create'));
});

// 后台首页/推荐链接管理
Breadcrumbs::register('link', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('推荐链接管理', url('admin/link'));
});