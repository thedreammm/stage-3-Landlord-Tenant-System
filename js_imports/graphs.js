function loadGraph(){
    thechart = new Chart(document.getElementById("lineGraph"), document.getElementById("graph1"));
    thechart.requestData(false);
}

class Chart {
    constructor(graph, viewbox){
        this.bufferX1 = 60;
        this.bufferX2 = 35;
        this.minX = 999999999;
        this.maxX = -999999999;
        this.xData = [];

        this.bufferY1 = 30;
        this.bufferY2 = 15;
        this.minY = 999999999;
        this.maxY = -999999999;
        this.yData = [];

        this.scaleX = 1;
        this.scaleY = 1;
        try{
            this.months = parseInt(document.getElementById("duration").value);
        }
        catch{
            this.months = 1;
        }
        this.dates = [];

        this.graph = graph;
        this.viewbox = viewbox;
        this.height = viewbox.clientHeight;
        this.width = viewbox.clientWidth;
        this.graphHeight = 800;
        this.graphWidth = 800;

        try{
            this.property_id = document.getElementById("property_id").value;
        }
        catch{
            this.property_id = false;
        }
        this.tenant_id = false;
    }

    requestData(params){
        var post_vars = "";
        var present = presentDay;
        var past = new GraphDate(presentDay, this.months);
        this.dates[0] = past;
        this.dates[1] = present;
        post_vars += "past=" + past.formatDate() + "&present=" + present.formatDate();

        if(this.property_id){ post_vars += "&property_id=" + this.property_id; }

        var filename = "../php_imports/load_graph.php";

        var Request = null;
        if(window.XMLHttpRequest){
            Request = new XMLHttpRequest();
        }
        else if(window.ActiveXObject){
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        }

        console.log(filename);
        console.log(post_vars);
        Request.responseType = 'json';
        Request.open("POST",filename);
        Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        Request.onreadystatechange = function(){
            if(Request.readyState == 4 && Request.status == 200){
                console.log(Request.response);
                var x;
                var y;
                var prev = -1;
                var latest = false;
                if(Request.response.length != 0){
                    for(var i = 0; i < Request.response.length; i++){
                        x = thechart.dateToX(thechart.dates[0], Request.response[i].date_due);
                        y = parseInt(Request.response[i].cost);
                        if( (prev != -1) && (x == thechart.xData[prev])){
                            thechart.yData[prev] += y;
                        }
                        else{
                            //console.log(i, x);
                            prev = thechart.xData.length;
                            thechart.xData.push(x);
                            thechart.yData.push(y);
                            
                            //console.log(thechart.xData);
                            
                            if(prev){
                                latest = thechart.xData.length - 2;
                                if(thechart.xData[latest] < thechart.minX){
                                    thechart.minX = thechart.xData[latest];
                                }
                                if(thechart.xData[latest] > thechart.maxX){
                                    thechart.maxX = thechart.xData[latest];
                                }
                                if(thechart.yData[latest] < thechart.minY){
                                    thechart.minY = thechart.yData[latest];
                                }
                                if(thechart.yData[latest] > thechart.maxY){
                                    thechart.maxY = thechart.yData[latest];
                                }
                            }
                        }
                    }
                    latest = thechart.xData.length - 1;
                    if(thechart.xData[latest] < thechart.minX){
                        thechart.minX = thechart.xData[latest];
                    }
                    if(thechart.xData[latest] > thechart.maxX){
                        thechart.maxX = thechart.xData[latest];
                    }
                    if(thechart.yData[latest] < thechart.minY){
                        thechart.minY = thechart.yData[latest];
                    }
                    if(thechart.yData[latest] > thechart.maxY){
                        thechart.maxY = thechart.yData[latest];
                    }
                }

                if(thechart.minY == 999999999){
                    thechart.maxY = 100;
                    thechart.minY = 0;
                }
                
                if(thechart.maxY - thechart.minY == 0){
                    thechart.maxY = thechart.minY + 100;
                }
                thechart.findScaleY();
                let scaleX = thechart.findScaleX();
                if(scaleX){ thechart.scaleX = scaleX; }
                thechart.graph.innerHTML = "";
                thechart.drawAxis();
                thechart.drawLine();
            }
        }
        Request.send(post_vars);
    }

