<script>
  var allOrdersString = "{{ json_encode($allOrders) }}";
  //console.log(allOrdersString);
  //alert(allOrdersString);
  allOrdersString = allOrdersString.replace(/&quot;/g,'"');
  allOrdersString = allOrdersString.replace(/""/g,'');
  //allOrdersString = allOrdersString.replace(/"/g,'');
  allOrdersString = allOrdersString.replace(/\\/g,'');
  //console.log(allOrdersString);
  //$( "body" ).data( "foo", allOrdersString);
  var parsed = JSON.parse(allOrdersString);
  console.log(parsed);
  //var parsed = JSON.parse(JSON.stringify(allOrdersString));
  alert(parsed[0]['items'][0]['name']);

  for(var i = 0 ; i < parsed[0]['items'].length ; i++){
	console.log(parsed[0]['items'][i]['name']);
  }
</script>
