
@include('pages.administrasi.pemohon.create.style')
<div class="step-box">
	<div class="step-header">
    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="step-list">
      <div class="step-button" data-tab="1">
          <div class="step-header-number active"><span><i class="fas fa-user-edit"></i></span></div>
          <div class="step-header-title">Data Pemohon</div>
      </div>
      <div class="step-button" data-tab="2">
          <div class="step-header-number"><span><i class="fas fa-th-list"></i></span></div>
          <div class="step-header-title">Detail Pemohon</div>
      </div>
      <div class="step-button" data-tab="3">
          <div class="step-header-number"><span><i class="fas fa-clipboard-check"></i></span></div>
          <div class="step-header-title">Ringkasan</div>
      </div>
    </div>
	</div>
	@include('pages.administrasi.pemohon.create.step1')
	@include('pages.administrasi.pemohon.create.step2')
	@include('pages.administrasi.pemohon.create.step3')
</div>

<script>
//====================================================================================================================================
// Collect and display data from Step 1 and Step 2 to Step 3
function collectAndDisplayData() {
		// Collect data from Step 1
		var customer = $("#customer").select2('data')[0].nama;
		var negara = $("#customer").select2('data')[0].negara;
		var nomor_bukti = $('input[name="nomor_bukti"]').val().toUpperCase();
		var tipe = $('input[name="tipe"]:checked').val();
		var tanggal_bukti = $('input[name="tanggal_bukti"]').val();
		var ppn = $('input[name="ppn"]').val();
		var nomor_peb = $('input[name="nomor_peb"]').val();
		var tanggal_peb = $('input[name="tanggal_peb"]').val();
		
		// Update Step 3 fields
		$('th.customer').html(`${customer} <span class="badge badge-default">${tipe}</span>`);
		$('th.negara').text(negara);
		$('th.nomor-bukti').text(nomor_bukti.toUpperCase());
		$('th.tanggal-bukti').text(tanggal_bukti);
		$('th.ppn').text(ppn + " %");
		$('th.nomor-peb').text(nomor_peb.toUpperCase());
		$('th.tanggal-peb').text(tanggal_peb);

		// Collect and display dynamic data from Step 2 (loop through forms)
		$('#table-barangkeluar-ringkasan tbody').empty(); // Clear table body

		$('#dynamic-form .form-item').each(function(index) {
				var barang = $(this).find(`select[name="barang[${index}]"]`).select2('data')[0].text;
				var jumlah = $(this).find('input[name="jumlah[]"]').val();
				var satuan = $(this).find('.append-satuan').text();
				var bruto = $(this).find('input[name="bruto[]"]').val();
				var netto = $(this).find('input[name="netto[]"]').val();
				var nilai = $(this).find('input[name="nilai[]"]').val();
				var nilai_ppn = $(this).find('input[name="nilai_ppn[]"]').val();
				var nilai_total = $(this).find('input[name="nilai_total[]"]').val();
				let mata_uang = $(this).find('input[name="mata_uang[]"]').val();
				if (tipe == "lokal") {
					mata_uang = "IDR";
				}

				// Append the collected data to the table in Step 3
				$('#table-barangkeluar-ringkasan tbody').append(`
						<tr>
								<td>${index + 1}</td>
								<td>${barang}</td>
								<td>${jumlah} ${satuan}</td>
								<td>${bruto}</td>
								<td>${netto}</td>
								<td>${mata_uang.toUpperCase()}  ${nilai}</td>
								<td>${mata_uang.toUpperCase()} ${nilai_ppn}</td>
								<td>${mata_uang.toUpperCase()} ${nilai_total}</td>
						</tr>
				`);
		});

		if (tipe == "lokal") {
			$('th.ppn').parent().show();
			$('th.nomor-peb').parent().hide();
			$('th.tanggal-peb').parent().hide();

			$('#table-barangkeluar-ringkasan th:nth-child(7)').show();
			$('#table-barangkeluar-ringkasan td:nth-child(7)').show();
			$('#table-barangkeluar-ringkasan th:nth-child(8)').show();
			$('#table-barangkeluar-ringkasan td:nth-child(8)').show();
		} else {
			$('th.ppn').parent().hide();
			$('th.nomor-peb').parent().show();
			$('th.tanggal-peb').parent().show();

			$('#table-barangkeluar-ringkasan th:nth-child(7)').hide();
			$('#table-barangkeluar-ringkasan td:nth-child(7)').hide();
			$('#table-barangkeluar-ringkasan th:nth-child(8)').hide();
			$('#table-barangkeluar-ringkasan td:nth-child(8)').hide();
		}
		
}
// End of Collect and Display Data
//====================================================================================================================================

//====================================================================================================================================
// Stepper
var max_step = 3
var stepper = new Stepper({
	max_step: max_step
})

