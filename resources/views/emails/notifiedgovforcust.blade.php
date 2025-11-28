<html>
@php
date_default_timezone_set('Asia/Jakarta');
@endphp

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:700px; margin:50px auto 10px;background-color:#fff !important;padding:50px;border-radius:3px;box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); background : url('https://raw.githubusercontent.com/mochammadqaysa/cdn/refs/heads/main/frame-email.png'); background-size: 100% 100%;  background-repeat: no-repeat;">
    <thead>
      <tr>
        <td colspan="2" style="text-align:center; padding-bottom:10px; border-bottom:2px solid #000;">
          <table width="100%" style="border:none;">
            <tr>
              <td style="width:10%; text-align:center;">
                <img src="https://raw.githubusercontent.com/tonnyheru/cdn-pengadilan/refs/heads/main/logo.png" alt="Logo" style="max-width:90px;">
              </td>
              <td style="width:80%; text-align:center; font-family: 'Times New Roman', Times, serif;">
                <div style="font-size:14px; font-weight:bold;">MAHKAMAH AGUNG REPUBLIK INDONESIA</div>
                <div style="font-size:14px; font-weight:bold;">DIREKTORAT JENDERAL BADAN PERADILAN UMUM</div>
                <div style="font-size:14px; font-weight:bold;">PENGADILAN TINGGI BANDUNG</div>
                <div style="font-size:20px; font-weight:bold;">PENGADILAN NEGERI BALE BANDUNG</div>
                <div style="font-size:12px;">Jl. Jaksa Naranata, Baleendah, Kabupaten Bandung 40375</div>
                <div style="font-size:12px;">Tlp/Fax: (022) 5940791 | Website: pn-balebandung.go.id | Email: pn.balebandung@gmail.com</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2" style="height:10px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="padding:10px 0;font-size:14px;">
          <p style="margin:0 0 40px 0;"><strong>Subjek: Pemberitahuan Status Pengajuan - Menuju Validasi Disdukcapil</strong></p>
          
          <p style="margin:0 0 30px 0;">Kepada Yth.<br>
          {{ @$data['nama_pemohon'] }}<br>
          {{ @$data['alamat_pemohon'] }}</p>

          <p style="margin:0 0 10px 0;">Dengan hormat,<br>Pengajuan dokumen administrasi catatan sipil Anda telah berhasil dikirim melalui Pengadilan Negeri Bale Bandung dan saat ini sedang menunggu proses verifikasi serta validasi dari pihak Disdukcapil. Mohon untuk memantau notifikasi berikutnya terkait hasil proses validasi.</p>

          <p style="margin:20px 0 5px 0;"><strong>Detail Pengajuan Anda:</strong></p>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="">
          <table width="100%" style="border:none;font-size:14px;">
            <tr>
              <td style="width:25%; text-align:left;">Nama Pemohon</td>
              <td style="width:3%; text-align:left;">:</td>
              <td style="width:72%; text-align:left;">{{ @$data['nama'] }}</td>
            </tr>
            <tr>
              <td style="width:25%; text-align:left;">Nomor Perkara</td>
              <td style="width:3%; text-align:left;">:</td>
              <td style="width:72%; text-align:left;">{{ @$data['no_perkara'] }}</td>
            </tr>
            <tr>
              <td style="width:25%; text-align:left;">Jenis Permohonan</td>
              <td style="width:3%; text-align:left;">:</td>
              <td style="width:72%; text-align:left;">{{ @$data['jenis_perkara'] }}</td>
            </tr>
            <tr>
              <td style="width:25%; text-align:left;">Tanggal Pengajuan</td>
              <td style="width:3%; text-align:left;">:</td>
              <td style="width:72%; text-align:left;">{{ @$data['tanggal_pengajuan'] }}</td>
            </tr>
            <tr>
              <td style="width:25%; text-align:left;">Berkas Terlampir</td>
              <td style="width:3%; text-align:left;">:</td>
              <td style="width:72%; text-align:left;">-</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding-top:20px;font-size:14px;">
          <p>Kami akan memberitahukan status terbaru setelah proses validasi oleh Disdukcapil selesai dilakukan, Terima Kasih.</p>
        </td>
      </tr>

      {{-- <tr>
        <td colspan="2" style="padding-top:20px;font-size:14px;">
          <p style="margin:0;"><strong>MAHKAMAH AGUNG REPUBLIK INDONESIA</strong></p>
          <p style="margin:0;">DIREKTORAT JENDERAL BADAN PERADILAN UMUM</p>
          <p style="margin:0;"><strong>PENGADILAN TINGGI BANDUNG</strong></p>
          <p style="margin:0;"><strong>PENGADILAN NEGERI BALE BANDUNG</strong></p>
          <p style="margin:0;">Jl. Jaksa Naranata Kel/Kec. Bale Endah Kabupaten Bandung, Jawa Barat 40375</p>
          <p style="margin:0;">Tlp/Fax. (022) 5940791</p>
          <p style="margin:0;">Website: pn-balebandung.go.id | Email: pn.balebandung@gmail.com</p>
        </td>
      </tr> --}}

      <tr>
        <td colspan="2" style="padding-top:20px;">
          <table width="100%" style="border:none;font-size:14px;">
            <tr>
              <td style="width:50%; text-align:left;"></td>
              <td style="width:20%; text-align:left;"></td>
              <td style="width:30%; text-align:center;">Hormat Kami,<br>Admin PN Bale Bandung</td>
            </tr>
            <tr style="height: 70px;"></tr>
            <tr>
              <td style="width:50%; text-align:left;"></td>
              <td style="width:20%; text-align:left;"></td>
              <td style="width:30%; text-align:center;">ttd.</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="height:150px;">&nbsp;</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
