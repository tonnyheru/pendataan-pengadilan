<style>
	.step-header {
			padding-bottom: 10px;
			margin-bottom: 10px;
	}
	.step-list {
			display: flex;
			flex-direction: row;
			justify-content: space-around;
	}
	.step-header-number{
			display: -ms-inline-flexbox;
			display: inline-flex;
			-ms-flex-line-pack: center;
			align-content: center;
			-ms-flex-pack: center;
			justify-content: center;
			width: 3em;
			height: 3em;
			padding: 0.5em 0;
			margin: 0.25rem;
			line-height: 1em;
			color: #fff;
			font-weight: 500;
			background-color: #6c757d;
			border-radius: 4em;
			padding-top: 25px;
			font-size: 1.5em;
	}

	.step-button{
			text-align: center;
			padding: 0px 50px;
	}

	.step-header-number.active{
			color: #fff;
			background-color: #016004;
	}

	.step-header-title{
			text-align: center;
	}

	.flatpickr-wrapper{
			width: 100% !important
	}

	.logo_image_picker{
			border-radius: 0.4rem !important;
			border: 1.5px dotted #dee2e6;
	}

	.image-hover-handler{
			transition: 0.5s;
	}
	.logo_image_picker:hover{
			.wrap_logo_image_picker{
			transform: scale(0.95)
			}

			.image-hover-handler{
			transform: scale(0.95)
			}
	}

	.wrap_logo_image_picker{
			transition: 0.5s;
	}

		/* Hide the radio buttons */
	.card-radio input[type="radio"] {
		display: none;
	}

	/* Style the card */
	.card-radio .card {
		cursor: pointer;
		transition: transform 0.2s ease-in, box-shadow 0.2s ease-in;
	}

	/* Highlight the selected card */
	.card-radio input[type="radio"]:checked + .card {
		border: 4px solid #007bff;
		box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
		transform: scale(1);
	}
</style>

