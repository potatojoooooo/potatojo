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
                    backgroundColor: ["red", "blue", "green", "purple"],
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    });
});
