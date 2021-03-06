@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{asset('admin/vendor/datatables_jquery/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/sweetalert2/dist/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/iCheck/skins/flat/orange.css')}}">
@endpush
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Menu</h1>
    </div>
    <p><strong><a href="{{route('dashboard')}}" class='text-decoration-none text-gray-900'>Dashboard</a></strong> / Manajemen Menu</p>
    <!-- Area Table -->
    {{-- @include('layouts.flash') --}}
    <div class="col-12 p-0">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-12 p-0 mb-3">
                    <div class="row">
                        <div class="col-6 align-items-start">
                            {{-- <button class="btn btn-warning mb-3 mr-2" onclick="location.href='{{route('subdivision_group.create')}}'">🞤 Create</button> --}}
                            <button type="button" class="btn btn-primary mb-3 mr-2" onclick="showCreateModal()" data-target="#createCategoryModal" data-toggle="modal">+ Tambah Menu</button>
                            <button class="btn btn-danger mb-3" onclick="initDeleteSelection()"> <i class="fa fa-trash"></i> Hapus Pilihan</button>
                        </div>
                        <div class="col-6 d-flex">
                        </div>
                    </div>
                </div>
                {!! $dataTable->table(['width' => '100%']) !!}
            </div>
        </div>
    </div>

    <!-- Modal Select Property -->
    <div class="modal fade modal-create" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Manajement Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="" id="menuFrom">
                        <input type="hidden" name="menu_id" id="menuId">
                        {!! Form::label('menu_name', 'Nama Menu') !!}
                        <input type="text" class="form-control" name="menu_name" id="menuName">
                        {{-- {!! Form::label('menu_category_id', 'Kategori menu', ['class' => 'mt-4']) !!} --}}
                        {{-- {!! Form::select('menu_category_id', $category, isset($menu) ? $menu->menu_category_id : 0, ['class' => 'form-control', 'id' => 'menuCategory']) !!} --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-submit">Save</button>
                    {{-- <button class="btn btn-warning btn-submit" onclick="submitForm()">Save</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{asset('admin/vendor/datatables_jquery/datatables.js')}}"></script>
<script src="{{asset('plugin/sweetalert2/dist/sweetalert2.js')}}"></script>
<script src="{{asset('plugin/iCheck/icheck.js')}}"></script>
@include('layouts.admin_js')
<script>

    // import swal from 'sweetalert';

    function initDeleteSelection(){
        let deleteUrl = "{{ url('menu_destroy') }}";
        deleteSelection(deleteUrl)
    }

    function initDeleteSingle(id){
        let deleteUrl = "{{ url('menu_destroy') }}"
        deleteSingle(id, deleteUrl)
    }

    let menuIdField = $('#menuId');
    let menuNameField = $('#menuName');
    let categorySelect = $('#menuCategory');
    let buttonSubmit = $('.btn-submit');
    let closeButton = $('.close');
    let modalHeader = $('#createCategoryModalLabel');

    closeButton.on('click', function(){
        clearForm();
    })

    // Show create modal and fill it with data
    function showCreateModal(){
        buttonSubmit.attr('onclick', "submitForm('create')")
        buttonSubmit.text('Save');
        modalHeader.text('Tambah Data Menu');
    }

    function showEditModal(){
        buttonSubmit.attr('onclick', "submitForm('update')")
        buttonSubmit.text('Update');
        modalHeader.text('Edit Data Menu');
    }

    function submitForm(url){
        let formData = $('#menuFrom').serializeArray();
        let csrf_token = "{{ csrf_token() }}";
        let method = '';
        let urlMethod = '';
        
        if(url == 'create'){
            method = 'post';
            urlMethod = "{{ url('menu/store')}}";
        }else{
            method = 'patch';
            urlMethod = "{{ url('menu_update')}}" + '/' + menuIdField.val();
        }

        $.ajax({
            headers: {'X-CSRF-TOKEN': csrf_token},
            url : urlMethod,
            dataType : "Json",
            method : method,
            data : formData,
            success: function(data){
                console.log(data)
                if(data[0] == 1){
                    $('.modal-create').modal('hide');
                    Swal.fire(
                        'Success',
                        data[1],
                        'success'
                    )}else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data[1]
                        })
                    }
                let table = $('#'+tableId).DataTable()
                clearForm()
                table.draw()
            }
        })
    }

    function clearForm(){
        $('#menuFrom')[0].reset();
    }

    function updateMenu(id){
        $('.modal-create').modal('show');
        $('.btn-back-properties').hide();
        let csrf_token = "{{csrf_token()}}"
        showEditModal()

        $.ajax({
            url : "{{url('menu')}}" + '/' + id,
            method : 'get',
            dataType : 'json',
            headers: {'X-CSRF-TOKEN': csrf_token},
            success: function(data){
                console.log(data)
                menuIdField.val(data.id);
                menuNameField.val(data.menu_name);
            }

        })
    }

</script>
{!! $dataTable->scripts() !!}
@endpush