<div class="step-box">
	<div class="step-header">
			<div class="step-list">
				<div class="step-button" data-tab="1">
						<div class="step-header-number active"><span><i class="fas fa-tv"></i></span></div>
						<div class="step-header-title">Data Awal</div>
				</div>
				<div class="step-button" data-tab="2">
						<div class="step-header-number">2</div>
						<div class="step-header-title">Data Item</div>
				</div>
				<div class="step-button" data-tab="3">
						<div class="step-header-number">3</div>
						<div class="step-header-title">Ringkasan</div>
				</div>
			</div>
	</div>
	<div class="step-body" data-tab="1">
		<div class="row">
			{{-- Tipe Barang --}}
			<div class="form-group col-md-12">
				<label>Pilih Tipe Barang <span class="text-danger">*</span></label>
				<div class="row justify-content-md-center">
					<!-- Option 1 -->
					<div class="col-md-3 card-radio transition">
						<label>
							<input type="radio" name="tipe_jurnal" value="bahan_baku" checked>
							<div class="card p-3" style="background: #ececec">
								<img class="rounded mx-auto d-block img-thumbnail mb-3" src="{{ asset('img/default-bahan.png') }}" alt="">
								<p><strong>Bahan Baku & Penolong</strong></p>
								<small>Material utama yang digunakan untuk memproduksi barang.<br>Seperti : Magnum ABS, Masking Film, PMMA, dll.</small>
							</div>
						</label>
					</div>
					<!-- Option 2 -->
					<div class="col-md-3 card-radio transition">
						<label>
							<input type="radio" name="tipe_jurnal" value="barang_jadi">
							<div class="card p-3" style="background: #ececec">
								<img class="rounded mx-auto d-block img-thumbnail mb-3" src="{{ asset('img/default-barang.png') }}" alt="">
								<p><strong>Barang Jadi</strong></p>
								<small>End-product yang telah selesai diproduksi dan siap untuk dijual.<br>Seperti : Tiaraprime F1, F2, F3, dll.</small>
							</div>
						</label>
					</div>
					<!-- Option 3 -->
					<div class="col-md-3 card-radio transition">
						<label>
							<input type="radio" name="tipe_jurnal" value="lainnya">
							<div class="card p-3" style="background: #ececec">
								<img class="rounded mx-auto d-block img-thumbnail mb-3" src="{{ asset('img/default-question.png') }}" alt="">
								<p><strong>Lainnya</strong></p>
								<small>Barang yang tidak dikategorikan bahan baku & barang jadi.<br>Seperti : Sample, Afval, Jumbo Bag, dll.</small>
							</div>
						</label>
					</div>
				</div>
			</div>
			{{-- Tipe Pelanggan --}}
			<div class="form-group col-md-12">
				<label>Pilih Tipe Pelanggan <span class="text-danger">*</span></label>
				<div class="row justify-content-md-center">
					<!-- Option 1 -->
					<div class="col-md-2 card-radio transition">
						<label>
							<input type="radio" name="tipe_customer" value="lokal" checked>
							<div class="card p-3 text-center" style="background: #ececec">
								<img class="rounded mx-auto d-block img-thumbnail mb-3" width="150" height="150" src="{{ asset('img/default-local.png') }}" alt="">
								<p><strong>Lokal</strong></p>
							</div>
						</label>
					</div>
					<!-- Option 2 -->
					<div class="col-md-2 card-radio transition">
						<label>
							<input type="radio" name="tipe_customer" value="ekspor">
							<div class="card p-3 text-center" style="background: #ececec">
								<img class="rounded mx-auto d-block img-thumbnail mb-3" width="150" height="150" src="{{ asset('img/default-export.png') }}" alt="">
								<p><strong>Ekspor</strong></p>
							</div>
						</label>
					</div>
				</div>
			</div>
			{{-- keterangan --}}
			<div class="form-group col-md-12" id="keterangan-lainnya">
				<label>Keterangan Item <span class="text-danger">*</span></label>
				<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Item">
			</div>
			{{-- Pelanggan --}}
			<div class="form-group col-md-12">
				<label>Pelanggan <span class="text-danger">*</span></label>
				<select name="customer" class="form-control select2-customer" id="customer">
					<option></option>
				</select>
			</div>
			{{-- Nomor Surat Jalan --}}
			<div class="form-group col-md-6">
				<label>Nomor Surat Jalan <span class="text-danger">*</span></label>
				<input type="text" name="nomor_sj" class="form-control" placeholder="Nomor Surat Jalan" style="text-transform:uppercase">
			</div>
			{{-- Tanggal Surat Jalan --}}
			<div class="form-group col-md-6 ">
				<label>Tanggal Surat Jalan <span class="text-danger">*</span></label>
				<div class='date'>
						<input type='text' class="form-control" name="tanggal_sj" id='tanggal_sj' style="background-color: white; " placeholder="Pilih Tanggal Surat Jalan" value="" />
				</div>
			</div>
			{{-- PPN --}}
			<div class="form-group col-md-12" id="lokal-ppn">
				<label>PPN</label>
				<div class="input-group">
						<input type="number" name="ppn" class="form-control" placeholder="PPN">
						<div class="input-group-append">
								<span class="input-group-text">%</span>
						</div>
				</div>
			</div>
			{{-- KURS --}}
			<div class="form-group col-md-12" id="ekspor-kurs">
				<label>Kurs</label>
				<div class="input-group">
						<div class="input-group-prepend">
								<span class="input-group-text">IDR</span>
						</div>
						<input type="number" name="kurs" step=".01" class="form-control" placeholder="Kurs">
				</div>
			</div>     
		</div>
	</div>
	<div class="step-body" data-tab="2" style="display: none;">
		<div class="col-md-10 mx-auto mb-5">
			<div id="dynamic-form">
				<!-- Original Form -->
				<div class="form-item card shadow">
					<div class="card-header" id="heading1">
						<div class="d-flex align-items-center">
								<span class="ml-2 mr-3 item-number">Item 1</span>
								<hr class="flex-grow-1">
								<a href="#collapse1" class="btn btn-info btn-sm item-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse1">
									<i class="fas fa-window-minimize"></i>
								</a>
								<a href="javascript:void(0)" class="btn btn-danger btn-sm remove-form" style="display: none"><i class="fas fa-trash"></i></a>
						</div>
					</div>

					<div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#dynamic-form">
						<div class="card-body">
							<div class="row">
								
								<!-- Barang -->
								<div class="form-group col-md-12 tipe-barang">
									<label>Barang <span class="text-danger">*</span></label>
									<select name="barang[0]" class="form-control select2-barang">
										<option></option>
									</select>
									<small id="stok-barang" style="display: none" class="form-text text-muted"></small>
								</div>

								<!-- Bahan -->
								<div class="form-group col-md-12 tipe-bahan">
									<label>Bahan <span class="text-danger">*</span></label>
									<select name="bahan[0]" class="form-control select2-bahan">
										<option></option>
									</select>
									<small id="stok-bahan" style="display: none" class="form-text text-muted"></small>
								</div>
								<!-- Nama Item -->
								<div class="form-group col-md-12 tipe-lainnya">
										<label>Nama Item <span class="text-danger">*</span></label>
										<input type="text" name="nama_item[]" class="form-control" placeholder="Nama Item">
								</div>
								<!-- Jumlah -->
								<div class="form-group col-md-12 ">
										<label>Jumlah <span class="text-danger">*</span></label>
										<div class="input-group">
												<input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah">
												<div class="input-group-append" style="display: none">
														<span class="input-group-text append-satuan"></span>
												</div>
										</div>
								</div>
								<!-- (Netto) -->
								<div class="form-group col-md-6 " style="">
										<label>Netto <span class="text-danger">*</span></label>
										<div class="input-group">
												<input type="number" name="netto[]" class="form-control" step=".001" placeholder="Netto">
												<div class="input-group-append">
														<span class="input-group-text">KG</span>
												</div>
										</div>
								</div>
								<!-- Bruto -->
								<div class="form-group col-md-6 " style="">
										<label>Bruto <span class="text-danger">*</span></label>
										<div class="input-group">
												<input type="number" name="bruto[]" class="form-control" step=".001" placeholder="Bruto">
												<div class="input-group-append">
														<span class="input-group-text">KG</span>
												</div>
										</div>
								</div>

								
								<!-- Mata Uang -->
								<div class="form-group col-md-12 ekspor-mata-uang">
										<label>Mata Uang </label>
										<input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang" style="text-transform:uppercase">
								</div>
								<!-- Nilai -->
								<div class="form-group col-md-12 " style="">
										<label>Nilai </label>
										<div class="input-group">
											<div class="input-group-prepend">
													<span class="input-group-text prepend-currency"></span>
											</div>
												<input type="number" name="nilai[]" class="form-control" step=".01" placeholder="Nilai">
										</div>
								</div>
								<!-- Nilai PPN -->
								<div class="form-group col-md-6 lokal-nilai-ppn" style="">
										<label>Nilai PPN </label>
										<div class="input-group">
											<div class="input-group-prepend">
													<span class="input-group-text">IDR</span>
											</div>
												<input type="number" name="nilai_ppn[]" class="form-control" step=".01" placeholder="Nilai PPN" readonly>
										</div>
								</div>
								<!-- Nilai Total -->
								<div class="form-group col-md-6 lokal-nilai-total" style="">
										<label>Nilai Total </label>
										<div class="input-group">
											<div class="input-group-prepend">
													<span class="input-group-text">IDR</span>
											</div>
												<input type="number" name="nilai_total[]" class="form-control" step=".01" placeholder="Nilai Total" readonly>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Button to add new form -->
			<a href="javascript:void(0)" id="add-form" class="btn btn-success mt-3"><i class="fas fa-plus"></i> Tambah Item</a>
		</div>
	</div>
	<div class="step-body" data-tab="3" style="display: none;">
		<div class="col-md-10 mx-auto">
				<table class="table table-borderless align-items-left table-flush table-header col-md-6">
						<tbody>
								<tr>
										<td>Nomor Bukti</td>
										<td>:</td>
										<th class="nomor-bukti">Nomor Bukti</th>
								</tr>
								<tr>
										<td>Tanggal Bukti</td>
										<td>:</td>
										<th class="tanggal-bukti">Tanggal</th>
								</tr>
								<tr>
										<td>Customer</td>
										<td>:</td>
										<th class="customer">Customer</th>
								</tr>
								<tr>
										<td>Negara Tujuan</td>
										<td>:</td>
										<th class="negara">Negara</th>
								</tr>
								<tr>
										<td>PPN</td>
										<td>:</td>
										<th class="ppn">Customer</th>
								</tr>
								<tr>
										<td>Nomor PEB</td>
										<td>:</td>
										<th class="nomor-peb">Nomor PEB</th>
								</tr>
								<tr>
										<td>Tanggal PEB</td>
										<td>:</td>
										<th class="tanggal-peb">Tanggal PEb</th>
								</tr>
						</tbody>
				</table>

				<div class="py-2">
					<h5>Informasi Item</h5>
						<table class="table table-responsive display nowrap" style="width:100%" id="table-barangkeluar-ringkasan">
								<thead>
										<tr>
												<th>No</th>
												<th class="all">Nama Barang</th>
												<th class="none">Jumlah</th>
												<th class="none">Bruto</th>
												<th class="none">Netto</th>
												<th class="none">Nilai</th>
												<th class="none">Nilai PPN</th>
												<th class="none">Nilai Total</th>
										</tr>
								</thead>
								<tbody>
								</tbody>
						</table>
				</div>
		</div>
		
	</div>
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
				$('.btn-prev').show()
			}
			break;
		case 2:
			isValid = validateStep2();
			collectAndDisplayData();
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

		$('#data_pemegang_va').hide()
		// if( (Ryuna.remove_format_rupiah('#mp1 th') >= 100000000 || Ryuna.remove_format_rupiah('#mp2 th') >= 100000000) && $('#disallow_teller').val() == 'false'){
		//   $('#data_pemegang_va').show()
		// }
	}

	if(stepper.position == 1){
		$('.btn-prev').hide()
		// $('.btn-close').show()
	}

	$('.step-button[data-tab="'+curr_position+'"] > .step-header-number').removeClass('active')

	$('.step-body[data-tab="'+curr_position+'"]').hide()
	$('.step-body[data-tab="'+stepper.position+'"]').show()
}

