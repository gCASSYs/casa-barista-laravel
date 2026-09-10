<script
  src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
  crossorigin="anonymous"
></script>
<script
  src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  crossorigin="anonymous"
></script>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
  crossorigin="anonymous"
></script>
  <script src="{{ asset('admin/js/adminlte.js') }}"></script>
  <script src="{{ asset('admin/js/script.js') }}"></script>
<script
  src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
  crossorigin="anonymous"
></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const sidebarWrapper = document.querySelector('.sidebar-wrapper');
    const sortableArea = document.querySelector('.connectedSortable');

    if (
      sidebarWrapper &&
      window.innerWidth > 992 &&
      globalThis.OverlayScrollbarsGlobal?.OverlayScrollbars
    ) {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: 'os-theme-light',
          autoHide: 'leave',
          clickScroll: true,
        },
      });
    }

    if (sortableArea && globalThis.Sortable) {
      new Sortable(sortableArea, {
        group: 'shared',
        handle: '.card-header',
      });

      sortableArea.querySelectorAll('.card-header').forEach((cardHeader) => {
        cardHeader.classList.add('is-sortable');
      });
    }
  });
</script>
