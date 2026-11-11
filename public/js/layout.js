// Navbar + footer Bootstrap, satu tempat untuk semua halaman
(function () {
  const s = document.currentScript, part = s.dataset.part;
  const f = location.pathname.split('/').pop() || 'index.html';
  const brand = (href, extra) => '<a class="navbar-brand" href="' + href + '">🌱 RK BIBIT ID' + (extra || '') + '</a>';
  const nav = (b, items) => '<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top"><div class="container">' + b +
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Buka menu"><span class="navbar-toggler-icon"></span></button>' +
    '<div class="collapse navbar-collapse justify-content-end" id="menu"><ul class="navbar-nav gap-lg-2">' + items + '</ul></div></div></nav>';
  const li = (href, txt, on, extra) => '<li class="nav-item"><a class="nav-link' + (on ? ' active" aria-current="page' : '') + '" href="' + href + '"' + (extra || '') + '>' + txt + '</a></li>';
  let html = '';
  if (part === 'nav') {
    const aktif = f === 'detail.html' ? 'katalog.html' : f;
    html = nav(brand('index.html'), [['index.html','Beranda'],['katalog.html','Katalog'],['tentang.html','Tentang Toko'],['pemesanan.html','Cara Pemesanan &amp; Penanganan']].map(x => li(x[0], x[1], x[0] === aktif)).join(''));
  } else if (part === 'adminnav') {
    const bibit = f === 'admin.php' || f === 'admin-form.php';
    html = nav(brand('admin.php', ' <span class="pill-admin">Admin</span>'), li('admin.php', 'Bibit', bibit) + li('admin-toko.php', 'Info Toko', f === 'admin-toko.php') +
      li('logout.php', 'Logout', false, ' onclick="return confirm(\'Keluar dari halaman admin?\')"'));
  } else {
    html = '<footer class="border-top py-3 text-center small text-secondary">© ' + new Date().getFullYear() + ' RK Bibit ID. Bibit sehat untuk kebun dan rumahmu.</footer>';
  }
  s.insertAdjacentHTML('beforebegin', html);
})();
