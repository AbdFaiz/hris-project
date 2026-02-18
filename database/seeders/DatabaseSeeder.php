<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyPhilosophy;
use App\Models\Division;
use App\Models\Echelon;
use App\Models\Grade;
use App\Models\Position;
use App\Models\Region;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Buat Role Dasar (Tanpa Artisan Call agar tidak stuck)
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);

        // 2. Bikin Role Panel User (Opsional)
        Role::firstOrCreate([
            'name' => config('filament-shield.panel_user.name', 'panel_user'),
            'guard_name' => 'web',
        ]);

        // 4. Kasih semua permission yang baru di-generate ke Super Admin
        $superAdminRole->syncPermissions(Permission::all());

        $customPages = [
            'page_MasterOrganizationCluster',
            'page_StructureCompany',
            'page_ChangePassword',
            'page_Dashboard',
        ];

        foreach ($customPages as $page) {
            Permission::firstOrCreate(['name' => $page, 'guard_name' => 'web']);
        }

        // --- 2. SEED ROLES ---
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // --- 3. SEED COMPANY ---
        $company = Company::create([
            'company_id' => 'ACS-01',
            'name' => 'PT Abacus Cash Solution',
            'address' => 'Jl. HR Rasuna Said',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'post_code' => '12920',
            'phone_number' => '02112345678',
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

        // --- 4. SEED REGIONS, ECHELONS, GRADES ---
        foreach (['MEDAN', 'BANDUNG'] as $idx => $city) {
            Region::create([
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
        }

        foreach (range(1, 6) as $i) {
            Echelon::create([
                'echelon_id' => 'S'.$i,
                'name' => 'Echelon '.$i,
                'is_active' => true,
            ]);
        }

        $grades = ['GM' => 'General Manager', 'DM' => 'Deputy Manager', 'AM' => 'Assistant Manager', 'PM' => 'Pro Manager', 'M' => 'Manager'];
        foreach ($grades as $id => $name) {
            Grade::create(['grade_id' => $id, 'name' => $name, 'is_active' => true]);
        }

        // --- 5. SEED DIVISIONS & UNITS ---
        $divData = [
            'NO-01' => ['name' => 'DIVISI NON OPERASI', 'units' => [['id' => 'NO.01', 'name' => 'Non Operasi']]],
            'NO-02' => ['name' => 'DIVISI OPERASI', 'units' => [['id' => 'UK-04', 'name' => 'OPERASI I'], ['id' => 'UK-05', 'name' => 'AREA I']]],
            'NO-03' => ['name' => 'DIVISI PENGEMBANGAN DAN PEMBINAAN OPERASI', 'units' => [['id' => 'UK-01', 'name' => 'PENGEMBANGAN OPERASI'], ['id' => 'UK-02', 'name' => 'BIRO PENGEMBANGAN OPERASI'], ['id' => 'UK-03', 'name' => 'URUSAN PENGUJIAN KELAYAKAN'], ['id' => 'UK-06', 'name' => 'SISTEM DAN PROSEDUR']]],
        ];

        foreach ($divData as $divId => $data) {
            $division = Division::create(['company_id' => $company->id, 'division_id' => $divId, 'name' => $data['name']]);
            foreach ($data['units'] as $u) {
                Unit::create(['company_id' => $company->id, 'division_id' => $division->id, 'unit_id' => $u['id'], 'name' => $u['name']]);
            }
        }

        // --- 6. SEED POSITIONS (Hanya 1 Loop) ---
        $posData = [
            ['id' => 'JB-01', 'name' => 'KEPALA DIVISI', 'unit' => 'UK-01'],
            ['id' => 'JB-02', 'name' => 'KEPALA BIRO', 'unit' => 'UK-02'],
            ['id' => 'JB-03', 'name' => 'KEPALA URUSAN', 'unit' => 'UK-03'],
            ['id' => 'JB-04', 'name' => 'KEPALA DIVISI OPERASI', 'unit' => 'UK-04'], // Bedakan nama agar slug unik
            ['id' => 'JB-05', 'name' => 'KOORDINATOR AREA', 'unit' => 'UK-05'],
            ['id' => 'JB-06', 'name' => 'KEPALA WILAYAH', 'unit' => 'UK-05'],
        ];

        foreach ($posData as $p) {
            $unit = Unit::where('unit_id', $p['unit'])->first();
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

                // Hubungkan ke Role (Opsional: Misal JB-01 jadi Super Admin)
                if ($p['id'] === 'JB-01') {
                    $position->roles()->attach($superAdminRole);
                }
            }
        }

        // --- 7. CREATE ADMIN USER ---
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@acs.com',
            'password' => bcrypt('superadmin'),
        ]);
        $admin->assignRole($superAdminRole);
    }
}
