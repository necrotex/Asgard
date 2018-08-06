<div class="mt-3">

    <table class="table table-striped" id="{{$type}}-applications-table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Applied on</th>
            <th scope="col">Last updated</th>
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

            var table = $('#{{$type}}-applications-table').DataTable({
                lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                select: {
                    items: 'row'
                },
                autoWidth: false,
                ajax: '{!! route('applications.' . $type) !!}',
                columns: [
                    {data: 'name', name: 'name',
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            if(oData.name) {
                                $(nTd).html("<a href="+oData.route+">"+oData.name+"</a>");
                            }
                        }
                    },
                    {data: 'status', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'last_update', name: 'last_update'}
                ]

            });

        });
    </script>
@endpush