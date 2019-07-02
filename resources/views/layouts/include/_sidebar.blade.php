<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ url('/')}}" class="{{ (request()->segment(1)=='dashboard') ? 'active' : ''}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ url('/guru')}}" class="{{ (request()->segment(1)=='guru') ? 'active' : ''}}"><i class="lnr lnr-user"></i> <span>Guru</span></a></li>
                <li><a href="{{ url('/buku')}}" class="{{ (request()->segment(1)=='buku') ? 'active' : ''}}"><i class="lnr lnr-user"></i> <span>Buku</span></a></li>
                <li><a href="{{ url('/siswa')}}" class="{{ (request()->segment(1)=='siswa') ? 'active' : ''}}"><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->