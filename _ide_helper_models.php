<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Agenda
 *
 * @property int $id
 * @property int|null $rapat_yayasan_id
 * @property string|null $tanggal
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereRapatYayasanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereUpdatedAt($value)
 */
	class Agenda extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AktifitasUser
 *
 * @property int $id
 * @property string|null $nama
 * @property string $aktifitas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser whereAktifitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AktifitasUser whereUpdatedAt($value)
 */
	class AktifitasUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Alhisan
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $logo
 * @property string|null $email
 * @property string|null $ig
 * @property string|null $fb
 * @property string|null $youtube
 * @property string|null $telegram
 * @property string|null $no_hp
 * @property string|null $no_telpon
 * @property string|null $tentang
 * @property string|null $visi
 * @property string|null $misi
 * @property string|null $tujuan
 * @property string|null $alamat
 * @property string|null $sejarah
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereFb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereIg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereMisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereNoTelpon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereSejarah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereTelegram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereTentang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereVisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alhisan whereYoutube($value)
 */
	class Alhisan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Artikel
 *
 * @property int $id
 * @property string $slug
 * @property int|null $kategori_id
 * @property int $user_id
 * @property string $judul
 * @property string $konten
 * @property string|null $thumbnail
 * @property int|null $dilihat
 * @property string|null $dipublikasi
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereDilihat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereDipublikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereKonten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artikel whereUserId($value)
 */
	class Artikel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bagian
 *
 * @property int $id
 * @property string $nama
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bagian whereUpdatedAt($value)
 */
	class Bagian extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Galeri
 *
 * @property int $id
 * @property string|null $filename
 * @property int|null $kategori_id
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri query()
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galeri whereUpdatedAt($value)
 */
	class Galeri extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Inventaris
 *
 * @property int $id
 * @property string|null $kode
 * @property string $nama
 * @property int|null $kategori_id
 * @property int|null $harga_beli_satuan
 * @property int|null $jumlah
 * @property string|null $keadaan
 * @property string|null $foto
 * @property string|null $tahun_pembelian
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereHargaBeliSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereKeadaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereTahunPembelian($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventaris whereUpdatedAt($value)
 */
	class Inventaris extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\KalimatHikmah
 *
 * @property int $id
 * @property string|null $penulis
 * @property string|null $text
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah query()
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah wherePenulis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KalimatHikmah whereUpdatedAt($value)
 */
	class KalimatHikmah extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\KasKeluar
 *
 * @property int $id
 * @property string $untuk
 * @property string|null $keterangan
 * @property string|null $nominal
 * @property string|null $tanggal
 * @property string|null $bukti_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereUntuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasKeluar whereUpdatedAt($value)
 */
	class KasKeluar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\KasMasuk
 *
 * @property int $id
 * @property string|null $dari
 * @property string|null $keterangan
 * @property string|null $nominal
 * @property string|null $tanggal
 * @property string|null $bukti_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk query()
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereDari($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KasMasuk whereUpdatedAt($value)
 */
	class KasMasuk extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kategori
 *
 * @property int $id
 * @property string $slug
 * @property string $nama
 * @property string $kategori
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereUpdatedAt($value)
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PengurusYayasan
 *
 * @property int $id
 * @property int $user_id
 * @property string $nama
 * @property string|null $foto
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PengurusYayasan whereUserId($value)
 */
	class PengurusYayasan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PesertaRapatYayasan
 *
 * @property int $id
 * @property int $rapat_yayasan_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan whereRapatYayasanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PesertaRapatYayasan whereUserId($value)
 */
	class PesertaRapatYayasan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $nik
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $jenis_kelamin
 * @property string|null $foto
 * @property string|null $no_hp
 * @property string|null $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereTempatLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RapatYayasan
 *
 * @property int $id
 * @property string $kode
 * @property string|null $tanggal
 * @property string|null $bahasan
 * @property string|null $hasil
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan query()
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereBahasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereHasil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RapatYayasan whereUpdatedAt($value)
 */
	class RapatYayasan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StrukturOrganisasi
 *
 * @property int $id
 * @property int $pengurus_yayasan_id
 * @property int $bagian_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi whereBagianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi wherePengurusYayasanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrukturOrganisasi whereUpdatedAt($value)
 */
	class StrukturOrganisasi extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $photo
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

