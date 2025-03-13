<div class="row">
  <div class="col-md-12">
    <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
      <div class="timeline-block">
        <span class="timeline-step badge-info">
          <i class="ni ni-bell-55"></i>
        </span>
        <div class="timeline-content">
          <small class="text-muted font-weight-bold">{{ $usulan->created_at }}</small>
          <h5 class=" mt-3 mb-0">Pembuatan usulan dengan nomor perkara {{ $usulan->no_perkara }} dengan pemohon {{ $usulan->pemohon->name }}</h5>
          <p class=" text-sm mt-1 mb-0">Usulan ini dibuat oleh {{ $usulan->createdBy->name }}</p>
          <div class="mt-3">
            <span class="badge badge-pill bg-info text-white">Pembuatan</span>
          </div>
        </div>
      </div>
      @foreach ($catatan as $item => $value)
      <div class="timeline-block">
        <span class="timeline-step badge-success">
          <i class="fas fa-ballot-check"></i>
        </span>
        <div class="timeline-content">
          <small class="text-muted font-weight-bold">{{ $value->timestamp }}</small>
          @php
          $status = '';
          $badge = '';
          $stat = '';
          switch ($value->status) {
            case '0':
              $status = 'Ditolak';
              $stat = 'Ditolak';
              $badge = 'bg-danger';
              break;
            case '1':
              $status = 'Pembuatan Usulan';
              $stat = 'Perlu Persetujuan';
              $badge = 'bg-success';
              break;
            case '2':
              $status = 'Disetujui Disdukcapil';
              $stat = 'Disetujui';
              $badge = 'bg-success';
              break;
            default:
              $status = '';
              $stat = '';
              $badge = '';
              break;
          }
          @endphp
          <h5 class=" mt-3 mb-0">Usulan dengan nomor perkara {{$usulan->no_perkara}} {{$status}} dengan nama petugas {{$value->name}}</h5>
          <p class=" text-sm mt-1 mb-0">Catatan : <strong> {{ $value->catatan }} </strong></p>
          <div class="mt-3">
            <span class="badge badge-pill {{$badge}} text-white">{{$stat}}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>