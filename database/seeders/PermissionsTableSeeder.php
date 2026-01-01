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
                'title' => 'financial_year_create',
            ],
            [
                'id'    => 18,
                'title' => 'financial_year_edit',
            ],
            [
                'id'    => 19,
                'title' => 'financial_year_show',
            ],
            [
                'id'    => 20,
                'title' => 'financial_year_delete',
            ],
            [
                'id'    => 21,
                'title' => 'financial_year_access',
            ],
            [
                'id'    => 22,
                'title' => 'division_create',
            ],
            [
                'id'    => 23,
                'title' => 'division_edit',
            ],
            [
                'id'    => 24,
                'title' => 'division_show',
            ],
            [
                'id'    => 25,
                'title' => 'division_delete',
            ],
            [
                'id'    => 26,
                'title' => 'division_access',
            ],
            [
                'id'    => 27,
                'title' => 'road_create',
            ],
            [
                'id'    => 28,
                'title' => 'road_edit',
            ],
            [
                'id'    => 29,
                'title' => 'road_show',
            ],
            [
                'id'    => 30,
                'title' => 'road_delete',
            ],
            [
                'id'    => 31,
                'title' => 'road_access',
            ],
            [
                'id'    => 32,
                'title' => 'package_create',
            ],
            [
                'id'    => 33,
                'title' => 'package_edit',
            ],
            [
                'id'    => 34,
                'title' => 'package_show',
            ],
            [
                'id'    => 35,
                'title' => 'package_delete',
            ],
            [
                'id'    => 36,
                'title' => 'package_access',
            ],
            [
                'id'    => 37,
                'title' => 'lot_create',
            ],
            [
                'id'    => 38,
                'title' => 'lot_edit',
            ],
            [
                'id'    => 39,
                'title' => 'lot_show',
            ],
            [
                'id'    => 40,
                'title' => 'lot_delete',
            ],
            [
                'id'    => 41,
                'title' => 'lot_access',
            ],
            [
                'id'    => 42,
                'title' => 'lot_item_create',
            ],
            [
                'id'    => 43,
                'title' => 'lot_item_edit',
            ],
            [
                'id'    => 44,
                'title' => 'lot_item_show',
            ],
            [
                'id'    => 45,
                'title' => 'lot_item_delete',
            ],
            [
                'id'    => 46,
                'title' => 'lot_item_access',
            ],
            [
                'id'    => 47,
                'title' => 'employee_manage_access',
            ],
            [
                'id'    => 48,
                'title' => 'office_type_create',
            ],
            [
                'id'    => 49,
                'title' => 'office_type_edit',
            ],
            [
                'id'    => 50,
                'title' => 'office_type_show',
            ],
            [
                'id'    => 51,
                'title' => 'office_type_delete',
            ],
            [
                'id'    => 52,
                'title' => 'office_type_access',
            ],
            [
                'id'    => 53,
                'title' => 'office_create',
            ],
            [
                'id'    => 54,
                'title' => 'office_edit',
            ],
            [
                'id'    => 55,
                'title' => 'office_show',
            ],
            [
                'id'    => 56,
                'title' => 'office_delete',
            ],
            [
                'id'    => 57,
                'title' => 'office_access',
            ],
            [
                'id'    => 58,
                'title' => 'designation_create',
            ],
            [
                'id'    => 59,
                'title' => 'designation_edit',
            ],
            [
                'id'    => 60,
                'title' => 'designation_show',
            ],
            [
                'id'    => 61,
                'title' => 'designation_delete',
            ],
            [
                'id'    => 62,
                'title' => 'designation_access',
            ],
            [
                'id'    => 63,
                'title' => 'employee_create',
            ],
            [
                'id'    => 64,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 65,
                'title' => 'employee_show',
            ],
            [
                'id'    => 66,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 67,
                'title' => 'employee_access',
            ],
            [
                'id'    => 68,
                'title' => 'auction_create',
            ],
            [
                'id'    => 69,
                'title' => 'auction_edit',
            ],
            [
                'id'    => 70,
                'title' => 'auction_show',
            ],
            [
                'id'    => 71,
                'title' => 'auction_delete',
            ],
            [
                'id'    => 72,
                'title' => 'auction_access',
            ],
            [
                'id'    => 73,
                'title' => 'auction_manage_access',
            ],
            [
                'id'    => 74,
                'title' => 'bidder_create',
            ],
            [
                'id'    => 75,
                'title' => 'bidder_edit',
            ],
            [
                'id'    => 76,
                'title' => 'bidder_show',
            ],
            [
                'id'    => 77,
                'title' => 'bidder_delete',
            ],
            [
                'id'    => 78,
                'title' => 'bidder_access',
            ],
            [
                'id'    => 79,
                'title' => 'bidder_auction_request_create',
            ],
            [
                'id'    => 80,
                'title' => 'bidder_auction_request_edit',
            ],
            [
                'id'    => 81,
                'title' => 'bidder_auction_request_show',
            ],
            [
                'id'    => 82,
                'title' => 'bidder_auction_request_delete',
            ],
            [
                'id'    => 83,
                'title' => 'bidder_auction_request_access',
            ],
            [
                'id'    => 84,
                'title' => 'bid_create',
            ],
            [
                'id'    => 85,
                'title' => 'bid_edit',
            ],
            [
                'id'    => 86,
                'title' => 'bid_show',
            ],
            [
                'id'    => 87,
                'title' => 'bid_delete',
            ],
            [
                'id'    => 88,
                'title' => 'bid_access',
            ],
            [
                'id'    => 89,
                'title' => 'profile_password_edit',
            ],
        ];

        // Transform display_name
        $finalData = array_map(function ($item) {
            $display = str_replace('_', ' ', $item['title']);
            $display = ucwords($display); // Capitalize each word
            $item['display_name'] = $display;
            return $item;
        }, $permissions);

        Permission::insert($finalData);
    }
}
