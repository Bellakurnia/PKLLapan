<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron"></span></a>
      </li>
		<ul class="nav side-menu">
      <li><a><i class="fa fa-mortar-board"></i> Keanggotaan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('lihatStaff.readAll') }}">Daftar Anggota</a></li>
          <li><a href="{{ route('tambahStaff.create') }}">Tambah Anggota</a></li>
        </ul>
      </li>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-globe"></i> Cabang <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          @foreach ($side as $id)
          <li><a href="{{ route('lihat.agam', $id->id_cabang) }}">{{ $id->nama_cabang }}</a></li>
          @endforeach
          <li><a href="{{ route('tambahCabang') }}">Tambah Cabang</a></li>
        </ul>
      </li>
    <ul class="nav side-menu">
      <li><a href="#"><i class="fa fa-folder"></i>Daftar File</a>
      </li>
  </div>
</div>
<!-- /sidebar menu -->
