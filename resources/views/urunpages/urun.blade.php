@extends('layouts.master')
@section('title','Ürün Düzenle')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a type="button" class="btn btn-info btn-sm" href="{{route('urunler')}}">Ürünler</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Ürün Düzenle</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@if($urun!=null) Ürün Düzenle @else Ürün Ekle @endif</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                      <form action="{{route('productUpdate')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" @if($urun!=null) value="{{$urun->id}}" @else value="0" @endif>
                        <div class="form-group">
                            <label for="name">Ürün Adı</label>
                            <input type="text" id="name" name="name" @if($urun!=null) value="{{$urun->name}}" @endif class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="info">Bilgi</label>
                            <textarea id="info" name="info" class="form-control" rows="4">@if($urun!=null) {{$urun->info}} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select id="category" name="category" class="form-control custom-select">
                                <option selected="" disabled="">Seçim Yapınız</option>
                                 @foreach ($categori as $item)
                                    <option @if($urun!=null) @if($item->name==$urun->category) selected @endif @endif value="{{$item->name}}">{{$item->name}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size">Beden</label>
                            <select id="size" name="size" class="form-control custom-select">
                                <option selected="" disabled="">Seçim Yapınız</option>
                                 @foreach ($sizes as $item)
                                    <option @if($urun!=null) @if($item->name==$urun->size) selected @endif @endif value="{{$item->name}}">{{$item->name}}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Fiyatı</label>
                            <input type="text" @if($urun!=null) value="{{$urun->price}}" @endif
                             oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="price" name="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="number">Adet</label>
                            <input type="number" min="0" id="number" name="number" @if($urun!=null) value="{{$urun->number}}" @endif class="form-control">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary btn-md">@if($urun!=null) Güncelle @else Ekle @endif</button>
                      </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Ürüne Resim Ekle</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body shadow">

                        <p class="mesaj text-center fs-4 fw-bold text-info " id="mesaj"></p>

                        <form method="post" action="{{route('photoAdd')}}" enctype="multipart/form-data" class="dropzone shadow p-3 mb-5 bg-body rounded " id="dropzone">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$urun->id}}">
                        </form>
                         @if($urun!=null and $urun->getPhoto!=null)
                          <div class="row">
                              @foreach ($urun->getPhoto as $item)
                              <div class="col-md-4 shadow text-center mb-2">
                                <img src="{{asset($item->url)}}" class="img-fluid" alt="...">
                              </div>
                              @endforeach
                          </div>
                         @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        {{-- <div class="row">
          <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
          </div>
        </div> --}}
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": true
            , "autoWidth": false
            , "buttons": ["copy", "excel", "pdf", "print"]
            , "lengthMenu": [
                [25, 50, 100, -1]
                , [25, 50, 100, "All"]
            ]
            , language: {
                info: "_TOTAL_ kayıttan _START_ ile _END_ arasındaki kayıtlar gösteriliyor."
                , infoEmpty: "Gösterilecek hiç kayıt yok."
                , loadingRecords: "Kayıtlar yükleniyor."
                , zeroRecords: "Tablo boş"
                , lengthMenu: "Hers sayfada _MENU_ kayıt göster"
                , search: "Arama:"
                , infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)"
                , buttons: {
                    copyTitle: "Panoya kopyalandı."
                    , copySuccess: "Panoya %d satır kopyalandı"
                    , copy: "Kopyala"
                    , print: "Yazdır"
                , },

                paginate: {
                    first: "İlk"
                    , previous: "Önceki"
                    , next: "Sonraki"
                    , last: "Son"
                }
            , }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
Dropzone.prototype.defaultOptions.dictDefaultMessage = "Resim dosyalarınızı buraya sürükleyip bırakınız!!";
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var id= $("#id").val();
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file)
        {
            var id= $("#id").val();
            var name = file.upload.filename;

            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                type: 'POST',
                url: '{{ url("photoDelete") }}',
                data: {
                    filename: name,
                    id:id,
                },
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file, response)
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
};
</script>
@endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('back')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

<style>
    .dropzone{
        border: 1px;
        border: dashed;
        border-radius: 20px!important;
    }
</style>
@endsection
