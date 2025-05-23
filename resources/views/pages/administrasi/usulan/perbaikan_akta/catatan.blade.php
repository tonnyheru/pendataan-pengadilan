<div class="row">
  <div class="col-md-12">
    <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
      @foreach ($catatan as $item => $value)
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
              $status = 'Telah diajukan';
              $stat = 'Menunggu Persetujuan';
              $badge = 'bg-info';
              break;
            case '2':
              $status = 'Disetujui Disdukcapil';
              $stat = 'Disetujui';
              $badge = 'bg-success';
              break;
            case '99':
              $status = 'Telah dirubah datanya';
              $stat = 'Perubahan Data';
              $badge = 'bg-yellow';
              break;
            default:
              $status = '';
              $stat = '';
              $badge = '';
              break;
          }
          @endphp
      <div class="timeline-block">
        <span class="timeline-step badge-success">
          <i class="fas fa-ballot-check"></i>
        </span>
        <div class="timeline-content">
          <small class="text-muted font-weight-bold">{{ $value->timestamp }}</small>
          <h5 class=" mt-3 mb-0">{{$status}} usulan dengan nomor perkara {{$perbaikanAktaDetail->submission->no_perkara}} dengan nama petugas {{$value->name}}</h5>
          <div class="mt-3">
            <span class="badge badge-pill {{$badge}} text-white">{{$stat}}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>