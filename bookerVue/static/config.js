var url = 'http://localhost/booker/bookerRest/server/api/'
//var url = 'http://192.168.0.15/~user7/bookerRest/server/api/'
var axConf = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
    }
}
//Get connection http
function getUrl() {
    return url
}
//Get the order of days of the week
function getWeekDays(str){
    if (str == 'sun')
    {
        return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
    }
    else if (str == 'mon')
    {
        return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
    }
}

//Get month
function getNameMonth(){
//function getNameMonth(str){
//    if (str == 'en')
//    {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
         'October', 'November', 'December']
//    }
}
