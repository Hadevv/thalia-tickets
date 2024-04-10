@props(['search'])

<form action="{{ route('show.index') }}" method="GET" id="searchForm" class="flex">
    <input type="text" name="search" value="{{ $search }}" placeholder="Search..." class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="searchInput">
</form>

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        document.getElementById('searchForm').submit();
        preventDefault();
    });
</script>
@endpush






