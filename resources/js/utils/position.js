export function getIp() {
    /*
    fetch('https://ipapi.co/json/')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            console.log(data);
            return data;
        });
        */
       return fetch('https://extreme-ip-lookup.com/json/')
        .then( res => res.json())
        .then(response => {
            console.log("ip response: ", response);
            return response;
        })
}



export function geoFindMe() {
  
    function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        console.log("Latitude: " + position.coords.latitude);
        console.log("Longitude: " + position.coords.longitude);
    }
}