    findScaleX(){
        switch(this.months){
            case 1:
                return 22;
            case 3:
                return 36;
            case 12:
                return 58;
            default:
                return false;
        }
    }

    dateToX(past_date, date) {
        switch(this.months){
            case 1:
                return parseInt(date.substr(8,9));
                break;
            case 3:
                var month = parseInt(date.substr(5,6));
                var day = parseInt(date.substr(8,9));
                var week = 0;
                var totalDays = 0;
                for(var i = past_date.month; i < month; i++){
                    totalDays += past_date.numDays[i];
                }
                totalDays += day;
                week = Math.ceil(totalDays / 7);
                return week;
                break;
            case 12:
                return parseInt(date.substr(5,6));
                break;
            default:
                return false;
                break;
            };
        return false;
    }

    getX(x){
        let tempX = x;
        tempX *= this.scaleX;
        tempX += this.minX + (this.bufferX1 + this.bufferX2);
        return tempX;
    }
    getY(y){
        let tempY = y;
        tempY -= this.minY;
        tempY *= this.scaleY;
        tempY = (this.height - (this.bufferY1 + this.bufferY2)) - tempY;
        return tempY;
    }

    findScaleY(){
        //console.log(this.minY, this.maxY);
        let tens = parseInt(this.maxY.toString().length);
        this.maxY = Math.ceil((this.maxY / Math.max(tens-1,1)) + 1) * (tens-1);
        tens = parseInt(this.minY.toString().length);
        this.minY = Math.floor((this.minY / Math.max(tens-1,1)) - 1 ) * (tens-1);
        //console.log(this.minY, this.maxY);

        this.scaleY = (thechart.graphHeight - (thechart.bufferY1 + thechart.bufferY2) ) / (thechart.maxY - thechart.minY);
    }

    drawAxis(){
        let addPath = "";
        addPath += '<path d="M' + (this.bufferX1+this.bufferX2) + ',' + (this.height - (this.bufferY1+this.bufferY2)) + 'v' + (this.graphHeight*-1);
        addPath += ' M' + (this.bufferX1+this.bufferX2) + ',' + (this.height - (this.bufferY1+this.bufferY2)) + ' h' + this.graphWidth + '"></path>';
        this.graph.innerHTML += addPath;
        let xRange = this.maxX - this.minX;
        let yRange = this.maxY - this.minY;
        if(yRange == 0){
            yRange = 10;
        }
        
        let limit = 0;
        switch(this.months){
            case 1:
                limit = 31;
                this.graph.innerHTML += '<text x="' + (this.bufferX1 + this.bufferX2 + Math.floor((this.graphWidth)/2)) + '" y="' + (this.height-3) + '" fill="black">' + "Days" + '</text>';
                break;
            case 3:
                limit = 19;
                this.graph.innerHTML += '<text x="' + (this.bufferX1 + this.bufferX2 + Math.floor((this.graphWidth)/2)) + '" y="' + (this.height-3) + '" fill="black">' + "Weeks" + '</text>';
                break;
            case 12:
                limit = 12;
                this.graph.innerHTML += '<text x="' + (this.bufferX1 + this.bufferX2 + Math.floor((this.graphWidth)/2)) + '" y="' + (this.height-3) + '" fill="black">' + "Months" + '</text>';
                break;
        }
        this.graph.innerHTML += '<text x="' + (this.bufferX1) + '" y="' + (this.height-3) + '" fill="black">' + this.dates[0].formatDate() + '<</text>';
        this.graph.innerHTML += '<text x="' + (this.bufferX1 + Math.floor((this.graphWidth))) + '" y="' + (this.height-3) + '" fill="black"><' + this.dates[1].formatDate() + '</text>';
        this.graph.innerHTML += '<text x="' + 0 + '" y="' + (this.height - Math.floor((this.graphHeight+100) / 2)) + '" fill="black">' + "Cost /£" + '</text>';
        //console.log(this.scaleX);
        //console.log(limit);
        for(var i = 0; i <= limit; i++){
            this.graph.innerHTML += '<text x="' + (this.bufferX1 + this.bufferX2 + Math.floor(this.scaleX*i)) + '" y="' + (this.height - this.bufferY1) + '" fill="black">' + i + '</text>';
        }
        for(var i = 0; i <= 10; i++){
            this.graph.innerHTML += '<text x="' + this.bufferX1 + '" y="' + (this.height - this.bufferY1 - this.bufferY2 - Math.floor((this.graphHeight/10)*i)) + '" fill="black">' + Math.floor(this.minY+((yRange/10)*i)) + '</text>';
        }
    }

