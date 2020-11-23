<?php

use Illuminate\Database\Seeder;
use Modules\Settings\Entities\AdminNavigation;

class AdminNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
              "id" => 1,
              "title" => "Dashboard",
              "uri" => "admin/dashboard",
              "icon_class" => "fas fa-tachometer-alt",
              "parent_id" => 0,
              "status" => 1,
              "created_at" => "2020-07-26T18:23:31.000000Z",
              "updated_at" => "2020-11-23T16:54:54.000000Z",
              "nav_order" => 1,
              "roles_allowed" => "[\"3\", \"2\", \"4\", \"1\"]"
            ],
            [
              "id" => 2,
              "title" => "Users",
              "uri" => "admin/users",
              "icon_class" => "fa fa-users",
              "parent_id" => 0,
              "status" => 1,
              "created_at" => "2020-07-26T18:25:31.000000Z",
              "updated_at" => "2020-07-27T05:04:00.000000Z",
              "nav_order" => 2,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 3,
              "title" => "CMS",
              "uri" => "#",
              "icon_class" => "fas fa-palette",
              "parent_id" => 0,
              "status" => 1,
              "created_at" => "2020-07-26T18:32:02.000000Z",
              "updated_at" => "2020-07-27T09:39:29.000000Z",
              "nav_order" => 3,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 4,
              "title" => "News",
              "uri" => "admin/cms/list/news",
              "icon_class" => "far fa-newspaper",
              "parent_id" => 3,
              "status" => 1,
              "created_at" => "2020-07-26T18:34:02.000000Z",
              "updated_at" => "2020-07-27T09:02:39.000000Z",
              "nav_order" => 5,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 5,
              "title" => "Blogs",
              "uri" => "admin/cms/list/blog",
              "icon_class" => "fa fa-file",
              "parent_id" => 3,
              "status" => 1,
              "created_at" => "2020-07-26T18:34:41.000000Z",
              "updated_at" => "2020-07-27T09:02:39.000000Z",
              "nav_order" => 6,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 6,
              "title" => "Pages",
              "uri" => "admin/cms/list/page",
              "icon_class" => "far fa-file-alt",
              "parent_id" => 3,
              "status" => 1,
              "created_at" => "2020-07-26T18:53:06.000000Z",
              "updated_at" => "2020-07-27T09:02:39.000000Z",
              "nav_order" => 4,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 7,
              "title" => "Setup",
              "uri" => "#",
              "icon_class" => "fa fa-cogs",
              "parent_id" => 0,
              "status" => 1,
              "created_at" => "2020-07-27T04:50:16.000000Z",
              "updated_at" => "2020-11-23T16:29:33.000000Z",
              "nav_order" => 13,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 8,
              "title" => "App Settings",
              "uri" => "app/settings",
              "icon_class" => "fa fa-cog",
              "parent_id" => 7,
              "status" => 1,
              "created_at" => "2020-07-27T05:25:02.000000Z",
              "updated_at" => "2020-11-23T16:56:28.000000Z",
              "nav_order" => 17,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 9,
              "title" => "Admin Navigation",
              "uri" => "app/settings/admin_nav",
              "icon_class" => "fa fa-cog",
              "parent_id" => 7,
              "status" => 1,
              "created_at" => "2020-07-27T06:01:39.000000Z",
              "updated_at" => "2020-11-22T12:36:55.000000Z",
              "nav_order" => 14,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 10,
              "title" => "User Navigation",
              "uri" => "app/settings/user_nav",
              "icon_class" => "fa fa-cog",
              "parent_id" => 12,
              "status" => 1,
              "created_at" => "2020-07-28T17:21:59.000000Z",
              "updated_at" => "2020-11-22T12:32:09.000000Z",
              "nav_order" => 11,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 11,
              "title" => "Services",
              "uri" => "admin/cms/list/service",
              "icon_class" => "fa fa-cog",
              "parent_id" => 3,
              "status" => 1,
              "created_at" => "2020-07-28T17:22:44.000000Z",
              "updated_at" => "2020-08-30T17:30:25.000000Z",
              "nav_order" => 7,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 12,
              "title" => "Appearance",
              "uri" => "#",
              "icon_class" => "fa fa-palette",
              "parent_id" => 0,
              "status" => 1,
              "created_at" => "2020-07-29T16:20:20.000000Z",
              "updated_at" => "2020-11-22T12:32:09.000000Z",
              "nav_order" => 10,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 13,
              "title" => "My Themes",
              "uri" => "app/themes",
              "icon_class" => "fa fa-palette",
              "parent_id" => 12,
              "status" => 1,
              "created_at" => "2020-08-09T04:45:47.000000Z",
              "updated_at" => "2020-11-22T12:32:09.000000Z",
              "nav_order" => 12,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 14,
              "title" => "Page Types",
              "uri" => "admin/page_type",
              "icon_class" => "far fa-file",
              "parent_id" => 7,
              "status" => 1,
              "created_at" => "2020-08-15T03:04:07.000000Z",
              "updated_at" => "2020-11-22T12:32:09.000000Z",
              "nav_order" => 18,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 15,
              "title" => "FIle Manager",
              "uri" => "admin/file-manager",
              "icon_class" => "fa fa-file",
              "parent_id" => 0,
              "status" => 1,
              "created_at" => "2020-08-17T17:36:07.000000Z",
              "updated_at" => "2020-11-22T12:32:09.000000Z",
              "nav_order" => 9,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 16,
              "title" => "Admin Roles",
              "uri" => "admin/roles",
              "icon_class" => "fas fa-user-tag",
              "parent_id" => 7,
              "status" => 1,
              "created_at" => "2020-09-02T16:51:39.000000Z",
              "updated_at" => "2020-11-22T12:37:09.000000Z",
              "nav_order" => 15,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 17,
              "title" => "Admin Permission",
              "uri" => "admin/permissions",
              "icon_class" => "fas fa-universal-access",
              "parent_id" => 7,
              "status" => 1,
              "created_at" => "2020-09-02T17:27:42.000000Z",
              "updated_at" => "2020-11-23T16:27:01.000000Z",
              "nav_order" => 16,
              "roles_allowed" => "[\"3\"]"
            ],
            [
              "id" => 18,
              "title" => "Gallery",
              "uri" => "admin/cms/list/gallery",
              "icon_class" => "fa fa-image",
              "parent_id" => 3,
              "status" => 1,
              "created_at" => "2020-11-22T12:31:49.000000Z",
              "updated_at" => "2020-11-22T12:32:09.000000Z",
              "nav_order" => 8,
              "roles_allowed" => "[\"3\", \"2\", \"4\"]"
            ]
        ];

        AdminNavigation::create($records);
    }
}
