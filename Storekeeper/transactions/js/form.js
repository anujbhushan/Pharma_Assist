AddRow = function(){
    

    
    var par = document.getElementById("container");
    
    var col = document.createElement("div");
    col.id="col"
    
    var med = document.createElement("input");
    med.className="m_name inp";
    med.type="text";
    med.name="Mname[]";
    med.placeholder="Enter medicine name here";
    col.appendChild(med)

    var qty = document.createElement("input");
    qty.className="m_qty";
    qty.type="number";
    qty.name="Mqty[]";
    qty.min = 1;
    col.appendChild(qty)

   par.appendChild(col);
    
}

AddOrderRow = function(){
   // var text= '<input class="m_name inp" type="text"  placeholder="Enter medicine name " >
    //<input class="m_quote inp" type="number" min=1 placeholder="Enter unit price ">
    //<input class="m_qty"  min=1 type="number"><br>'
    

    var par = document.getElementById("container");
    
    var col = document.createElement("div");
    col.id="col"
    
    var med = document.createElement("input");
    med.className="m_name inp";
    med.type="text";
    med.name="mname[]";
    med.placeholder="Enter medicine name here";
    col.appendChild(med)

    var qty = document.createElement("input");
    qty.className="m_quote inp";
    qty.type="number";
    qty.name="price[]";
    qty.min = 1;
    col.appendChild(qty)

    var qty = document.createElement("input");
    qty.className="m_qty";
    qty.type="number";
    qty.name="qty[]";
    qty.min = 1;
    col.appendChild(qty)

   par.appendChild(col);
}

function getMed(){
    alert("working")
}