function validateStep1() {
	let kosong = ''

	var tipe = $('input[name="tipe_jurnal"]:checked').val();
	if (tipe == "lainnya") {
		let validateKeterangan = $('[name="keterangan"]').val()
		if (!validateKeterangan) {
			kosong += '<li>Kolom Keterangan Wajib Diisi</li>'
		}
	}

	let validateCustomer = $('[name="customer"]').val()
	if (!validateCustomer) {
		kosong += '<li>Kolom Pelanggan Wajib Diisi</li>'
	}

	let validateNomorSJ = $('[name="nomor_sj"]').val()
	if (!validateNomorSJ) {
		kosong += '<li>Kolom Nomor Surat Jalan Wajib Diisi</li>'
	}

	let validateTanggalSJ = $('[name="tanggal_sj"]').val()
	if (!validateTanggalSJ) {
		kosong += '<li>Kolom Tanggal Surat jalan Wajib Diisi</li>'
	}

	

	


	$('#response_container').empty()
	if(kosong){
		let message = `<div class="alert alert-danger alert-dismissible fade show">
				<ul style="margin: 0; padding: 0">
					Step 1:
					<ul>
							${kosong}
					</ul>
				</ul>
			</div>`
		$('#response_container').html(message)
		return false;
	}
	return true;
}

