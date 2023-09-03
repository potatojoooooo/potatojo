document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("event-durations").getContext("2d");
    var durationsData = JSON.parse(
        document
            .getElementById("event-durations-data")
            .getAttribute("data-durations")
    );
    var durationData = [];
    var eventDates = [];

    durationsData.forEach(function (item) {
        durationData.push(item.duration_hours);
        eventDates.push(item.date);
    });

    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: eventDates,
            datasets: [
                {
                    label: "Event Durations (in hours)",
                    data: durationData,
                    backgroundColor: "rgba(75, 192, 192, 1)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: {
                        stepSize: 1,
                    },
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Hours",
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: "Event Date",
                    },
                },
            },
        },
    });
});
