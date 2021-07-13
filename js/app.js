// Listen for submit

document.getElementById("loan-form").addEventListener("submit", computeResults);

function computeResults(e) {
  // UI

  const UIamount = document.getElementById("amount").value;
  const UIselling = document.getElementById("selling").value;
  const UIresource = document.getElementById("resource").value;
  const UIlabour = document.getElementById("labour").value;

  //Calculate Profits
  const growthCosts = parseFloat(UIresource) + parseFloat(UIlabour);
  const totalSales = parseFloat(UIamount) * parseFloat(UIselling);
  const totalProft = totalSales - growthCosts;
  const profitMargin = (totalProft/totalSales) * 100;
  const markup = ((totalSales - growthCosts) / growthCosts) * 100;
  
  //Show results

  document.getElementById("sales").innerHTML = "$" + totalSales.toFixed(2);

  document.getElementById("profit").innerHTML = "$" + totalProft.toFixed(2);

  document.getElementById("profitMargin").innerHTML = profitMargin.toFixed(2) + "%";

  document.getElementById("markup").innerHTML = markup.toFixed(2) + "%";

  e.preventDefault();
}
