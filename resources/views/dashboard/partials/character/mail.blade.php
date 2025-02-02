<div class="mt-3">

    <table class="table table-striped table-hover data-table-clickable" id="mail-table">
        <thead>
        <tr>
            <th scope="col">Sender</th>
            <th scope="col">Subject</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
    </table>

</div>

<div class="modal fade" id="mail-modal" tabindex="-1" role="dialog" aria-labelledby="mail-modal-subject"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

@push('js')
    <script>
        $(function () {

            var table = $('#mail-table').DataTable({
                lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                select: {
                    items: 'row'
                },
                autoWidth: false,
                ajax: '{!! route('character.mails', $character) !!}',
                columns: [
                    {data: 'sender_name', name: 'sender_name'},
                    {data: 'subject', name: 'subject'},
                    {data: 'date', name: 'date'}
                ]

            });

            $('#mail-table').on('click', 'tr', function () {
                var data = table.row(this).data();

                axios.post('{{route('character.mail', [$character])}}', {id: data['mail_id']}).then(function (response) {
                    var data = response.data;

                    $('#mail-modal').on('show.bs.modal', function () {
                        var modal = $(this);

                        modal.find('.modal-content').html(data);
                    });

                    $('#mail-modal').modal({show: true});
                });
            });

        });
    </script>
@endpush