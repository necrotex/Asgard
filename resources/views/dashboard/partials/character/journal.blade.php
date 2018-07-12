<div class="mt-3">

    <table class="table table-striped table-hover data-table-clickable" id="journal-table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Type</th>
            <th scope="col">Other Party</th>
            <th scope="col">Amount</th>
            <th scope="col">Balance</th>
        </tr>
        </thead>
    </table>

</div>

<div class="modal fade" id="journal-modal" tabindex="-1" role="dialog" aria-labelledby="journal-modal-subject" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function(){
            $(function() {

                var table = $('#journal-table').DataTable({
                    processing: true,
                    serverSide: true,
                    select: {
                        items: 'row'
                    },
                    autoWidth: false,
                    ajax: '{!! route('character.journal', $character) !!}',
                    columns: [
                        { data: 'date', name: 'date' },
                        { data: 'ref_type', name: 'ref_type' },
                        { data: 'other_party', name: 'other_party' },
                        { data: 'amount', name: 'amount' },
                        { data: 'balance', name: 'balance' }
                    ]

                });

                $('#journal-table').on('click', 'tr', function () {
                    var data = table.row(this).data();

                    axios.post('{{route('character.journal.entry', $character)}}', {id: data['ref_id']}).then(function (response) {
                        var data = response.data;

                        $('#journal-modal').on('show.bs.modal', function () {
                            var modal = $(this);

                            modal.find('.modal-content').html(data);
                        });

                        $('#journal-modal').modal({show: true});
                    });
                });
            });
        });

    </script>
@endpush