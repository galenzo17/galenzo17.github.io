function load() {
    //alert("evento load detectado!");
    fetch ('orders.xml')
    .then(response => response.text())
  .then(str => (new window.DOMParser()).parseFromString(str, "text/xml"))
  .then(data => console.log(data));

    
  }
  window.onload = load;