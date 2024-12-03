<table class="min-w-full bg-white">
    <thead>
        <!-- Row for the title -->
        <tr>
            <th colspan="3" class="py-4 text-center text-l font-semibold border-b border-gray-300 whitespace-nowrap">
                Top 10 Vulnerable Apps
            </th>
        </tr>
        <!-- Header row for columns -->
        <tr>
            <th class="py-2 border border-gray-300 text-center">No</th>
            <th class="py-2 border border-gray-300">Domain</th>
            <th class="py-2 border border-gray-300">Total Vulnerabilities</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $index => $record)
            <tr>
                <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $record->domain }}</td>
                <td class="border px-4 py-2">{{ $record->total_vulnerabilities }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
