<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'habit_create',
            ],
            [
                'id'    => 18,
                'title' => 'habit_edit',
            ],
            [
                'id'    => 19,
                'title' => 'habit_show',
            ],
            [
                'id'    => 20,
                'title' => 'habit_delete',
            ],
            [
                'id'    => 21,
                'title' => 'habit_access',
            ],
            [
                'id'    => 22,
                'title' => 'survey_create',
            ],
            [
                'id'    => 23,
                'title' => 'survey_edit',
            ],
            [
                'id'    => 24,
                'title' => 'survey_show',
            ],
            [
                'id'    => 25,
                'title' => 'survey_delete',
            ],
            [
                'id'    => 26,
                'title' => 'survey_access',
            ],
            [
                'id'    => 27,
                'title' => 'answer_create',
            ],
            [
                'id'    => 28,
                'title' => 'answer_edit',
            ],
            [
                'id'    => 29,
                'title' => 'answer_show',
            ],
            [
                'id'    => 30,
                'title' => 'answer_delete',
            ],
            [
                'id'    => 31,
                'title' => 'answer_access',
            ],
            [
                'id'    => 32,
                'title' => 'agent_create',
            ],
            [
                'id'    => 33,
                'title' => 'agent_edit',
            ],
            [
                'id'    => 34,
                'title' => 'agent_show',
            ],
            [
                'id'    => 35,
                'title' => 'agent_delete',
            ],
            [
                'id'    => 36,
                'title' => 'agent_access',
            ],
            [
                'id'    => 37,
                'title' => 'scheduler_create',
            ],
            [
                'id'    => 38,
                'title' => 'scheduler_edit',
            ],
            [
                'id'    => 39,
                'title' => 'scheduler_show',
            ],
            [
                'id'    => 40,
                'title' => 'scheduler_delete',
            ],
            [
                'id'    => 41,
                'title' => 'scheduler_access',
            ],
            [
                'id'    => 42,
                'title' => 'user_habit_create',
            ],
            [
                'id'    => 43,
                'title' => 'user_habit_edit',
            ],
            [
                'id'    => 44,
                'title' => 'user_habit_show',
            ],
            [
                'id'    => 45,
                'title' => 'user_habit_delete',
            ],
            [
                'id'    => 46,
                'title' => 'user_habit_access',
            ],
            [
                'id'    => 47,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 48,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 49,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 50,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 51,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
