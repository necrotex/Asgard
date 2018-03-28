<div class="mt-3">

    <table class="table table-striped" id="transactions-table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Type</th>
            <th scope="col">Amount</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
    </table>

</div>

<div class="modal fade" id="mail-modal" tabindex="-1" role="dialog" aria-labelledby="mail-modal-subject" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function(){
            $(function() {

                var table = $('#transactions-table').DataTable({
                    processing: true,
                    serverSide: true,
                    select: {
                        items: 'row'
                    },
                    autoWidth: false,
                    ajax: '{!! route('character.transactions', $character) !!}',
                    columns: [
                        { data: 'date', name: 'date' },
                        { data: 'type_id', name: 'type_id' },
                        { data: 'quantity', name: 'quantity' },
                        { data: 'unit_price', name: 'unit_price' }
                    ]
                });
            });
        });

    </script>
@endpush