<div class="row">

    <div class="form-group col-md-6">
      <label>Nomor Perkara <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" placeholder="Nomor Perkara" value="{{ @$data->name }}">
    </div>

    <div class="form-group col-md-6">
      <label>Jenis Perkara</label>
      <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ @$data->tempat_lahir }}">
    </div>

    <div class="form-group col-md-12">
      <label>Pemohon</label>
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}">
    </div>

    <div class="col-md-12 justify-content-md-start">
        <div class="col-md-6">
            <label for="logo">Foto KTP</label>
            <div class="logo_image_picker my-1 position-relative rounded overflow-hidden d-flex justify-content-center align-items-center" style="height: 150px; width: 150px; border: 1.5px dotted #dee2e6; cursor: pointer;">
                <div class="text-center upload-placeholder">
                    <i class="fas fa-upload fa-2x"></i>
                    <p class="small">Klik di sini untuk mengunggah gambar</p>
                </div>
                <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail position-absolute w-100 h-100" style="object-fit: cover; display: none;">
                <div id="pdf-placeholder" class="text-center position-absolute w-100 h-100 d-none flex-column justify-content-center align-items-center">
                    <i class="fas fa-file-pdf fa-3x text-danger"></i>
                    <p class="small mt-1" id="filename">File PDF</p>
                </div>
                <div class="loading_image_picker position-absolute w-100 h-100 d-none" style="backdrop-filter: blur(2px); top: 0; left: 0;">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <img src="{{ asset('img/loading2.gif') }}" style="height: 15px;">
                        <p class="small fw-bold ms-2">Tunggu Sebentar</p>
                    </div>
                </div>
            </div>
            <input type="file" accept="image/jpeg, image/png, image/gif, application/pdf" name="profile" id="logo" autocomplete="off" style="display: none;">
        </div>
    </div>

</div>

<script>
  $(() => {
  
  $('.logo_image_picker').on('click', function() {
      $('#logo').click();
  });

  $('#logo').change(function() {
    const file = this.files[0];
    const fileType = file['type'];
    const fileName = file.name;
    const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    const validFileTypes = [...validImageTypes, 'application/pdf'];
    
    if ($.inArray(fileType, validFileTypes) < 0) {
        Ryuna.noty('warning', '', 'Hanya file gambar (JPG, PNG, GIF) atau PDF yang diperbolehkan.')
        $(this).val(''); // Clear the input if invalid file
        $('#imagePreview').hide();
        
        $("#pdf-placeholder").removeClass('d-flex');
        $("#pdf-placeholder").addClass('d-none');

        $('#filename').text("");
        $('.upload-placeholder').show();
        return false;
      }
      
      const reader = new FileReader();
      reader.onload = function(e) {
        if (fileType === 'application/pdf') {
          console.log('pdf')
          $('#imagePreview').hide();
          $("#pdf-placeholder").removeClass('d-none');
          $("#pdf-placeholder").addClass('d-flex');
          $('#filename').text(fileName);
        } else {
          console.log('img')
          $('#imagePreview').attr('src', e.target.result).show();
          $('#filename').text("");
          $("#pdf-placeholder").removeClass('d-flex');
          $("#pdf-placeholder").addClass('d-none');
        }
      $('.upload-placeholder').hide();
    }
    reader.readAsDataURL(file);

    $('.loading_image_picker').removeClass('d-none');

    // Simulate loading delay for demo purposes
    setTimeout(function() {
        $('.loading_image_picker').addClass('d-none');
    }, 1000); // Adjust as needed
});
})
</script>