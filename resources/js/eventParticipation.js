// public/js/chart.js
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document
        .getElementById("participation-over-time")
        .getContext("2d");
    var chartData = document.getElementById("participation-chart-data");
    var labels = JSON.parse(chartData.getAttribute("data-labels"));
    var data = JSON.parse(chartData.getAttribute("data-data"));
    console.log(labels); // Check the labels in the browser console
    console.log(data); // Check the data in the browser console

    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Events",
                    data: data,
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: "rgba(23, 37, 84, 0.2)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [
                    {
                        title: {
                            display: true,
                            text: "Month",
                        },
                    },
                ],
                yAxes: [
                    {
                        ticks: {
                            stepSize: 1,
                        },
                        title: {
                            display: true,
                            text: "Count",
                        },
                    },
                ],
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 14,
                        },
                    },
                },
            },
        },
    });
});
