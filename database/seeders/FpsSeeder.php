<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Organization\Position;
use App\Models\Recruitment\FpsRequest;
use App\Models\Recruitment\FpsRequestItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class FpsSeeder extends Seeder
{
    public function run(): void
    {
        // Get data employee yang memiliki user (Kepala Urusan)
        $applicant = Employee::whereHas('user', fn($q) => 
            $q->where('email', 'ahmad.fauzi@acs.com')
        )->first();
        
        // Get admin user untuk created_by
        $admin = User::where('email', 'admin@acs.com')->first();
        
        // Get positions
        $positionKepalaWilayah = Position::where('position_id', 'JB-06')->first();
        $positionKoordinatorArea = Position::where('position_id', 'JB-05')->first();

        // Cek apakah data yang diperlukan tersedia
        if (!$applicant || !$admin || !$positionKepalaWilayah || !$positionKoordinatorArea) {
            $this->command->error('Data required for FPS seeder not found!');
            return;
        }

        // ==================== FPS 1 - ACTIVE (Sudah Disetujui) ====================
        $fps1 = FpsRequest::create([
            'fps_number' => '001/ACS-HCM/FPS/I/2025', // Manual untuk contoh
            'applicant_id' => $applicant->id,
            'applicant_name' => $applicant->name,
            'applicant_position' => $applicant->position?->name ?? 'KEPALA URUSAN',
            'applicant_region' => $applicant->region?->name ?? 'MEDAN',
            'request_date' => '2025-01-10',
            'needed_date' => '2025-02-01',
            'request_type' => 'addition',
            'request_reason' => 'Ekspansi wilayah membutuhkan tambahan tenaga untuk area baru',
            'result_reason' => 'Disetujui dengan catatan proses rekrutmen segera dilaksanakan',
            'status' => 'approved',
            'final_status' => 'active',
            'created_by' => $applicant->user_id, // Pakai user_id dari employee
        ]);

        // Item 1.1 - Kepala Wilayah (2 orang, 1 sudah terpenuhi)
        FpsRequestItem::create([
            'fps_request_id' => $fps1->id,
            'request_quantity' => 2,
            'position_id' => $positionKepalaWilayah->id,
            'education_level' => 'S1',
            'major' => 'Manajemen/Ekonomi',
            'gender' => 'L',
            'marital_status' => 'Semua',
            'age_range' => '28-40 tahun',
            'work_requirements' => 'Pengalaman minimal 3 tahun di posisi yang sama, memahami operasional lapangan',
            'special_skills' => 'Leadership, komunikasi baik, mampu bekerja di bawah tekanan',
            'job_description' => 'Memimpin wilayah, mengawasi operasional, memastikan target tercapai',
            'report_to' => 'Kepala Divisi Operasi',
            'employment_status' => 'contract',
            'need_work_desk' => true,
            'need_uniform' => true,
            'need_computer_laptop' => true,
            'need_email' => true,
            'fulfilled_quantity' => 1, // 1 sudah terpenuhi
        ]);

        // Item 1.2 - Koordinator Area (3 orang, 2 sudah terpenuhi)
        FpsRequestItem::create([
            'fps_request_id' => $fps1->id,
            'request_quantity' => 3,
            'position_id' => $positionKoordinatorArea->id,
            'education_level' => 'D3/S1',
            'major' => 'Semua jurusan',
            'gender' => 'Semua',
            'marital_status' => 'Semua',
            'age_range' => '23-35 tahun',
            'work_requirements' => 'Pengalaman minimal 1 tahun di bidang operasional',
            'special_skills' => 'Menguasai Microsoft Office, komunikatif',
            'job_description' => 'Mengkoordinir area, monitoring kegiatan operasional',
            'report_to' => 'Kepala Wilayah',
            'employment_status' => 'contract',
            'need_work_desk' => true,
            'need_uniform' => true,
            'need_computer_laptop' => true,
            'need_email' => true,
            'fulfilled_quantity' => 2, // 2 sudah terpenuhi
        ]);

        // ==================== FPS 2 - DRAFT (Masih Pengajuan) ====================
        $fps2 = FpsRequest::create([
            'fps_number' => '002/ACS-HCM/FPS/I/2025', // Manual untuk contoh
            'applicant_id' => $applicant->id,
            'applicant_name' => $applicant->name,
            'applicant_position' => $applicant->position?->name ?? 'KEPALA URUSAN',
            'applicant_region' => $applicant->region?->name ?? 'MEDAN',
            'request_date' => '2025-01-15',
            'needed_date' => '2025-03-01',
            'request_type' => 'replacement',
            'request_reason' => 'Penggantian karyawan yang resign karena pensiun',
            'result_reason' => null,
            'status' => 'pending',
            'final_status' => 'draft',
            'created_by' => $applicant->user_id,
        ]);

        // Item 2.1 - Kepala Wilayah (1 orang)
        FpsRequestItem::create([
            'fps_request_id' => $fps2->id,
            'request_quantity' => 1,
            'position_id' => $positionKepalaWilayah->id,
            'education_level' => 'S1',
            'major' => 'Manajemen',
            'gender' => 'L',
            'marital_status' => 'Semua',
            'age_range' => '30-45 tahun',
            'work_requirements' => 'Pengalaman minimal 5 tahun di level manajerial',
            'special_skills' => 'Leadership kuat, mampu membuat strategi, negosiasi',
            'job_description' => 'Memimpin wilayah, target oriented, membawahi 50+ karyawan',
            'report_to' => 'Kepala Divisi Operasi',
            'employment_status' => 'permanent',
            'need_work_desk' => true,
            'need_uniform' => true,
            'need_computer_laptop' => true,
            'need_email' => true,
            'other_needs' => 'Kendaraan operasional',
            'fulfilled_quantity' => 0,
        ]);

        // ==================== FPS 3 - CLOSED (Selesai) ====================
        $fps3 = FpsRequest::create([
            'fps_number' => '003/ACS-HCM/FPS/XII/2024', // Manual untuk contoh
            'applicant_id' => $applicant->id,
            'applicant_name' => $applicant->name,
            'applicant_position' => $applicant->position?->name ?? 'KEPALA URUSAN',
            'applicant_region' => $applicant->region?->name ?? 'MEDAN',
            'request_date' => '2024-12-01',
            'needed_date' => '2025-01-15',
            'request_type' => 'addition',
            'request_reason' => 'Kebutuhan operasional untuk area baru',
            'result_reason' => 'Proses rekrutmen selesai, semua posisi terisi',
            'status' => 'approved',
            'final_status' => 'closed',
            'closed_at' => '2025-01-20 14:30:00',
            'created_by' => $applicant->user_id,
        ]);

        // Item 3.1 - Koordinator Area (2 orang, sudah terpenuhi semua)
        FpsRequestItem::create([
            'fps_request_id' => $fps3->id,
            'request_quantity' => 2,
            'position_id' => $positionKoordinatorArea->id,
            'education_level' => 'D3',
            'major' => 'Semua jurusan',
            'gender' => 'Semua',
            'marital_status' => 'Semua',
            'age_range' => '22-30 tahun',
            'work_requirements' => 'Fresh graduate dipersilahkan, pengalaman jadi nilai plus',
            'special_skills' => 'Komunikatif, mau belajar, bisa bekerja dalam tim',
            'job_description' => 'Membantu operasional area, administrasi lapangan',
            'report_to' => 'Kepala Wilayah',
            'employment_status' => 'contract',
            'need_work_desk' => true,
            'need_uniform' => true,
            'need_computer_laptop' => false,
            'need_email' => true,
            'fulfilled_quantity' => 2, // Sudah terpenuhi semua
        ]);

        // ==================== FPS 4 - PENDING (Menunggu Approval) ====================
        $fps4 = FpsRequest::create([
            'fps_number' => '004/ACS-HCM/FPS/I/2025', // Manual untuk contoh
            'applicant_id' => $applicant->id,
            'applicant_name' => $applicant->name,
            'applicant_position' => $applicant->position?->name ?? 'KEPALA URUSAN',
            'applicant_region' => $applicant->region?->name ?? 'MEDAN',
            'request_date' => '2025-01-20',
            'needed_date' => '2025-02-15',
            'request_type' => 'addition',
            'request_reason' => 'Penambahan karyawan untuk proyek baru',
            'result_reason' => null,
            'status' => 'pending',
            'final_status' => 'active', // Sudah active tapi masih pending approval? 
            'created_by' => $applicant->user_id,
        ]);

        // Item 4.1 - Staff Operasional (5 orang)
        FpsRequestItem::create([
            'fps_request_id' => $fps4->id,
            'request_quantity' => 5,
            'position_id' => $positionKoordinatorArea->id, // Bisa pakai posisi lain jika ada
            'education_level' => 'SMA/D3',
            'major' => 'Semua jurusan',
            'gender' => 'Semua',
            'marital_status' => 'Semua',
            'age_range' => '18-30 tahun',
            'work_requirements' => 'Bersedia bekerja shift, jujur, teliti',
            'special_skills' => 'Mengoperasikan komputer dasar',
            'job_description' => 'Menangani transaksi operasional, administrasi',
            'report_to' => 'Koordinator Area',
            'employment_status' => 'contract',
            'need_work_desk' => true,
            'need_uniform' => true,
            'need_computer_laptop' => false,
            'need_email' => false,
            'fulfilled_quantity' => 0,
        ]);

        // ==================== FPS 5 - REJECTED (Ditolak) ====================
        $fps5 = FpsRequest::create([
            'fps_number' => '005/ACS-HCM/FPS/XII/2024', // Manual untuk contoh
            'applicant_id' => $applicant->id,
            'applicant_name' => $applicant->name,
            'applicant_position' => $applicant->position?->name ?? 'KEPALA URUSAN',
            'applicant_region' => $applicant->region?->name ?? 'MEDAN',
            'request_date' => '2024-12-10',
            'needed_date' => '2025-01-01',
            'request_type' => 'replacement',
            'request_reason' => 'Penggantian karyawan yang mengundurkan diri',
            'result_reason' => 'Tidak disetujui karena sedang ada pembatasan hiring',
            'status' => 'rejected',
            'final_status' => 'cancelled',
            'closed_at' => '2024-12-15 09:00:00',
            'created_by' => $applicant->user_id,
        ]);

        // Item 5.1 - Staff (1 orang)
        FpsRequestItem::create([
            'fps_request_id' => $fps5->id,
            'request_quantity' => 1,
            'position_id' => $positionKoordinatorArea->id,
            'education_level' => 'S1',
            'major' => 'Akuntansi',
            'gender' => 'P',
            'marital_status' => 'Semua',
            'age_range' => '25-35 tahun',
            'work_requirements' => 'Pengalaman minimal 2 tahun',
            'special_skills' => 'Menguasai pembukuan',
            'job_description' => 'Administrasi keuangan',
            'report_to' => 'Kepala Wilayah',
            'employment_status' => 'permanent',
            'need_work_desk' => true,
            'need_uniform' => true,
            'need_computer_laptop' => true,
            'need_email' => true,
            'fulfilled_quantity' => 0,
        ]);

        $this->command->info('FPS Seeder completed successfully!');
        $this->command->table(
            ['FPS Number', 'Applicant', 'Type', 'Status', 'Final Status'],
            FpsRequest::all()->map(fn($fps) => [
                $fps->fps_number,
                $fps->applicant_name,
                $fps->request_type,
                $fps->status,
                $fps->final_status,
            ])->toArray()
        );
    }
}