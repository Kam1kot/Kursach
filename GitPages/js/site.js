(function () {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

  window.copyText = function (element) {
    const email = 'Geek-print33@yandex.ru';
    navigator.clipboard
      .writeText(email)
      .then(() => {
        const originalText = element.innerHTML;
        element.innerHTML = 'Почта скопирована!';
        setTimeout(() => {
          element.innerHTML = originalText;
        }, 1500);
      })
      .catch(() => {
        alert('Не удалось скопировать почту.');
      });
  };

  const sidebarToggle = document.querySelector('[data-lte-toggle="sidebar"]');
  sidebarToggle?.addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('mainSidebar')?.classList.toggle('sidebar-collapsed');
  });

  const cookieKey = 'cookie_info_shown';
  const cookieToastEl = document.getElementById('cookieToast');
  if (cookieToastEl && !localStorage.getItem(cookieKey)) {
    const toast = bootstrap.Toast.getOrCreateInstance(cookieToastEl);
    toast.show();
    document.getElementById('cookieAccept')?.addEventListener('click', () => {
      localStorage.setItem(cookieKey, '1');
      toast.hide();
    });
  }
})();
