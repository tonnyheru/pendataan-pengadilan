CREATE TABLE submission (
    uid VARCHAR(40) PRIMARY KEY,
    no_perkara VARCHAR(40) UNIQUE,
    submission_type ENUM('perbaikan_akta', 'akta_kematian', 'akta_perkawinan', 'akta_perceraian', 'pengangkatan_anak', 'pengesahan_anak', 'pengakuan_anak', 'pembatalan_akta_kelahiran', 'pembatalan_perceraian', 'pembatalan_perkawinan') DEFAULT NULL,
    pemohon_uid varchar(40) DEFAULT NULL,
    status VARCHAR(1),
    catatan text DEFAULT NULL,
    approved_at TIMESTAMP NULL DEFAULT NULL,
    approved_by VARCHAR(40),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by VARCHAR(40),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by VARCHAR(40),
    FOREIGN KEY (pemohon_uid) REFERENCES pemohon(uid) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(uid) ON DELETE CASCADE,
    FOREIGN KEY (updated_by) REFERENCES users(uid) ON DELETE CASCADE
);
