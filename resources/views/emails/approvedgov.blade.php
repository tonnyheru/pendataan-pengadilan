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
              <td style="width:5%; text-align:center;">
                <img src="{{ @$data['logo'] }}" alt="Logo" style="max-width:80px;">
              </td>
              <td style="width:95%; text-align:center; font-family: 'Times New Roman', Times, serif;">
                <div style="font-size:14px; font-weight:bold;">PEMERINTAH DAERAH {{ @$data['daerah_disdukcapil'] }}</div>
                <div style="font-size:16px; font-weight:bold;">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>
                <div style="font-size:11px;">{{ @$data['alamat_disdukcapil'] }}</div>
                <div style="font-size:11px;">{!! @$data['alamat-line2'] !!}</div>
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
          <p style="margin:0 0 40px 0;"><strong>Subjek: Usulan Pemohon Telah Disetujui oleh Disdukcapil</strong></p>
          
          <p style="margin:0 0 30px 0;">Kepada Yth.<br>
           Pengadilan Negeri Bale Bandung<br>
          Jalan Jaksa Naranata Kel/Kec. Bale Endah Kabupaten Bandung, Jawa Barat 40375</p>

          <p style="margin:0 0 10px 0;">Dengan hormat,<br> Kami informasikan bahwa usulan pemohon terkait perkara catatan sipil yang diajukan oleh
          Pengadilan Negeri Bale Bandung telah diterima dan disetujui oleh pihak Disdukcapil. Proses
          pembaharuan dokumen catatan sipil untuk pemohon akan segera diproses sesuai dengan
          prosedur yang berlaku.</p>

          <p style="margin:20px 0 5px 0;"><strong> Berikut adalah informasi terkait usulan yang disetujui:</strong></p>
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
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="padding-top:20px;font-size:14px;">
          <p> Terima kasih atas kerjasama yang baik.</p>
        </td>
      </tr>
      
      <tr>
        <td colspan="2" style="height:50;">&nbsp;</td>
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
              <td style="width:30%; text-align:center;">Hormat Kami,<br>Admin Disdukcapil</td>
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
