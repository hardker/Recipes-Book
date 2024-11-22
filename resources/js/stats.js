// // Функция для инициализации графиков
// // function initializeCharts(recipesData, commentsData, statisticsData,recipesByCategories) {
// //     createRecipesChart(recipesData);
// //     createCommentsChart(commentsData);
// //     createPageViewsChart(statisticsData);
// //     createRecByCatChart(recipesByCategories);
// //   //  createTimeOnSiteChart(analyticsData);
// // }

// // Экспортируем функцию для использования в Blade-шаблоне
// // export { initializeCharts };

// // Функция для создания графика количества рецептов по месяцам
// function createRecipesChart(recipesData) {
//     const recipesChart = new Chart(document.getElementById("RecipesChart"), {
//         type: "line",
//         data: {
//             labels: recipesData.labels,
//             datasets: [
//                 {
//                     label: "Количество рецептов",
//                     data: recipesData.data,
//                     backgroundColor: "rgba(54, 162, 235, 0.2)",
//                     borderColor: "rgba(54, 162, 235, 1)",
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                 },
//             },
//         },
//     });
// }

// // Функция для создания графика количества комментариев по месяцам
// function createCommentsChart(commentsData) {
//     const commentsChart = new Chart(document.getElementById("commentsChart"), {
//         type: "bar",
//         data: {
//             labels: commentsData.labels,
//             datasets: [
//                 {
//                     label: "Количество комментариев",
//                     data: commentsData.data,
//                     backgroundColor: "rgba(75, 192, 192, 0.2)",
//                     borderColor: "rgba(75, 192, 192, 1)",
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                 },
//             },
//         },
//     });
// }

// // Функция для создания графика количества просмотров страниц
// function createPageViewsChart(statisticsData) {
//     const pageViewsChart = new Chart(
//         document.getElementById("pageViewsChart"),
//         {
//             type: "bar",
//             data: {
//                 labels: ["Просмотры страниц"],
//                 datasets: [
//                     {
//                         label: "Количество просмотров",
//                         data: [statisticsData.pageViews],
//                         backgroundColor: "rgba(255, 99, 132, 0.2)",
//                         borderColor: "rgba(255, 99, 132, 1)",
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                     },
//                 },
//             },
//         }
//     );
// }

// // Функция для создания графика количества кликов по ссылкам
// function createRecByCatChart(recipesByCategories) {
//     const recByCatChart = new Chart(
//         document.getElementById("recByCatChart"),
//         {
//             type: "bar",
//             data: {
//                 labels: ["Клик по ссылкам"],
//                 datasets: [
//                     {
//                         label: "Количество кликов",
//                         data: [recipesByCategories.data],
//                         backgroundColor: "rgba(153, 102, 255, 0.2)",
//                         borderColor: "rgba(153, 102, 255, 1)",
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                     },
//                 },
//             },
//         }
//     );
// }

// // Функция для создания графика количества времени на сайте
// function createTimeOnSiteChart(analyticsData) {
//     const timeOnSiteChart = new Chart(
//         document.getElementById("timeOnSiteChart"),
//         {
//             type: "bar",
//             data: {
//                 labels: ["Время на сайте"],
//                 datasets: [
//                     {
//                         label: "Количество записей",
//                         data: [analyticsData.timeOnSite],
//                         backgroundColor: "rgba(255, 159, 64, 0.2)",
//                         borderColor: "rgba(255, 159, 64, 1)",
//                         borderWidth: 1,
//                     },
//                 ],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                     },
//                 },
//             },
//         }
//     );
// }
