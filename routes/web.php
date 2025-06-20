<?php

use App\Http\Controllers\LombaVerificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKelolaLombaController;
use App\Http\Controllers\AdminKelolaPrestasiController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidangKeahlianController;
use App\Http\Controllers\CompetitionSubmissionController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenManagementController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaManagementController;
use App\Http\Controllers\PeringkatController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TingkatanController;
use App\Http\Controllers\PrestasiVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\MahasiswaNotifikasiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HallOfFameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/login', [LandingController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/hallOfFame', [HallOfFameController::class, 'index'])->name('hallOfFame');

// Notification routes (moved here and fixed paths)
Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

// Admin routes
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/export-pdf', [AdminController::class, 'exportDashboardPDF'])->name('admin.dashboard.exportPDF');

    // Admin Management Routes
    Route::prefix('adminManagement')->name('admin.adminManagement.')->group(function () {
        Route::get('/', [AdminManagementController::class, 'index'])->name('index');
        Route::get('/list', [AdminManagementController::class, 'getAdminList'])->name('list');
        Route::get('/show/{id}', [AdminManagementController::class, 'show'])->name('show');
        Route::get('/create_ajax', [AdminManagementController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [AdminManagementController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [AdminManagementController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [AdminManagementController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [AdminManagementController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [AdminManagementController::class, 'destroyAjax'])->name('destroyAjax');
        Route::get('/export_pdf', [AdminManagementController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [AdminManagementController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/import_form', [AdminManagementController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [AdminManagementController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [AdminManagementController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Dosen Management Routes
    Route::prefix('dosenManagement')->name('admin.dosenManagement.')->group(function () {
        Route::get('/', [DosenManagementController::class, 'index'])->name('index');
        Route::get('/list', [DosenManagementController::class, 'getDosenList'])->name('list');
        Route::get('/show/{id}', [DosenManagementController::class, 'show'])->name('show');
        Route::put('/{id}/reset-password', [DosenManagementController::class, 'resetPassword'])->name('resetPassword');
        Route::get('/create_ajax', [DosenManagementController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [DosenManagementController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [DosenManagementController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [DosenManagementController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [DosenManagementController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [DosenManagementController::class, 'destroyAjax'])->name('destroyAjax');
        Route::get('/export_pdf', [DosenManagementController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [DosenManagementController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/import_form', [DosenManagementController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [DosenManagementController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [DosenManagementController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Mahasiswa Management Routes
    Route::prefix('mahasiswaManagement')->name('admin.mahasiswaManagement.')->group(function () {
        Route::get('/', [MahasiswaManagementController::class, 'index'])->name('index');
        Route::get('/list', [MahasiswaManagementController::class, 'getMahasiswaList'])->name('list');
        Route::get('/show/{id}', [MahasiswaManagementController::class, 'show'])->name('show');
        Route::put('/{id}/reset-password', [MahasiswaManagementController::class, 'resetPassword'])->name('resetPassword');
        Route::get('/create_ajax', [MahasiswaManagementController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [MahasiswaManagementController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [MahasiswaManagementController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [MahasiswaManagementController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [MahasiswaManagementController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [MahasiswaManagementController::class, 'destroyAjax'])->name('destroyAjax');
        Route::get('/export_pdf', [MahasiswaManagementController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [MahasiswaManagementController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/import_form', [MahasiswaManagementController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [MahasiswaManagementController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [MahasiswaManagementController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Manajemen Pengguna
    Route::get('/mahasiswa', [AdminController::class, 'mahasiswaIndex'])->name('admin.mahasiswa.index');
    Route::get('/dosen', [AdminController::class, 'dosenIndex'])->name('admin.dosen.index');
    Route::get('/admin', [AdminController::class, 'adminIndex'])->name('admin.admin.index');

    // Manajemen Prestasi
    Route::get('/prestasi/verification', [AdminController::class, 'prestasiVerification'])->name('admin.prestasi.verification');
    Route::get('/prestasi/akademik', [AdminController::class, 'prestasiAkademik'])->name('admin.prestasi.akademik');
    Route::get('/prestasi/non-akademik', [AdminController::class, 'prestasiNonAkademik'])->name('admin.prestasi.non-akademik');
    Route::get('/prestasi', [AdminController::class, 'prestasiIndex'])->name('admin.prestasi.index');
    Route::get('/prestasi/report', [AdminController::class, 'prestasiReport'])->name('admin.prestasi.report');

    // Admin Kelola Bobot
    Route::prefix('kelolaBobot')->name('admin.kelolaBobot.')->group(function () {
        Route::get('/', [BobotController::class, 'index'])->name('index');
        Route::put('/update', [BobotController::class, 'update'])->name('update');
    });

    // Admin Kelola Rekomendasi Topsis
    Route::prefix('rekomendasiTopsis')->name('admin.rekomendasiTopsis.')->group(function () {
        Route::get('/', [RekomendasiController::class, 'index'])->name('index');
        Route::post('/generate', [RekomendasiController::class, 'generateRekomendasi'])->name('generate');
        Route::post('/kirim-rekomendasi', [RekomendasiController::class, 'kirimRekomendasi'])->name('kirimRekomendasi');
    });

    // Admin Kelola Rekomendasi Saw
    Route::prefix('admin/rekomendasiSaw')->name('admin.rekomendasiSaw.')->middleware(['auth', 'role:Admin'])->group(function () {
        Route::get('/', [RekomendasiController::class, 'indexSaw'])->name('index');
        Route::post('/generate', [RekomendasiController::class, 'generateRekomendasiSaw'])->name('generate');
        Route::post('/kirim-rekomendasi', [RekomendasiController::class, 'kirimRekomendasiSaw'])->name('kirimRekomendasi');
    });

    // Admin Kelola Prestasi
    Route::prefix('adminKelolaPrestasi')->name('admin.adminKelolaPrestasi.')->group(function () {
        Route::get('/', [AdminKelolaPrestasiController::class, 'index'])->name('index');
        Route::get('/list', [AdminKelolaPrestasiController::class, 'getPrestasiList'])->name('list');
        Route::get('/show/{id}', [AdminKelolaPrestasiController::class, 'show'])->name('show');

        // AJAX routes
        Route::get('/create_ajax', [AdminKelolaPrestasiController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [AdminKelolaPrestasiController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [AdminKelolaPrestasiController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [AdminKelolaPrestasiController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [AdminKelolaPrestasiController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [AdminKelolaPrestasiController::class, 'destroyAjax'])->name('destroyAjax');

        // Export routes
        Route::get('/export_pdf', [AdminKelolaPrestasiController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [AdminKelolaPrestasiController::class, 'exportExcel'])->name('exportExcel');

        // Import routes
        Route::get('/import_form', [AdminKelolaPrestasiController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [AdminKelolaPrestasiController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [AdminKelolaPrestasiController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Admin Verifikasi Lomba
    Route::prefix('lombaVerification')->name('admin.lombaVerification.')->group(function () {
        Route::get('/', [LombaVerificationController::class, 'index'])->name('index');
        Route::get('/list', [LombaVerificationController::class, 'list'])->name('list');
        Route::get('/show/{id}', [LombaVerificationController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [LombaVerificationController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [LombaVerificationController::class, 'reject'])->name('reject');
    });
    // Admin Kelola Lomba
    Route::prefix('adminKelolaLomba')->name('admin.adminKelolaLomba.')->group(function () {
        Route::get('/', [AdminKelolaLombaController::class, 'index'])->name('index');
        Route::get('/list', [AdminKelolaLombaController::class, 'getLombaList'])->name('list');
        Route::get('/show/{id}', [AdminKelolaLombaController::class, 'show'])->name('show');

        // AJAX routes
        Route::get('/keahlian-search', [AdminKelolaLombaController::class, 'ajaxKeahlianSearch'])->name('ajaxKeahlianSearch');
        Route::get('/create_ajax', [AdminKelolaLombaController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [AdminKelolaLombaController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [AdminKelolaLombaController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [AdminKelolaLombaController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [AdminKelolaLombaController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [AdminKelolaLombaController::class, 'destroyAjax'])->name('destroyAjax');

        // Export routes
        Route::get('/export_pdf', [AdminKelolaLombaController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [AdminKelolaLombaController::class, 'exportExcel'])->name('exportExcel');

        // Import routes
        Route::get('/import_form', [AdminKelolaLombaController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [AdminKelolaLombaController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [AdminKelolaLombaController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Manajemen Lomba
    Route::get('/lomba/verification', [AdminController::class, 'lombaVerification'])->name('admin.lomba.verification');
    Route::get('/lomba', [AdminController::class, 'lombaIndex'])->name('admin.lomba.index');

    // Master Data
    Route::get('/master/periode', [AdminController::class, 'masterPeriode'])->name('admin.master.periode');
    Route::get('/master/prodi', [AdminController::class, 'masterProdi'])->name('admin.master.prodi');

    // Master Tingkatan Lomba Routes
    Route::prefix('master/tingkatanLomba')->name('admin.master.tingkatanLomba.')->group(function () {
        Route::get('/', [TingkatanController::class, 'index'])->name('index');
        Route::get('/list', [TingkatanController::class, 'getTingkatanList'])->name('list');
        Route::post('/', [TingkatanController::class, 'store']);
        Route::get('/show/{id}', [TingkatanController::class, 'show']);

        // AJAX routes
        Route::get('/create_ajax', [TingkatanController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [TingkatanController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [TingkatanController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [TingkatanController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [TingkatanController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [TingkatanController::class, 'destroyAjax'])->name('destroyAjax');

        // Export routes
        Route::get('/export_pdf', [TingkatanController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [TingkatanController::class, 'exportExcel'])->name('exportExcel');

        // Import routes
        Route::get('/import_form', [TingkatanController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [TingkatanController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [TingkatanController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Master Peringkat Lomba Routes
    Route::prefix('master/peringkatLomba')->name('admin.master.peringkatLomba.')->group(function () {
        Route::get('/', [PeringkatController::class, 'index'])->name('index');
        Route::get('/list', [PeringkatController::class, 'getPeringkatList'])->name('list');
        Route::post('/', [PeringkatController::class, 'store']);
        Route::get('/show/{id}', [PeringkatController::class, 'show']);

        // AJAX routes
        Route::get('/create_ajax', [PeringkatController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [PeringkatController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [PeringkatController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [PeringkatController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [PeringkatController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [PeringkatController::class, 'destroyAjax'])->name('destroyAjax');

        // Export routes
        Route::get('/export_pdf', [PeringkatController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [PeringkatController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/import_form', [PeringkatController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [PeringkatController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [PeringkatController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Master Program Studi Routes
    Route::prefix('master/prodi')->name('admin.master.prodi.')->group(function () {
        Route::get('/', [ProdiController::class, 'index'])->name('index');
        Route::get('/list', [ProdiController::class, 'getProdiList'])->name('list');
        Route::post('/', [ProdiController::class, 'store']);
        Route::get('/show/{id}', [ProdiController::class, 'show']);

        // AJAX routes
        Route::get('/create_ajax', [ProdiController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [ProdiController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [ProdiController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [ProdiController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [ProdiController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [ProdiController::class, 'destroyAjax'])->name('destroyAjax');

        // Export routes
        Route::get('/export_pdf', [ProdiController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [ProdiController::class, 'exportExcel'])->name('exportExcel');

        // Import routes
        Route::get('/import_form', [ProdiController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [ProdiController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [ProdiController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Master Bidang Keahlian Routes
    Route::prefix('master/bidangKeahlian')->name('admin.master.bidangKeahlian.')->group(function () {
        Route::get('/', [BidangKeahlianController::class, 'index'])->name('index');
        Route::get('/list', [BidangKeahlianController::class, 'getBidangKeahlianList'])->name('list');

        // AJAX routes
        Route::get('/create_ajax', [BidangKeahlianController::class, 'createAjax'])->name('createAjax');
        Route::post('/store_ajax', [BidangKeahlianController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [BidangKeahlianController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [BidangKeahlianController::class, 'updateAjax'])->name('updateAjax');
        Route::delete('/{id}/delete_ajax', [BidangKeahlianController::class, 'deleteAjax'])->name('deleteAjax');
        Route::get('/{id}/confirm_ajax', [BidangKeahlianController::class, 'confirmAjax'])->name('confirmAjax');
        Route::get('/{id}/lihat_mahasiswa', [BidangKeahlianController::class, 'lihatMahasiswa'])->name('lihatMahasiswa');

        Route::get('/show/{id}', [BidangKeahlianController::class, 'show'])->name('show');

        // Export/Import routes - converted from dash to underscore format
        Route::get('/export_pdf', [BidangKeahlianController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/import_form', [BidangKeahlianController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [BidangKeahlianController::class, 'importExcel'])->name('importExcel');
        Route::get('/export_excel', [BidangKeahlianController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/generate_template', [BidangKeahlianController::class, 'generateTemplate'])->name('generateTemplate');
    });

    // Master Semester Routes
    Route::prefix('master/semester')->name('admin.master.semester.')->group(function () {
        Route::get('/', [SemesterController::class, 'index'])->name('index');
        Route::get('/list', [SemesterController::class, 'getSemesterList'])->name('list');
        Route::post('/', [SemesterController::class, 'store']);
        Route::get('/show/{id}', [SemesterController::class, 'show']);

        // AJAX routes
        Route::get('/create_ajax', [SemesterController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [SemesterController::class, 'storeAjax'])->name('storeAjax');
        Route::get('/{id}/edit_ajax', [SemesterController::class, 'editAjax'])->name('editAjax');
        Route::put('/{id}/update_ajax', [SemesterController::class, 'updateAjax'])->name('updateAjax');
        Route::get('/{id}/confirm_ajax', [SemesterController::class, 'confirmAjax'])->name('confirmAjax');
        Route::delete('/{id}/delete_ajax', [SemesterController::class, 'destroyAjax'])->name('destroyAjax');

        // Export routes
        Route::get('/export_pdf', [SemesterController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export_excel', [SemesterController::class, 'exportExcel'])->name('exportExcel');

        // Import routes
        Route::get('/import_form', [SemesterController::class, 'importForm'])->name('importForm');
        Route::post('/import_excel', [SemesterController::class, 'importExcel'])->name('importExcel');
        Route::get('/generate_template', [SemesterController::class, 'generateTemplate'])->name('generateTemplate');
    });

    Route::get('/master/keahlian', [AdminController::class, 'masterKeahlian'])->name('admin.master.keahlian');

    // Settings profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/admin/profile/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/admin/profile/update-photo', [AdminController::class, 'updatePhoto'])->name('admin.updatePhoto');

    Route::prefix('system')->name('admin.system.')->group(function () {
        Route::get('/', [SystemController::class, 'system'])->name('index');
        Route::post('/pdf-settings', [SystemController::class, 'updatePdfSettings'])->name('updatePdfSettings');

        // Banner routes
        Route::post('/banner', [SystemController::class, 'storeBanner'])->name('storeBanner');
        Route::put('/banner/{id}', [SystemController::class, 'updateBanner'])->name('updateBanner');
        Route::delete('/banner/{id}', [SystemController::class, 'deleteBanner'])->name('deleteBanner');
        Route::get('/banner/{id}/edit', [SystemController::class, 'editBannerModal'])->name('editBannerModal');
        Route::get('/banner/{id}/confirm', [SystemController::class, 'confirmDeleteBannerModal'])->name('confirmDeleteBannerModal');
    });

    // Verifikasi Prestasi
    Route::prefix('prestasiVerification')->name('admin.prestasiVerification.')->group(function () {
        Route::get('/', [PrestasiVerificationController::class, 'adminIndex'])->name('index');
        Route::get('/list', [PrestasiVerificationController::class, 'adminList'])->name('list');
        Route::get('/show/{id}', [PrestasiVerificationController::class, 'adminShow'])->name('show');
        Route::post('/{id}/verify', [PrestasiVerificationController::class, 'adminVerify'])->name('verify');
    });
});

// Dosen routes
Route::middleware(['auth', 'role:Dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DosenController::class, 'index'])->name('dashboard');

    // Lihat Lomba dan Tambah
    Route::prefix('lomba')->name('lomba.')->group(function () {
        Route::get('/', [LombaController::class, 'lombaIndex'])->name('index');
        Route::get('/show/{id}', [LombaController::class, 'lombaShow'])->name('show');
        Route::get('/create_ajax', [LombaController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [LombaController::class, 'storeAjax'])->name('storeAjax');
    });

    // Bimbingan Mahasiswa
    Route::prefix('bimbingan')->name('bimbingan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\BimbinganController::class, 'index'])->name('index');
        Route::get('/list', [\App\Http\Controllers\BimbinganController::class, 'list'])->name('list');
        Route::get('/show/{id}', [\App\Http\Controllers\BimbinganController::class, 'show'])->name('show');
    });

    // Profil Dosen
    Route::get('/profile', [DosenController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [DosenController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/update', [DosenController::class, 'updateProfile'])->name('updateProfile');
    Route::put('/profile/update-password', [DosenController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/profile/change-password', [DosenController::class, 'changePassword'])->name('changePassword');
    Route::post('/profile/update-photo', [DosenController::class, 'updatePhoto'])->name('updatePhoto');

    // Riwayat Pengajuan Lomba
    Route::prefix('riwayatPengajuanLomba')->name('riwayatPengajuanLomba.')->group(function () {
        Route::get('/', [DosenController::class, 'riwayatPengajuanLombaIndex'])->name('index');
        Route::get('/list', [DosenController::class, 'riwayatPengajuanLombaList'])->name('list');
        Route::get('/show/{id}', [DosenController::class, 'riwayatPengajuanLombaShow'])->name('show');
    });

    // Verifikasi Prestasi
    Route::prefix('prestasiVerification')->name('prestasiVerification.')->group(function () {
        Route::get('/', [PrestasiVerificationController::class, 'dosenIndex'])->name('index');
        Route::get('/list', [PrestasiVerificationController::class, 'dosenList'])->name('list');
        Route::get('/show/{id}', [PrestasiVerificationController::class, 'dosenShow'])->name('show');
        Route::post('/{id}/verify', [PrestasiVerificationController::class, 'dosenVerify'])->name('verify');
    });
});

// Achievement Process for Dosen - Outside dosen prefix
Route::middleware(['auth', 'role:Dosen'])->prefix('dosen/achievement')->name('dosen.achievement.')->group(function () {
    Route::get('/create', [CompetitionSubmissionController::class, 'Create'])->name('create');
    Route::post('/store', [CompetitionSubmissionController::class, 'Store'])->name('store');

    // AJAX routes for validation
    Route::post('/check-duplicate', [CompetitionSubmissionController::class, 'checkDuplicateLomba'])->name('check-duplicate');
    Route::get('/keahlian-suggestions', [CompetitionSubmissionController::class, 'getKeahlianSuggestions'])->name('keahlian-suggestions');
});

// Mahasiswa routes
Route::middleware(['auth', 'role:Mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('dashboard');
    Route::get('/notifikasi', [MahasiswaNotifikasiController::class, 'index'])->name('notifikasi');

    // Lihat Lomba dan Tambah
    Route::prefix('lomba')->name('lomba.')->group(function () {
        Route::get('/', [LombaController::class, 'lombaIndex'])->name('index');
        Route::get('/show/{id}', [LombaController::class, 'lombaShow'])->name('show');
        Route::post('/daftar', [LombaController::class, 'daftarLomba'])->name('daftar');
        Route::get('/create_ajax', [LombaController::class, 'createAjax'])->name('createAjax');
        Route::post('/ajax', [LombaController::class, 'storeAjax'])->name('storeAjax');
    });

    // Manajemen Prestasi
    Route::prefix('prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('index');
        Route::get('/list', [MahasiswaController::class, 'prestasiListAjax'])->name('list');
        Route::get('/create_ajax', [MahasiswaController::class, 'prestasiCreateAjax'])->name('createAjax');
        Route::post('/ajax', [MahasiswaController::class, 'prestasiStoreAjax'])->name('storeAjax');
        Route::get('/show_ajax/{id}', [MahasiswaController::class, 'prestasiShowAjax'])->name('showAjax');
    });

    // Notifikasi Mahasiswa
    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/', [MahasiswaNotifikasiController::class, 'index'])->name('index'); // Tampilkan semua notifikasi
        Route::get('/{index}', [MahasiswaNotifikasiController::class, 'show'])->name('show'); // Lihat detail notifikasi
        Route::post('/read/{index}', [MahasiswaNotifikasiController::class, 'markAsRead'])->name('read'); // Tandai satu notifikasi dibaca
        Route::post('/read-all', [MahasiswaNotifikasiController::class, 'markAllAsRead'])->name('read_all'); // Tandai semua notifikasi dibaca
        Route::get('/unread-count', [MahasiswaNotifikasiController::class, 'getUnreadCount'])->name('unread_count'); // Ambil jumlah belum dibaca
        // Opsional: Simulasi notifikasi dummy (untuk testing)
        Route::get('/simulate', [MahasiswaNotifikasiController::class, 'simulateNotifikasi'])->name('simulate');
    });

    // Profil Mahasiswa
    Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [MahasiswaController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/update', [MahasiswaController::class, 'updateProfile'])->name('updateProfile');
    Route::put('/profile/update-password', [MahasiswaController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/profile/change-password', [MahasiswaController::class, 'changePassword'])->name('changePassword');
    Route::post('/profile/update-photo', [MahasiswaController::class, 'updatePhoto'])->name('updatePhoto');

    // Riwayat Pengajuan Lomba
    Route::prefix('riwayatPengajuanLomba')->name('riwayatPengajuanLomba.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'riwayatPengajuanLombaIndex'])->name('index');
        Route::get('/list', [MahasiswaController::class, 'riwayatPengajuanLombaList'])->name('list');
        Route::get('/show/{id}', [MahasiswaController::class, 'riwayatPengajuanLombaShow'])->name('show');
    });

    // Riwayat Pengajuan Prestasi
    Route::prefix('riwayatPengajuanPrestasi')->name('riwayatPengajuanPrestasi.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'riwayatPengajuanPrestasiIndex'])->name('index');
        Route::get('/list', [MahasiswaController::class, 'riwayatPengajuanPrestasiList'])->name('list');
        Route::get('/show/{id}', [MahasiswaController::class, 'riwayatPengajuanPrestasiShow'])->name('show');
    });
});

// Achievement Verification Process - Outside mahasiswa prefix
Route::middleware(['auth', 'role:Mahasiswa'])->prefix('student/achievement')->name('student.achievement.')->group(function () {
    Route::get('/create', [CompetitionSubmissionController::class, 'create'])->name('create');
    Route::post('/select-competition', [CompetitionSubmissionController::class, 'selectCompetition'])->name('select-competition');
    Route::post('/store', [CompetitionSubmissionController::class, 'store'])->name('store');
    Route::post('/finalize', [CompetitionSubmissionController::class, 'finalizeSubmission'])->name('finalize');
    Route::get('/step3', [CompetitionSubmissionController::class, 'step3'])->name('step3');
});
// Profil Mahasiswa
Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [MahasiswaController::class, 'editProfile'])->name('editProfile');
Route::put('/profile/update', [MahasiswaController::class, 'updateProfile'])->name('updateProfile');
Route::put('/profile/update-password', [MahasiswaController::class, 'updatePassword'])->name('updatePassword');
Route::post('/profile/change-password', [MahasiswaController::class, 'changePassword'])->name('changePassword');
Route::post('/profile/update-photo', [MahasiswaController::class, 'updatePhoto'])->name('updatePhoto');


// Achievement Verification Process - Outside mahasiswa prefix
Route::middleware(['auth', 'role:Mahasiswa'])->prefix('student/achievement')->name('student.achievement.')->group(function () {
    Route::get('/create', [CompetitionSubmissionController::class, 'create'])->name('create');
    Route::post('/select-competition', [CompetitionSubmissionController::class, 'selectCompetition'])->name('select-competition');
    Route::post('/store', [CompetitionSubmissionController::class, 'store'])->name('store');
    Route::post('/finalize', [CompetitionSubmissionController::class, 'finalizeSubmission'])->name('finalize');
    Route::get('/step3', [CompetitionSubmissionController::class, 'step3'])->name('step3');

    // New AJAX routes for validation
    Route::post('/check-duplicate', [CompetitionSubmissionController::class, 'checkDuplicateLomba'])->name('check-duplicate');
    Route::get('/keahlian-suggestions', [CompetitionSubmissionController::class, 'getKeahlianSuggestions'])->name('keahlian-suggestions');
});

// Fallback for unauthorized access
Route::fallback(function () {
    return redirect('/login');
});
