<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Village;
use App\Models\District;
use App\Models\Penduduk;
use App\Models\Province;
use App\Models\Regencie;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PendudukResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;

class PendudukResource extends Resource implements HasShieldPermissions
{
    use HasShieldFormComponents;
    protected static ?string $model = Penduduk::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $title = 'Penduduk';

    protected static ?string $navigationLabel = 'Penduduk';

    protected static ?string $pluralModelLabel = 'Penduduk';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-m-user-group';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'restore',
            'restore_any',
            'force_delete',
            'force_delete_any',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Wizard::make([
                    // Langkah 1: Data Pribadi
                    \Filament\Forms\Components\Wizard\Step::make('Data Pribadi')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('kk')
                                ->label('Nomor KK')
                                ->mask('9999999999999999')
                                ->placeholder('Isi dengan 0 (nol) sebanyak 16 digit jika data tidak ada')
                                ->required()
                                ->minLength(16)
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 3
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('nik')
                                ->label('Nomor NIK')
                                ->mask('9999999999999999')
                                ->placeholder('Isi dengan 0 (nol) sebanyak 16 digit jika data tidak ada')
                                ->required()
                                ->minLength(16)
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 3
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('nama_lengkap')
                                ->label('Nama Lengkap')
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 6
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('nama_lengkap', strtoupper($state));
                                }),
                            \Filament\Forms\Components\Select::make('jenis_kelamin')
                                ->label('Jenis Kelamin')
                                ->options([
                                    'L' => 'Laki-laki',
                                    'P' => 'Perempuan'
                                ])
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\Select::make('agama')
                                ->label('Agama')
                                ->options([
                                    'Islam' => 'Islam',
                                    'Protestan' => 'Protestan',
                                    'Katolik' => 'Katolik',
                                    'Hindu' => 'Hindu',
                                    'Budha' => 'Budha',
                                    'Konghucu' => 'Konghucu'
                                ])
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\Select::make('status_pernikahan')
                                ->label('Status Pernikahan')
                                ->options([
                                    'Belum Kawin' => 'Belum Kawin',
                                    'Kawin' => 'Kawin',
                                    'Cerai Hidup' => 'Cerai Hidup',
                                    'Cerai Mati' => 'Cerai Mati',
                                ])
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('tempat_lahir')
                                ->label('Tempat Lahir')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 4
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('tempat_lahir', strtoupper($state));
                                }),
                            \Filament\Forms\Components\DatePicker::make('tanggal_lahir')
                                ->label('Tanggal Lahir')
                                ->required()
                                ->native(false)
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                        ])
                        ->columns(6)
                        ->columnSpanFull(),

                    // Langkah 2: Informasi Pendidikan & Pekerjaan
                    \Filament\Forms\Components\Wizard\Step::make('Pendidikan & Pekerjaan')
                        ->schema([
                            \Filament\Forms\Components\Select::make('pendidikan')
                                ->label('Pendidikan Terakhir')
                                ->options([
                                    'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
                                    'Belum Tamat SD/Sederajat' => 'Belum Tamat SD/Sederajat',
                                    'Tamat SD/Sederajat' => 'Tamat SD/Sederajat',
                                    'SLTP/Sederajat' => 'SLTP/Sederajat',
                                    'SLTA/Sederajat' => 'SLTA/Sederajat',
                                    'Diploma I (D1)' => 'Diploma I (D1)',
                                    'Diploma II (D2)' => 'Diploma II (D2)',
                                    'Diploma III (D3)' => 'Diploma III (D3)',
                                    'Diploma IV (D4)/Sarjana Terapan' => 'Diploma IV (D4)/Sarjana Terapan',
                                    'Strata I (S1)' => 'Strata I (S1)',
                                    'Strata II (S2)' => 'Strata II (S2)',
                                    'Strata III (S3)' => 'Strata III (S3)',
                                ])
                                ->required()
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\Select::make('jenis_pekerjaan')
                                ->label('Jenis Pekerjaan')
                                ->options([
                                    "Belum/Tidak Bekerja" => "Belum/Tidak Bekerja",
                                    "Mengurus Rumah Tangga" => "Mengurus Rumah Tangga",
                                    "Pelajar/Mahasiswa" => "Pelajar/Mahasiswa",
                                    "Pensiunan" => "Pensiunan",
                                    "Pewagai Negeri Sipil (PNS)" => "Pewagai Negeri Sipil (PNS)",
                                    "Tentara Nasional Indonesia (TNI)" => "Tentara Nasional Indonesia (TNI)",
                                    "Kepolisian RI (POLRI)" => "Kepolisian RI (POLRI)",
                                    "Perdagangan" => "Perdagangan",
                                    "Petani/Pekebun" => "Petani/Pekebun",
                                    "Peternak" => "Peternak",
                                    "Nelayan/Perikanan" => "Nelayan/Perikanan",
                                    "Industri" => "Industri",
                                    "Konstruksi" => "Konstruksi",
                                    "Transportasi" => "Transportasi",
                                    "Karyawan Swasta" => "Karyawan Swasta",
                                    "Karyawan BUMN" => "Karyawan BUMN",
                                    "Karyawan BUMD" => "Karyawan BUMD",
                                    "Karyawan Honorer" => "Karyawan Honorer",
                                    "Buruh Harian Lepas" => "Buruh Harian Lepas",
                                    "Buruh Tani/Perkebunan" => "Buruh Tani/Perkebunan",
                                    "Buruh Nelayan/Perikanan" => "Buruh Nelayan/Perikanan",
                                    "Buruh Peternakan" => "Buruh Peternakan",
                                    "Pembantu Rumah Tangga" => "Pembantu Rumah Tangga",
                                    "Tukang Cukur" => "Tukang Cukur",
                                    "Tukang Listrik" => "Tukang Listrik",
                                    "Tukang Batu" => "Tukang Batu",
                                    "Tukang Kayu" => "Tukang Kayu",
                                    "Tukang Sol Sepatu" => "Tukang Sol Sepatu",
                                    "Tukang Las/Pandai Besi" => "Tukang Las/Pandai Besi",
                                    "Tukang Jahit" => "Tukang Jahit",
                                    "Penata Rias" => "Penata Rias",
                                    "Penata Busana" => "Penata Busana",
                                    "Penata Rambut" => "Penata Rambut",
                                    "Mekanik" => "Mekanik",
                                    "Seniman" => "Seniman",
                                    "Tabib" => "Tabib",
                                    "Paraji" => "Paraji",
                                    "Perancang Busana" => "Perancang Busana",
                                    "Penterjemah" => "Penterjemah",
                                    "Imam Masjid" => "Imam Masjid",
                                    "Pendeta" => "Pendeta",
                                    "Pastor" => "Pastor",
                                    "Wartawan" => "Wartawan",
                                    "Ustadz/Mubaligh" => "Ustadz/Mubaligh",
                                    "Juru Masak" => "Juru Masak",
                                    "Promotor Acara" => "Promotor Acara",
                                    "Anggota DPR-RI" => "Anggota DPR-RI",
                                    "Anggota DPD" => "Anggota DPD",
                                    "Anggota BPK" => "Anggota BPK",
                                    "Presiden" => "Presiden",
                                    "Wakil Presiden" => "Wakil Presiden",
                                    "Anggota Mahkamah Konstitusi" => "Anggota Mahkamah Konstitusi",
                                    "Anggota Kabinet/Kementerian" => "Anggota Kabinet/Kementerian",
                                    "Duta Besar" => "Duta Besar",
                                    "Gubernur" => "Gubernur",
                                    "Wakil Gubernur" => "Wakil Gubernur",
                                    "Bupati" => "Bupati",
                                    "Wakil Bupati" => "Wakil Bupati",
                                    "Walikota" => "Walikota",
                                    "Wakil Walikota" => "Wakil Walikota",
                                    "Anggota DPRD Provinsi" => "Anggota DPRD Provinsi",
                                    "Anggota DPRD Kabupaten/Kota" => "Anggota DPRD Kabupaten/Kota",
                                    "Dosen" => "Dosen",
                                    "Guru" => "Guru",
                                    "Pilot" => "Pilot",
                                    "Pengacara" => "Pengacara",
                                    "Notaris" => "Notaris",
                                    "Arsitek" => "Arsitek",
                                    "Akuntan" => "Akuntan",
                                    "Konsultan" => "Konsultan",
                                    "Dokter" => "Dokter",
                                    "Bidan" => "Bidan",
                                    "Perawat" => "Perawat",
                                    "Apoteker" => "Apoteker",
                                    "Psikiater/Psikolog" => "Psikiater/Psikolog",
                                    "Penyiar Televisi" => "Penyiar Televisi",
                                    "Penyiar Radio" => "Penyiar Radio",
                                    "Pelaut" => "Pelaut",
                                    "Peneliti" => "Peneliti",
                                    "Sopir" => "Sopir",
                                    "Pialang" => "Pialang",
                                    "Paranormal" => "Paranormal",
                                    "Pedagang" => "Pedagang",
                                    "Perangkat Desa" => "Perangkat Desa",
                                    "Kepala Desa" => "Kepala Desa",
                                    "Biarawati" => "Biarawati",
                                    "Wiraswasta" => "Wiraswasta"
                                ])
                                ->required()
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                        ])
                        ->columnSpanFull(),

                    // Langkah 3: Data Keluarga
                    \Filament\Forms\Components\Wizard\Step::make('Data Keluarga')
                        ->schema([
                            \Filament\Forms\Components\Select::make('status_hubungan_keluarga')
                                ->label('Status Dalam Keluarga')
                                ->options([
                                    'Suami' => 'Suami',
                                    'Istri' => 'Istri',
                                    'Anak' => 'Anak'
                                ])
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 6
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('nama_ayah')
                                ->label('Nama Ayah')
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 3
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('nama_ayah', strtoupper($state));
                                }),
                            \Filament\Forms\Components\TextInput::make('nama_ibu')
                                ->label('Nama Ibu')
                                ->required()
                                ->columnSpan([
                                    'sm' => 6,
                                    'md' => 3
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('nama_ibu', strtoupper($state));
                                }),
                        ])
                        ->columns(6)
                        ->columnSpanFull(),

                    // Langkah 4: Alamat Lengkap
                    \Filament\Forms\Components\Wizard\Step::make('Alamat Lengkap')
                        ->schema([
                            \Filament\Forms\Components\Select::make('kewarganegaraan')
                                ->label('Kewarganeragaan')
                                ->options([
                                    'WNI' => 'WNI',
                                    'WNA' => 'WNA'
                                ])
                                ->required()
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('no_paspor')
                                ->label('Nomor Paspor')
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 3
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('no_kitas_kitap')
                                ->label('Nomor KITAS / KITAP')
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 3
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\Select::make('provinsi')
                                ->label('Provinsi')
                                ->required()
                                ->options(
                                    Province::query()->pluck('name', 'id')->toArray()
                                )
                                ->searchable()
                                ->reactive()
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('kabupaten', null);
                                }),
                            \Filament\Forms\Components\Select::make('kabupaten_kota')
                                ->label('Kabupaten/Kota')
                                ->required()
                                ->options(
                                    fn(callable $get) => Regencie::query()->where('province_id', $get('provinsi'))->pluck('name', 'id')->toArray()
                                )
                                ->searchable()
                                ->reactive()
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('kecamatan', null);
                                }),
                            \Filament\Forms\Components\Select::make('kecamatan')
                                ->label('Kecamatan')
                                ->required()
                                ->options(
                                    fn(callable $get) => District::query()->where('regency_id', $get('kabupaten_kota'))->pluck('name', 'id')->toArray()
                                )
                                ->searchable()
                                ->reactive()
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('desa', null);
                                }),

                            \Filament\Forms\Components\Select::make('desa_kelurahan')
                                ->label('Desa/Kelurahan')
                                ->required()
                                ->options(
                                    fn(callable $get) => Village::query()->where('district_id', $get('kecamatan'))->pluck('name', 'id')->toArray()
                                )->searchable()
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 2
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\Textarea::make('alamat')
                                ->label('Alamat')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 5
                                ])
                                ->live()
                                ->lazy()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                    $set('alamat', strtoupper($state));
                                }),
                            \Filament\Forms\Components\TextInput::make('rt')
                                ->required()
                                ->maxLength(3)
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 1
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('rw')
                                ->required()
                                ->maxLength(3)
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 1
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                            \Filament\Forms\Components\TextInput::make('kode_pos')
                                ->required()
                                ->maxLength(5)
                                ->columnSpan([
                                    'sm' => 8,
                                    'md' => 1
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, $livewire, $component, $set) {
                                    $livewire->validateOnly($component->getStatePath());
                                }),
                        ])
                        ->columns(8)
                        ->columnSpanFull(),
                ])
                    ->nextAction(
                        fn($action, $record) => $action->extraAttributes(fn() => $record !== null ? ['class' => 'hidden'] : ['class' => ''])
                    )
                    ->previousAction(
                        fn($action, $record) => $action->extraAttributes(fn() => $record !== null ? ['class' => 'hidden'] : ['class' => ''])
                    )
                    ->skippable(fn($record) => $record !== null)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('kk')
                    ->label('Nomor KK')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nik')
                    ->label('Nomor NIK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn($state) => ($state === "L") ? 'LAKI-LAKI' : 'PEREMPUAN')
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('agama')
                    ->label('Agama')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pendidikan')
                    ->label('Pendidikan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('jenis_pekerjaan')
                    ->label('Jenis Pekerjaan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_pernikahan')
                    ->label('Status Pernikahan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_hubungan_keluarga')
                    ->label('Status Hubungan Keluarga')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kewarganegaraan')
                    ->label('Kewarganegaraan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('no_paspor')
                    ->label('No Paspor')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('no_kitas_kitap')
                    ->label('No Kitas/Kitap')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_ayah')
                    ->label('Nama Ayah')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->label('Nama Ibu')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat Lengkap')
                    ->formatStateUsing(function ($record) {
                        $provinsi = Province::find($record->provinsi)->name;
                        $kabupaten_kota = Regencie::find($record->kabupaten_kota)->name;
                        $kecamatan = District::find($record->kecamatan)->name;
                        $desa_kelurahan = Village::find($record->desa_kelurahan)->name;
                        return \Illuminate\Support\Str::limit("{$record->alamat} RT.{$record->rt} RW.{$record->rw} DESA/KELURAHAN {$desa_kelurahan} KECAMATAN {$kecamatan} {$kabupaten_kota} PROVINSI {$provinsi} NEGARA INDONESIA {$record->kode_pos}", 35);
                    })
                    ->tooltip(function ($record) {
                        $provinsi = Province::find($record->provinsi)->name;
                        $kabupaten_kota = Regencie::find($record->kabupaten_kota)->name;
                        $kecamatan = District::find($record->kecamatan)->name;
                        $desa_kelurahan = Village::find($record->desa_kelurahan)->name;
                        return "{$record->alamat} RT.{$record->rt} RW.{$record->rw} DESA/KELURAHAN {$desa_kelurahan} KECAMATAN {$kecamatan} {$kabupaten_kota} PROVINSI {$provinsi} NEGARA INDONESIA {$record->kode_pos}";
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat')
                        ->closeModalByClickingAway(false)
                        ->modalWidth(\Filament\Support\Enums\MaxWidth::SevenExtraLarge),
                    Tables\Actions\EditAction::make()
                        ->label('Ubah'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus'),
                    Tables\Actions\RestoreAction::make()
                        ->label('Kembalikan'),
                    Tables\Actions\ForceDeleteAction::make()
                        ->label('Hapus Selamanya'),
                ]),
            ])
            ->actionsColumnLabel('Aksi')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            // 'view' => Pages\ViewPenduduks::route('/{record}'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count()
            ? static::getModel()::count()
            : null;
    }

}
