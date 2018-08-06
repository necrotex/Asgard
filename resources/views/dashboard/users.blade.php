@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Users')
@section('CONTENT_TITLE', 'Users')

@section('content')

<div class="mt-3">

    <table class="table table-striped" id="users-table">
        <thead>
        <tr>
            <th scope="col">Name</th>
        </tr>
        </thead>
    </table>

</div>
@endsection

@push('js')
    <script>
        $(function () {

            var table = $('#users-table').DataTable({
                lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                processing: true,
                serverSide: true,
                select: {
                    items: 'row'
                },
                autoWidth: false,
                ajax: '{!! route('users.table') !!}',
                columns: [
                    {data: 'name', name: 'name',
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                            if(oData.route) {
                                $(nTd).html("<a href="+oData.route+">"+oData.name+"</a>");
                            }
                        }
                    }
                ]

            });

        });
    </script>
@endpush