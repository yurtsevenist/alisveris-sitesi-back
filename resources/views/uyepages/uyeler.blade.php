@extends('layouts.master')
@section('title','Üye Listesi')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a></li>
               <li class="breadcrumb-item active">Üye Listesi</li> 
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sitenize kayıtlı üyelerin listesi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Adı Soyadı</th>
                  <th>E-Posta</th>
                  <th>Telefon</th>
                  <th>Adres</th>
                  <th>Sipariş Sayısı</th>
                  <th>Toplam Alışveriş (TL)</th>
                  <th>Üyelik Tarihi</th>
                  <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                    @php($say=0)
                   @foreach ($users as $user )
                   @php($say++)
                   <tr>
                      <td>{{$say}}</td> 
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                      <td class="text-center">
                          <a href="" class="btn btn-primary btn-sm" title="Üyeyi İncele"><i class="fas fa-eye"></i></a>
                          <a href="" class="btn btn-danger btn-sm" title="Üyeyi Sil"><i class="fas fa-trash-alt"></i></a>

                      </td>
                   </tr>
                       
                   @endforeach     
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('js')
      <!-- DataTables  & Plugins -->
<script src="{{asset('back')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('back')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('back')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('back')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('back')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('back')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print"],  
         "lengthMenu": [ [25, 50,100, -1], [25, 50,100, "All"] ],
            language: {
            info: "_TOTAL_ kayıttan _START_ ile _END_ arasındaki kayıtlar gösteriliyor.",
            infoEmpty: "Gösterilecek hiç kayıt yok.",
            loadingRecords: "Kayıtlar yükleniyor.",
            zeroRecords: "Tablo boş",
            lengthMenu: "Hers sayfada _MENU_ kayıt göster",
            search: "Arama:",
            infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
            buttons: {
                copyTitle: "Panoya kopyalandı.",
                copySuccess: "Panoya %d satır kopyalandı",
                copy: "Kopyala",
                print: "Yazdır",
            },

            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
        }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
    });
  </script>
  @endsection
  @section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  @endsection
