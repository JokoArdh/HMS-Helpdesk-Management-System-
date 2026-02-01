<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    private $permissions = [

        'dashboard' => [
            'view'
        ],

        'keluhan' => [
            'view',
            'create',
            'update', //dibatesi form IT, User dan Manager
            'delete',
        ],

        'user' => [
            'view',
            'create',
            'update', // Admin bisa ubah status (active/inactive) | user dftar otomatis assign role 'user'
            'delete'
        ],

        'log-eror' => [
            'view',
            'create',
            'update',
            'delete',
            'export'
        ],

        'kategori' => [
            'view',
            'create',
            'update',
            'delete'
        ],

        'barang' => [
            'view',
            'create',
            'update',
            'delete'
        ],

        'transaksi' => [
            'view',
            'create', // IT bisa menambah barang masuk/keluar
            'update', // IT bisa Approve    /Rejecet transaksi dan User tidak bisa mengubbah statusnya
            'approved', // IT Approved
            'export'
        ],

        'riwayat' => [
            'view',
            'create',
            'update', // dibatesi form IT dan Manager
            'export'
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ( $this->permissions as $key => $value ) {
            foreach ( $value as $permission ){
                Permission::firstOrCreate([
                    'name' => $key . '-' . $permission,
                    'guard_name' => 'web',
                ]);
            }
        }

        //pemberian permission
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web'])
            ->givePermissionTo(Permission::all());
        
        Role::firstOrCreate(['name' => 'it', 'guard_name' => 'web'])
            ->givePermissionTo([
                'dashboard-view',
                'kategori-view',
                'kategori-create',
                'kategori-update',
                'kategori-delete',
                'barang-view',
                'barang-create',
                'barang-update',
                'barang-delete',
                'log-eror-view',
                'log-eror-create',
                'log-eror-update',
                'log-eror-delete',
                'log-eror-export',
                'riwayat-view',
                'riwayat-export',
                'riwayat-update',
                'transaksi-view',
                'transaksi-create', // memasukan brang msuk ke stok tanpa persetujuan
                'transaksi-update', // untuk acc permintaan dari user
                'transaksi-approved',
                'transaksi-export',
            ]);
        Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web'])
            ->givePermissionTo([
                'dashboard-view',
                'transaksi-view',
                'transaksi-export',
                'riwayat-view',
                'riwayat-export',
                'keluhan-view',
                'keluhan-update' // agar bisa update status(open/closed)
            ]);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web'])
            ->givePermissionTo([
                'dashboard-view',
                'transaksi-view',
                'transaksi-create',
                'riwayat-view',
                'riwayat-create',
                'keluhan-view',
                'keluhan-create',
                'keluhan-update',
                'keluhan-delete'
            ]);
    }
}