function validateStep2() {
	let kosong = ''       
	var tipeJurnal = $('input[name="tipe_jurnal"]:checked').val();
	var tipeCustomer = $('input[name="tipe_customer"]:checked').val();
	$('#dynamic-form .form-item').each(function (index) {
		switch (tipeJurnal) {
			case "lainnya":
				let namaItemValue = $(this).find('.form-group select[name="nama_item[]"]').val()
				if (!namaItemValue) {  // If the field is empty
					kosong += `<li>Kolom Nama Item pada data ke - ${index + 1} wajib diisi</li>`;
				}
				break;
			case "bahan_baku":
				let bahanValue = $(this).find('.form-group select[name="bahan['+index+']"]').val()
				if (!bahanValue) {  // If the field is empty
					kosong += `<li>Kolom Bahan pada data ke - ${index + 1} wajib diisi</li>`;
				}
				break;
			case "barang_jadi":
				let barangValue = $(this).find('.form-group select[name="barang['+index+']"]').val()
				if (!barangValue) {  // If the field is empty
					kosong += `<li>Kolom Barang pada data ke - ${index + 1} wajib diisi</li>`;
				}
				break;
			default:
				break;
		}
		
	});

	$('[name="jumlah[]"]').each(function(index) {
		let jumlahValue = $(this).val(); // Get the value of the current field
		
		if (!jumlahValue) {  // If the field is empty
			kosong += `<li>Kolom Jumlah pada data ke - ${index + 1} wajib diisi</li>`;
		}
	});

	$('[name="bruto[]"]').each(function(index) {
		if ($(this).is(":visible")) {
			let jumlahKgValue = $(this).val(); // Get the value of the current field
			
			if (!jumlahKgValue) {  // If the field is empty
				kosong += `<li>Kolom Bruto pada data ke - ${index + 1} wajib diisi</li>`;
			}
		}
	});

	$('[name="netto[]"]').each(function(index) {
		if ($(this).is(":visible")) {
			let jumlahKgValue = $(this).val(); // Get the value of the current field
			
			if (!jumlahKgValue) {  // If the field is empty
				kosong += `<li>Kolom Netto pada data ke - ${index + 1} wajib diisi</li>`;
			}
		}
	});

	$('#response_container').empty()
	if(kosong){
		let message = `<div class="alert alert-danger alert-dismissible fade show">
				<ul style="margin: 0; padding: 0">
					Step 2
					<ul>
						${kosong}
					</ul>
				</ul>
			</div>`
		$('#response_container').html(message)
		return false;
	}
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