function nextStep() {
	let curr_position = stepper.position;
	let isValid = false;
	switch(curr_position) {
		case 1:
			isValid = validateStep1();
			if (isValid) {
				const percent = 50;
				$('.progress-bar')
					.css('width', percent + '%')
					.attr('aria-valuenow', percent);
				$('.btn-prev').show()
			}
			break;
		case 2:
      const percent = 85;
      $('.progress-bar')
        .css('width', percent + '%')
        .attr('aria-valuenow', percent);
			isValid = validateStep2();
			// collectAndDisplayData();
			break;
		case 3:
			isValid = true;
			break;
		default:
			break;
	}

	if (!isValid) {
		return;
	}

	if (curr_position == max_step) {
			save();
		return;
	}

	stepper.next();

	$('.step-button[data-tab="'+stepper.position+'"] > .step-header-number').addClass('active')
	$('.step-body[data-tab="'+curr_position+'"]').hide()
	$('.step-body[data-tab="'+stepper.position+'"]').show()

	if(stepper.position == max_step){
		$('.btn-next').text('Simpan')
	}
}

function prevStep() {
	let curr_position = stepper.position
	stepper.prev()
	if(stepper.position < max_step){
		$('.btn-next').text('Lanjut')

	}

	if(stepper.position == 1){
		const percent = 20;
		$('.progress-bar')
			.css('width', percent + '%')
			.attr('aria-valuenow', percent);
		$('.btn-prev').hide()
		// $('.btn-close').show()
	} else if(stepper.position == 2){
    const percent = 50;
    $('.progress-bar')
      .css('width', percent + '%')
      .attr('aria-valuenow', percent);
  } else if(stepper.position == 3){
    const percent = 85;
    $('.progress-bar')
      .css('width', percent + '%')
      .attr('aria-valuenow', percent);
  }

	$('.step-button[data-tab="'+curr_position+'"] > .step-header-number').removeClass('active')

	$('.step-body[data-tab="'+curr_position+'"]').hide()
	$('.step-body[data-tab="'+stepper.position+'"]').show()
}

function validateStep1() {
	let kosong = ''
 
  let validateProvince = $('#province').val()
  if (!validateProvince) {
    $('#province').addClass('is-invalid')
    kosong += '<li>Kolom Provinsi Wajib Diisi</li>'
  } else {
    $('#province').removeClass('is-invalid')
  }

  let validateRegency = $('#regency').val()
  if (!validateRegency) {
    $('#regency').addClass('is-invalid')
    kosong += '<li>Kolom Kabupaten / Kota Wajib Diisi</li>'
  } else {
    $('#regency').removeClass('is-invalid')
  }
  
  let validateDistrict = $('#district').val() 
  if (!validateDistrict) {
    $('#district').addClass('is-invalid')
    kosong += '<li>Kolom Kecamatan Wajib Diisi</li>'
  } else {
    $('#district').removeClass('is-invalid')
  }

  let validateVillage = $('#village').val()
  if (!validateVillage) {
    $('#village').addClass('is-invalid')
    kosong += '<li>Kolom Desa / Kelurahan Wajib Diisi</li>'
  } else {
    $('#village').removeClass('is-invalid')
  }

  let validateKK = $('input[name="kk"]').val()
  if (!validateKK) {
    $('input[name="kk"]').addClass('is-invalid')
    kosong += '<li>Kolom Nomor Kartu Keluarga Wajib Diisi</li>'
  } else {
    $('input[name="kk"]').removeClass('is-invalid')
  }
  let validateNIK = $('input[name="nik"]').val()
  if (!validateNIK) {
    $('input[name="nik"]').addClass('is-invalid')
    kosong += '<li>Kolom Nomor Induk Kependudukan Wajib Diisi</li>'
  } else {
    $('input[name="nik"]').removeClass('is-invalid')
  }
  let validateName = $('input[name="name"]').val()
  if (!validateName) {
    $('input[name="name"]').addClass('is-invalid')
    kosong += '<li>Kolom Nama Lengkap Wajib Diisi</li>'
  } else {
    $('input[name="name"]').removeClass('is-invalid')
  }
  let validateTempatLahir = $('input[name="tempat_lahir"]').val()
  if (!validateTempatLahir) {
    $('input[name="tempat_lahir"]').addClass('is-invalid')
    kosong += '<li>Kolom Tempat Lahir Wajib Diisi</li>'
  } else {
    $('input[name="tempat_lahir"]').removeClass('is-invalid')
  }
  let validateTanggalLahir = $('input[name="tanggal_lahir"]').val()
  if (!validateTanggalLahir) {
    $('input[name="tanggal_lahir"]').addClass('is-invalid')
    kosong += '<li>Kolom Tanggal Lahir Wajib Diisi</li>'
  } else {
    $('input[name="tanggal_lahir"]').removeClass('is-invalid')
  }
  let validateEmail = $('input[name="email"]').val()
  if (!validateEmail) {
    $('input[name="email"]').addClass('is-invalid')
    kosong += '<li>Kolom Email Wajib Diisi</li>'
  } else {
    $('input[name="email"]').removeClass('is-invalid')
  }
  let validateNoTelp = $('input[name="no_telp"]').val()
  if (!validateNoTelp) {
    $('input[name="no_telp"]').addClass('is-invalid')
    kosong += '<li>Kolom No Telpon Wajib Diisi</li>'
  } else {
    $('input[name="no_telp"]').removeClass('is-invalid')
  }

	if(kosong){
		return false;
	}
	return true;
}

