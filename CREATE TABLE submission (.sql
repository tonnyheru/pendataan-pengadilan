CREATE TABLE submission (
    uid VARCHAR(40) PRIMARY KEY,
    no_perkara VARCHAR(40) UNIQUE,
    submission_type ENUM('perbaikan_akta', 'akta_kematian', 'akta_perkawinan', 'akta_perceraian', 'pengangkatan_anak', 'pengesahan_anak', 'pengakuan_anak', 'pembatalan_akta_kelahiran', 'pembatalan_perceraian', 'pembatalan_perkawinan') DEFAULT NULL,
    pemohon_uid varchar(40) DEFAULT NULL,
    disdukcapil_uid varchar(40) DEFAULT NULL,
    status VARCHAR(1) DEFAULT NULL,
    catatan text DEFAULT NULL,
    approved_at TIMESTAMP NULL DEFAULT NULL,
    approved_by VARCHAR(40),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by VARCHAR(40),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by VARCHAR(40),
    FOREIGN KEY (pemohon_uid) REFERENCES pemohon(uid) ON DELETE CASCADE,
    FOREIGN KEY (disdukcapil_uid) REFERENCES disdukcapil(uid) ON DELETE CASCADE
);

CREATE TABLE submission_documents (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    document_name VARCHAR(255) DEFAULT NULL,
    document_type VARCHAR(100) DEFAULT NULL,
    file_path VARCHAR(255) DEFAULT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE perbaikan_akta_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    jenis_akta VARCHAR(50) DEFAULT NULL,
    nomor_akta VARCHAR(100) DEFAULT NULL,
    jenis_elemen_perbaikan VARCHAR(100) DEFAULT NULL,
    data_sebelum TEXT DEFAULT NULL,
    data_sesudah TEXT DEFAULT NULL,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE akta_kematian_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    nik_jenazah VARCHAR(16) DEFAULT NULL,
    nama_jenazah VARCHAR(255) DEFAULT NULL,
    wilayah_kelahiran ENUM('dalam_negeri', 'luar_negeri') DEFAULT NULL,
    provinsi_kelahiran VARCHAR(100) DEFAULT NULL,
    tanggal_kematian DATE DEFAULT NULL,
    waktu_kematian TIME DEFAULT NULL,
    tempat_kematian VARCHAR(255) DEFAULT NULL,
    sebab_kematian VARCHAR(255) DEFAULT NULL,
    yang_menerangkan VARCHAR(100) DEFAULT NULL,
    keterangan TEXT DEFAULT NULL,

    nik_ayah VARCHAR(16) DEFAULT NULL,
    nama_ayah VARCHAR(255) DEFAULT NULL,
    nik_ibu VARCHAR(16) DEFAULT NULL,
    nama_ibu VARCHAR(255) DEFAULT NULL,

    nik_saksi1 VARCHAR(16) DEFAULT NULL,
    nama_saksi1 VARCHAR(255) DEFAULT NULL,
    nik_saksi2 VARCHAR(16) DEFAULT NULL,
    nama_saksi2 VARCHAR(255) DEFAULT NULL,

    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE akta_perkawinan_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,

    -- Suami
    nik_suami VARCHAR(16) DEFAULT NULL,
    kk_suami VARCHAR(16) DEFAULT NULL,
    nama_suami VARCHAR(255) DEFAULT NULL,
    kewarganegaraan_suami VARCHAR(50) DEFAULT NULL,
    alamat_suami TEXT DEFAULT NULL,
    anak_ke_suami VARCHAR(10) DEFAULT NULL,
    perkawinan_ke_suami VARCHAR(10) DEFAULT NULL,
    nama_istri_terakhir VARCHAR(255) DEFAULT NULL,
    istri_ke VARCHAR(10) DEFAULT NULL,
    nik_ayah_suami VARCHAR(16) DEFAULT NULL,
    nama_ayah_suami VARCHAR(255) DEFAULT NULL,
    nik_ibu_suami VARCHAR(16) DEFAULT NULL,
    nama_ibu_suami VARCHAR(255) DEFAULT NULL,

    -- Istri
    nik_istri VARCHAR(16) DEFAULT NULL,
    kk_istri VARCHAR(16) DEFAULT NULL,
    nama_istri VARCHAR(255) DEFAULT NULL,
    kewarganegaraan_istri VARCHAR(50) DEFAULT NULL,
    alamat_istri TEXT DEFAULT NULL,
    anak_ke_istri VARCHAR(10) DEFAULT NULL,
    perkawinan_ke_istri VARCHAR(10) DEFAULT NULL,
    nama_suami_terakhir VARCHAR(255) DEFAULT NULL,
    nik_ayah_istri VARCHAR(16) DEFAULT NULL,
    nama_ayah_istri VARCHAR(255) DEFAULT NULL,
    nik_ibu_istri VARCHAR(16) DEFAULT NULL,
    nama_ibu_istri VARCHAR(255) DEFAULT NULL,

    -- Saksi
    nik_saksi1 VARCHAR(16) DEFAULT NULL,
    nama_saksi1 VARCHAR(255) DEFAULT NULL,
    nik_saksi2 VARCHAR(16) DEFAULT NULL,
    nama_saksi2 VARCHAR(255) DEFAULT NULL,

    -- Data perkawinan
    tanggal_pemberkatan DATE DEFAULT NULL,
    tempat_pemberkatan VARCHAR(255) DEFAULT NULL,
    tanggal_lapor DATE DEFAULT NULL,
    waktu_lapor TIME DEFAULT NULL,
    agama VARCHAR(100) DEFAULT NULL,
    nama_pemuka_agama VARCHAR(255) DEFAULT NULL,
    no_putusan VARCHAR(100) DEFAULT NULL,
    tanggal_putusan DATE DEFAULT NULL,

    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE akta_perceraian_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,

    -- Suami
    nik_suami VARCHAR(16) DEFAULT NULL,
    kk_suami VARCHAR(16) DEFAULT NULL,
    paspor_suami VARCHAR(50) DEFAULT NULL,
    nama_suami VARCHAR(255) DEFAULT NULL,
    tempat_lahir_suami VARCHAR(100) DEFAULT NULL,
    tanggal_lahir_suami DATE DEFAULT NULL,
    alamat_suami TEXT DEFAULT NULL,
    perceraian_ke VARCHAR(10) DEFAULT NULL,
    kewarganegaraan_suami VARCHAR(50) DEFAULT NULL,

    -- Istri
    nik_istri VARCHAR(16) DEFAULT NULL,
    kk_istri VARCHAR(16) DEFAULT NULL,
    paspor_istri VARCHAR(50) DEFAULT NULL,
    nama_istri VARCHAR(255) DEFAULT NULL,
    tempat_lahir_istri VARCHAR(100) DEFAULT NULL,
    tanggal_lahir_istri DATE DEFAULT NULL,
    alamat_istri TEXT DEFAULT NULL,
    kewarganegaraan_istri VARCHAR(50) DEFAULT NULL,

    -- Data Perceraian
    yang_mengajukan VARCHAR(10) DEFAULT NULL,
    no_akta_kawin VARCHAR(100) DEFAULT NULL,
    tanggal_akta_kawin DATE DEFAULT NULL,
    tempat_perkawinan VARCHAR(255) DEFAULT NULL,
    no_putusan VARCHAR(100) DEFAULT NULL,
    tanggal_putusan DATE DEFAULT NULL,
    sebab_perceraian TEXT DEFAULT NULL,
    tanggal_lapor DATE DEFAULT NULL,
    waktu_lapor TIME DEFAULT NULL,
    keterangan TEXT DEFAULT NULL,

    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE pengangkatan_anak_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    nama_anak VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE pengakuan_anak_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    nama_anak VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);


CREATE TABLE pembatalan_akta_kelahiran_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    nama_pemilik_akta VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE pembatalan_perceraian_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    nama_suami VARCHAR(255) DEFAULT NULL,
    nama_istri VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);

CREATE TABLE pembatalan_perkawinan_details (
    uid VARCHAR(40) PRIMARY KEY,
    submission_uid VARCHAR(40) DEFAULT NULL,
    nama_suami VARCHAR(255) DEFAULT NULL,
    nama_istri VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (submission_uid) REFERENCES submissions(uid) ON DELETE CASCADE
);