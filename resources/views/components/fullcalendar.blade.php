@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function () {
            let calendar = $('#calendar').fullCalendar({
                events: {!! json_encode($schedules) !!},
                timeFormat: 'H:mm',
                eventClick: function (calEvent) {
                    $('.title').text(calEvent.title);
                    $('.start').text('Jam Mulai : ' + moment(calEvent.start).locale('id').format('LLLL'));
                    $('.end').text('Jam Selesai : ' + moment(calEvent.end).locale('id').format('LLLL'));
                    $('#modal-show-schedule-' + calEvent.id).modal();
                },
                viewRender: function(view) {
                    $('.fullcalendar-title').html(view.title);
                    $('.fc-time').addClass('text-white');
                }
            });

            $('body').on('click', '[data-calendar-view]', function(e) {
                e.preventDefault();

                $('[data-calendar-view]').removeClass('active');
                $(this).addClass('active');

                let calendarView = $(this).attr('data-calendar-view');
                calendar.fullCalendar('changeView', calendarView);
            });

            $('body').on('click', '.fullcalendar-btn-next', function(e) {
                e.preventDefault();
                calendar.fullCalendar('next');
            });

            $('body').on('click', '.fullcalendar-btn-prev', function(e) {
                e.preventDefault();
                calendar.fullCalendar('prev');
            });
        });

    </script>

@endpush
