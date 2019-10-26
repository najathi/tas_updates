//Total Tax[YQ, YR, Tax - 3, Tax - 4]

var basicc = [];
var yq = [];
var yr = [];
var tax_3 = [];
var tax_4 = [];
var total_tax = [];
var supp_charge = [];
var service_amt = [];
var net_profit = [];
var net_due = [];
var net_to_supplier = [];

/* var basicc = $("input[name='basicc[]']").map(function () { return $(obj).val(); }).get();
var yq = $("input[name='yq[]']").map(function () { return $(obj).val(); }).get();
var yr = $("input[name='yr[]']").map(function () { return $(obj).val(); }).get();
var tax_3 = $("input[name='tax_3[]']").map(function () { return $(obj).val(); }).get();
var tax_4 = $("input[name='tax_4[]']").map(function () { return $(obj).val(); }).get();
var total_tax = $("input[name='total_tax[]']").map(function () { return $(obj).val(); }).get();
var supp_charge = $("input[name='supp_charge[]']").map(function () { return $(obj).val(); }).get();
var service_amt = $("input[name='service_amt[]']").map(function () { return $(obj).val(); }).get();
var net_profit = $("input[name='net_profit[]']").map(function () { return $(obj).val(); }).get();
var net_due = $("input[name='net_due[]']").map(function () { return $(obj).val(); }).get();
var net_to_supplier = $("input[name='net_to_supplier[]']").map(function () { return $(obj).val(); }).get(); */

function calc() {

  //var arrCount = document.getElementsByName('p_name[]').length;
  var arrCount = $('input[name="p_name[]"]').length;
  //var arrCount = jQuery('input[name="p_name[]"]').length;

  for (let i = 0; i < arrCount; i++) {

    basicc[i] = Number(document.getElementById('basicc' + i).value);
    yq[i] = Number(document.getElementById('yq' + i).value);
    yr[i] = Number(document.getElementById('yr' + i).value);
    tax_3[i] = Number(document.getElementById('tax_3' + i).value);
    tax_4[i] = Number(document.getElementById('tax_4' + i).value);
    total_tax[i] = Number(document.getElementById('total_tax' + i).value);
    supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
    service_amt[i] = Number(document.getElementById('service_amt' + i).value);
    net_profit = Number(document.getElementById('net_profit' + i).value);
    net_due[i] = Number(document.getElementById('net_due' + i).value);
    net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);

    /* var e = obj.id.toString();

    if (e == 'basicc' + i) {
      basicc[i] = Number(obj.value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'yq' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(obj.value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'yr' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(obj.value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'tax_3' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(obj.value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'tax_4' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(obj.value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'total_tax' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(obj.value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'supp_charge' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(obj.value);
      service_amt[i] = Number(document.getElementById('service_amt' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'service_amt' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(obj.value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'net_profit' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('net_profit' + i).value);
      net_profit[i] = Number(obj.value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'net_due' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('net_profit' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(obj.value);
      net_to_supplier[i] = Number(document.getElementById('net_to_supplier' + i).value);
    }
    else if (e == 'net_to_supplier' + i) {
      basicc[i] = Number(document.getElementById('basicc' + i).value);
      yq[i] = Number(document.getElementById('yq' + i).value);
      yr[i] = Number(document.getElementById('yr' + i).value);
      tax_3[i] = Number(document.getElementById('tax_3' + i).value);
      tax_4[i] = Number(document.getElementById('tax_4' + i).value);
      total_tax[i] = Number(document.getElementById('total_tax' + i).value);
      supp_charge[i] = Number(document.getElementById('supp_charge' + i).value);
      service_amt[i] = Number(document.getElementById('net_profit' + i).value);
      net_profit[i] = Number(document.getElementById('net_profit' + i).value);
      net_due[i] = Number(document.getElementById('net_due' + i).value);
      net_to_supplier[i] = Number(obj.value);
    } */

    // Total Tax
    total_tax[i] = Number(yq[i] + yr[i] + tax_3[i] + tax_4[i]);
    document.getElementById('total_tax' + i).value = total_tax[i].toFixed(2);

    // Net to Supply (Basic + all taxes + Supp Charge = (Net to Supp))
    net_to_supplier[i] = Number(basicc[i] + (yq[i] + yr[i] + tax_3[i] + tax_4[i]) + supp_charge[i]);
    document.getElementById('net_to_supplier' + i).value = net_to_supplier[i].toFixed(2);

    // Basic + all taxes + Supp charge + Service amt = (Net Due)
    net_due[i] = Number(basicc[i] + (yq[i] + yr[i] + tax_3[i] + tax_4[i]) + supp_charge[i] + service_amt[i]);
    document.getElementById('net_due' + i).value = net_due[i].toFixed(2);

    // Net Due - Net to Supp = (Net Earning / Net Profit)
    net_profit[i] = Number(net_due[i] - net_to_supplier[i]);
    document.getElementById('net_profit' + i).value = Number(net_profit[i].toFixed(2));

  }

}
