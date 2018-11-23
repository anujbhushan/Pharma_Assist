function createAlerts(){
    // need to check stock table
    // need to check order track table
    // need to show orders delivered
}



var obj = {
    stockAlerts: function(count){
        var par= document.getElementById("alerts");
        var alt = document.createElement("a");
        alt.className = "list-group-item notif";
        alt.innerHTML = count+" Meds Out of Stock";
        alt.href="/transactions/outOfStock.php";
        console.log("alert function!")
        par.appendChild(alt);
    },
    orderAlerts: function(orders){
        var ord = JSON.parse(orders)
        var len = ord.length;
        var par= document.getElementById("alerts");
        
        for(var i=0;i<len;i++)
        {    
            var alt = document.createElement("a");
            alt.className = "list-group-item notif";
            alt.innerHTML = ord[i]+" Order in Transit";
            alt.href="/transactions/trackOrder.php";
            
            par.appendChild(alt);
        }
    },
    recAlerts: function(orders){
        var ord = JSON.parse(orders)
        var len = ord.length;
        var par= document.getElementById("alerts");
        
        for(var i=0;i<len;i++)
        {    
            var alt = document.createElement("a");
            alt.className = "list-group-item notif";
            alt.innerHTML = ord[i]+" Order delivered";
            alt.href="/transactions/prevOrder.php";
            
            par.appendChild(alt);
        }
    }
}