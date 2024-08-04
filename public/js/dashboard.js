document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Log the inquiriesArray to the console
    console.log(inquiriesArray);

    function getChartData(inquiries) {
        const reportTypes = [
            'Credit Report Plus',
            'Quick Summary Report',
            'CRIB Score Report',
            'Credit Report',
            'Snapshot Report',
        ];

        const counts = reportTypes.map(type => {
            return inquiries.reduce((count, inquiry) => {
                if (inquiry.requested_report === type) {
                    return count + 1;
                }
                return count;
            }, 0);
        });

        return { labels: reportTypes, data: counts };
    }

    const { labels, data } = getChartData(inquiriesArray);

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Report Counts',
                data: data,
                backgroundColor: 'rgba(102, 16, 242, 0.2)',
                borderColor: 'rgba(102, 16, 242, 1)',
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
