<INPUT type="button" value="Add Invoice Item" onclick="addRow('dataTable')" />
<INPUT type="button" value="Delete Item(s)" onclick="deleteRow('dataTable')" />

<form action="" method="post" enctype="multipart/form-data">

  <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;">
    <TR>
      <TH>
        <INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
      </TH>
      <TH>Quanity</TH>
      <TH>Item</TH>
      <TH>Unit Cost</TH>
      <TH formula="cost*qty" summary="sum">Price</TH>
    </TR>
    <TR>
      <TD>
        <INPUT type="checkbox" name="chk[]">
      </TD>
      <TD>
        <INPUT type="text" id="qty1" name="qty[]" onchange="totalIt()"> </TD>
      <TD>
        <INPUT type="text" id="item1" name="item[]"> </TD>
      <TD>
        <INPUT type="text" id="cost1" name="cost[]" onchange="totalIt()"> </TD>
      <TD>
        <INPUT type="text" id="price1" name="price[]" readonly="readonly" value="0.00"> </TD>
    </TR>
  </TABLE>
</form>
Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">

<!-------JAVASCRIPT--------->
<script>
  function calc(idx) {
    var price = parseFloat(document.getElementById("cost" + idx).value) *
      parseFloat(document.getElementById("qty" + idx).value);
    //alert(idx+":"+price);  
    document.getElementById("price" + idx).value = isNaN(price) ? "0.00" : price.toFixed(2);
    //document.getElementById("total") = totalIt;
  }

  function totalIt() {
    var qtys = document.getElementsByName("qty[]");
    var total = 0;
    for (var i = 1; i <= qtys.length; i++) {
      calc(i);
      var price = parseFloat(document.getElementById("price" + i).value);
      total += isNaN(price) ? 0 : price;
    }
    document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
  }

  window.onload = function() {
    document.getElementsByName("qty[]")[0].onkeyup = function() {
      calc(1)
    };
    document.getElementsByName("cost[]")[0].onkeyup = function() {
      calc(1)
    };
  }

  var rowCount = 0;

  function addRow(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "checkbox";
    element1.name = "chk[]";
    cell1.appendChild(element1);

    var cell3 = row.insertCell(1);
    var element3 = document.createElement("input");
    element3.type = "text";
    element3.name = "qty[]";
    element3.id = "qty" + rowCount;
    element3.onkeyup = totalIt;
    cell3.appendChild(element3);

    var cell4 = row.insertCell(2);
    var element4 = document.createElement("input");
    element4.type = "text";
    element4.name = "item[]";
    element4.id = "item" + rowCount;
    cell4.appendChild(element4);

    var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "cost[]";
    element5.id = "cost" + rowCount;
    element5.onkeyup = totalIt;
    cell5.appendChild(element5);

    var cell6 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "text";
    element6.name = "price[]";
    element6.id = "price" + rowCount;
    element6.value = "0.00";
    $(element6).attr("readonly", "true");
    cell6.appendChild(element6);

  }

  function deleteRow(tableID) {
    try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      document.getElementById("select-all").checked = false;

      for (var i = 1; i < rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null != chkbox && true == chkbox.checked) {
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
    } catch (e) {
      alert(e);
    }
  }

</script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script>
  $("input").blur(function() {
    if ($(this).attr("data-selected-all")) {
      //Remove atribute to allow select all again on focus        
      $(this).removeAttr("data-selected-all");
    }
  });
  
   $("input").click(function() {
    if (!$(this).attr("data-selected-all")) {
      try {
        $(this).selectionStart = 0;
        $(this).selectionEnd = $(this).value.length + 1;
        //add atribute allowing normal selecting post focus
        $(this).attr("data-selected-all", true);
      } catch (err) {
        $(this).select();
        //add atribute allowing normal selecting post focus
        $(this).attr("data-selected-all", true);
      }
    }
  });

  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
        checkboxes[i].checked = source.checked;
    }
  }

</script>