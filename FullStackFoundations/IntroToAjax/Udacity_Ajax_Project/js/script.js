
function loadData() {

    var $body = $('body');
    var $wikiElem = $('#wikipedia-links');
    var $nytHeaderElem = $('#nytimes-header');
    var $nytElem = $('#nytimes-articles');
    var $greeting = $('#greeting');

    // clear out old data before new request
    $wikiElem.text("");
    $nytElem.text("");

    // load streetview
    var street = $("#street").val(); 
    var city = $("#city").val(); 
    var address = street + ', '+city

    $greeting.text('So you wnat to live at '+address+'?');
    
    var streetviewUrl = 'https://maps.googleapis.com/maps/api/streetview?size=600x400&location='+ address+ '';
    // YOUR CODE GOES HERE!
    streetViewQuery = '<img class="bgimg" src="'+streetviewUrl+'"">'
    
    $body.append(streetViewQuery);
    return false;
};

$('#form-container').submit(loadData);
