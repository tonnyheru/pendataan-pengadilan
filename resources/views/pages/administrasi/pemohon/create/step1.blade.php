
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
    <div class="form-group col-md-12">
      <label>Delegasikan Ke <span class="text-danger">*</span></label>
      <select name="delegasi" class="form-control select2-delegasi">
        <option value=""></option>
        <option value="">asd</option>
        <option value="">asd</option>
        <option value="">asd</option>
      </select>
    </div>
    {{-- keterangan --}}
    <div class="form-group col-md-12" id="keterangan-lainnya">
        <label>Keterangan Item <span class="text-danger">*</span></label>
        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Item">
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