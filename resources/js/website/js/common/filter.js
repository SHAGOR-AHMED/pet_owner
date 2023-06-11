import Vue from 'vue';

Vue.filter('subString', function(content, length){
  return content.substring(0, length);
});

Vue.filter('currencyConverter', function (amount, currency='৳ ') {
  if (!amount) return ''
  var value = (amount).toLocaleString(
      undefined,
      { minimumFractionDigits: 2 }
  );
  return currency + value;
})