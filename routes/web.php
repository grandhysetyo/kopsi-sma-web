<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardLeaderController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\UnggahanController;
use App\Http\Controllers\TwibbonController;
use App\Http\Controllers\DashboardMemberController;
use App\Http\Controllers\BerkasMemberController;
use App\Http\Controllers\UnggahanMemberController;
use App\Http\Controllers\TwibbonMemberController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\AkunAdminController;
use App\Http\Controllers\JuriController;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UnggahController;
use App\Http\Controllers\CountdownController;
use App\Http\Controllers\TwibboniceController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\KejuaraanController;
use App\Http\Controllers\KejuaraanMemberController;
use App\Http\Controllers\NaskahController;
use App\Http\Controllers\DashboardJuriController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\SekolahAdminController;
use App\Http\Controllers\TimAdminController;
use App\Http\Controllers\KetuaAdminController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LinimasaController;
use App\Http\Controllers\TanggalController;

Route::get('/leader-register', [FrontendController::class, 'ketua'])->name('daftar_ketua');
Route::get('/member-register', [FrontendController::class, 'anggota'])->name('daftar_anggota');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('kelurahanss', [FrontendController::class, 'kelurahann'])->name('kelurahanss');
Route::post('kelurahans', [FrontendController::class, 'kelurahan'])->name('kelurahans');
Route::post('bidang', [FrontendController::class, 'bidang'])->name('bidang-kategori');
Route::post('sekolah-tim', [FrontendController::class, 'sekolah'])->name('tim-sekolah');
Route::post('tim-tim', [FrontendController::class, 'tim'])->name('cari-tim');
Route::post('user-user', [FrontendController::class, 'user'])->name('cari-user');
Route::post('province', [FrontendController::class, 'province'])->name('province');
Route::post('/ketua/register', [FrontendController::class, 'daftar_ketua'])->name('ketua_daftar_post')->middleware('guest');
Route::post('/anggota/register', [FrontendController::class, 'daftar_anggota'])->name('anggota_daftar_post')->middleware('guest');
Route::get('/kode/{kode}', [FrontendController::class, 'kode_ref'])->name('kode_ref')->middleware('guest');

Route::group(['prefix' => 'leader', 'middleware' => ['auth','leader']], function(){
    Route::get('/dashboard', [DashboardLeaderController::class, 'dashboard'])->name('leader');
    Route::get('/akun', [DashboardLeaderController::class, 'akun'])->name('akun.leader');
    Route::put('/akun', [DashboardLeaderController::class, 'simpan_akun'])->name('akun.leader.save');
    Route::get('/biodata', [DashboardLeaderController::class, 'biodata'])->name('biodata.leader');
    Route::put('/biodata', [DashboardLeaderController::class, 'simpan_biodata'])->name('biodata.leader.save');
    Route::get('/tim', [DashboardLeaderController::class, 'tim'])->name('tim.leader');
    Route::put('/tim', [DashboardLeaderController::class, 'simpan_tim'])->name('tim.leader.save');
    Route::get('/anggota', [DashboardLeaderController::class, 'anggota'])->name('anggota.leader');
    Route::get('/pembimbing', [DashboardLeaderController::class, 'pembimbing'])->name('pembimbing.leader');
    Route::put('/pembimbing', [DashboardLeaderController::class, 'simpan_pembimbing'])->name('pembimbing.leader.save');
    Route::resource('kejuaraan', KejuaraanController::class);
    Route::get('kejuaraan/{id}/delete', [KejuaraanController::class, 'destroy'])->name('hapus.kejuaraan');


    Route::resource('berkas', BerkasController::class);
    Route::get('berkas/{id}/delete', [BerkasController::class, 'destroy'])->name('hapus.berkas');
    Route::resource('proposal', ProposalController::class);
    Route::get('proposal/{id}/delete', [ProposalController::class, 'destroy'])->name('hapus.proposal');
    Route::get('proposal/{id}/unduh/pdf', [ProposalController::class, 'pdf'])->name('proposal.unduh.bukti');

    Route::resource('naskah', NaskahController::class);
    Route::get('naskah/{id}/delete', [NaskahController::class, 'destroy'])->name('hapus.naskah');
    Route::resource('poster', PosterController::class);
    Route::get('poster/{id}/delete', [PosterController::class, 'destroy'])->name('hapus.poster');
    Route::resource('presentasi', PresentasiController::class);
    Route::get('presentasi/{id}/delete', [PresentasiController::class, 'destroy'])->name('hapus.presentasi');



    Route::get('/ortu', [DashboardLeaderController::class, 'ortu'])->name('ortu.leader');
    Route::put('/ortu', [DashboardLeaderController::class, 'simpan_ortu'])->name('ortu.leader.save');
    Route::resource('unggahan', UnggahanController::class);
    Route::get('unggahan/{id}/delete', [UnggahanController::class, 'destroy'])->name('hapus.unggahan');
    Route::get('/unggah/{id}', [UnggahanController::class, 'cek'])->name('unggah');
    Route::get('/sekolah', [DashboardLeaderController::class, 'sekolah'])->name('sekolah.leader');
    Route::put('/sekolah', [DashboardLeaderController::class, 'simpan_sekolah'])->name('sekolah.leader.save');
    Route::resource('twibbonice', TwibbonController::class);
    Route::get('twibbonice/{id}/delete', [TwibbonController::class, 'destroy'])->name('hapus.twibbonice');
});

