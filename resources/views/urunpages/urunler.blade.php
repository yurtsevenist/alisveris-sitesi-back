@extends('layouts.master')
@section('title','Ürün Listesi')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a type="button" class="btn btn-info btn-sm" href="{{route('urun',0)}}">Ürün Ekle</a>
            <a type="button" class="btn btn-danger btn-sm deleteall-click" urun_id="0">Tüm Ürünleri Sil</a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a></li>
               <li class="breadcrumb-item active">Ürün Listesi</li>
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
              <h3 class="card-title">Sitenize kayıtlı ürünlerin listesi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if($urunler->count()>0)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Ürün Adı</th>
                  <th>Kategori</th>
                  <th>Beden</th>
                  <th>Bilgi</th>
                  <th>Birim Fiyatı</th>
                  <th>Adet</th>
                  <th>Satılan Adet</th>
                  <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                    @php($say=0)
                   @foreach ($urunler as $item)
                   @php($say++)
                     <tr>
                        <td>{{$say}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->category}}</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->info}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->number}}</td>
                        <td>0</td>
                        <td class="text-center">
                            <a href="{{route('urun',$item->id)}}" class="btn btn-primary btn-sm" title="Ürünü İncele"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-danger btn-sm deleteall-click" urun_id={{$item->id}} title="Ürünü Sil"><i class="fas fa-trash-alt"></i></a>
                       </td>
                    </tr>
                   @endforeach
                </tbody>

              </table>
              @else
                <h5 class="text-info text-center">Sisteminize kayıtlı ürün bulunmamaktadır</h5>
              @endif
            </div>
            <!-- /.card-body -->
          </div>
    </section>
    {{-- delete all modall --}}
    <div class="modal fade" id="deleteAllModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tüm Ürünleri Sil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Sisteminize kayıtlı {{$urunler->count()}} adet ürün silinecek, onaylıyormusunuz</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
              <a type="button" class="btn btn-primary" href="{{route('deleteAllProduct')}}">Onayla</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    {{-- delete all modal end --}}
     {{-- delete product modall --}}
     <div class="modal fade" id="deleteModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ürün Sil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">

              <p>Sisteminize kayıtlı seçmiş oldugunuz ürün silinecek, onaylıyormusunuz</p>
            </div>
            <form action="{{route('deleteProduct')}}" method="post">
             @csrf
             <input type="hidden" name="id" id="id" value="">
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
              <button type="submit" class="btn btn-primary">Onayla</button>
            </div>
            </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    {{-- delete product modal end --}}
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
   <script>
    $(function(){
       $('.deleteall-click').click(function(){
        id = $(this)[0].getAttribute('urun_id');
        if(id==0)
        {
            $('#deleteAllModal').modal('show');
        }
        else
        {
            $('#id').val(id);
            $('#deleteModal').modal('show');
        }



       });
    });
  </script>
  @endsection
  @section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  @endsection