function validateStep2() {
	// let kosong = ''       
	// var tipeJurnal = $('input[name="tipe_jurnal"]:checked').val();
	// var tipeCustomer = $('input[name="tipe_customer"]:checked').val();
	// $('#dynamic-form .form-item').each(function (index) {
	// 	switch (tipeJurnal) {
	// 		case "lainnya":
	// 			let namaItemValue = $(this).find('.form-group select[name="nama_item[]"]').val()
	// 			if (!namaItemValue) {  // If the field is empty
	// 				kosong += `<li>Kolom Nama Item pada data ke - ${index + 1} wajib diisi</li>`;
	// 			}
	// 			break;
	// 		case "bahan_baku":
	// 			let bahanValue = $(this).find('.form-group select[name="bahan['+index+']"]').val()
	// 			if (!bahanValue) {  // If the field is empty
	// 				kosong += `<li>Kolom Bahan pada data ke - ${index + 1} wajib diisi</li>`;
	// 			}
	// 			break;
	// 		case "barang_jadi":
	// 			let barangValue = $(this).find('.form-group select[name="barang['+index+']"]').val()
	// 			if (!barangValue) {  // If the field is empty
	// 				kosong += `<li>Kolom Barang pada data ke - ${index + 1} wajib diisi</li>`;
	// 			}
	// 			break;
	// 		default:
	// 			break;
	// 	}
		
	// });

	// $('[name="jumlah[]"]').each(function(index) {
	// 	let jumlahValue = $(this).val(); // Get the value of the current field
		
	// 	if (!jumlahValue) {  // If the field is empty
	// 		kosong += `<li>Kolom Jumlah pada data ke - ${index + 1} wajib diisi</li>`;
	// 	}
	// });

	// $('[name="bruto[]"]').each(function(index) {
	// 	if ($(this).is(":visible")) {
	// 		let jumlahKgValue = $(this).val(); // Get the value of the current field
			
	// 		if (!jumlahKgValue) {  // If the field is empty
	// 			kosong += `<li>Kolom Bruto pada data ke - ${index + 1} wajib diisi</li>`;
	// 		}
	// 	}
	// });

	// $('[name="netto[]"]').each(function(index) {
	// 	if ($(this).is(":visible")) {
	// 		let jumlahKgValue = $(this).val(); // Get the value of the current field
			
	// 		if (!jumlahKgValue) {  // If the field is empty
	// 			kosong += `<li>Kolom Netto pada data ke - ${index + 1} wajib diisi</li>`;
	// 		}
	// 	}
	// });

	// $('#response_container').empty()
	// if(kosong){
	// 	let message = `<div class="alert alert-danger alert-dismissible fade show">
	// 			<ul style="margin: 0; padding: 0">
	// 				Step 2
	// 				<ul>
	// 					${kosong}
	// 				</ul>
	// 			</ul>
	// 		</div>`
	// 	$('#response_container').html(message)
	// 	return false;
	// }
	return true;
}
// End of Stepper
//====================================================================================================================================


$(() => {
	//====================================================================================================================================
	// initialize date picker and select 2
	$('#tanggal_sj').flatpickr({
		static: true,
		dateFormat: "Y-m-d",
	})
	$('#tanggal_peb').flatpickr({
		static: true,
		dateFormat: "Y-m-d",
	})
	function loadCustomers(tipe) {
			
	}
	
	// end of initialize date picker and select 2
	//====================================================================================================================================
	
	//====================================================================================================================================
	// Step 1
	

	function parseFixed(form, zero) {
		var kursValue = form.val(); // Get the input value
		var kursFloat = parseFloat(kursValue); // Convert to float
		if (isNaN(kursFloat)) {
			$(this).val(''); // Optionally clear the input if it's not a valid number
		} else {
			form.val(kursFloat.toFixed(zero) || ''); // Use an empty string if it's NaN
		}
	}
	$(document).on('blur', 'input[name="kurs"]', function () {
			parseFixed($(this),2);
	});
	// End of Step 1
	//====================================================================================================================================
	

	//====================================================================================================================================
	// step 2

	// End of step 2
	//====================================================================================================================================


	// step 3
	
})
	



</script>