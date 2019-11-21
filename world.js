$(document).ready(function () {
    
    let countryBtn = $('#countryLookup');
    let cityBtn = $('#cityLookup');

    countryBtn.on('click', function() {
        let input = $('#country').val();
        
        $.ajax("world.php", {
            method: "GET",
            data: {
                country: input
            }
        }).done(function(response) {
            $('#result').html(response);
        }).fail(function() {
            alert("An error occurred");
        });
    });

    cityBtn.on('click', function() {
        let input = $('#country').val();
        
        $.ajax("world.php", {
            method: "GET",
            data: {
                country: input,
                context: "cities"
            }
        }).done(function(response) {
            $('#result').html(response);
        }).fail(function() {
            alert("An error occurred");
        });
    });
    
});