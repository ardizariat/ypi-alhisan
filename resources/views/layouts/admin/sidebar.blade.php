 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active">
         <div class="sidebar-header position-relative">
             <div class="d-flex justify-content-between align-items-center">
                 <div class="logo">
                     <a href="/" target="_blank"><img src="{{ asset('assets/images/logo/alhisanLogo.png') }}"
                             style="height:100px" alt="Alhisan" srcset=""></a>
                 </div>
                 <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                     <div class="form-check form-switch fs-6">
                         <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                     </div>
                 </div>
                 <div class="sidebar-toggler  x">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <div class="sidebar-menu">
             <ul class="menu">
                 <li class="sidebar-title">Menu</li>
                 <li class="sidebar-item {{ activeClass('admin.dashboard.index') }}">
                     <a href="{{ route('admin.dashboard.index') }}" class='sidebar-link'>
                         <i class="bi bi-grid-fill"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ activeClass('admin.alhisan.index') }}">
                     <a href="{{ route('admin.alhisan.index') }}" class='sidebar-link'>
                         <i class="bi bi-gear-wide-connected"></i>
                         <span>Alhisan</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ activeClass('admin.pengurus-yayasan.index') }}">
                     <a href="{{ route('admin.pengurus-yayasan.index') }}" class='sidebar-link'>
                         <i class="bi bi-incognito"></i>
                         <span>Pengurus Yayasan</span>
                     </a>
                 </li>

                 <li
                     class="sidebar-item has-sub {{ activeClass('admin.kategori-artikel.index') }} {{ activeClass('admin.artikel.index') }} {{ activeClass('admin.artikel.create') }} {{ activeClass('admin.artikel.edit') }}">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-pen"></i>
                         <span>Artikel</span>
                     </a>
                     <ul
                         class="submenu {{ activeClass('admin.artikel.index') }} {{ activeClass('admin.artikel.create') }} {{ activeClass('admin.artikel.edit') }} {{ activeClass('admin.kategori-artikel.index') }}">
                         <li
                             class="submenu-item {{ activeClass('admin.artikel.index') }} {{ activeClass('admin.artikel.create') }} {{ activeClass('admin.artikel.edit') }}">
                             <a href="{{ route('admin.artikel.index') }}">Artikel</a>
                         </li>
                         <li class="submenu-item {{ activeClass('admin.kategori-artikel.index') }}">
                             <a href="{{ route('admin.kategori-artikel.index') }}">Kategori</a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item {{ activeClass('admin.kalimat-hikmah.index') }}">
                     <a href="{{ route('admin.kalimat-hikmah.index') }}" class='sidebar-link'>
                         <i class="bi bi-vector-pen"></i>
                         <span>Kalimat Hikmah</span>
                     </a>
                 </li>
                 <li
                     class="sidebar-item has-sub {{ activeClass('admin.galeri.index') }} {{ activeClass('admin.poster-dakwah.index') }}">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-image-fill"></i>
                         <span>Galeri</span>
                     </a>
                     <ul
                         class="submenu {{ activeClass('admin.galeri.index') }} {{ activeClass('admin.poster-dakwah.index') }}">
                         <li class="submenu-item {{ activeClass('admin.galeri.index') }}">
                             <a href="{{ route('admin.galeri.index') }}">Galeri Kegiatan</a>
                         </li>
                         <li class="submenu-item {{ activeClass('admin.poster-dakwah.index') }}">
                             <a href="{{ route('admin.poster-dakwah.index') }}">Poster Dakwah</a>
                         </li>
                     </ul>
                 </li>
                 <li
                     class="sidebar-item {{ activeClass('admin.rapat-yayasan.index') }} {{ activeClass('admin.rapat-yayasan.show') }} {{ activeClass('admin.rapat-yayasan.create') }}">
                     <a href="{{ route('admin.rapat-yayasan.index') }}" class='sidebar-link'>
                         <i class="bi bi-border-width"></i>
                         <span>Rapat Yayasan</span>
                     </a>
                 </li>
                 <li class="sidebar-item {{ activeClass('admin.agenda.index') }}">
                     <a href="{{ route('admin.agenda.index') }}" class='sidebar-link'>
                         <i class="bi bi-card-checklist"></i>
                         <span>Agenda</span>
                     </a>
                 </li>
                 <li
                     class="sidebar-item {{ activeClass('admin.inventaris.index') }} {{ activeClass('admin.inventaris.create') }} {{ activeClass('admin.inventaris.show') }} {{ activeClass('admin.inventaris.edit') }}">
                     <a href="{{ route('admin.inventaris.index') }}" class='sidebar-link'>
                         <i class="bi bi-receipt"></i>
                         <span>Inventaris</span>
                     </a>
                 </li>
                 <li
                     class="sidebar-item has-sub {{ activeClass('admin.kas-keluar.index') }} {{ activeClass('admin.kas-masuk.index') }}">
                     <a href="#" class='sidebar-link'>
                         <i class="bi bi-currency-exchange"></i>
                         <span>Kas</span>
                     </a>
                     <ul
                         class="submenu {{ activeClass('admin.kas-keluar.index') }} {{ activeClass('admin.kas-masuk.index') }}">
                         <li class="submenu-item {{ activeClass('admin.kas-masuk.index') }}">
                             <a href="{{ route('admin.kas-masuk.index') }}">Kas Masuk</a>
                         </li>
                         <li class="submenu-item {{ activeClass('admin.kas-keluar.index') }}">
                             <a href="{{ route('admin.kas-keluar.index') }}">Kas Keluar</a>
                         </li>
                     </ul>
                 </li>
                 @role('superAdmin')
                     <li
                         class="sidebar-item has-sub {{ activeClass('admin.user.index') }} {{ activeClass('admin.role-permission.index') }} {{ activeClass('admin.aktifitas-user.index') }}">
                         <a href="#" class='sidebar-link'>
                             <i class="bi bi-person-lines-fill"></i>
                             <span>User</span>
                         </a>
                         <ul
                             class="submenu {{ activeClass('admin.user.index') }} {{ activeClass('admin.role-permission.index') }} {{ activeClass('admin.aktifitas-user.index') }}">
                             <li class="submenu-item {{ activeClass('admin.user.index') }}">
                                 <a href="{{ route('admin.user.index') }}">User</a>
                             </li>
                             <li class="submenu-item {{ activeClass('admin.role-permission.index') }}">
                                 <a href="{{ route('admin.role-permission.index') }}">Role & Permission</a>
                             </li>
                             <li class="submenu-item {{ activeClass('admin.aktifitas-user.index') }}">
                                 <a href="{{ route('admin.aktifitas-user.index') }}">Aktifitas USer</a>
                             </li>
                         </ul>
                     </li>
                 @endrole
             </ul>
         </div>
     </div>
 </div>
