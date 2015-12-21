
var request = require('request')

var url = 'http://localhost/social-networks-final/index.php?r=space%2Fadmin%2Fbanner-image-upload&sguid=79bba48e-5f14-4691-bde2-e23c1939c2ef'

request.post({
  url: url,
  formData: {
    'bannerFiles[]': request('https://upload.wikimedia.org/wikipedia/en/f/f1/HELLO!!!!!.png')
  }
}, function (err, res, body) {
  // console.log(err)
  console.log(res)
  // console.log(body)
})
