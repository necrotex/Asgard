<div class="mt-3">

    <table class="table table-striped" id="mail-table">
        <thead>
        <tr>
            <th scope="col">Sender</th>
            <th scope="col">Subject</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
    </table>

</div>

@push('js')
    <script>
        $(function() {

            var table = $('#mail-table').DataTable({
                processing: true,
                serverSide: true,
                select: {
                    items: 'row'
                },
                autoWidth: false,
                ajax: '{!! route('character.mails', $character) !!}',
                columns: [
                    { data: 'sender_name', name: 'sender_name' },
                    { data: 'subject', name: 'subject' },
                    { data: 'date', name: 'date' }
                ]
            });

            $('#mail-table').on('click', 'tr', function(event) {
                console.log(table.row(this).data());
            });

        });
    </script>
@endpush