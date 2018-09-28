@extends('layout.app')

@section('menu_active')
    @php($active = 'Lembur')
@endsection

@section('style')
<link href="{{ url('public/coreui/vendors/DataTables/css/data-table.css') }}" rel="stylesheet" />
<link href="{{ url('public/coreui/vendors/bootstrap4-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
<style type="text/css">

</style>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('public/coreui/vendors/DataTables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ url('public/coreui/vendors/DataTables/js/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ url('public/coreui/vendors/bootstrap4-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') }}"></script>
@include('lembur.input_lembur.js')
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-info">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ strtoupper($error) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @component('component.card')
        @slot('title')
            <i class="fa fa-pencil-square"></i> LEMBUR KARYAWAN
        @endslot
        <div class="form-inline">
            <button type="submit" class="btn btn-outline-primary mb-2" onclick="date()" data-backdrop="static" data-toggle="modal" href='#modal_upload'><i class="fa fa-clock-o"></i> INPUT DATA LEMBUR</button>
        </div>
        <table id="upload-table" class="table table-responsive-lg table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>TANGGAL</th>
                    <th>MASUK</th>
                    <th>KELUAR</th>
                </tr>
            </thead>
        </table>
    @endcomponent

    {{ Form::open(['url'=>'/lembur/input_lembur/store','method'=>'post']) }}
    @component('component.modal-primary',['id'=>'modal_upload','title'=>'INPUT DATA LEMBUR','size'=>'modal-lg'])
        <div class="row p-2">
            <select class="form-control border-primary" id="fm" name="fm" required data-toggle="tooltip" data-placement="top" title="PILIH FACTORY MANAGER">
                <option value="">Pilih FM</option>
                @foreach($data_fm as $key => $value )
                <option value="{{ $value->nik }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row p-2">

            <div class="col-sm-4 border border-primary">
                <div class="6"><p class="text-center">TANGGAL<br><span id="txt_tanggal">-</span></p></div>
                <div class="6">
                    {{ Form::hidden('tanggal',old('masuk'),['autocomplete'=>'off','class'=>'form-control','id'=>'tanggal','required']) }}
                </div>
            </div>

            <div class="col-sm-4 border border-primary">
                <div class="6"><p class="text-center">MASUK<br><span id="txt_masuk">-</span></p></div>
                <div class="6">
                    {{ Form::hidden('masuk',old('masuk'),['autocomplete'=>'off','class'=>'form-control','id'=>'masuk','required']) }}
                </div>
            </div>

            <div class="col-sm-4 border border-primary">
                <div class="6"><p class="text-center">KELUAR<br><span id="txt_keluar">-</span></p></div>
                <div class="6">
                    {{ Form::hidden('keluar',old('keluar'),['autocomplete'=>'off','class'=>'form-control','id'=>'keluar','required']) }}
                </div>
            </div>

        </div>

        @component('component.alert-info',['id'=>'alert_unggah','class'=>'mt-2'])
            asdas
        @endcomponent
        @slot('footer')
            <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
            <input type="submit" class="btn btn-primary" value="Simpan">
        @endslot
    @endcomponent
    {{ Form::close() }}
@endsection