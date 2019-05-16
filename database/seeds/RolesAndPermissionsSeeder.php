<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'Добавить лида']);
        Permission::create(['name' => 'Редактировать сделку со статусом Проверка анкеты']);
        Permission::create(['name' => 'Редактировать сделку со статусом Подписан']);
        Permission::create(['name' => 'Редактировать сделку со статусом Выдан']);
        Permission::create(['name' => 'Редактировать сделку со статусом Отказ']);
        Permission::create(['name' => 'Редактировать сделку со статусом Закрыта']);
        Permission::create(['name' => 'Редактировать сделку со статусом Назначить встречу']);
        Permission::create(['name' => 'Редактировать сделку со статусом Встреча назначена']);
        Permission::create(['name' => 'Задать вопрос']);
        Permission::create(['name' => 'Ответить на вопрос']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'Частный инвестор']);
        $role->givePermissionTo('Добавить лида');
        $role->givePermissionTo('Редактировать сделку со статусом Проверка анкеты');
        $role->givePermissionTo('Редактировать сделку со статусом Подписан');
        $role->givePermissionTo('Редактировать сделку со статусом Назначить встречу');
        $role->givePermissionTo('Редактировать сделку со статусом Встреча назначена');
        $role->givePermissionTo('Задать вопрос');

        $role = Role::create(['name' => 'Администратор']);
        $role->givePermissionTo('Редактировать сделку со статусом Проверка анкеты');
        $role->givePermissionTo('Редактировать сделку со статусом Подписан');
        $role->givePermissionTo('Редактировать сделку со статусом Выдан');
        $role->givePermissionTo('Редактировать сделку со статусом Отказ');
        $role->givePermissionTo('Редактировать сделку со статусом Закрыта');
        $role->givePermissionTo('Редактировать сделку со статусом Назначить встречу');
        $role->givePermissionTo('Редактировать сделку со статусом Встреча назначена');
        $role->givePermissionTo('Ответить на вопрос');
        //  $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Андеррайтер']);
        //  $role->givePermissionTo(Permission::all());
        $role->givePermissionTo('Редактировать сделку со статусом Проверка анкеты');
        $role->givePermissionTo('Редактировать сделку со статусом Подписан');
        $role->givePermissionTo('Редактировать сделку со статусом Выдан');
        $role->givePermissionTo('Редактировать сделку со статусом Отказ');
        $role->givePermissionTo('Редактировать сделку со статусом Закрыта');
        $role->givePermissionTo('Редактировать сделку со статусом Назначить встречу');
        $role->givePermissionTo('Редактировать сделку со статусом Встреча назначена');
    }
}
