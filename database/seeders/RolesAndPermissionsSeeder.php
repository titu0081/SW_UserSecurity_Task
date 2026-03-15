<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::firstOrCreate(['name' => 'create tasks', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'edit tasks', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'delete tasks', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'show tasks', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'read users', 'guard_name' => 'web']);

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'show tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'read users',
        ]);

        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editor->syncPermissions([
            'show tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
        ]);

        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $user->syncPermissions(['show tasks']);
    }
}