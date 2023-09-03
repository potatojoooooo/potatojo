document.addEventListener("DOMContentLoaded", function () {
    var categoryData = document.getElementById("category-data");
    var categoryNames = JSON.parse(
        categoryData.getAttribute("data-category-names")
    );
    var categoryCounts = JSON.parse(
        categoryData.getAttribute("data-category-counts")
    );
    console.log(categoryNames);
    console.log(categoryCounts);

    var ctx = document.getElementById("event-categories").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: categoryNames,
            datasets: [
                {
                    data: categoryCounts,
                    backgroundColor: [
                        "#85586F",
                        "#D6EFED",
                        "#957DAD",
                        "#DEB6AB",
                        "#FEC8D8",
                        "#898AA6",
                        "#F8ECD1",
                        "#AC7D88",
                        "#E0BBE4",
                    ],
                    borderColor: "rgba(23, 37, 84, 0.2)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    });
});
