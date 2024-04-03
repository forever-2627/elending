

<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
    <p id="copyright" class="text-muted mb-1 mb-md-0"></p>
    <p class="text-muted">BestLoan With <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i></p>
  </footer>

@push('script')
    <script>
        $('document').ready(() => {
            let currentYear = new Date().getFullYear();
            console.log(currentYear);
            $('#copyright').html(`Copyright ©  ${currentYear}`);
        });

    </script>
@endpush