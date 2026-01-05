const primary = '#4f46e5';
const muted = '#e5e7eb';

function lineChart(ctxId) {
    const ctx = document.getElementById(ctxId);
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['10 May','11 May','12 May','13 May','14 May','15 May','16 May'],
            datasets: [{
                label: 'Income',
                data: [40,60,45,70,55,80,65],
                backgroundColor: primary,
                borderRadius: 6
            },{
                label: 'Expense',
                data: [25,35,30,45,32,50,40],
                backgroundColor: '#c7d2fe',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: muted }, ticks: { stepSize: 20 } }
            }
        }
    });
}

function pieChart(ctxId) {
    const ctx = document.getElementById(ctxId);
    if (!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Male','Female','Child','Geriatric'],
            datasets: [{
                data: [35,40,15,10],
                backgroundColor: ['#6366f1','#22c55e','#f97316','#facc15']
            }]
        },
        options: {
            cutout: '65%',
            plugins: { legend: { position: 'bottom' } }
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    lineChart('revenueChart');
    lineChart('balanceChart');
    pieChart('appointmentsPie');
});
