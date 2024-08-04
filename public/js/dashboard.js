document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    function getTableData() {
        const table = document.getElementById('reportTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        const reportTypes = [
            'Credit Report Plus',
            'Quick Summary Report',
            'CRIB Score Report',
            'Credit Report',
            'Snapshot Report',
        ];

        const counts = reportTypes.map(type => {
            return Array.from(rows).reduce((count, row) => {
                const cols = row.getElementsByTagName('td');
                console.log(`Checking row:`, cols); // Debug log
                console.log(`Checking id_type: ${cols[3].innerText.trim()}`); // Adjusted to get the requested_report column
                if (cols[3].innerText.trim() === type) { // Adjust index for 'requested_report'
                    return count + 1;
                }
                return count;
            }, 0);
        });

        console.log('Extracted Labels:', reportTypes);
        console.log('Extracted Data:', counts);

        return { labels: reportTypes, data: counts };
    }

    const { labels, data } = getTableData();

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Change to 'bar'
        data: {
            labels: labels,
            datasets: [{
                label: 'Report Counts',
                data: data,
                backgroundColor: 'rgba(102, 16, 242, 0.2)', // Light purple background
                borderColor: 'rgba(102, 16, 242, 1)', // Dark purple border
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    boxPadding: 3
                }
            }
        }
    });
});