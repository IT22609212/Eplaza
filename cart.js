

function displayTotal1() {
  var num1 = parseInt(document.getElementById("num1").value);
  var sum1 = num1 * 5000;
  document.getElementById("result1").textContent = "Rs: " + sum1;
  return sum1; // Return the calculated value
}

function displayTotal2() {
  var num2 = parseInt(document.getElementById("num2").value);
  var sum2 = num2 * 10000;
  document.getElementById("result2").textContent = "Rs: " + sum2;
  return sum2; // Return the calculated value
}

function displayTotal() {
  var total = displayTotal1() + displayTotal2();
  document.getElementById("subtotal").textContent = "Rs: " + total;
}
