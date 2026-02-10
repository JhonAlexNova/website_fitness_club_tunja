@extends('layouts.app')

@push('page_css')
<link rel="stylesheet" href="{{ url('css/stock.min.css') }}">
@endpush

@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('page_scripts')
<script src="{{ url('libs/fullcalendar-6.1.15/dist/index.global.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      expandRows: true,
      slotMinTime: '08:00',
      slotMaxTime: '20:00',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      initialView: 'dayGridMonth',
      navLinks: true,
      editable: true,
      selectable: true,
      nowIndicator: true,
      dayMaxEvents: true,

      events: function(fetchInfo, successCallback, failureCallback) {
        $.ajax({
          url: '{{ url("/admon/horarios_clases") }}',  
          method: 'GET',
          dataType: 'json',
          data: {
            start: fetchInfo.startStr,
            end: fetchInfo.endStr
          },
          success: function(response) {
            successCallback(response); 
          },
          error: function() {
            failureCallback();
          }
        });
      }
    });

    calendar.render();
  });
</script>
@endpush
