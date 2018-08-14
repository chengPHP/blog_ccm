<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //用户管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 1,
            'name' => 'user',
            'display_name' => '用户管理',
            'description' => '用户管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 2,
            'name' => 'create.user',
            'display_name' => '创建用户',
            'description' => '创建用户',
            'status' => 1,
            'pid' => 1,
            'path' => '0,1,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 3,
            'name' => 'show.user',
            'display_name' => '显示用户信息',
            'description' => '显示用户信息',
            'status' => 1,
            'pid' => 1,
            'path' => '0,1,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 4,
            'name' => 'edit.user',
            'display_name' => '修改用户信息',
            'description' => '修改用户信息',
            'status' => 1,
            'pid' => 1,
            'path' => '0,1,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 5,
            'name' => 'destroy.user',
            'display_name' => '删除用户',
            'description' => '删除用户',
            'status' => 1,
            'pid' => 1,
            'path' => '0,1,',
            'created_at' => date("Y-m-d H:i:s")
        ]);


        //类别管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 6,
            'name' => 'category',
            'display_name' => '类别管理',
            'description' => '类别管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 7,
            'name' => 'create.category',
            'display_name' => '创建类别',
            'description' => '创建类别',
            'status' => 1,
            'pid' => 6,
            'path' => '0,6,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 8,
            'name' => 'show.category',
            'display_name' => '显示类别',
            'description' => '显示类别',
            'status' => 1,
            'pid' => 6,
            'path' => '0,6,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 9,
            'name' => 'edit.category',
            'display_name' => '修改类别信息',
            'description' => '修改类别信息',
            'status' => 1,
            'pid' => 6,
            'path' => '0,6,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 10,
            'name' => 'destroy.category',
            'display_name' => '删除类别信息',
            'description' => '删除类别信息',
            'status' => 1,
            'pid' => 6,
            'path' => '0,6,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //文章管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 11,
            'name' => 'article',
            'display_name' => '文章管理',
            'description' => '文章管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 12,
            'name' => 'create.article',
            'display_name' => '创建文章',
            'description' => '创建文章',
            'status' => 1,
            'pid' => 11,
            'path' => '0,11,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 13,
            'name' => 'show.article',
            'display_name' => '显示文章信息',
            'description' => '显示文章信息',
            'status' => 1,
            'pid' => 11,
            'path' => '0,11,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 14,
            'name' => 'edit.article',
            'display_name' => '修改文章信息',
            'description' => '修改文章信息',
            'status' => 1,
            'pid' => 11,
            'path' => '0,11,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 15,
            'name' => 'destroy.article',
            'display_name' => '删除文章信息',
            'description' => '删除文章信息',
            'status' => 1,
            'pid' => 11,
            'path' => '0,11,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //导航栏管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 16,
            'name' => 'nav',
            'display_name' => '导航栏管理',
            'description' => '导航栏管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 17,
            'name' => 'create.nav',
            'display_name' => '添加导航栏',
            'description' => '添加导航栏',
            'status' => 1,
            'pid' => 16,
            'path' => '0,16,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 18,
            'name' => 'show.nav',
            'display_name' => '显示导航栏',
            'description' => '显示导航栏',
            'status' => 1,
            'pid' => 16,
            'path' => '0,16,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 19,
            'name' => 'edit.nav',
            'display_name' => '修改导航栏信息',
            'description' => '修改导航栏信息',
            'status' => 1,
            'pid' => 16,
            'path' => '0,16,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 20,
            'name' => 'destroy.nav',
            'display_name' => '删除导航栏',
            'description' => '删除导航栏',
            'status' => 1,
            'pid' => 16,
            'path' => '0,16,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //个人日记管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 21,
            'name' => 'diary',
            'display_name' => '个人日记管理',
            'description' => '个人日记管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 22,
            'name' => 'create.diary',
            'display_name' => '添加个人日记',
            'description' => '添加个人日记',
            'status' => 1,
            'pid' => 21,
            'path' => '0,21,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 23,
            'name' => 'show.diary',
            'display_name' => '显示个人日记',
            'description' => '显示个人日记',
            'status' => 1,
            'pid' => 21,
            'path' => '0,21,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 24,
            'name' => 'edit.diary',
            'display_name' => '修改个人日记信息',
            'description' => '修改个人日记信息',
            'status' => 1,
            'pid' => 21,
            'path' => '0,21,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 25,
            'name' => 'destroy.diary',
            'display_name' => '删除个人日记信息',
            'description' => '删除个人日记信息',
            'status' => 1,
            'pid' => 21,
            'path' => '0,21,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //留言管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 26,
            'name' => 'feedback',
            'display_name' => '留言管理',
            'description' => '留言管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 27,
            'name' => 'create.feedback',
            'display_name' => '添加留言',
            'description' => '添加留言',
            'status' => 1,
            'pid' => 26,
            'path' => '0,26,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 28,
            'name' => 'show.feedback',
            'display_name' => '显示留言信息',
            'description' => '显示留言信息',
            'status' => 1,
            'pid' => 26,
            'path' => '0,26,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 29,
            'name' => 'edit.feedback',
            'display_name' => '修改留言信息',
            'description' => '修改留言信息',
            'status' => 1,
            'pid' => 26,
            'path' => '0,26,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 30,
            'name' => 'destroy.feedback',
            'display_name' => '删除留言信息',
            'description' => '删除留言信息',
            'status' => 1,
            'pid' => 26,
            'path' => '0,26,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 31,
            'name' => 'reply.feedback',
            'display_name' => '回复留言',
            'description' => '回复留言',
            'status' => 1,
            'pid' => 26,
            'path' => '0,26,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //推荐链接管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 32,
            'name' => 'link',
            'display_name' => '推荐链接管理',
            'description' => '推荐链接管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 33,
            'name' => 'create.link',
            'display_name' => '添加推荐链接',
            'description' => '添加推荐链接',
            'status' => 1,
            'pid' => 32,
            'path' => '0,32,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 34,
            'name' => 'show.link',
            'display_name' => '显示推荐链接信息',
            'description' => '显示推荐链接信息',
            'status' => 1,
            'pid' => 32,
            'path' => '0,32,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 35,
            'name' => 'edit.link',
            'display_name' => '修改推荐链接信息',
            'description' => '修改推荐链接信息',
            'status' => 1,
            'pid' => 32,
            'path' => '0,32,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 36,
            'name' => 'destroy.link',
            'display_name' => '删除推荐链接',
            'description' => '删除推荐链接',
            'status' => 1,
            'pid' => 32,
            'path' => '0,32,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //角色管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 37,
            'name' => 'role',
            'display_name' => '角色管理',
            'description' => '角色管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 38,
            'name' => 'create.role',
            'display_name' => '添加角色',
            'description' => '添加角色',
            'status' => 1,
            'pid' => 37,
            'path' => '0,37,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 39,
            'name' => 'show.role',
            'display_name' => '显示角色信息',
            'description' => '显示角色信息',
            'status' => 1,
            'pid' => 37,
            'path' => '0,37,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 40,
            'name' => 'edit.role',
            'display_name' => '修改角色信息',
            'description' => '修改角色信息',
            'status' => 1,
            'pid' => 37,
            'path' => '0,37,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 41,
            'name' => 'destroy.role',
            'display_name' => '删除角色',
            'description' => '删除角色',
            'status' => 1,
            'pid' => 37,
            'path' => '0,37,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        //权限管理
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 42,
            'name' => 'permission',
            'display_name' => '权限管理',
            'description' => '权限管理',
            'status' => 1,
            'pid' => 0,
            'path' => '0,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 43,
            'name' => 'create.permission',
            'display_name' => '添加权限',
            'description' => '添加权限',
            'status' => 1,
            'pid' => 42,
            'path' => '0,42,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 44,
            'name' => 'show.permission',
            'display_name' => '显示权限信息',
            'description' => '显示权限信息',
            'status' => 1,
            'pid' => 42,
            'path' => '0,42,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 45,
            'name' => 'edit.permission',
            'display_name' => '修改权限信息',
            'description' => '修改权限信息',
            'status' => 1,
            'pid' => 42,
            'path' => '0,42,',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \Illuminate\Support\Facades\DB::table('Permissions')->insert([
            'id' => 46,
            'name' => 'destroy.permission',
            'display_name' => '删除权限',
            'description' => '删除权限',
            'status' => 1,
            'pid' => 42,
            'path' => '0,42,',
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