Route::group(['prefix' => 'juri', 'middleware' => ['auth','juri']], function(){
    Route::get('/dashboard', [DashboardJuriController::class, 'dashboard'])->name('juri');
    Route::get('/proposal', [DashboardJuriController::class, 'proposal'])->name('proposal.juri');
    Route::get('/proposal/{id}', [DashboardJuriController::class, 'nilai_proposal'])->name('proposal.re');
    Route::post('/proposal/{id}/simpan', [DashboardJuriController::class, 'simpan_review'])->name('simpan_review');
    Route::get('/review-proposal', [DashboardJuriController::class, 'review_proposal'])->name('proposal.review');
    Route::get('/seleksi-proposal/edit/{id}', [DashboardJuriController::class, 'edit_review'])->name('seleksi_proposal.edit');
    Route::put('/seleksi-proposal/{id}/update', [DashboardJuriController::class, 'update_review'])->name('perbarui_review');

    Route::get('/naskah', [DashboardJuriController::class, 'naskah'])->name('naskah.juri');
    Route::get('/naskah/{id}', [DashboardJuriController::class, 'nilai_naskah'])->name('nilai.naskah');
    Route::post('/naskah/{id}/simpan', [DashboardJuriController::class, 'simpan_nilai'])->name('simpan_nilai');
    Route::get('/review-naskah', [DashboardJuriController::class, 'review_naskah'])->name('naskah.review');
    Route::get('/ranking-naskah', [DashboardJuriController::class, 'ranking_naskah'])->name('naskah.ranking');
    Route::get('/review-naskah/{id}', [DashboardJuriController::class, 'edit_review_naskah'])->name('edit.nilai.naskah');
    Route::put('/review-naskah/{id}/simpan', [DashboardJuriController::class, 'simpan_nilai_naskah'])->name('simpan.nilai.naskah');

    Route::get('/poster', [DashboardJuriController::class, 'poster'])->name('poster.juri');
    Route::get('/poster/{id}', [DashboardJuriController::class, 'nilai_poster'])->name('nilai.poster');
    Route::post('/poster/{id}/simpan', [DashboardJuriController::class, 'simpan_nilai_poster'])->name('simpan_nilai_poster');
    Route::get('/review-poster', [DashboardJuriController::class, 'review_poster'])->name('poster.review');
    Route::get('/review-poster/{id}', [DashboardJuriController::class, 'edit_review_poster'])->name('edit.nilai.poster');
    Route::put('/review-poster/{id}/simpan', [DashboardJuriController::class, 'update_nilai_poster'])->name('simpan.nilai.poster');

    Route::get('/presentasi', [DashboardJuriController::class, 'presentasi'])->name('presentasi.juri');
    Route::get('/presentasi/{id}', [DashboardJuriController::class, 'nilai_presentasi'])->name('nilai.presentasi');
    Route::post('/presentasi/{id}/simpan', [DashboardJuriController::class, 'simpan_nilai_presentasi'])->name('simpan_nilai_presentasi');
    Route::get('/review-presentasi', [DashboardJuriController::class, 'review_presentasi'])->name('presentasi.review');
    Route::get('/review-presentasi/{id}', [DashboardJuriController::class, 'edit_review_presentasi'])->name('edit.nilai.presentasi');
    Route::put('/review-presentasi/{id}/simpan', [DashboardJuriController::class, 'update_nilai_presentasi'])->name('simpan.nilai.presentasi');
});