    drawLine(){
        var addPath = "";
        let x;
        let y;
        x = this.getX(this.xData[0]);
        y = this.getY(this.yData[0]);
        
        addPath  += '<path d="M' + x + ',' + y;
        for(var i = 0; i < this.xData.length; i++){
            x = this.getX(this.xData[i]);
            y = this.getY(this.yData[i]);
            //console.log(this.xData[i], this.yData[i]);
            //console.log(x, y);
            addPath  += ' L' + x + ',' + y;
        }
        addPath += '"></path>';
        this.graph.innerHTML += addPath;
    }
}

function updatePropertyId(element){
    loadGraph();
    //thechart.property_id = element.value;
}

function updateDuration(element){
    loadGraph();
}

function changePresent(amount){
    try{
        var diff = thechart.months * amount;
        presentDay.subtractMonths(diff);
    }
    catch{
        presentDay = new GraphDate(false);
    }
    return;
}

class GraphDate {
    constructor(otherDate, diff){
        this.numDays = [31,28,31,30,31,30,31,31,30,31,30,31];
        
        if(otherDate){
            this.day = otherDate.day;
            this.month = otherDate.month;
            this.year = otherDate.year;
        }
        else{
            let dateObj = new Date(Date.now());
            this.day = dateObj.getDate();
            this.month = dateObj.getMonth();
            this.year = dateObj.getFullYear();
            this.month += 1;
        }
        console.log(this.year, this.month, this.day);
        if(this.year % 4 == 0 && (this.year % 100 != 0 || this.year % 400 == 0)){
            this.numDays[1] = 29;
        }
        if(diff){
            if(diff == 12){
                this.month = 1;
            }
            else{
                diff -= 1;
                this.month = Math.max(this.month-diff, 1);
            }
            this.day = 1;
        }
    }

    formatDate(){
        var strDay = this.day.toString();
        if(this.day < 10){
            strDay = "0" + strDay;
        }
        var strMonth = this.month.toString();
        if(this.month < 10){
            strMonth = "0" + strMonth;
        }
        var strYear = this.year.toString();
        return strYear + '-' + strMonth + '-' + strDay;
    }

    subtractMonths(diff){
        console.log(diff);
        this.month += diff;
        let notFinished = true;
        if(diff == -12){
            this.year -= 1;
            this.month = 12;
        }
        else{
            while(notFinished){
                console.log(notFinished);
                if(this.month < 1){
                    console.log("<");
                    console.log(this.formatDate());
                    this.year -= 1;
                    this.month = 12+this.month;
                }
                else if(this.month > 12){
                    console.log(">");
                    console.log(this.formatDate());
                    this.year += 1;
                    this.month = this.month-12;
                }
                else{
                    notFinished = false;
                }
            }
        }
        this.day = this.numDays[this.month-1];
        console.log(this.formatDate());
    }
}

var thechart;
var presentDay = new GraphDate(false);