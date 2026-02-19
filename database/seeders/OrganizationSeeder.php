<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Organization\Company;
use App\Models\Organization\CompanyPhilosophy;
use App\Models\Organization\Division;
use App\Models\Organization\Echelon;
use App\Models\Organization\Grade;
use App\Models\Organization\Position;
use App\Models\Organization\Region;
use App\Models\Organization\Unit;
use App\Models\Employee;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Role Dasar
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $kepalaUrusanRole = Role::firstOrCreate(['name' => 'kepala_urusan', 'guard_name' => 'web']);
        $kepalaBiroRole = Role::firstOrCreate(['name' => 'kepala_biro', 'guard_name' => 'web']);
        $kepalaDivisiRole = Role::firstOrCreate(['name' => 'kepala_divisi', 'guard_name' => 'web']);
        $hcmRole = Role::firstOrCreate(['name' => 'hcm', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);

        // 2. Kasih semua permission ke Super Admin
        $superAdminRole->syncPermissions(Permission::all());

        // --- 3. SEED COMPANY ---
        $company = Company::create([
            'company_id' => 'ACS-01',
            'name' => 'PT Abacus Cash Solution',
            'level' => 'Holding',
            'address' => 'Jl. HR Rasuna Said',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'post_code' => '12920',
            'phone_number' => '02112345678',
            'email' => 'info@abacus-cash.co.id',
            'website' => 'https://abacus-cash.co.id',
            'tin_number' => '01.234.567.8-901.000',
            'account_number' => '1234567890',
            'account_name' => 'PT Abacus Cash Solution',
            'profile' => 'Perusahaan penyedia solusi pemrosesan uang tunai terkemuka.',
        ]);

        CompanyPhilosophy::create([
            'company_id' => $company->id,
            'vision' => 'Menjadi perusahaan penyedia jasa pengolahan uang tunai yang terpercaya dan inovatif di Indonesia.',
            'mission' => 'Memberikan layanan terbaik dengan standar keamanan tinggi bagi seluruh mitra bisnis.',
        ]);

        // --- 4. SEED REGIONS ---
        $regions = [];
        foreach (['MEDAN', 'BANDUNG', 'JAKARTA'] as $idx => $city) {
            $region = Region::create([
                'company_id' => $company->id,
                'region_id' => 'WL-0'.($idx + 1),
                'name' => $city,
                'is_active' => true,
                'address' => 'Alamat '.$city,
                'city' => $city,
                'province' => 'Provinsi '.$city,
                'postcode' => '00000',
                'phone_number' => '0811000000',
            ]);
            $regions[$city] = $region;
        }

        // --- 5. SEED ECHELONS ---
        $echelons = [];
        foreach (range(1, 6) as $i) {
            $echelon = Echelon::create([
                'echelon_id' => 'S'.$i,
                'name' => 'Eselon '.$i,
                'is_active' => true,
            ]);
            $echelons['S'.$i] = $echelon;
        }

        // --- 6. SEED GRADES ---
        $grades = [];
        $gradeData = ['GM' => 'General Manager', 'DM' => 'Deputy Manager', 'AM' => 'Assistant Manager', 'PM' => 'Pro Manager', 'M' => 'Manager'];
        foreach ($gradeData as $id => $name) {
            $grade = Grade::create([
                'grade_id' => $id, 
                'name' => $name, 
                'is_active' => true
            ]);
            $grades[$id] = $grade;
        }

        // --- 7. SEED DIVISIONS & UNITS ---
        $divisions = [];
        $units = [];
        
        $divData = [
            'NO-01' => ['name' => 'DIVISI NON OPERASI', 'units' => [
                ['id' => 'NO.01', 'name' => 'Non Operasi']
            ]],
            'NO-02' => ['name' => 'DIVISI OPERASI', 'units' => [
                ['id' => 'UK-04', 'name' => 'OPERASI I'], 
                ['id' => 'UK-05', 'name' => 'AREA I']
            ]],
            'NO-03' => ['name' => 'DIVISI PENGEMBANGAN DAN PEMBINAAN OPERASI', 'units' => [
                ['id' => 'UK-01', 'name' => 'PENGEMBANGAN OPERASI'],
                ['id' => 'UK-02', 'name' => 'BIRO PENGEMBANGAN OPERASI'],
                ['id' => 'UK-03', 'name' => 'URUSAN PENGUJIAN KELAYAKAN'],
                ['id' => 'UK-06', 'name' => 'SISTEM DAN PROSEDUR']
            ]],
        ];

        foreach ($divData as $divId => $data) {
            $division = Division::create([
                'company_id' => $company->id, 
                'division_id' => $divId, 
                'name' => $data['name'],
                'is_active' => true
            ]);
            $divisions[$divId] = $division;
            
            foreach ($data['units'] as $u) {
                $unit = Unit::create([
                    'company_id' => $company->id, 
                    'division_id' => $division->id, 
                    'unit_id' => $u['id'], 
                    'name' => $u['name'],
                    'is_active' => true
                ]);
                $units[$u['id']] = $unit;
            }
        }

        // --- 8. SEED POSITIONS ---
        $positions = [];
        $posData = [
            ['id' => 'JB-01', 'name' => 'KEPALA DIVISI', 'unit' => 'UK-01', 'grade' => 'GM', 'echelon' => 'S1'],
            ['id' => 'JB-02', 'name' => 'KEPALA BIRO', 'unit' => 'UK-02', 'grade' => 'DM', 'echelon' => 'S2'],
            ['id' => 'JB-03', 'name' => 'KEPALA URUSAN', 'unit' => 'UK-03', 'grade' => 'AM', 'echelon' => 'S3'],
            ['id' => 'JB-04', 'name' => 'KEPALA DIVISI OPERASI', 'unit' => 'UK-04', 'grade' => 'GM', 'echelon' => 'S1'],
            ['id' => 'JB-05', 'name' => 'KOORDINATOR AREA', 'unit' => 'UK-05', 'grade' => 'PM', 'echelon' => 'S4'],
            ['id' => 'JB-06', 'name' => 'KEPALA WILAYAH', 'unit' => 'UK-05', 'grade' => 'M', 'echelon' => 'S5'],
        ];

        foreach ($posData as $p) {
            $unit = $units[$p['unit']] ?? null;
            if ($unit) {
                $position = Position::create([
                    'company_id' => $company->id,
                    'division_id' => $unit->division_id,
                    'unit_id' => $unit->id,
                    'position_id' => $p['id'],
                    'name' => $p['name'],
                    'is_active' => true,
                    'profile' => 'Job desk '.$p['name'],
                ]);
                $positions[$p['id']] = $position;
            }
        }

        // --- 9. CREATE ADMIN USER ---
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@acs.com',
            'password' => bcrypt('superadmin'),
        ]);
        $admin->assignRole($superAdminRole);

        // --- 10. CREATE USERS FOR EMPLOYEES ---
        
        // User untuk Kepala Divisi
        $userKadiv = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@acs.com',
            'password' => bcrypt('password123'),
        ]);
        $userKadiv->assignRole($kepalaDivisiRole);

        // User untuk Kepala Urusan
        $userKaUrusan = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@acs.com',
            'password' => bcrypt('password123'),
        ]);
        $userKaUrusan->assignRole($kepalaUrusanRole);

        // User untuk Staff HCM
        $userHcm = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@acs.com',
            'password' => bcrypt('password123'),
        ]);
        $userHcm->assignRole($hcmRole);

        // --- 11. CREATE EMPLOYEES ---
        
        // Employee 1: Kepala Divisi
        Employee::create([
            'user_id' => $userKadiv->id,
            'employee_id' => 'EMP-2024001',
            'name' => 'Budi Santoso',
            'company_id' => $company->id,
            'region_id' => $regions['JAKARTA']->id,
            'division_id' => $divisions['NO-03']->id, // DIVISI PENGEMBANGAN DAN PEMBINAAN OPERASI
            'unit_id' => $units['UK-01']->id, // PENGEMBANGAN OPERASI
            'position_id' => $positions['JB-01']->id, // KEPALA DIVISI
            'grade_id' => $grades['GM']->id,
            'echelon_id' => $echelons['S1']->id,
            'join_date' => '2020-01-15',
            'is_active' => true,
        ]);

        // Employee 2: Kepala Urusan
        Employee::create([
            'user_id' => $userKaUrusan->id,
            'employee_id' => 'EMP-2024002',
            'name' => 'Ahmad Fauzi',
            'company_id' => $company->id,
            'region_id' => $regions['MEDAN']->id,
            'division_id' => $divisions['NO-03']->id, // DIVISI PENGEMBANGAN DAN PEMBINAAN OPERASI
            'unit_id' => $units['UK-03']->id, // URUSAN PENGUJIAN KELAYAKAN
            'position_id' => $positions['JB-03']->id, // KEPALA URUSAN
            'grade_id' => $grades['AM']->id,
            'echelon_id' => $echelons['S3']->id,
            'join_date' => '2021-03-20',
            'is_active' => true,
        ]);

        // Employee 3: Staff HCM (optional)
        Employee::create([
            'user_id' => $userHcm->id,
            'employee_id' => 'EMP-2024003',
            'name' => 'Siti Nurhaliza',
            'company_id' => $company->id,
            'region_id' => $regions['JAKARTA']->id,
            'division_id' => $divisions['NO-01']->id, // DIVISI NON OPERASI
            'unit_id' => $units['NO.01']->id, // Non Operasi
            'position_id' => $positions['JB-05']->id, // KOORDINATOR AREA
            'grade_id' => $grades['PM']->id,
            'echelon_id' => $echelons['S4']->id,
            'join_date' => '2022-05-10',
            'is_active' => true,
        ]);
    }
}
