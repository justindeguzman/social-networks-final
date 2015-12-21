
var request = require('request')
var _ = require('lodash')

function fetchPictures (cb) {
  var url = 'https://a.tiles.mapbox.com/v4/oo.kbip7077/features.json?access_token=pk.eyJ1Ijoib28iLCJhIjoiWXFoMHRIWSJ9.ZdI5DZEZ0qE6J0IcsR3w1w'

  request({url: url, json: true},
    function (err, res, body) {
      if (err) {
        cb(err, null)
      } else {
        var arr = _(body.features)
          .pluck('properties')
          .filter(function (node) {
            return node.description.indexOf('jpg') > -1
          })
          .value()

        arr = _.map(arr, _.partialRight(_.pick, 'title', 'description'))

        for (var i = 0; i < arr.length; i++) {
          arr[i].picture = findUrls(arr[i].description)[0]
          delete arr[i].description
        }

        var a = []

        for (var j = 0; j < arr.length; j++) {
          var node = arr[j].title.match(/\d/g)

          if (node) {
            arr[j].node = node.join('')
            delete arr[j].title
            a.push(arr[j])
          }
        }

        console.log(a)
      }
    }
  )
}

/**
 * http://stackoverflow.com/questions/4504853/how-do-i-extract-a-url-from-plain-text-using-jquery
 * A utility function to find all URLs - FTP, HTTP(S) and Email - in a text string
 * and return them in an array.  Note, the URLs returned are exactly as found in the text.
 *
 * @param text
 *            the text to be searched.
 * @return an array of URLs.
 */
function findUrls (text) {
  var source = (text || '').toString()
  var urlArray = []
  var matchArray

  // Regular expression to find FTP, HTTP(S) and email URLs.
  var regexToken = /(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g

  // Iterate through any URLs in the text.
  while ((matchArray = regexToken.exec(source)) !== null) {
    var token = matchArray[0]
    urlArray.push(token)
  }

  return urlArray
}

fetchPictures()