Route::group(['prefix' => 'member', 'middleware' => ['auth','member']], function(){
    Route::get('/dashboard', [DashboardMemberController::class, 'dashboard'])->name('member');
    Route::get('/akun-member', [DashboardMemberController::class, 'akun'])->name('akun.member');
    Route::put('/akun-member', [DashboardMemberController::class, 'simpan_akun'])->name('akun.member.save');
    Route::get('/biodata-member', [DashboardMemberController::class, 'biodata'])->name('biodata.member');
    Route::put('/biodata-member', [DashboardMemberController::class, 'simpan_biodata'])->name('biodata.member.save');
    Route::resource('kejuaraan-member', KejuaraanMemberController::class);
    Route::get('kejuaraan-member/{id}/delete', [KejuaraanMemberController::class, 'destroy'])->name('hapus.kejuaraan-member');
    Route::get('/ortu-member', [DashboardMemberController::class, 'ortu'])->name('ortu.member');
    Route::put('/ortu-member', [DashboardMemberController::class, 'simpan_ortu'])->name('ortu.member.save');
    Route::resource('twibbonice-member', TwibbonMemberController::class);
    Route::get('twibbonice-member/{id}/delete', [TwibbonMemberController::class, 'destroy'])->name('hapus.twibbonice-member');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('admin');
    Route::resource('akun', AkunController::class);
    Route::get('akun/{id}/delete', [AkunController::class, 'destroy'])->name('hapus.akun');
    Route::resource('sekolah', SekolahAdminController::class);
    Route::get('sekolah/{id}/delete', [SekolahAdminController::class, 'destroy'])->name('hapus.sekolah');
    Route::resource('tim', TimAdminController::class);
    Route::get('tim/{id}/delete', [TimAdminController::class, 'destroy'])->name('hapus.tim');
    Route::resource('pembimbing', PembimbingController::class);
    Route::get('pembimbing/{id}/delete', [PembimbingController::class, 'destroy'])->name('hapus.pembimbing');
    Route::resource('ketua', KetuaAdminController::class);
    Route::get('ketua/{id}/delete', [KetuaAdminController::class, 'destroy'])->name('hapus.ketua');
    Route::resource('bidang', BidangController::class);
    Route::get('bidang/{id}/delete', [BidangController::class, 'destroy'])->name('hapus.bidang');
    Route::resource('info', InfoController::class);
    Route::get('info/{id}/delete', [InfoController::class, 'destroy'])->name('hapus.info');
    Route::resource('linimasa', LinimasaController::class);
    Route::get('linimasa/{id}/delete', [LinimasaController::class, 'destroy'])->name('hapus.linimasa');
    Route::resource('tanggal', TanggalController::class);
    Route::get('tanggal/{id}/delete', [TanggalController::class, 'destroy'])->name('hapus.tanggal');
});

require __DIR__.'/auth.php';

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
