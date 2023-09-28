$(document).ready(function () {
    // Make an AJAX request to fetch opening hours from your JSON file
    $.ajax({
        url: 'opening_hours.json', // Replace with the actual path to your JSON file
        dataType: 'json',
        success: function (data) {
            var daysOfWeek = {
                'Monday': 'Lundi',
                'Tuesday': 'Mardi',
                'Wednesday': 'Mercredi',
                'Thursday': 'Jeudi',
                'Friday': 'Vendredi',
                'Saturday': 'Samedi',
                'Sunday': 'Dimanche'
            };

            for (var day in daysOfWeek) {
                var opening = data[day + 'Opening'];
                var closing = data[day + 'Closing'];
                var hoursText = '';

                if (opening === 'Closed') {
                    hoursText = daysOfWeek[day] + ': Fermé';
                } else {
                    hoursText = daysOfWeek[day] + ': ' + opening + ' - ' + closing;
                }

                $('#' + day.toLowerCase() + 'Hours').text(hoursText);
            }
        },
        error: function () {
            // Handle error when opening hours cannot be fetched
            $('.hours').text('Error fetching opening hours');
        }
    });
});