function test(){

    alert("Incorrect Login Credentials!");
}

function logoutVerify(){
  if (confirm("Are You Sure You Want To Logout?")){
    window.location.href = "index.php";
  }
}

function validateFormLogin() {
    var sn = document.forms["loginForm"]["username"].value;
    if (sn == "") {
      alert("Please Enter A Username");
      return false;
    }
  
    var sName = document.forms["loginForm"]["password"].value;
    if (sName == "") {
      alert("Please Enter A Password");
      return false;
    }
  }

  $(document).ready(function(){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(success);
    }
    $(".modal").modal();
    $("#city_submit").click(function(){
      var cityName = $("#icon_prefix").val();
      $("#icon_prefix").val("");
      $("#location").html("");
      getWeatherByCityName(cityName);
      getForecastByCityName(cityName);
    });
    $("#icon_prefix").keypress(function(event){
      if(event.keyCode == "13"){
        $("#city_submit").trigger("click");
      }
    });
    $("#current_city").click(function(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success);
      }
    });
  });
  
  function success(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    // var latitude = 30;
    // var longitude = -10;
    setLoc(latitude, longitude);
    getWeather(latitude, longitude);
    getForecast(latitude, longitude);
  }
  
  function setLoc(latitude, longitude){
    if(latitude >= 0){
      latitude = Math.round(latitude) + "<small>°N</small>";
    }
    else{
      latitude = Math.round(latitude) + "<small>°S</small>";
    }
    if(longitude >= 0){
      longitude = Math.round(longitude) + "<small>°E</small>";
    }
    else{
      longitude = Math.round(longitude) + "<small>°W</small>";
    }
    $("#location").html(latitude + ", " + longitude);
  }
  
  var appid = "c231437c38aeccd6596f746f3e95b155";
  var units = "metric";
  
  function getWeather(latitude, longitude){
    $.ajax({
      url: "https://api.openweathermap.org/data/2.5/weather?lang=zh_cn&units=" + units + "&appid=" + appid + "&lat=" + latitude + "&lon=" + longitude,
      success: function(json){
        console.log(json);
        $("#weather").html(json.weather[0].main);
        $("#weather_desc").html("(" + json.weather[0].description + ")");
        $("#weather_icon").html(getWeatherIcon(json.weather[0].id));
        $("#temp").html(json.main.temp + "<small>℃</small>");
        $("#pressure").html(json.main.pressure + "hPa");
        $("#humidity").html(json.main.humidity + "%");
        $("#wind_speed").html(json.wind.speed + "meter/sec");
        $("#cloudiness").html(json.clouds.all + "%");
        $("#city").html(json.name + ", " + counTrans[json.sys.country]);
        $("#time").html(dateTransform(json.dt));
        $("#sunrise_time").html(timeTransform(json.sys.sunrise));
        $("#sunset_time").html(timeTransform(json.sys.sunset));
      }
    });
  }
  
  function getWeatherByCityName(cityName){
    $.ajax({
      url: "https://api.openweathermap.org/data/2.5/weather?lang=zh_cn&units=" + units + "&appid=" + appid + "&q=" + cityName,
      success: function(json){
        $("#weather").html(json.weather[0].main);
        $("#weather_desc").html("(" + json.weather[0].description + ")");
        $("#weather_icon").html(getWeatherIcon(json.weather[0].id));
        $("#temp").html(json.main.temp + "<small>℃</small>");
        $("#pressure").html(json.main.pressure + "hPa");
        $("#humidity").html(json.main.humidity + "%");
        $("#wind_speed").html(json.wind.speed + "meter/sec");
        $("#cloudiness").html(json.clouds.all + "%");
        $("#city").html(json.name + ", " + counTrans[json.sys.country]);
        $("#time").html(dateTransform(json.dt));
        $("#sunrise_time").html(timeTransform(json.sys.sunrise));
        $("#sunset_time").html(timeTransform(json.sys.sunset));
      }
    });
  }
  
  function getForecast(latitude, longitude){
    $.ajax({
      url: "https://api.openweathermap.org/data/2.5/forecast?lang=zh_cn&units=" + units + "&appid=" + appid + "&lat=" + latitude + "&lon=" + longitude,
      success: function(json){
        var html = "";
        for(var i = 0; i < json.cnt; i++){
          html += "<tr>";
          html += "<td>"
          html += json.list[i].dt_txt;
          html += "</td>";
          html += "<td>";
          html += getWeatherIcon(json.list[i].weather[0].id);
          html += "</td>";
          html += "<td>";
          html += json.list[i].main.temp_min.toFixed(2);
          html += "℃~";
          html += json.list[i].main.temp_max.toFixed(2);
          html += "℃";
          html += "</td>";
          html += "</tr>";
        }
        $("#forecast").html(html);
        $("#city_now").html(json.city.name);
      }
    });
  }
  
  function getForecastByCityName(cityName){
    $.ajax({
      url: "https://api.openweathermap.org/data/2.5/forecast?lang=zh_cn&units=" + units + "&appid=" + appid + "&q=" + cityName,
      success: function(json){
        var html = "";
        for(var i = 0; i < json.cnt; i++){
          html += "<tr>";
          html += "<td>"
          html += json.list[i].dt_txt;
          html += "</td>";
          html += "<td>";
          html += getWeatherIcon(json.list[i].weather[0].id);
          html += "</td>";
          html += "<td>";
          html += json.list[i].main.temp_min.toFixed(2);
          html += "℃~";
          html += json.list[i].main.temp_max.toFixed(2);
          html += "℃";
          html += "</td>";
          html += "</tr>";
        }
        $("#forecast").html(html);
        $("#city_now").html(json.city.name);
      }
    });
  }
  
  function timeTransform(unix_time) {
    var data = new Date(unix_time*1000);
    return data.toLocaleTimeString();
  }
  
  function dateTransform(unix_time) {
    var data = new Date(unix_time*1000);
    return data.toLocaleString();
  }
  
  function getWeatherIcon(iconId) {
    var icon = "";
    if(iconId >= 200 && iconId < 300){
      icon = "thunderstorm";
    }
    else if(iconId >= 300 && iconId < 400){
      icon = "rain-mix";
    }
    else if(iconId >= 500 && iconId < 600){
      icon = "rain";
    }
    else if(iconId >= 600 && iconId < 700){
      icon = "snow";
    }
    else if(iconId >= 700 && iconId < 800){
      icon = "fog";
    }
    else if(iconId == 800){
      icon = "day-sunny";
    }
    else if(iconId > 800 && iconId < 900){
      icon = "cloud";
    }
    icon = "<i class='wi wi-" + icon + "'></i>";
    return icon;
  }
  
  var counTrans = {   
   "AO": "Angola",   
   "AF": "Afghanistan",   
   "AL": "Albania",   
   "DZ": "Algeria",   
   "AD": "Andorra",   
   "AI": "Anguilla",   
   "AG": "Barbuda Antigua",   
   "AR": "Argentina",   
   "AM": "Armenia",   
   "AU": "Australia",   
   "AT": "Austria",   
   "AZ": "Azerbaijan",   
   "BS": "Bahamas",   
   "BH": "Bahrain",   
   "BD": "Bangladesh",   
   "BB": "Barbados",   
   "BY": "Belarus",   
   "BE": "Belgium",   
   "BZ": "Belize",   
   "BJ": "Benin",   
   "BM": "Bermuda Is.",   
   "BO": "Bolivia",   
   "BW": "Botswana",   
   "BR": "Brazil",   
   "BN": "Brunei",   
   "BG": "Bulgaria",   
   "BF": "Burkina-faso",   
   "MM": "Burma",   
   "BI": "Burundi",   
   "CM": "Cameroon",   
   "CA": "Canada",   
   "CF": "Central African Republic",   
   "TD": "Chad",   
   "CL": "Chile",   
   "CN": "China",   
   "CO": "Colombia",   
   "CG": "Congo",   
   "CK": "Cook Is.",   
   "CR": "Costa Rica",   
   "CU": "Cuba",   
   "CY": "Cyprus",   
   "CZ": "Czech Republic",   
   "DK": "Denmark",   
   "DJ": "Djibouti",   
   "DO": "Dominica Rep.",   
   "EC": "Ecuador",   
   "EG": "Egypt",   
   "SV": "EI Salvador",   
   "EE": "Estonia",   
   "ET": "Ethiopia",   
   "FJ": "Fiji",   
   "FI": "Finland",   
   "FR": "France",   
   "GF": "French Guiana",   
   "GA": "Gabon",   
   "GM": "Gambia",   
   "GE": "Georgia",   
   "DE": "Germany",   
   "GH": "Ghana",   
   "GI": "Gibraltar",   
   "GR": "Greece",   
   "GD": "Grenada",   
   "GU": "Guam",   
   "GT": "Guatemala",   
   "GN": "Guinea",   
   "GY": "Guyana",   
   "HT": "Haiti",   
   "HN": "Honduras",   
   "HK": "Hongkong",   
   "HU": "Hungary",   
   "IS": "Iceland",   
   "IN": "India",   
   "ID": "Indonesia",   
   "IR": "Iran",   
   "IQ": "Iraq",   
   "IE": "Ireland",   
   "IL": "Israel",   
   "IT": "Italy",   
   "JM": "Jamaica",   
   "JP": "Japan",   
   "JO": "Jordan",   
   "KH": "Kampuchea (Cambodia)",   
   "KZ": "Kazakstan",   
   "KE": "Kenya",   
   "KR": "Korea",   
   "KW": "Kuwait",   
   "KG": "Kyrgyzstan",   
   "LA": "Laos",   
   "LV": "Latvia",   
   "LB": "Lebanon",   
   "LS": "Lesotho",   
   "LR": "Liberia",   
   "LY": "Libya",   
   "LI": "Liechtenstein",   
   "LT": "Lithuania",   
   "LU": "Luxembourg",   
   "MO": "Macao",   
   "MG": "Madagascar",   
   "MW": "Malawi",   
   "MY": "Malaysia",   
   "MV": "Maldives",   
   "ML": "Mali",   
   "MT": "Malta",   
   "MU": "Mauritius",   
   "MX": "Mexico",   
   "MD": "Moldova",   
   "MC": "Monaco",   
   "MN": "Mongolia",   
   "MS": "Montserrat Is.",   
   "MA": "Morocco",   
   "MZ": "Mozambique",   
   "NA": "Namibia",   
   "NR": "Nauru",   
   "NP": "Nepal",   
   "NL": "Netherlands",   
   "NZ": "New Zealand",   
   "NI": "Nicaragua",   
   "NE": "Niger",   
   "NG": "Nigeria",   
   "KP": "North Korea",   
   "NO": "Norway",   
   "OM": "Oman",   
   "PK": "Pakistan",   
   "PA": "Panama",   
   "PG": "Papua New Cuinea",   
   "PY": "Paraguay",   
   "PE": "Peru",   
   "PH": "Philippines",   
   "PL": "Poland",   
   "PF": "French Polynesia",   
   "PT": "Portugal",   
   "PR": "Puerto Rico",   
   "QA": "Qatar",   
   "RO": "Romania",   
   "RU": "Russia",   
   "LC": "Saint Lueia",   
   "VC": "Saint Vincent",   
   "SM": "San Marino",   
   "ST": "Sao Tome and Principe",   
   "SA": "Saudi Arabia",   
   "SN": "Senegal",   
   "SC": "Seychelles",   
   "SL": "Sierra Leone",   
   "SG": "Singapore",   
   "SK": "Slovakia",   
   "SI": "Slovenia",   
   "SB": "Solomon Is.",   
   "SO": "Somali",   
   "ZA": "South Africa",   
   "ES": "Spain",   
   "LK": "Sri Lanka",   
   "SD": "Sudan",   
   "SR": "Suriname",   
   "SZ": "Swaziland",   
   "SE": "Sweden",   
   "CH": "Switzerland",   
   "SY": "Syria",   
   "TW": "Taiwan",   
   "TJ": "Tajikstan",   
   "TZ": "Tanzania",   
   "TH": "Thailand",   
   "TG": "Togo",   
   "TO": "Tonga",   
   "TT": "Trinidad and Tobago",   
   "TN": "Tunisia",   
   "TR": "Turkey",   
   "TM": "Turkmenistan",   
   "UG": "Uganda",   
   "UA": "Ukraine",   
   "AE": "United Arab Emirates",   
   "GB": "United Kiongdom",   
   "US": "United States of America",   
   "UY": "Uruguay",   
   "UZ": "Uzbekistan",   
   "VE": "Venezuela",   
   "VN": "Vietnam",   
   "YE": "Yemen",   
   "YU": "Yugoslavia",   
   "ZW": "Zimbabwe",   
   "ZR": "Zaire",   
   "ZM": "Zambia"  
   };