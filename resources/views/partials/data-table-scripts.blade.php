@push('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .action .dropdown-item.active,
         .dropdown-item:active {
             color: #fff;
             text-decoration: none;
             background-color: #fff;
         }
         .action .dropdown-item.active,
         .dropdown-item:hover a, .action .dropdown-item.active,
         .dropdown-item:hover button {
            transform: scale(1.15)
         }
 
     </style>
@endpush
@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
