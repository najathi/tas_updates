function viewData() {
  var passanger = document.getElementById('p_name').value;
  var fromT = document.getElementById('from_to').value;
  var depart = document.getElementById('depart_date').value;
  var ticketno = document.getElementById('ticket_no').value;
  var totalF = document.getElementById('net_due').value;

  document.getElementById('pass').innerHTML = passanger;
  document.getElementById('frTo').innerHTML = fromT;
  document.getElementById('dept').innerHTML = depart;
  document.getElementById('ticket').innerHTML = ticketno;
  document.getElementById('tFare').innerHTML = totalF;
}