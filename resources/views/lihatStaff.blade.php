@extends('templates.admins.master')

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
      @if (session()->has('deleteNotif'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('deleteNotif')}} </strong>
      </div>
    @endif
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong> {{session()->get('success')}} </strong>
      </div>
    @endif
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Anggota</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 1%" >Number</th>
              <th> Nama Anggota</th>
              <th>Email</th>
              <th>Nomor Identitas</th>
              <th>Jabatan Anggota</th>
              <th style="width: 1%">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php $no = 0;?>
              @foreach($readUser as $read)
              <?php $no++ ;?>
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $read->name }}</td>
              <td>{{ $read->email }}</td>
              <td>{{ $read->identitas }}</td>
              <?php
              if($read->isAdmin == 0) {
                $jabatan = 'Staff';
              }
              else if($read->isAdmin == 1) {
                $jabatan = 'Admin';
              }
              else if($read->isAdmin ==2) {
                $jabatan = 'Peneliti';
              }
              else {
                $jabatan = 'Direktur';
              }
              ?>
              <td>{{ $jabatan }}</td>
              <td>
                <?php
                if($read->id != Auth::id()) {
                ?>

                  <form action="{{ route('lihatStaff.destroy', $read->id) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-xs"  onclick="deleteConfirm()"><i class="fa fa-trash-o"></i>Delete</button>

                      <script>
                          function deleteConfirm() {
                            event.preventDefault(); // prevent form submit
                            var form = event.target.form; // storing the form
                              swal({
                                title: "Apakah anda yakin?",
                                text: "Anda tidak dapat mengembalikan akun yang telah dihapus",         type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Hapus",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                              if (isConfirm) {
                                form.submit();          // submitting the form when user press yes
                              }
                            });
                            }
                      </script>

                  </form>

              </td>
            </tr>
          <?php }
          ?>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>



@endsection
